<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Bridge;

use Adriatic\PHPAkademija\DesignPattern\Bridge\OrdinaryRemoteControl;
use Adriatic\PHPAkademija\DesignPattern\Bridge\RefinedRemoteControl;
use Adriatic\PHPAkademija\DesignPattern\Bridge\RemoteControl;
use Adriatic\PHPAkademija\DesignPattern\Bridge\SamsungTvAdapter;
use Adriatic\PHPAkademija\DesignPattern\Bridge\SonyTvAdapter;
use Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations\SamsungTv;
use Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations\SonyTv;
use PHPUnit\Framework\TestCase;

class BridgeTest extends TestCase
{
    /** @test */
    public function watchSamsungTvWithOrdinaryRemote()
    {
        $remote = new OrdinaryRemoteControl(new SamsungTvAdapter(new SamsungTv()));

        $output = $this->turnTvOnSetChannelThenTurnOff($remote, 4);

        $this->assertEquals([
            'Uključujem Samsung Tv',
            'Postavljam Samsung kanal na 4',
            'Gasim Samsung Tv',
            '',
        ], explode("\n", $output));
    }

    /** @test */
    public function watchSamsungTvWithRefinedRemote()
    {
        $remote = new RefinedRemoteControl(new SamsungTvAdapter(new SamsungTv()));

        ob_start();
        $remote->on();
        $remote->setChannel(4);
        $remote->nextChannel();
        $remote->previousChannel();
        $remote->off();
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertEquals([
            'Uključujem Samsung Tv',
            'Postavljam Samsung kanal na 4',
            'Postavljam Samsung kanal na 5',
            'Postavljam Samsung kanal na 4',
            'Gasim Samsung Tv',
            '',
        ], explode("\n", $output));
    }

    /** @test */
    public function watchSonyTvWithRefinedRemoteControlButWithoutUsingRefinedControls()
    {
        $sony = new RefinedRemoteControl(new SonyTvAdapter(new SonyTv()));

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
