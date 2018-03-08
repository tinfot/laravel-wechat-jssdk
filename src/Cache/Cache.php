<?php

namespace Tinfot;

use Illuminate\Cache\Repository;
use Tinfot\Contracts\Cache as CacheContract;

class Cache implements CacheContract {

    protected $repository;

    /**
     * Cache constructor.
     *
     * @param \Illuminate\Cache\Repository $repository
     */
    public function __construct(Repository $repository) {
        $this->repository = $repository;
    }

    public function get($key, $default = null) {
        return $this->repository->get($key, $default);
    }

    public function set($key, $value, $seconds = null) {
        $this->repository->put($key, $value, $this->toMinutes($seconds));
    }

    public function has($key) {
        return $this->repository->has($key);
    }

    public function delete($key) {
        return $this->repository->delete($key);
    }

    private function toMinutes($seconds = null) {
        return is_null($seconds) ? 0 : ($seconds / 60);
    }

}