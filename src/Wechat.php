<?php

namespace Tinfot;

use Tinfot\Contracts\Wechat as WechatContract;

class Wechat implements WechatContract {

    private $app_id;
    private $app_secret;

    public function __construct($app_id, $app_secret) {
        $this->app_id     = $app_id;
        $this->app_secret = $app_secret;
    }

    public function getSignPackage(){
        $model = new AccessToken($this->app_id, $this->app_secret);
        $model->get();

    }
}