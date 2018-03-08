<?php

namespace Tinfot;

use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;

class AccessToken {

    private $grant_type = 'client_credential';
    private $app_id;
    private $app_secret;
    private $base_url = 'https://api.weixin.qq.com/cgi-bin/token';
    private $url;
    private $token_key = 'tinfot:';


    /**
     * AccessToken constructor.
     *
     * @param string $app_id
     * @param string $app_secret
     */
    public function __construct($app_id, $app_secret) {
        $this->app_id     = $app_id;
        $this->app_secret = $app_secret;
        $this->token_key  .= $app_id . ':access_token';
        $this->setUrl();
    }

    /**
     * Set url
     */
    private function setUrl() {
        $this->url = "{$this->base_url}?grant_type={$this->grant_type}&appid={$this->app_id}&secret={$this->app_secret}";
    }

    /**
     * Get access token
     *
     * @return mixed
     */
    public function get() {
        if (Cache::has($this->token_key)) {
            return Cache::get($this->token_key);
        }
        $client = new Client();
        $resule = $client->request('GET', $this->url);
        if ($resule->getStatusCode() == 200) {
            $data         = $resule->getBody();
            $access_token = isset($data->access_token) ? $data->access_token : '';
            Cache::put($this->token_key, $access_token, Carbon::now()->addMinutes(100));
            return $access_token;
        } else {
            return false;
        }
    }

}