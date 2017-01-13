<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution;

use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\SmsService;

class SmsProviderNotifier implements ProviderNotifier
{
    private $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function askForConfirmation(int $accommodationId)
    {
        $providerPhoneNumber = $this->getProviderPhoneNumber($accommodationId);
        $this->smsService->sendSms($providerPhoneNumber, 'Prihvaćate li rezervaciju smještaja?');
    }

    private function getProviderPhoneNumber(int $accommodationId)
    {
        return '091 234 5678';
    }
}
