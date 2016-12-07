<?php

namespace Adriatic\PHPAkademija\OOPIntro\ClosureExample;

class ArticleRepository
{
    public static $getTagsMethodCalled = false;

    public function getArticle()
    {
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
