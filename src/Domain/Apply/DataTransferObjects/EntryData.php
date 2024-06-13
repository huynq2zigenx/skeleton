<?php

namespace Domain\Apply\DataTransferObjects;

use Domain\Apply\Models\Company;
use Domain\Apply\Models\Entry;
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
        public readonly null|Lazy|CompanyData|array $company
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
			'company' => CompanyData::from(Company::findOrFail($request->company_id)),
        ]);
    }

    public static function fromModel(Entry $entry): self
    {
        return self::from([
            ...$entry->toArray(),
			'company' => Lazy::whenLoaded('company', $entry, fn() => CompanyData::from($entry->company)),
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
