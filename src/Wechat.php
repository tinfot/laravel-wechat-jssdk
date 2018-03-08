<?php

namespace Tinfot;

use Tinfot\Contracts\Wechat as WechatContract;

class Wechat implements WechatContract {

    private $app_id;
    private $app_secret;

    private $access_token;
    private $js_api_ticket;
    private $signPackage;
    private $url;

    public function __construct($app_id, $app_secret, $url) {
        $this->app_id     = $app_id;
        $this->app_secret = $app_secret;
        $this->url        = $url;
    }

    public function getSignPackage() {
        return $this->signPackage;
    }

    public function setSignPackage() {
        $this->setAccessToken();
        $this->setJsApiTicket();
        $model = new SignPackage($this->app_id, $this->js_api_ticket, $this->url);
        $model->build();
        $this->signPackage = $model->get();
    }
    
    private function setAccessToken() {
        $model              = new AccessToken($this->app_id, $this->app_secret);
        $this->access_token = $model->get();
    }

    private function setJsApiTicket() {
        $model               = new JsApiTicket($this->app_id, $this->access_token);
        $this->js_api_ticket = $model->get();
    }


}