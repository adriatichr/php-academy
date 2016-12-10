<?php

namespace AppBundle\Twig;

class DemoExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('rot13filter', array($this, 'rotate13')),
        );
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('rot13function', [$this, 'rotate13'])
        ];
    }

    public function rotate13($text)
    {
        return str_rot13($text);
    }

    public function getName()
    {
        return 'demo_extension';
    }
}
