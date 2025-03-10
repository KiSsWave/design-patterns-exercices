<?php

namespace Test;

use PHPUnit\Framework\TestCase;

use App\Laptop;
use App\Gpu;
use App\OledScreen;

class ComputerDecoratorTest extends TestCase
{
    public function testBasicLaptop()
    {
        $laptop = new Laptop();

        $this->assertSame(400, $laptop->getPrice());
        $this->assertSame("A laptop computer", $laptop->getDescription());
    }

    public function testLaptopWithGPU()
    {
        $laptop = new Laptop();
        $laptopWithGpu = new Gpu($laptop);

        $this->assertSame(700, $laptopWithGpu->getPrice());
        $this->assertSame("A laptop computer with a GPU", $laptopWithGpu->getDescription());
    }

    public function testLaptopWithOLEDScreen()
    {
        $laptop = new Laptop();
        $laptopWithOledScreen = new OledScreen($laptop);

        $this->assertSame(600, $laptopWithOledScreen->getPrice());
        $this->assertSame("A laptop computer with an OLED screen", $laptopWithOledScreen->getDescription());
    }

    public function testLaptopWithGPUAndOLEDScreen()
    {
        $laptop = new Laptop();
        $laptopWithGpu = new Gpu($laptop);
        $laptopWithGpuAndOled = new OledScreen($laptopWithGpu);

        $this->assertSame(900, $laptopWithGpuAndOled->getPrice());
        $this->assertSame("A laptop computer with a GPU with an OLED screen", $laptopWithGpuAndOled->getDescription());
    }
}