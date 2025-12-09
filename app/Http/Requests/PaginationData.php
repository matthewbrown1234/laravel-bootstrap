<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

final readonly class PaginationData
{
    public function __construct(
        public int $page,
        public int $perPage,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $perPage = max(1, min(100, $request->integer('per_page', 50)));
        $page = max(1, $request->integer('page', 1));

        return new self(page: $page, perPage: $perPage);
    }
}
