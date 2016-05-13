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
    public $cached_item;
    
    public function __construct($api_request_json, $endpoint, $curl_url, $cached_item = false)
    {
        $this->json = $api_request_json;
        
        $request = json_decode($api_request_json);
        
        $this->code = $request->code;
        $this->data = $request->data;
        $this->endpoint = $endpoint;
        $this->curl_url = $curl_url;
        
        // by default a requests cached_item param is false, as though it is a live request.
        $this->cached_item = $cached_item;
        
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