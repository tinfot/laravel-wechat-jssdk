<?php

namespace Tinfot;

use Tinfot\Contracts\SignPackage as SignPackageContract;

class SignPackage implements SignPackageContract {

    private $app_id;
    private $js_api_ticket;
    private $nonce_string;
    private $signature;
    private $sign_package;
    private $timestamp;
    private $url;
    private $string;

    public function __construct($app_id, $js_api_ticket, $url) {
        $this->app_id        = $app_id;
        $this->js_api_ticket = $js_api_ticket;
        $this->url           = $url;
        $this->timestamp     = time();
    }

    public function setNonceString() {
        $model              = new NonceString();
        $this->nonce_string = $model->build();
    }

    public function setString() {
        $this->string = "jsapi_ticket={$this->js_api_ticket}&noncestr={$this->nonce_string}&timestamp={$this->timestamp}&url={$this->url}";
    }

    public function setSignature() {
        $this->signature = sha1($this->string);
    }

    public function setSignPackage() {
        $this->sign_package = [
            "appId"     => $this->app_id,
            "nonceStr"  => $this->nonce_string,
            "timestamp" => $this->timestamp,
            "url"       => $this->url,
            "signature" => $this->signature,
            "rawString" => $this->string
        ];
    }

    public function build() {
        $this->setNonceString();
        $this->setSignature();
        $this->setString();
        $this->setSignPackage();
    }

    public function get() {
        return $this->sign_package;
    }

}