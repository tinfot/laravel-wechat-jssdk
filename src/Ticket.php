<?php

namespace WechatJSSDK;


class Ticket {

    private $base_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&";
    private $access_token;
    private $url;
    private $key = "jsapi_ticket.json";

    /**
     * Ticket constructor.
     *
     * @param $access_token
     */
    public function __construct($access_token) {
        $this->access_token = $access_token;
        $this->setUrl();
    }

    /**
     * Set url
     */
    private function setUrl() {
        $this->url = $this->base_url . "access_token={$this->access_token}";
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
            $ticket = $data->jsapi_ticket;
        } else {
            $http   = new Http($this->url);
            $result = json_decode($http->send());
            $ticket = $result->ticket;
            if ($ticket) {
                $data->expire_time  = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $cache->put($this->key, json_encode($data));
            }
        }
        return $ticket;
    }
}