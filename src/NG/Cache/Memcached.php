<?php

namespace NG\Cache;

class Memcached extends AbstractCache {
    /**
     * @var \Memcached
     */
    private $connection;

    /**
     * @throws Exception
     */
    public function __construct() {
        if (!extension_loaded('memcached')) {
            throw new Exception('memcached extension isn\'t loaded.');
        }
        $this->connection = new \Memcached();
    }

    /**
     * @param string $host
     * @param int $port
     * @return Memcached
     */
    public function addServer($host, $port) {
        $this->connection->addServer($host, $port);
        return $this;
    }

    /**
     * @return \Memcached
     */
    private function getConnection() {
        return $this->connection;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param int $ttl
     */
    public function set($key, $value, $ttl = 0) {
        $this->getConnection()->set($key, $value, $ttl);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        $value = $this->getConnection()->get($key);
        if ($value === false) {
            return null;
        }
        return $value;
    }

    /**
     * @param string $key
     * @return Memcached
     */
    public function delete($key) {
        $this->getConnection()->delete($key);
        return $this;
    }
}
