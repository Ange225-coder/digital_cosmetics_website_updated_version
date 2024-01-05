<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersSettingsManager;
    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersSettingsExceptions;

    function updatePhoneCtrl(): void
    {
        $updatePhone = new UsersSettingsManager();
        $users_datas = new UsersManager();

        $request = $_SERVER['REQUEST_METHOD'];
        $user_id = $_SESSION['id'];

        if($request == 'POST') {
            $new_phone = strip_tags($_POST['new_phone']);

            if(preg_match('#^0[157]([- ]?[0-9]{2}){4}$#', $new_phone)) {
                foreach($users_datas->getUserData() as $phoneVerify) {
                    if($new_phone === $phoneVerify['u_number']) {
                        throw new UsersSettingsExceptions(UsersSettingsExceptions::errorPhoneAlreadyExists());
                    }
                }

                $updatePhone->updatePhone($new_phone, $user_id);

                $_SESSION['phoneUpdating_done'] = 'Mise à jour du contact effectuée avec succèss. Reconnectez-vous pour prendre en compte la mise à jour';
            }
            else {
                throw new UsersSettingsExceptions(UsersSettingsExceptions::errorPhoneFormat());
            }
        }
    }