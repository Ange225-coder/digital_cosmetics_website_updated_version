<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;

    function getFullNameCtrl(): void
    {
        $get_full_name = new UsersManager();

        $request = $_SERVER['REQUEST_METHOD'];

        if($request == 'POST') {

            $full_name = strip_tags($_POST['full_name']);

            $dataExists = false;

            foreach($get_full_name->getFullName() as $checkingFullName) {

                if($full_name === $checkingFullName['u_full-name']) {

                    $_SESSION['full_name'] = $full_name;

                    header('location: ../../../frontend/views/users/forgottenPwd/resetEmailForm.php');

                    $dataExists = true;
                }
           }

            if(!$dataExists) {
                throw new UsersManagerExceptions($full_name.UsersManagerExceptions::errorFullNameNotExists());
            }
        }
    }