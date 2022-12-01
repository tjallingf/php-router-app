<?php
    function require_all($dir) {
        foreach (glob_recursive($dir, '*.php') as $file) require_once $file;
    }

    function glob_recursive($base, $pattern, $flags = 0) {
        $flags = $flags & ~GLOB_NOCHECK;
        
        if (substr($base, -1) !== DIRECTORY_SEPARATOR) {
            $base .= DIRECTORY_SEPARATOR;
        }

        $files = glob($base.$pattern, $flags);
        if (!is_array($files)) {
            $files = [];
        }

        $dirs = glob($base.'*', GLOB_ONLYDIR|GLOB_NOSORT|GLOB_MARK);
        if (!is_array($dirs)) {
            return $files;
        }
        
        foreach ($dirs as $dir) {
            $dirFiles = glob_recursive($dir, $pattern, $flags);
            $files = array_merge($files, $dirFiles);
        }

        return $files;
    }

    function join_paths(...$paths) {
        return preg_replace('~[/\\\\]+~', '/', implode('/', $paths));
    }

    function array_get_path(array $arr, string $path) {
        $path_exploded = explode('.', $path);

        $value = $arr;

        foreach ($path_exploded as $path_item) {
            $value = @$value[$path_item];
        }

        return $value;
    }
    
    function root_dir() {       
        return dirname(str_replace('\\', '/', realpath(__DIR__)));
    }

    function relative_root_dir() {
        $document_root = rtrim(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])), '/');
        
        return str_replace($document_root, '', root_dir());
    }

    // ---------------------------- //
    //          POLYFILLS           //
    // ---------------------------- //
    if(!function_exists('str_contains')) {
        function str_contains(string $haystack, string $needle) {
            return empty($needle) || strpos($haystack, $needle) !== false;
        }
    }

    if(!function_exists('str_starts_with')) {
        function str_starts_with(string $haystack, string $needle) {
            return empty($needle) || strpos($haystack, $needle) === 0;
        }
    }

    if(!function_exists('str_ends_with')) {
        function str_ends_with(string $haystack, string $needle) {
            return empty($needle) || substr($haystack, -strlen($needle)) === $needle;
        }
    }