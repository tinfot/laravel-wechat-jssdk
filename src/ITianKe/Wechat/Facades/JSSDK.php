<?php

namespace RichardTianke\Wechat\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * Laravel Wechat JSSDK Facade
 *
 * @category   Laravel Wechat
 * @version    1.0.0
 * @package    richardtianke/laravel-wechat-jssdk
 * @copyright  Copyright (c) 2017 - 2018 Richard Tian (http://www.richard.lol)
 * @author     Richard <richard_tianke@qq.com>
 * @license    https://mit-license.org/    MIT
 */
class JSSDK extends Facade{
    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jssdk';
    }
}