<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Builder;

use Adriatic\PHPAkademija\DesignPattern\Builder\Product;
use PHPUnit\Framework\TestCase;

class ProductBuilderTest extends TestCase
{
    /** @test */
    public function buildProductWithName()
    {
        $product1 = Product::createBuilder()
            ->withName('Mlijeko')
            ->withCategory('Namirnice')
            ->withPrice(5.99)
            ->getProduct();
        $product2 = Product::createBuilder()
            ->withName('Pasta za zube')
            ->withCategory('Higijenski proizvodi')
            ->withPrice(24.99)
            ->getProduct();

        $this->assertEquals('Mlijeko', $product1->name());
        $this->assertEquals('Namirnice', $product1->category());
        $this->assertEquals(5.99, $product1->price());
        $this->assertEquals('Pasta za zube', $product2->name());
        $this->assertEquals('Higijenski proizvodi', $product2->category());
        $this->assertEquals(24.99, $product2->price());
    }
}
