<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test that basic math works.
     */
    public function test_that_math_works(): void
    {
        $this->assertEquals(2, 1 + 1);
        $this->assertEquals(10, 5 * 2);
    }

    /**
     * Test that arrays work correctly.
     */
    public function test_that_arrays_work(): void
    {
        $array = [1, 2, 3];
        $this->assertCount(3, $array);
        $this->assertContains(2, $array);
    }
}
