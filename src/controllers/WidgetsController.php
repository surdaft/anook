<?php namespace surdaft\anook\controllers;

class WidgetsController extends Controller
{
    public static function update($new_data, $old_Data)
    {
        // loop through widget values and sanitize them.
        foreach ($new_data as $datA_key => &$data_value) {
            $data_value = strip_tags($data_value);
            $data_value = add_slashes($data_value);
        }
        
        return $new_data;
    }
}