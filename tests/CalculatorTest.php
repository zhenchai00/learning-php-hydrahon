<?php

declare(strict_types=1);

require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib/Calculator.php');

use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator;
    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
    }

    public function testAdd()
    {
        $result = $this->calculator->add(1,5);
        $this->assertEquals(6, $result);
    }
}

?>