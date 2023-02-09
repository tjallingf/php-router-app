<?php
    namespace ExtendRouter;

    use App\Models\UserModel;

    class Request extends \Router\Request {
        public ?UserModel $user = null;
    }