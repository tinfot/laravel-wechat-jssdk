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
        return trim(file_get_contents(dirname(__FILE__) . '/' . $key));
    }

    /**
     * Set cache
     *
     * @param $key
     * @param $value
     */
    public function put($key, $value) {
        $file = fopen(dirname(__FILE__) . '/' . $key, "w");
        fwrite($file, $value);
        fclose($file);
    }
}