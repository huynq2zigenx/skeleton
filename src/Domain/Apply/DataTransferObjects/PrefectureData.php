<?php

namespace Domain\Apply\DataTransferObjects;

use Domain\Apply\Models\Prefecture;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class PrefectureData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $area_name,
        public readonly int $cnt,
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(Prefecture $prefecture): self
    {
        return self::from([
            ...$prefecture->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'area_name' => ['required', 'string'],
        ];
    }
}
