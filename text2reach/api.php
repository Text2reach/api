<?php

abstract class Text2reach_API {
    const API_URI_BASE = 'http://www.text2reach.com/api/1.0/';

    protected $api_key = null;
    protected $uri = null;
    protected $response = null;
    protected $required_params = array(); // List of parameters that have no default values set

    /**
     *
     */
    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    /**
     * @return Text2reach_API
     */
    protected function uri_init($function) {
        $this->uri = self::API_URI_BASE.$function.'/?';
        $this->uri_param('api_key', $this->api_key);
        return $this;
    }

    /**
     * @return Text2reach_API
     */
    protected function uri_param($key, $value) {
        $this->uri .= $key.'='.$value.'&';
        return $this;
    }

    /**
     * @return Text2reach_API
     */
    protected function check() {
        foreach ($this->required_params as $param) {
            if ($this->$param == null) {
                throw new Text2reach_Exception('Required parameter missing: "'.$param.'"');
            }
        }
        return $this;
    }

    /**
     *
     */
    protected function execute() {
        $this->check();

        $c = curl_init($this->uri);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_USERAGENT, 'Text2reach API wrapper');
		$this->response = curl_exec($c);

        if ($this->response === false) {
            throw new Text2reach_Exception('Connection problem');
        }

		curl_close($c);
    }

    /**
     *
     */
    public function response() {
        return $this->response;
    }
}