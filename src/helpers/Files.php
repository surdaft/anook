<?php namespace surdaft\anook\helpers;

class Files
{
    /**
     * Path from root dir of the plugin
     */
    public static function mkdir($path)
    {
        $path_array = explode('/', $path);
        
        $current_directory = SURDAFT_ANOOK_PLUGIN_DIR;
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