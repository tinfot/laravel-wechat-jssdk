<?php

namespace WechatJSSDK;

class AccessToken {

    private $app_id;
    private $app_secret;
    private $base_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&";
    private $url;
    private $key = "access_token.json";

    /**
     * AccessToken constructor.
     *
     * @param string $app_id
     * @param string $app_secret
     */
    public function __construct($app_id, $app_secret) {
        $this->app_id     = $app_id;
        $this->app_secret = $app_secret;
        $this->setUrl();
    }

    /**
     * Set url
     */
    private function setUrl() {
        $this->url = $this->base_url . "appid={$this->app_id}&secret={$this->app_secret}";
    }

    /**
     * Get access token
     *
     * @return mixed
     */
    public function get() {
        $cache = new Cache();
        $data  = json_decode($cache->get($this->key));

        if ($data->expire_time > time()) {
            $access_token = $data->access_token;
        } else {
            $http         = new Http($this->url);
            $result       = json_decode($http->send());
            $access_token = $result->access_token;
            if ($access_token) {
                $data->expire_time  = time() + 7000;
                $data->access_token = $access_token;
                $cache->put($this->key, json_encode($data));
            }
        }
        return $access_token;
    }

}