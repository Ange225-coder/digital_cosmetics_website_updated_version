<?php

    declare(strict_types = 1);

    require_once(__DIR__.'/../../../autoload/autoload.php');

    use App\model\productManager\ProductInCartManager;

    function getTotalPriceCtrl(): array
    {
        $get_total_price = new ProductInCartManager();

        $full_name = $_SESSION['full_name'];

        return $get_total_price->getTotalPrice($full_name);
    }