<?php

namespace Adriatic\PHPAkademija\AutomatedTesting;

class StringCalculator
{
    public function add(string $numbers) : int
    {
        $sum = 0;
        $negatives = [];

        foreach ($this->getNumbersAsArray($numbers) as $numberString) {
            if($numberString < 0)
                $negatives[] = $numberString;

            if($numberString > 1000)
                continue;

            $sum += $numberString;
        }

        if(!empty($negatives))
            throw new NegativesNotAllowedException(implode(', ', $negatives));

        return $sum;
    }

    private function getNumbersAsArray(string $numbers) : array
    {
        return explode('__delimiter__', $this->normalizeDelimiters($numbers));
    }

    private function normalizeDelimiters(string $numbers) : string
    {
        foreach ($this->getDelimiters($numbers) as $delimiter) {
            $numbers = str_replace($delimiter, '__delimiter__', $numbers);
        }

        return $numbers;
    }

    private function getDelimiters(string $numbers) : array
    {
        $defaultDelimiters = ["\n", ','];

        if (!$this->hasUserDefinedDelimiters($numbers)) {
            return $defaultDelimiters;
        }

        $delimitersString = $this->getUserDefinedDelimitersString($numbers);
        $userDefinedDelimiters = $this->extractDelimitersFromString($delimitersString);

        return array_merge($defaultDelimiters, $userDefinedDelimiters);
    }

    public function hasUserDefinedDelimiters(string $numbers) : bool
    {
        return strpos($numbers, '#') === 0;
    }

    private function getUserDefinedDelimitersString(string $numbers) : string
    {
        $firstNewlineIndex = strpos($numbers, "\n");
        $substringLength = $firstNewlineIndex - 1;

        return substr($numbers, 1, $substringLength);
    }

    private function extractDelimitersFromString(string $delimitersString) : array
    {
        return explode('][', rtrim(ltrim($delimitersString, '['), ']'));
    }
}


class NegativesNotAllowedException extends \LogicException {}
