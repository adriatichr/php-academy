<?php

use Adriatic\PHPAkademija\OOPIntro\ClosureExample\ArticleRepository;
use PHPUnit\Framework\TestCase;

class ArticleRepositoryTest extends TestCase
{
    /** @test */
    public function lazyLoadingUsingClosures()
    {
        $articleRepository = new ArticleRepository();

        $article = $articleRepository->getArticle();
        $this->assertFalse(ArticleRepository::$getTagsMethodCalled);

        $tags = $article->getTags();
        $this->assertTrue(ArticleRepository::$getTagsMethodCalled);
        $this->assertEquals(['tag 1', 'tag 2'], $tags);
    }
}
