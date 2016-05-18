<?php namespace surdaft\anook\libs\api;

/**
 * This is an api request object, all data from an api call is fed into
 * this class and this is the class you are returned from an API call.
 */
class Request
{
    private $code;
    private $fresh = false; // if this is from a transient
    private $data;
    private $endpoint;
    private $curl_url;
    private $json;
    
    public function __construct($decoded_data, $endpoint, $curl_url, $json_data)
    {
        $this->json = $json_data;
        
        $request = $decoded_data;
        
        $this->code = $request->code;
        $this->data = $request->data;
        $this->endpoint = $endpoint;
        $this->curl_url = $curl_url;
        
        return $this;
    }
    
    public function json()
    {
        return $this->json;
    }
    
    public function endpoint()
    {
        return $this->endpoint;
    }
    
    public function curl_url()
    {
        return $this->curl_url;
    }
    
    public function data()
    {
        return $this->data;
    }
    
    public function code()
    {
        return $this->code;
    }
    
    public function setFresh()
    {
        $this->fresh = true;
        return $this;
    }
}