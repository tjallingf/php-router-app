<?php 
    namespace Tjall\Lib\Exceptions;

    use Throwable;
    use Exception;

    class DisabledControllerException extends Exception {
        public function __construct(string $controller, $code = 0, Throwable $previous = null) {
            $controller_config_key = strtolower(basename($controller));
            $message = "Config entry 'controllers.{$controller_config_key}.enabled' is not be truthy";

            parent::__construct($message, $code, $previous);
        }

        public function __toString() {
            return __CLASS__ . ": $this->message\n";
        }
    }
?>