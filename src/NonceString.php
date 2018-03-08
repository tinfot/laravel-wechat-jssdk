<?php

namespace Tinfot;

/**
 * Class NonceString
 * @package WechatJSSDK
 *
 * @property integer $length
 * @property string $character
 */
class NonceString {

    private $character = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    private $length = 16;

    /**
     * Set nonce string length
     *
     * @param $length
     */
    public function setLength($length) {
        $this->length = $length;
    }

    /**
     * Set nonce string character
     *
     * @param $character
     */
    public function setCharacter($character) {
        $this->character = $character;
    }

    /**
     * Generate nonce string
     *
     * @return string
     */
    public function build() {
        $result = "";
        for ($i = 0; $i < $this->length; $i++) {
            $result .= substr($this->character, mt_rand(0, strlen($this->character) - 1), 1);
        }
        return $result;
    }

}