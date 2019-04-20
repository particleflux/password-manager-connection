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

//    const DATA_DIRECTORY = __DIR__ . '/_data/';
//    const OUTPUT_DIRECTORY = __DIR__ . '/../build/';
//
//    /**
//     * Invokes a inaccessible method
//     * @param $object
//     * @param $method
//     * @param array $args
//     * @param bool $revoke whether to make method inaccessible after execution
//     * @return mixed
//     * @since 2.0.11
//     */
//    protected function invokeMethod($object, $method, $args = [], $revoke = true)
//    {
//        $reflection = new \ReflectionClass(get_class($object));
//        $method = $reflection->getMethod($method);
//        $method->setAccessible(true);
//        $result = $method->invokeArgs($object, $args);
//        if ($revoke) {
//            $method->setAccessible(false);
//        }
//        return $result;
//    }
//
//    /**
//     * Sets an inaccessible object property to a designated value
//     * @param $object
//     * @param $propertyName
//     * @param $value
//     * @param bool $revoke whether to make property inaccessible after setting
//     */
//    protected function setInaccessibleProperty($object, $propertyName, $value, $revoke = true)
//    {
//        $class = new \ReflectionClass($object);
//        while (!$class->hasProperty($propertyName)) {
//            $class = $class->getParentClass();
//        }
//        $property = $class->getProperty($propertyName);
//        $property->setAccessible(true);
//        $property->setValue($object, $value);
//        if ($revoke) {
//            $property->setAccessible(false);
//        }
//    }
//
//    /**
//     * Gets an inaccessible object property
//     * @param $object
//     * @param $propertyName
//     * @param bool $revoke whether to make property inaccessible after getting
//     * @return mixed
//     */
//    protected function getInaccessibleProperty($object, $propertyName, $revoke = true)
//    {
//        $class = new \ReflectionClass($object);
//        while (!$class->hasProperty($propertyName)) {
//            $class = $class->getParentClass();
//        }
//        $property = $class->getProperty($propertyName);
//        $property->setAccessible(true);
//        $result = $property->getValue($object);
//        if ($revoke) {
//            $property->setAccessible(false);
//        }
//        return $result;
//    }
//
//    /**
//     * Build full path to test file in _data directory
//     */
//    protected function getTestFilePath($fileName): string
//    {
//        return self::DATA_DIRECTORY . $fileName;
//    }
//
//    /**
//     * Build full path to file in build directory
//     */
//    protected function getOutputFilePath($fileName): string
//    {
//        return self::OUTPUT_DIRECTORY . $fileName;
//    }
}