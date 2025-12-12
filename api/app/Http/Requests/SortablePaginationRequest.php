<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read { col: string, dir: 'asc'|'desc'}sortBy
 */
abstract class SortablePaginationRequest extends FormRequest
{
    /** @return array<string, string> */
    abstract public function sortableColumns(): array;

    const SORT_BY_PARAM = 'sortBy';

    protected function prepareForValidation(): void
    {
        if (!$this->has(SortablePaginationRequest::SORT_BY_PARAM)) {
            return;
        }
        $rawSortByList = explode(',', trim($this->get(SortablePaginationRequest::SORT_BY_PARAM)));
        $parsedSortByList = array_reduce($rawSortByList, function ($acc, $item) {
            $sortPair = explode(':', trim($item));
            if (empty($sortPair[0])) return $acc;
            return [...$acc, ["col" => trim($sortPair[0]), "dir" => trim($sortPair[1] ?? 'asc')]];
        }, []);
        $this->merge([SortablePaginationRequest::SORT_BY_PARAM => $parsedSortByList]);
    }

    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'perPage' => ['nullable', 'integer', 'min:1', 'max:100'],
            SortablePaginationRequest::SORT_BY_PARAM . '.*.col' => ['nullable', 'in:' . implode(',', $this->sortableColumns())],
            SortablePaginationRequest::SORT_BY_PARAM . '.*.dir' => ['nullable', 'in:' . implode(',', ['asc', 'desc'])],
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
        return array_map(fn($it) => new SortBy($it['col'], $it['dir']), $this->query(SortablePaginationRequest::SORT_BY_PARAM, []));
    }
}
