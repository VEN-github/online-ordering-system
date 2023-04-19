<?php

declare(strict_types=1);

if ( ! function_exists('include_files_in_directory')) {
    function include_files_in_directory(string $directory = '')
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                include $file->getPathname();
            }
        }
    }
}

if ( ! function_exists('get_latest_api_version_with_prefix')) {
    function get_latest_api_version_with_prefix($isUppercase = true): string
    {
        return ($isUppercase ? 'V' : 'v') . config('api.version.latest');
    }
}

if ( ! function_exists('get_fully_qualified_class_name')) {
    function get_fully_qualified_class_name(string $class): string
    {
        $reflectionClass = new ReflectionClass($class);

        return $reflectionClass->getName();
    }
}
