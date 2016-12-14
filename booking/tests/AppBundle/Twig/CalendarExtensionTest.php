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

    private function date($dateString)
    {
        return new \DateTimeImmutable($dateString);
    }

}