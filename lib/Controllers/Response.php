<?php 
    namespace Tjall\App\Controllers;

    use Tjall\App\Controllers\StaticAsset;

    class Response {
        public static int $status = 0;
        public static array $data = [];
        private static array $options = [];
        private static $redirect;

        public static function init(array $options = []) {
            self::$options = $options;

            return __CLASS__;
        }

        public static function send($data) {
            array_push(self::$data, @self::getOption('json') || is_array($data) ? json_encode($data) : $data);

            return __CLASS__;
        }

        public static function status(int $status) {
            self::$status = $status;

            return __CLASS__;
        }

        public static function header(string $key, string $value) {
            if(!headers_sent())
                header("{$key}: {$value}", true);

            return __CLASS__;
        }
        
        public static function throw(int $status = 400, $message = null) {
            if(self::getOption('json')) {
                self::status($status)::send(['error' => $message ?? $status, 'status' => $status])::end();
                return __CLASS__;
            }

            self::status($status)::send(View::get('error/403'))::end();

            return __CLASS__;
        }
        
        public static function end() {
            if(self::getOption('json'))
                self::header('content-type', 'application/json');

            if(self::$redirect)
                self::header('location', self::$redirect);

            if(!self::$status)
                self::status(self::$redirect ? 302 : 200);

            echo(implode('', self::$data));
            
            exit(http_response_code(self::$status));

            return __CLASS__;
        }

        public static function getOption($key) {
            return @self::$options[$key];
        }

        public static function redirect(string $dest) {
            self::$redirect = $dest;
        }

        public static function sendFile(string $filename) {
            $content_type = StaticAsset::getContentType($filename);
            $content_length = filesize($filename);
            $content = file_get_contents($filename);

            return self
                ::header('Content-Type', $content_type)
                ::header('Content-Length', $content_length)
                ::send($content);
        }
    }