<?php

namespace Tests\AppBundle\Twig;

use AppBundle\Twig\CalendarExtension;
use PHPUnit\Framework\TestCase;

class CalendarExtensionTest extends TestCase
{
    private $extension;

    public function setUp()
    {
        $this->extension = new CalendarExtension();
    }

    /** @test */
    public function datesOutsideOfMonthHaveNoClass()
    {
        $class = $this->extension->getDayClass($this->date('2016-06-30'), 7, []);
        $this->assertSame('', $class);
    }

    /**
     * @testWith ["2016-06-25"]
     *           ["2016-06-26"]
     */
    public function weekendDatesOutsideOfMonthHaveWeekendClass($weekendDateString)
    {
        $class = $this->extension->getDayClass($this->date($weekendDateString), 7, []);
        $this->assertSame('weekend', $class);
    }

    /** @test */
    public function datesInsideOfMonthButNotInReservedDatesHaveFreeClass()
    {
        $class = $this->extension->getDayClass($this->date('2016-07-01'), 7, []);
        $this->assertSame('free', $class);
    }

    /**
     * @testWith ["2016-07-02"]
     *           ["2016-07-03"]
     */
    public function weekendDatesInsideOfMonthButNotInReservedDatesHaveFreeAndWeekendClasses($weekendDateString)
    {
        $class = $this->extension->getDayClass($this->date('2016-07-02'), 7, []);
        $this->assertContains('free', explode(' ', $class));
        $this->assertContains('weekend', explode(' ', $class));
    }

    /** @test */
    public function datesInsideOfMonthAndInReservedDatesHaveNotFreeClass()
    {
        $class = $this->extension->getDayClass($this->date('2016-07-05'), 7, [$this->date('2016-07-05 20:00:05')]);
        $this->assertSame('notFree', $class);
    }

    /**
     * @testWith ["2016-07-02"]
     *           ["2016-07-03"]
     */
    public function weekendDatesInsideOfMonthAndInReservedDatesHaveNotFreeAndWeekendClasses($weekendDateString)
    {
        $class = $this->extension->getDayClass($this->date($weekendDateString), 7,
            [$this->date($weekendDateString . ' 20:00:01')]);
        $this->assertContains('notFree', explode(' ', $class));
        $this->assertContains('weekend', explode(' ', $class));
    }

    /**
     * @testWith ["January", 1]
     *           ["February", 2]
     *           ["March", 3]
     *           ["April", 4]
     *           ["May", 5]
     *           ["June", 6]
     *           ["July", 7]
     *           ["August", 8]
     *           ["September", 9]
     *           ["October", 10]
     *           ["November", 11]
     *           ["December", 12]
     */
    public function getMonthName($expectedMonthName, $monthNumber)
    {
        $this->assertEquals($expectedMonthName, $this->extension->getMonthName($monthNumber));
    }

    /** @test */
    public function getNextMonth()
    {
        $this->assertEquals('{"month":6,"year":2017}', $this->extension->getNextMonth(5, 2017));
        $this->assertEquals('{"month":1,"year":2018}', $this->extension->getNextMonth(12, 2017));
    }

    /** @test */
    public function getPreviousMonth()
    {
        $this->assertEquals('{"month":4,"year":2017}', $this->extension->getPreviousMonth(5, 2017));
        $this->assertEquals('{"month":12,"year":2016}', $this->extension->getPreviousMonth(1, 2017));
    }

    /** @test */
    public function getPreviousMonthFebruaryRegression()
    {
        $this->assertEquals('{"month":2,"year":2017}', $this->extension->getPreviousMonth(3, 2017),
            sprintf("Ako je trenutni datum npr. 29.12 \n%s\nće stvoriti datum u 29.02.2017 što je zapravo 01.03.2017. Bolje je koristiti npr. \n%s.",
                '\DateTimeImmutable::createFromFormat("Y-m", $year . "-" . $month);',
                '\DateTimeImmutable::createFromFormat("Y-m-d", $year . "-" . $month . "-01");'));
    }

    private function date($dateString)
    {
        return new \DateTimeImmutable($dateString);
    }
}
