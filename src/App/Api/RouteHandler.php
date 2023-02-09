<?php
    namespace App\Api;

    class RouteHandler {
        protected string $controllerClass;

        public function construct(string $controller_class) {
            $this->controllerClass = $controller_class;
        }

        public function list(string $id) {

        }
    }