<?php namespace surdaft\anook\libs\api;

use surdaft\anook\libs\api\Request;

class Api
{
    const API_URL = "https://www.anook.com/api";
    
    private $code;
    private $endpoint;
    private $headers;
    private $curl_url;
    
    public static function __callStatically($name, $arguments)
    {
        if ($name == 'query') {
            return new static(...$arguments);
        }
        
        static::$name(...$arguments);
    }
    
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
        $this->curl_url = "{self::API_URL}/{$this->endpoint}";
    }
    
    public function curl()
    {
        $ch = curl_init($this->curl_url);
        curl_setopt_array($ch, [
                
        ]);
        $return = curl_exec($ch);
        curl_close($ch);
        
        return new Request($return, $this->endpoint, $this->curl_url);
    }
}