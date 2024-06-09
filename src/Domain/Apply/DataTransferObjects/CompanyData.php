<?php

namespace Domain\Apply\DataTransferObjects;

use Domain\Apply\Models\Company;
use Domain\Shared\Models\User;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class CompanyData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $address,
        public readonly null|Lazy|User|array $user
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(Company $company): self
    {
        return self::from([
            ...$company->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'user_id' => ['sometimes', 'int', 'exists:users,id'],
        ];
    }
}
