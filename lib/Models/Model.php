<?php
    namespace Tjall\Lib\Models;

    abstract class Model {
        abstract public static function find(string $id);
        abstract public static function all();
    }