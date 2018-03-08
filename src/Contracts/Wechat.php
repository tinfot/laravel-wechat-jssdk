<?php

namespace Tinfot\Contracts;


interface Wechat {

    public function __construct($app_id, $app_secret, $url);
}