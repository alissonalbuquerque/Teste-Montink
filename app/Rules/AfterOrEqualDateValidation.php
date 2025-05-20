<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterOrEqualDateValidation implements ValidationRule
{
    protected Carbon $date;
    protected string $dateFormatted;

    public function __construct(string $date)
    {
        $this->date = Carbon::parse($date);
        $this->dateFormatted = $this->date->format('d/m/Y');
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $inputDate = Carbon::parse($value);

            if ($inputDate->lessThan($this->date)) {
                $fail("O campo :attribute deve ser uma data igual ou maior que {$this->dateFormatted}.");
            }
        } catch (\Exception $e) {
            $fail("O campo :attribute não contém uma data válida.");
        }
    }

    public static function create(string $date) {
        return new self($date);
    }
}