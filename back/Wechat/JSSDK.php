<?php

namespace RichardTianke\Wechat;

class JSSDK {

    private $app_id;
    private $app_secret;

    /**
     * JSSDK constructor.
     *
     * @param string $app_id
     * @param string $app_secret
     */
    public function __construct($app_id, $app_secret) {
        $this->app_id     = $app_id;
        $this->app_secret = $app_secret;
    }

    public function getSignPackage() {
        $model        = new AccessToken($this->app_id, $this->app_secret);
        $access_token = $model->get();
        $ticket       = new Ticket($access_token);
        $jsapiTicket  = $ticket->get();

        // 注意 URL 一定要动态获取，不能 hardcode.
        //        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        //        $url      = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url       = $_GET['url'];
        $timestamp = time();
        $nonce     = new NonceString();
        $nonce->setString(16);
        $nonceStr = $nonce->getString();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->app_id,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }
}