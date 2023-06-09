<?php
declare(strict_types=1);

namespace particleflux\PMConnection\tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected string $oldPath;

    public function setUp() : void
    {
        $path = getenv('PATH');
        $this->oldPath = $path !== false ? $path : '';
        $supportDir = __DIR__ . '/_support';
        putenv("PATH=$supportDir:{$this->oldPath}");
    }

    public function tearDown() : void
    {
        putenv("PATH={$this->oldPath}");
    }
}
