<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once($path);
    });

    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;

    function getUserDataForLoginCtrl(): void
    {
        $user_data = new UsersManager();

        $request = $_SERVER['REQUEST_METHOD'];

        if($request == 'POST') {
            $full_name = strip_tags($_POST['full_name']);
            $email = strip_tags($_POST['email']);

            $data_entered = $user_data->getUserDataForLogin($full_name);

            if($data_entered && $data_entered['u_email'] === $email) {
                $_SESSION['full_name'] = $full_name;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $data_entered['u_number'];
                $_SESSION['id'] = $data_entered['id'];
            }
            else {
                throw new UsersManagerExceptions(UsersManagerExceptions::errorWrongDatas().'('. $full_name. ' / ' . $email . ')');
            }
        }
    }