<?php

namespace App;

class Gpu extends ComputerDecorator
{
    public function getPrice(): int
    {
        return $this->computer->getPrice() + 300;
    }

    public function getDescription(): string
    {
        return $this->computer->getDescription() . " with a GPU";
    }
}