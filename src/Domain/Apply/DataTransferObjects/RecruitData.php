<?php

namespace Domain\Apply\DataTransferObjects;

use Domain\Apply\Models\Company;
use Domain\Apply\Models\Recruit;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
class RecruitData extends Data
{
	public function __construct(
        public readonly ?int $id,
        public readonly string $title,
        public readonly string $description,
		public readonly string $start_date,
        public readonly string $end_date,
        public readonly null|Lazy|Company|array $company
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(Recruit $recruit): self
    {
        return self::from([
            ...$recruit->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'company_id' => ['sometimes', 'int', 'exists:companies,id'],
        ];
    }
}
