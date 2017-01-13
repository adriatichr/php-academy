<?php

namespace Adriatic\PHPAkademija\AutomatedTesting;

class StringCalculator
{
    public function add(string $numbers) : int
    {
        $sum = 0;
        foreach ($this->getNumbersArray($numbers) as $numberString) {
            $sum += $numberString;
        }

        return $sum;
    }

    private function getNumbersArray(string $numbers) : array
    {
        foreach ($this->getDelimiters($numbers) as $delimiter) {
            $numbers = str_replace($delimiter, '__delimiter__', $numbers);
        }

        return explode('__delimiter__', $numbers);
    }

    private function getDelimiters($numbers)
    {
        $delimiters = ["\n", ','];
        if (strpos($numbers, '#') === 0) {
            $delimiters[] = substr($numbers, 1, 1);
        }

        return $delimiters;
    }
}
