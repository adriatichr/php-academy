<?php

namespace Adriatic\PHPAkademija\OOPIntro\ClosureExample;

class Article
{
    private $loadTags;

    public function __construct(callable $loadTags)
    {
        $this->loadTags = $loadTags;
    }

    public function getTags()
    {
        # PHP 7:
        return ($this->loadTags)();

        # PHP 5.6:
        // return call_user_func($this->loadTags);
    }
}
