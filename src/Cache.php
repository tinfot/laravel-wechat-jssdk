<?php

namespace WechatJSSDK;

class Cache {

    /**
     * Get cache
     *
     * @param $key
     *
     * @return string
     */
    public function get($key) {
        return trim(file_get_contents($key));
    }

    /**
     * Set cache
     *
     * @param $key
     * @param $value
     */
    public function put($key, $value) {
        $file = fopen($key, "w");
        fwrite($file, $value);
        fclose($file);
    }
}