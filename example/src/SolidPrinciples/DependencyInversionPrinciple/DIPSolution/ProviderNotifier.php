<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution;

interface ProviderNotifier
{
    public function askForConfirmation(int $accommodationId);
}
