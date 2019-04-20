<?php

namespace particleflux\PMConnection;

use particleflux\PMConnection\exceptions\ConnectionFailedException;
use particleflux\PMConnection\exceptions\InvalidConfigException;

/**
 * 'pass' password manager connection
 *
 * Connect to __pass__, _the standard unix password manager_
 * https://www.passwordstore.org/
 */
class PassConnection implements PMConnectionInterface
{
    private const PASS_EXECUTABLE = 'pass';

    /** @var string Prefix to apply to all passwords (subfolder) */
    private $prefix = '';

    private $userAttribute = 'username';

    /**
     * PassConnection constructor
     *
     * @param array $config Configuration options
     * @throws InvalidConfigException
     */
    public function __construct($config = [])
    {
        foreach ($config as $name => $value) {
            if (!property_exists($this, $name)) {
                throw new InvalidConfigException("Configuration option '$name' does not exist");
            }
            $this->$name = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function getPassword(string $account): string
    {
        $output = $this->execute($account);
        return $output[0];
    }

    /**
     * @inheritDoc
     */
    public function getUser(string $account): string
    {
        return $this->getAttribute($account, $this->userAttribute);
    }

    /**
     * @inheritDoc
     */
    public function getAttribute(string $account, string $attribute): string
    {
        $output = $this->execute($account);

        foreach ($output as $line) {
            if (strpos($line, ':') === false) {
                continue;
            }
            [$attr, $value] = explode(':', $line);
            if ($attr === $attribute) {
                return ltrim($value);
            }
        }

        throw new ConnectionFailedException("Attribute '$attribute' does not exist");
    }

    private function execute(string $account) : array
    {
        $output = [];
        $status = 0;

        exec(
            sprintf(
                '%s show %s',
                self::PASS_EXECUTABLE,
                escapeshellarg($this->prefix . $account)
            ),
            $output,
            $status
        );

        if ($status !== 0 || !count($output)) {
            throw new ConnectionFailedException('pass command failed');
        }

        return $output;
    }
}
