<?php

namespace Tests;

use App\Animal;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{
    private $name;

    protected function setup()
    {
        parent::setup();

        $this->name = 'pochi';
    }

    public function testOfAbstractClass()
    {
        // Error: Cannot instantiate abstract class App\Animal
        $this->expectException(\Error::class);
        $this->assertInstanceOf(Animal::class, Animal::of($this->name));
    }

    public function testOfAnonymousClass()
    {
        // Error: Call to private App\Animal::__construct() from context 'Tests\AnimalTest'
        $this->expectException(\Error::class);
        $this->assertInstanceOf(Animal::class, $this->anonymousAnimal($this->name)::of($this->name));
    }

    public function testOfExtendedClass()
    {
        // OK
        $this->assertInstanceOf(Animal::class, TestableAnimal::of($this->name));
    }

    private function anonymousAnimal(string $name): Animal
    {
        return new class($name) extends Animal
        {
        };
    }
}

class TestableAnimal extends Animal
{
}
