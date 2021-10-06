<?php

namespace Mobin\PinPolicy\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsPinConsecutive implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $value = str_split($value);
        $result = true;
        for($i = 0; $i < 4; $i++){
            if(isset($value[$i+1])){
                if($value[$i+1] == $value[$i] || $value[$i+1] == ($value[$i] +1) || $value[$i+1] == ($value[$i] - 1))
                    $result = false;
            }
        }
        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "Repeated or Consecutive Sequence Are Not Allowed For PIN";
    }
}