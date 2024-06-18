<?php

namespace Domain\Apply\DataTransferObjects;

use Domain\Apply\Models\Company;
use Domain\Apply\Models\Entry;
use Domain\Apply\Models\Recruit;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
class EntryData extends Data
{
	public function __construct(
        public readonly ?int $id,
        public readonly string $first_name,
        public readonly string $last_name,
		public readonly string $phone,
        public readonly string $email,
        public readonly null|Lazy|CompanyData|array $company,
        public readonly null|Lazy|RecruitData|array $recruit
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
			'company' => CompanyData::from(Company::findOrFail($request->company_id)),
			'recruit' => RecruitData::from(Recruit::findOrFail($request->recruit_id)),
        ]);
    }

    public static function fromModel(Entry $entry): self
    {
        return self::from([
            ...$entry->toArray(),
			'company' => Lazy::whenLoaded('company', $entry, fn() => CompanyData::from($entry->company)),
			'recruit' => Lazy::whenLoaded('recruit', $entry, fn() => RecruitData::from($entry->recruit)),
        ]);
    }

    public static function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'digits:10'],
            'email' => ['required', 'string', 'email'],
            'company_id' => ['sometimes', 'int', 'exists:companies,id'],
        ];
    }
}
