<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;

    function resetEmailCtrl(): void
    {
        $reset_email = new UsersManager();

        $full_name = $_SESSION['full_name'];

        $request = $_SERVER['REQUEST_METHOD'];

        if($request == 'POST') {
            $email = strip_tags($_POST['email']);

            if(preg_match('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {
                foreach($reset_email->getUserData() as $checkingEmail) {
                    if($email === $checkingEmail['u_email']) {
                        throw new UsersManagerExceptions($email.UsersManagerExceptions::errorEmailAlreadyExist());
                    }
                }
            }
            else {
                throw new UsersManagerExceptions(UsersManagerExceptions::errorFormatEmail());
            }

            $reset_email->resetEmail($email, $full_name);
        }
    }