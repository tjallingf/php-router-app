<?php
    namespace ExtendRouter;

    use MyApp\Models\UserModel;

    class Request extends \Router\Request {
        public ?UserModel $user = null;
    }