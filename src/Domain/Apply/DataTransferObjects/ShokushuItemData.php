<?php

namespace Domain\Apply\DataTransferObjects;

use Domain\Apply\Models\ShokushuItem;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class ShokushuItemData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly int $snum,
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(ShokushuItem $shokushuItem): self
    {
        return self::from([
            ...$shokushuItem->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'snum' => ['required', 'int'],
        ];
    }
}
