<?php 
    // namespace Tjall\Lib\Helpers;

    // class Url {
    //     public static function trim(string $url): string {
    //         $parts = self::parse($url);
    //         $res = '';

    //         $res .= $parts['path'];
    //         $res .= $parts['query'] ? '?'.$parts['query'] : '';

    //         return $res;
    //     }

    //     public static function toPartsArray(string $url): array {

    //     }

    //     public static function templateTrim(string $template): string {
    //         // Remove leading and trailing slashes
    //         $template = '/'.trim($template, '/');
            
    //         // Convert all parts that are not a parameter to lowercase
    //         $template = preg_replace_callback('/[^{}]+(?![^{]*})/', function ($match) {
    //             return strtolower($match[0]);
    //         }, $template);

    //         return $template;
    //     }

    //     public static function templateToPartsArray(string $template): array {
    //         $parts = explode('/', $template);
    //         $url_array = [];

    //         foreach ($parts as $index => $part) {
    //             $is_parameter = (str_starts_with($part, '{') && str_ends_with($part, '}'));
    //             $part_name = ltrim(rtrim($part, '}'), '{');

    //             if(!$is_parameter)
    //                 $part_name = strtolower($part_name)

    //             $url_array[$index] = [
    //                 'is_parameter' => $is_parameter,
    //                 'name' => $part_name
    //             ];
    //         }

    //         return $url_array;
    //     }

    //     public static function matchesTemplate(array $url_parts, array $template_parts): bool {
    //         var_dump($url_parts, $template_parts);
    //         return false;
    //     }

    //     public static function parse(string $url): array {
    //         $parts = parse_url($url);

    //         return [
    //             'scheme'   => strtolower($parts['scheme'] ?? ''),
    //             'hostname' => strtolower($parts['hostname'] ?? ''),
    //             'path'     => '/'.strtolower(trim($parts['path'] ?? '/', '/')),
    //             'query'    => $parts['query'] ?? ''
    //         ];
    //     }
    // }