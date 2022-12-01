<?php
    namespace Tjall\Lib\Controllers;

    use Tjall\Lib\Controllers\Controller;

    class Config extends Controller {
        protected static array $data = [];

        static public function populate() {
            static::$data = json_decode(file_get_contents(APP_CONFIG_FILE), true) ?? [];
        }
    }