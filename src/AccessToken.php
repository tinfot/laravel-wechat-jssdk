<?php

namespace Tinfot;

use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Tinfot\Exception\AccessTokenException;

/**
 * Class AccessToken
 *
 * @package Tinfot
 */
class AccessToken {

    private $app_id;
    private $app_secret;
    private $base_url = 'https://api.weixin.qq.com/cgi-bin/token';
    private $grant_type = 'client_credential';
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
     * Set get access token url
     */
    private function setUrl() {
        $this->url = "{$this->base_url}?grant_type={$this->grant_type}&appid={$this->app_id}&secret={$this->app_secret}";
    }

    /**
     * Get wechat access token
     *
     * @return mixed|string
     *
     * @throws AccessTokenException
     */
    public function get() {
        if (Cache::has($this->token_key)) {
            return Cache::get($this->token_key);
        }
        $client = new Client();
        $result = $client->request('GET', $this->url);
        $data   = json_decode($result->getBody());
        $token  = isset($data->access_token) ? $data->access_token : '';
        if ($token) {
            Cache::put($this->token_key, $token, Carbon::now()->addMinutes(100));
        } else {
            throw new AccessTokenException('invalid.access.token', 404);
        }
        return $token;
    }

}