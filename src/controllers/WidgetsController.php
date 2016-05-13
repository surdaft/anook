<?php namespace surdaft\anook\controllers;

/**
 * Widgets Controller manages the data processing for widgets
 */
class WidgetsController extends Controller
{
    /**
     * Update
     * loop through the variables and sanitize them for saving
     * @param $new_data     array   An array of the new data to be saved
     * @param $old_data     array   An array of the old data if that influences the new data
     */
    public static function update(array $new_data, array $old_Data)
    {
        // loop through widget values and sanitize them.
        foreach ($new_data as $datA_key => &$data_value) {
            $data_value = strip_tags($data_value);
        }
        
        // return the sanitized data
        return $new_data;
    }
}