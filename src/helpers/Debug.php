<?php namespace surdaft\anook\helpers;

class Debug
{
    public static function printExit(...$data)
    {
         echo '<pre>';
         foreach ($data as $data_item) {
            echo print_r($data_item, true) . "\n";
         }
         echo '</pre>';
         exit;
    }
}