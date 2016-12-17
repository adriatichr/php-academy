<?php

namespace AppBundle\Twig;

class CalendarExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('generateDatesForMonth', [$this, 'generateDatesForMonth']),
            new \Twig_SimpleFunction('getDayClass', [$this, 'getDayClass']),
            new \Twig_SimpleFunction('getMonthName', [$this, 'getMonthName'])
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

        if(in_array($day->format('w'), [0, 6]))
            $classes[] = 'weekend';

        if($day->format('m') == $month)
            $classes[] = $this->isReservedDate($day, $reservedDates) ? 'notFree' : 'free';

        return implode(' ', $classes);

        // if(in_array($day, $reservedDates))
        //     return 'notFree';

        // return 'free';
    }

    private function isReservedDate(\DateTimeImmutable $day, array $reservedDates)
    {
        foreach ($reservedDates as $reservedDate) {
            if($reservedDate->format('Y-m-d') === $day->format('Y-m-d')) {
                return true;
            }
        }

        return false;
    }
    
    public function getMonthName(int $month)
    {
        switch($month) {
            case 1: return 'Siječanj';
            case 2: return 'Veljača';
            case 3: return 'Ožujak';
            case 4: return 'Travanj';
            case 5: return 'Svibanj';
            case 6: return 'Lipanj';
            case 7: return 'Srpanj';
            case 8: return 'Kolovoz';
            case 9: return 'Rujan';
            case 10: return 'Listopad';
            case 11: return 'Studeni';
            case 12: return 'Prosinac';
            default: return '';
        }
    }

    public function getName()
    {
        return 'calendar_extension';
    }
}
