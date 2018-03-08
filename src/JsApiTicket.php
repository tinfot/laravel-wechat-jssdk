<?php

namespace Tinfot;

use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Tinfot\Exception\TicketException;

class JsApiTicket {

    private $access_token;
    private $base_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket";
    private $type = 'jsapi';
    private $url;
    private $token_key = 'tinfot:';

    /**
     * Ticket constructor.
     *
     * @param string $app_id
     * @param string $access_token
     */
    public function __construct($app_id, $access_token) {
        $this->access_token = $access_token;
        $this->token_key    .= $app_id . ':jsapi_ticket';
        $this->setUrl();
    }

    /**
     * Set get js api ticket url
     */
    private function setUrl() {
        $this->url = "{$this->base_url}?type={$this->type}&access_token={$this->access_token}";
    }

    /**
     * Get jsapi ticket
     *
     * @return mixed|string
     * @throws TicketException
     */
    public function get() {
        if (Cache::has($this->token_key)) {
            return Cache::get($this->token_key);
        }
        $client = new Client();
        $result = $client->request('GET', $this->url);
        $data   = json_decode($result->getBody());
        $token  = isset($data->ticket) ? $data->ticket : '';
        if ($token) {
            Cache::put($this->token_key, $token, Carbon::now()->addMinutes(100));
        } else {
            throw new TicketException('invalid.jsapi.ticket', 404);
        }
        return $token;
    }
}