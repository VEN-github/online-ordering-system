<?php

if (! function_exists('include_files_in_directory')) {
    function include_files_in_directory(string $directory = '')
    {
        foreach (glob("$directory/*.php") as $filename)
        {
            include $filename;
        }
    }
}

if (! function_exists('get_latest_api_version_with_prefix')) {
    function get_latest_api_version_with_prefix($isUppercase = true): string
    {
        return ($isUppercase ? 'V' : 'v') . config('api.version.latest');
    }
}

if (! function_exists('get_fully_qualified_class_name')) {
    function get_fully_qualified_class_name(string $class): string
    {
        $reflectionClass = new ReflectionClass($class);

        return $reflectionClass->getName();
    }
}
