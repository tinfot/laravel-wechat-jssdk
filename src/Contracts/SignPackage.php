<?php

namespace Tinfot\Contracts;

/**
 * Interface SignPackage
 *
 * @package Tinfot\Contracts
 */
interface SignPackage {

    /**
     * SignPackage constructor.
     *
     * @param $app_id
     * @param $js_api_ticket
     * @param $url
     */
    public function __construct($app_id, $js_api_ticket, $url);

    /**
     * Set before hash string
     *
     * @return mixed
     */
    public function setString();

    /**
     * After hash string
     *
     * @return mixed
     */
    public function setSignature();

    /**
     * Generate a nonce string
     *
     * @return mixed
     */
    public function setNonceString();

    /**
     * build result
     *
     * @return mixed
     */
    public function build();

    /**
     * Get results
     *
     * @return mixed
     */
    public function get();


}