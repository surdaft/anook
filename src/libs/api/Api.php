<?php namespace surdaft\anook\libs\api;

use surdaft\anook\libs\api\Request;
use surdaft\anook\helpers\Debug;

class Api
{
    private $api_url = "https://www.anook.com/api";
    
    private $code;
    private $endpoint;
    private $curl_url;
    
    private $debug_request = false;
    
    private $headers = [
        'X-Surdaft-Anook: Hiya!'    // an identifying header.. just incase we ever needed to do that
    ];
    
    public static function __callStatic($name, $arguments)
    {
        if ($name == 'query') {
            return new static(...$arguments);
        }
        
        static::$name(...$arguments);
    }
    
    public function __construct($endpoint, $options = [])
    {
        $this->endpoint = $endpoint;
        
        if (!empty($options['headers'])) {
            // To allow for custom headers on specific requests
            $this->headers = array_merge($options['headers'], $this->headers);
        }
        
        if (!empty($options['api_url'])) {
            // incase we wish to allow this api library to access other api's
            $this->api_url = $options['api_url'];
        }
        
        if (!empty($options['debug'])) {
            $this->debug_request = true;
        }
        
        $this->curl_url = "{$this->api_url}/{$this->endpoint}";
        
        return $this;
    }
    
    public function curl()
    {
        $ch = curl_init($this->curl_url);
        curl_setopt_array($ch, [
            CURLOPT_FOLLOWLOCATION  => true,            // follow redirects
            CURLOPT_RETURNTRANSFER  => true,            // return what is on the other end inside the exec variable
            CURLOPT_HTTPHEADER      => $this->headers
        ]);
        $return = curl_exec($ch);
        
        if ($this->debug_request) {
            Debug::printExit($return);
        }
        
        curl_close($ch);
        
        return new Request($return, $this->endpoint, $this->curl_url);
    }
}