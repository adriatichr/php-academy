<?php

namespace Adriatic\PHPAkademija\OOPIntro\ClosureExample;

class ArticleRepository
{
    public static $getTagsMethodCalled = false;

    public function getArticle()
    {
        /**
         * Umjesto da tagove dohvaćamo odmah i šaljemo ih Article klasi, umjesto toga šaljemo closure koji će Article
         * izvršiti baš kada se na njemu pozove metoda getTags(). Drugim riječima, umjesto da smo odmah dohvatili tagove
         * i poslali ih u Article, mi Article klasi šaljemo "upute" kako da sam dohvati tagove. Article onda može ako
         * želi odgoditi dohvaćanje tagova za trenutak kada se točno pozove getTags() metoda.
         */
        return new Article(function () {
            return $this->getTags();
        });
    }

    private function getTags()
    {
        self::$getTagsMethodCalled = true;

        return ['tag 1', 'tag 2'];
    }
}
