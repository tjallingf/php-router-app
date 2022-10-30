<?php
    namespace Tjall\Router\Models;

    use Tjall\Router\Models\Model;

    class User extends Model {
        public static function all() {
            $path = root_dir() . '/storage/data/users.json';

            return json_decode(file_get_contents($path), true);
        }

        public static function update(string $username, array $new_user) {
            $user = self::find($username, true);

            foreach ($new_user as $key => $value) {
                $user[$key] = $value;
            }

            $path = root_dir() . "/storage/data/users.json";
            $users = self::all();
            $users[$username] = $user;
            file_put_contents($path, json_encode($users), true);

            return __CLASS__;
        }

        public static function passwordMatches(string $username, string $password) {
            $user = @self::find($username, false);
            return password_verify($password, @$user['password_hash']);
        }

        public static function find(string $username, bool $hide_explicits = true) {
            $user = self::all()[$username];
            
            if($hide_explicits !== false)
                unset($user['password_hash']);

            return $user;
        }
    }