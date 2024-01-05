<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersSettingsManager;
    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersSettingsExceptions;

    function delAccountCtrl(): void
    {
        $deletion = new UsersSettingsManager();
        $users_data = new UsersManager();

        $request = $_SERVER['REQUEST_METHOD'];

        $user_id = $_SESSION['id'];
        $full_name = $_SESSION['full_name'];

        //$user_id = $deletion->getUserId($id);

        if($request == 'POST') {
            $email = strip_tags($_POST['email']);

            $data_entered = $users_data->getUserDataForLogin($full_name);

            if($data_entered && $data_entered['u_email'] === $email) {

                $deletion->delAccount($user_id);

                session_destroy();
            }
            else {
                throw new UsersSettingsExceptions(UsersSettingsExceptions::errorEmail());
            }
        }
    }