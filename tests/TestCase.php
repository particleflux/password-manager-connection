<?php

namespace particleflux\PMConnection\tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $oldPath;

    public function setUp() : void
    {
        $this->oldPath = getenv('PATH');
        $supportDir = __DIR__ . '/_support';
        putenv("PATH=$supportDir:{$this->oldPath}");
    }

    public function tearDown() : void
    {
        putenv("PATH={$this->oldPath}");
    }
}
