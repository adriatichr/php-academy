<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory;

class CarAssembly
{
    protected $componentFactory;

    public function __construct(ComponentFactory $componentFactory)
    {
        $this->componentFactory = $componentFactory;
    }

    public function assemble()
    {
        return [
            'Sastavljam motor: ' . $this->componentFactory->createEngine()->type(),
            'Sastavljam šasiju: ' . $this->componentFactory->createBodyConfiguration()->name(),
            'Sastavljam ovjes: ' . $this->componentFactory->createSuspension()->type(),
            'Sastavljam kotače sa gumama: ' . $this->componentFactory->createWheels()->tiresBrand(),
        ];
    }
}
