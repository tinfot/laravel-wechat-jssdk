<?php

namespace WechatJSSDK;

/**
 * Class Http
 *
 * @package WechatJSSDK
 */
class Http {

    private $url;

    /**
     * Http constructor.
     *
     * @param string $url
     */
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * Begin curl transfer
     *
     * @return mixed
     */
    public function send() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}