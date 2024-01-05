<?php

    declare(strict_types = 1);

    if(!isset($_SESSION)) {
        session_start();
    }

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\usersManager\UsersManager;

    function getOrderInProcessCtrl(): bool|array
    {
        $get_orderInProcess = new UsersManager();

        $full_name = $_SESSION['full_name'];

        return $get_orderInProcess->getOrderInProcess($full_name);
    }