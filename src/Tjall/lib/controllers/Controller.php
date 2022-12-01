<?php 
    namespace Tjall\Lib\Controllers;

    abstract class Controller {
        protected static array $data = [];

        static public function index() {
            if(!count(static::$data)) static::populate();

            return static::$data;
        }

        static public function find(string $item) {
            return array_get_path(static::index(), $item);
        }

        abstract static public function populate();
    }