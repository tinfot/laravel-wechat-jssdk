<?php

namespace Tinfot\Exception;

use Tinfot\Exception;

/**
 *
 * Access token Exception
 *
 * @category   Wechat
 * @version    1.0.0
 * @package    tinfot/laravel-wechat-jssdk
 * @copyright  Copyright (c) 2017 - 2018 Richard Tian (http://www.richard.lol)
 * @author     Richard <richard_tianke@qq.com>
 * @license    https://mit-license.org/    MIT
 */
class AccessTokenException extends Exception {
    /**
     * Class constructor
     *
     * @param string $message Error message
     * @param int $code Error code
     */
    function __construct($message = null, $code = 0) {
        parent::__construct($message, $code);
    }
}