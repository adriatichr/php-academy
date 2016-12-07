<?php

// Ovaj file mora biti uključen da bi mogli koristiti autoloading. Prije korištenja, spojiti se na PuTTY i unutar example
// direktorija pokrenuti naredbu "composer install"
require_once __DIR__ . '/../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\Car;	// Car klasa se nalazi u src/OOPIntro/Car.php

$myCar = new Car('silver');
echo $myCar->getCurrentSpeed();
