<?php
    namespace MyApp\Models;

    class UserModel {
        protected array $props = [];

        public function __construct(array $props) {
            $this->props = $props;
        }

        public function getFirstName(): string|null {
            return @$this->props['first_name'];
        }

        public function getLastName(): string|null {
            return @$this->props['last_name'];
        }

        public function getName() {
            return $this->getFirstName().' '.$this->getLastName();
        }

        public function getSetting(string $setting): mixed {
            return @$this->props['settings'][$setting];
        }
    }