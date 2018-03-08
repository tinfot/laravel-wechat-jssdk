<?php

namespace Tinfot\Contracts;

interface Cache {

    /**
     * Get cache
     *
     * @param string $key
     * @param string $default
     *
     * @return string
     */
    public function get($key, $default = null);

    /**
     * Set cache
     *
     * @param string $key
     * @param mixed $value
     * @param mixed $seconds
     *
     * @return string
     */
    public function set($key, $value, $seconds = null);

    /**
     * Check cache exist
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key);

    /**
     * Remove cache
     *
     * @param string $key
     *
     * @return bool
     */
    public function delete($key);


}