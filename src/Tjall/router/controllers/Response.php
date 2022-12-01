<?php
    namespace Tjall\Router\Controllers;

    class Response {
        const BODY_SEPERATOR = "\r\n";

        protected static array $listener;
        protected static array $headers = [];
        protected static array $body = [];
        protected static int $statusCode = 200;

        public static function init(array $listener) {
            self::$listener = $listener;

            return __CLASS__;
        }

        public static function send($data): string {
            array_push(self::$body, $data);

            return __CLASS__;
        }

        public static function json($data): string {
            self::send(json_encode($data));
            self::header('content-type', 'application/json');

            return __CLASS__;
        }

        public static function status(int $status_code) {
            self::$statusCode = $status_code;

            return __CLASS__;
        }

        public static function sendError($message, int $status_code = 0) {
            if($status_code) self::status($status_code);
            self::send($message);
            
            self::end();

            return __CLASS__;
        }

        public static function header(string $key, string $value, bool $replace = false): string {
            $key = strtolower(trim($key));
            
            if(!isset(self::$headers[$key]) || $replace)
                self::$headers[$key] = $value;

            return __CLASS__;
        }

        public static function end(): string {
            // Send headers
            foreach (self::$headers as $key => $value) {
                header("{$key}: ${value}", true);
            }

            // Send status code
            http_response_code(self::$statusCode);

            // Send body
            echo(implode(self::BODY_SEPERATOR, self::$body));

            return __CLASS__;
        }
    }