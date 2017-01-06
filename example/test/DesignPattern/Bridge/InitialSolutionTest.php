<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Facade;

use Adriatic\PHPAkademija\DesignPattern\Bridge\InitialSolution\RemoteControl;
use Adriatic\PHPAkademija\DesignPattern\Bridge\InitialSolution\SamsungControl;
use Adriatic\PHPAkademija\DesignPattern\Bridge\InitialSolution\SonyControl;
use Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations\SamsungTv;
use Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations\SonyTv;
use PHPUnit\Framework\TestCase;

class InitialSolutionTest extends TestCase
{
    /** @test */
    public function watchSamsungTv()
    {
        $samsung = new SamsungControl(new SamsungTv());

        $output = $this->turnTvOnSetChannelThenTurnOff($samsung, 4);

        $this->assertEquals([
            'Uključujem Samsung Tv',
            'Postavljam Samsung kanal na 4',
            'Gasim Samsung Tv',
            '',
        ], explode("\n", $output));
    }

    /** @test */
    public function watchSonyTv()
    {
        $sony = new SonyControl(new SonyTv());

        $output = $this->turnTvOnSetChannelThenTurnOff($sony, 5);

        $this->assertEquals([
            'Uključujem Sony Tv',
            'Postavljam Sony kanal na 5',
            'Gasim Sony Tv',
            '',
        ], explode("\n", $output));
    }

    private function turnTvOnSetChannelThenTurnOff(RemoteControl $remoteControl, int $channel) : string
    {
        ob_start();
        $remoteControl->on();
        $remoteControl->setChannel($channel);
        $remoteControl->off();
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
