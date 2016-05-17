<?php namespace surdaft\anook;

class Debug
{
    public static function dd(...$data)
    {
         echo '<pre>';
         foreach ($data as $data_item) {
            echo print_r($data_item, true) . "\n";
         }
         echo '</pre>';
         exit;
    }
}