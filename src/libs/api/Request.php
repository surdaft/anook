<?php namespace surdaft\anook\libs\api;

/**
 * This is an api request object, all data from an api call is fed into
 * this class and this is the class you are returned from an API call.
 */
class Request
{
    public $code;
    public $data;
    public $json;
    public $endpoint;
    public $curl_url;
    
    public function __construct($api_request_json, $endpoint, $curl_url)
    {
        $this->json = $api_request_json;
        
        $request = json_decode($api_request_json);
        
        $this->code = $request->code;
        $this->data = $request->data;
        $this->endpoint = $endpoint;
        $this->curl_url = $curl_url;
        
        return $this;
    }
    
    public function getJson()
    {
        return $this->json;
    }
    
    public function getEndpoint()
    {
        return $this->endpoint;
    }
    
    public function getCurlUrl()
    {
        return $this->curl_url;
    }
}