<?php

// http://phpacademy.example.{inicijali}/OOPExamples/Closure.php
require_once __DIR__ . '/../../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\ClosureExample\ArticleRepository;

?>

<p>Primjer korištenja closure-a za lazy loading:</p>

<?php
$articleRepository = new ArticleRepository();
$article = $articleRepository->getArticle();

echo '<br />';
echo ArticleRepository::$getTagsMethodCalled ? 'Tagovi dohvaćeni iz baze' : 'Tagovi još nisu dohvaćeni iz baze';

$tags = $article->getTags();
echo '<br />';
echo 'Pozvana getTags() metoda na klasi Article';
echo '<br />';
echo ArticleRepository::$getTagsMethodCalled ? 'Tagovi dohvaćeni iz baze' : 'Tagovi još nisu dohvaćeni iz baze';