<?php

namespace Adriatic\PHPAkademija\TestDouble;

interface LoginService
{
    public function isLoggedIn(int $customerId) : bool;
}
