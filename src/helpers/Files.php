<?php namespace surdaft\anook\helpers;

use surdaft\anook\exceptions\FilesException;

/**
 * Files allows for easily creating drectories and checking that they already exist.
 * It would probably be best to run this on most paths within caching.
 */
class Files
{
    /**
     * Path from root dir of the plugin
     * @param $path string This would contain the path you want to make sure exists, from the plugins directory.
     * @throw FilesException
     */
    public static function mkdir($path)
    {
        $path_array = explode('/', $path);
        
        $current_directory = SURDAFT_ANOOK_DIRECTORY_PATH;
        foreach ($path_array as $folder) {
            $current_directory .= "/{$folder}";
            if (!file_exists($current_directory)) {
                if (!mkdir($current_directory)) {
                    throw new FilesException("Error ocurred when trying to create {$folder} at {$current_directory}.");
                }
            }
        }
    }
}