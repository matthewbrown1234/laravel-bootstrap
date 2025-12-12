<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SortByParam implements ValidationRule
{
    /**
     * @param array<string> $allowColumns
     */
    public function __construct(public array $allowColumns)
    {
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === '' || $value === null) {
            return;
        }
        if (!is_string($value)) {
            $fail($attribute . ' must be a string.');
            return;
        }
        $rawSortByList = explode(',', trim($value));
        foreach ($rawSortByList as $item) {
            $sortPair = explode(':', trim($item));
            if (empty($sortPair[0])) {
                continue;
            }
            if (!in_array($sortPair[0], $this->allowColumns, true)) {
                $fail($attribute . ' contains invalid column name.');
                return;
            }
            if (!empty($sortPair[1]) && !in_array($sortPair[1], ['asc', 'desc'], true)) {
                $fail($attribute . ' contains invalid sort direction.');
                return;
            }
        }
    }
}
