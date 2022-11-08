<?php
    namespace Tjall\Lib\Helpers;

    class Url {
        public static function getParts(string $listener_url) {
            $listener_url = self::strip($listener_url, false);
            $items = explode('/', self::strip($listener_url, false));

            $parts = [];

            foreach ($items as $item) {
                if(str_starts_with($item, ':')) {
                    $part = [
                        'type' => 'param',
                        'name' => rtrim(ltrim($item, ':'), '?'),
                        'is_required' => !str_ends_with($item, '?')
                    ];
                } else {
                    $part = [
                        'type' => 'path',
                        'name' => $item
                    ];
                }
                
                array_push($parts, $part);
            }

            return $parts;
        }

        public static function getParams(string $request_url, array $parts) {
            $request_url = self::strip($request_url, false);
            $items = explode('/', $request_url);

            $params = [];

            foreach ($parts as $index => $part) {
                if($part == '')
                    continue;

                if($part['type'] == 'param') {
                    if($part['is_required'] && !@$items[$index]) {
                        $params = false;
                        break;
                    }

                    $params[$part['name']] = @$items[$index];
                }

                if($part['type'] == 'path' && @$items[$index] != $part['name']) {
                    $params = false;
                    break;
                }
            }

            return $params;
        }

        public static function strip($url, $keep_query = true) {
            // The '?' is also used for optional url parameters
            if(!$keep_query && strpos($url, '?') != strlen($url) - 1) 
                $url = strtok($url, '?');


            return rtrim(rtrim(strtolower($url), '/'), '?');
        }

        public static function makeRelative(string $url, string $root) {
            if(empty($root)) return $url;
            
            return substr($url, strpos($url, $root) + strlen($root));
        }

        public static function join(...$items) {
            return implode('/', array_map(function($item) {
                return trim($item, '/');
            }, $items));
        }
    }