<?php

namespace Domain\Apply\DataTransferObjects;

use Domain\Apply\Models\Entry;
use Domain\Apply\Models\Company;
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
        public readonly null|Lazy|Company|array $company
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(Entry $entry): self
    {
        return self::from([
            ...$entry->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'mail' => ['required', 'string'],
            'company_id' => ['sometimes', 'int', 'exists:companies,id'],
        ];
    }
}
