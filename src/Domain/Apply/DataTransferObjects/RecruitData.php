<?php

namespace Domain\Apply\DataTransferObjects;

use Carbon\Carbon;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Prefecture;
use Domain\Apply\Models\Recruit;
use Domain\Apply\Models\ShokushuItem;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class RecruitData extends Data
{
	public function __construct(
		public readonly ?int $id,
		public readonly string $title,
		public readonly string $description,
		public readonly string $start_date,
		public readonly string $end_date,
		public readonly null|Lazy|CompanyData $company,
		public readonly null|Lazy|PrefectureData $prefecture,
		public readonly null|Lazy|DataCollection|ShokushuItemData $shokushuItems,
        public readonly null|string $url_image
	) {
	}

	public static function fromRequest(Request $request): self
	{
		return self::from([
			...$request->all(),
			'company' => CompanyData::from(Company::findOrFail($request->company_id)),
			'prefecture' => PrefectureData::from(Prefecture::findOrFail($request->prefecture_id)),
			'shokushuItems' => ShokushuItemData::collect($request->shokushu_items)
		]);
	}

	public static function fromModel(Recruit $recruit): self
	{
        $media = $recruit->getMedia('product-images');
		$url = $media[0]->getTemporaryUrl(Carbon::now()->addMinutes(5));

		return self::from([
			...$recruit->toArray(),
			'company' => Lazy::whenLoaded('company', $recruit, fn () => CompanyData::from($recruit->company)),
			'prefecture' => Lazy::whenLoaded('prefecture', $recruit, fn () => PrefectureData::from($recruit->prefecture)),
			'shokushuItems' => Lazy::whenLoaded('shokushuItems', $recruit, fn () =>
				ShokushuItemData::collect($recruit->shokushuItems)
			),
            'url_image' => $url,
		]);
	}

	public static function rules(): array
	{
		return [
			'title' => ['required', 'string'],
			'description' => ['required', 'string'],
			'company_id' => ['sometimes', 'int', 'exists:companies,id'],
			'prefecture_id' => ['sometimes', 'int', 'exists:prefectures,id'],
			'shokushu_items' => ['required', 'array']
		];
	}
}
