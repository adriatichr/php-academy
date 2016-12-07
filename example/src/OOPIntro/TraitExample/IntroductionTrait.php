<?php

namespace Adriatic\PHPAkademija\OOPIntro\TraitExample;

trait IntroductionTrait
{
    public function introduceYourself()
    {
        return 'Hello, I am ' . $this->getFullName();
    }
}
