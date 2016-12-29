<?php

namespace AppBundle\Twig;

class CalendarExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('generateDatesForMonth', [$this, 'generateDatesForMonth']),
            new \Twig_SimpleFunction('getDayClass', [$this, 'getDayClass']),
            new \Twig_SimpleFunction('getMonthName', [$this, 'getMonthName']),
            new \Twig_SimpleFunction('getNextMonth', [$this, 'getNextMonth']),
            new \Twig_SimpleFunction('getPreviousMonth', [$this, 'getPreviousMonth']),
        ];
    }

    public function generateDatesForMonth(int $month, int $year)
    {
        $startDate = \DateTimeImmutable::createFromFormat('Y-m-d',
            sprintf('%s-%s-01', $year, $month))->modify('monday this week');
        $endDate = \DateTimeImmutable::createFromFormat('Y-m-d',
            sprintf('%s-%s-01', $year, $month))->modify('first monday of next month');

        $monthPeriod = new \DatePeriod(
            $startDate,
            \DateInterval::createFromDateString('1 day'),
            $endDate);

        $datesInMonth = [];
        foreach ($monthPeriod as $date) {
            $datesInMonth[] = $date;
        }

        return $datesInMonth;
    }

    public function getDayClass(\DateTimeImmutable $day, int $month, array $reservedDates)
    {
        $classes = [];

        if (in_array($day->format('w'), [0, 6])) {
            $classes[] = 'weekend';
        }

        if ($day->format('m') == $month) {
            $classes[] = $this->isReservedDate($day, $reservedDates) ? 'notFree' : 'free';
        }

        return implode(' ', $classes);
    }

    public function getMonthName(int $monthNumber)
    {
        return \DateTimeImmutable::createFromFormat('m', $monthNumber)->format('F');
    }

    public function getNextMonth(int $month, int $year)
    {
        return $this->getJsonMonthData('next', $month, $year);
    }

    public function getPreviousMonth(int $month, int $year)
    {
        return $this->getJsonMonthData('previous', $month, $year);
    }

    private function getJsonMonthData(string $nextOrPrevious, int $month, int $year)
    {
        $month = $nextOrPrevious === 'next' ? $month + 1 : $month - 1;
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', $year . '-' . $month . '-01');
        $month = (int)$date->format('m');
        $year = (int)$date->format('Y');

        return json_encode(['month' => $month, 'year' => $year]);
    }

    private function isReservedDate(\DateTimeImmutable $day, array $reservedDates)
    {
        foreach ($reservedDates as $reservedDate) {
            if ($reservedDate->format('Y-m-d') === $day->format('Y-m-d')) {
                return true;
            }
        }

        return false;
    }

    public function getName()
    {
        return 'calendar_extension';
    }
}
