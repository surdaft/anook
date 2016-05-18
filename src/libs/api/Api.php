<?php namespace surdaft\anook\libs\api;

use surdaft\anook\libs\api\Request;
use surdaft\anook\Debug;
use surdaft\anook\helpers\Files;

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
    
    /**
     * Add caching to this
     */
    public function curl()
    {
        /**
         * Cache using wp transients, this will then hook into any caching plugins used by the user, as well
         * as provide caching for those that do not have such things.
         */
        $transient_id = "surdaft/anook/{$this->endpoint}";
        if (($request = get_transient($transient_id)) !== false) {
            // if any images we need to update them here
            return $request;
        }
        
        $ch = curl_init($this->curl_url);
        curl_setopt_array($ch, [
            CURLOPT_FOLLOWLOCATION  => true,            // follow redirects
            CURLOPT_RETURNTRANSFER  => true,            // return what is on the other end inside the exec variable
            CURLOPT_HTTPHEADER      => $this->headers
        ]);
        $return = curl_exec($ch);
        
        if ($this->debug_request) {
            Debug::dd($return);
        }
        
        $decoded_return = json_decode($return);
        
        curl_close($ch);
        
        // cache image
        $decoded_return->data[0]->picture = static::cacheImage($decoded_return->data[0]->picture);
        
        
        $request = new Request($decoded_return, $this->endpoint, $this->curl_url, $return);
        set_transient($transient_id, $request, 12 * HOUR_IN_SECONDS);
        
        // set that it is fresh within the object -- cant hurt.
        $request->setFresh();
        
        return $request;
    }
    
    public function header($header_key, $header_value)
    {
        $this->headers[] = "{$header_key}:{$header_value}";
        
        return $this;
    }
    
    public function headers(array $headers)
    {
        foreach ($headers as $header_key => $header_value) {
            $this->header($header_key, $header_value);
        }
        
        return $this;
    }
    
    public static function getUser($username)
    {
        return self::query("user/{$username}")->curl();
    }
    
    public static function getNook($nook_id)
    {
        return self::query("nook/{$nook_id}")->curl();
    }
    
    public static function getGame($game_id)
    {
        return self::query("game/{$game_id}")->curl();
    }
    
    public static function flushTransient($endpoint)
    {
        return delete_transient("surdaft/anook/{$endpoint}");
    }
    
    public static function cacheImage($image_url)
    {
        # Ensure the directory exists
        Files::mkdir('images/temp');
        
        # Generate a filename using the url - this is not cryptographically secure but that doesn't matter :P
        $filename = md5($image_url);
        $filepath = SURDAFT_ANOOK_DIRECTORY_PATH . "/images/temp/{$filename}.jpg";
        
        $file = file_put_contents($filepath, file_get_contents($image_url));
        
        return plugins_url("anook/images/temp/{$filename}.jpg");
    }
}