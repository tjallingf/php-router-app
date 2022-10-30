<?php
    namespace Tjall\Router\Helpers;

    class Error {
        public static function asArray(int $errno, string $errstr, string $errfile, int $errline) {
            return [
                'number' => $errno,
                'message' => $errstr,
                'file' => $errfile,
                'line' => $errline
            ];
        }
    }
?>