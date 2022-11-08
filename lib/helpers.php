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

    function root_dir() {
        return dirname(__DIR__);
    }

    function join_paths(...$paths) {
        return preg_replace('~[/\\\\]+~', DIRECTORY_SEPARATOR, implode(DIRECTORY_SEPARATOR, $paths));
    }

    function str_replace_first(string $search, string $replace, string $subject) {
        $pos = strpos($subject, $search);
        if($pos === false)
            return $subject;

        return substr_replace($subject, $replace, $pos, strlen($search));
    }

    function random_hex($length) {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    function random_str($length = 32) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
    }

    function base64_url_encode($str) {
        return str_replace(['=', '+', '/'], ['', '-', '_'], base64_encode($str));
    }

    function base64_url_decode($str) {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $str));
    }

    function date_iso($unix = null) {
        if(!isset($unix)) {
            $unix = time();
        }

        $datetime = new DateTime();
        $datetime->setTimestamp($unix);
        return $datetime->format(DateTime::ATOM); 
    }

    function strpos_all($haystack, $needle) {
        $needle_length = strlen($needle);
        $offset = 0;
        $occurence = 0;
        $occurences = [];

        while (($offset = strpos($haystack, $needle, $offset)) !== false) {
            array_push($occurences, $offset);
            $offset += $needle_length; 
        }

        return $occurences;
    }

    function array_search_key(array $haystack, $needle) {
        $iterator  = new RecursiveArrayIterator($haystack);
        $recursive = new RecursiveIteratorIterator(
            $iterator,
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($recursive as $key => $value) {
            if ($key === $needle) {
                return $value;
            }
        }
    }
    
    function array_item_sibling($ref_key, $ref_value, $req_key, $context) {
        foreach ($context as $key => $value) {
            if(isset($value[$ref_key]) && $value[$ref_key] == $ref_value) {
                return $value[$req_key] ?? null;
            }
        }

        return null;
    }

    function escape_quotes($str) {
        return str_replace(['\'', '\"'], ['\\x27', '\\x22'], $str);
    }

    function str_split_pos($str, $pos) {
        $str1 = substr($str, 0, $pos);
        $str2 = substr($str, $pos);

        return [$str1, $str2];
    }

    function strtobool($str) {
        return filter_var($str, FILTER_VALIDATE_BOOLEAN);
    }

    function str_replace_between($needle_start, $needle_end, $replace, $haystack, $replace_needles_too = false) {
        $pos = strpos($haystack, $needle_start);
        $start = $pos === false ? 0 : $pos + strlen($needle_start);

        $pos = strpos($haystack, $needle_end, $start);
        $end = $pos === false ? strlen($haystack) : $pos;

        if($replace_needles_too) {
            $start = $start - strlen($needle_start);
            $end = $end + strlen($needle_end);
        }

        return substr_replace($haystack, $replace, $start, $end - $start);
    }

    function filter_items($item, $filter = []) {
        if(isset($filter) && !empty($filter)) {
            $item = array_filter($item, function ($key) use ($filter) {
                return in_array($key, $filter);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $item;
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