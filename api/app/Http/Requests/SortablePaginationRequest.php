<?php

namespace App\Http\Requests;

use App\Rules\SortByParam;
use Illuminate\Foundation\Http\FormRequest;

abstract class SortablePaginationRequest extends FormRequest
{
    /** @return string[] */
    abstract public function sortableColumns(): array;

    const SORT_BY_PARAM = 'sortBy';

    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'perPage' => ['nullable', 'integer', 'min:1', 'max:100'],
            self::SORT_BY_PARAM => ['nullable', 'string', new SortByParam($this->sortableColumns())],
        ];
    }

    public function getPage(): int
    {
        return $this->query('page', 1);
    }

    public function getPerPage(): int
    {
        return $this->query('perPage', 10);
    }

    /**
     * @return array<SortBy>|null
     */
    public function getSortBy(): array|null
    {
        if (!$this->has(SortablePaginationRequest::SORT_BY_PARAM)) return null;
        $rawSortByList = explode(',', trim($this->get(SortablePaginationRequest::SORT_BY_PARAM)));
        if (empty($rawSortByList)) return null;
        /** @var array<SortBy> */
        return array_reduce($rawSortByList, function ($acc, $item) {
            $sortPair = explode(':', trim($item));
            if (empty($sortPair[0])) return $acc;
            return [...$acc, new SortBy(col: trim($sortPair[0]), dir: trim($sortPair[1] ?? 'asc'))];
        }, []);
    }
}
