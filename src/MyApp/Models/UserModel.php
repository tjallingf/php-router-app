<?php
    namespace MyApp\Models;

    class UserModel {
        protected array $props = [];

        public function __construct(array $props) {
            $this->props = $props;
        }

        public function getName() {
            return $this->props['first_name'].' '.$this->props['last_name'];
        }

        public function getSetting(string $setting): mixed {
            return @$this->props['settings'][$setting];
        }
    }