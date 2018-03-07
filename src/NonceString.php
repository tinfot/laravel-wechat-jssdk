<?php

namespace WechatJSSDK;

/**
 * Class NonceString
 * @package WechatJSSDK
 *
 * @property string $string
 * @property string $character
 */
class NonceString {

    private $string;
    private $character = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Set nonce string
     *
     * @param int $length
     *
     * @return string
     */
    public function setString($length = 16) {
        for ($i = 0; $i < $length; $i++) {
            $this->string .= substr($this->character, mt_rand(0, strlen($this->character) - 1), 1);
        }
    }

    /**
     * Get nonce string
     *
     * @return mixed
     */
    public function getString() {
        return $this->string;
    }
}