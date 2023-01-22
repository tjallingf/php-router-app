<?php
    namespace ExtendRouter;

    use Router\Request as BaseRequest;
    use MyApp\Models\UserModel;

    class Request extends BaseRequest {
        public ?UserModel $user = null;
    }