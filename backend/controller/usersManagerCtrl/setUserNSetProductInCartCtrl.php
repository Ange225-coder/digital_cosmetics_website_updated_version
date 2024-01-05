<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    require_once(__DIR__.'/../productsManagerCtrl/getAProductDatasCtrl.php');

    use App\model\productManager\ProductInCartManager;
    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\SetUserNSetProductInCartExceptions;
    use App\exceptions\productManagerExceptions\ProductInCartManagerExceptions;

    //$full_name = $_SESSION['full_name'] ?? '';
    //$email = $_SESSION['email'] ?? '';
    //$phone = $_SESSION['phone'] ?? '';

    function setUserNSetProductInCartCtrl(): void
    {
        $set_user = new UsersManager();
        $set_productInCart = new ProductInCartManager();

        $product_data = getAProductDatasCtrl();

        $purchased_product = $product_data['p_name'];
        $product_image = $product_data['p_img'];

        $request = $_SERVER['REQUEST_METHOD'];

        if(!isset($_SESSION['full_name'])) {

            if($request == 'POST') {
                $full_name = strip_tags($_POST['fullName']);
                $email = strip_tags($_POST['email']);
                $phone = strip_tags($_POST['phoneNumber']);
                $quantityToBuy = $_POST['quantityToBuy'];

                if(isset($_GET['product_id']) && $_GET['product_id'] > 0 && is_numeric($_GET['product_id'])) {
                    $product_id = $_GET['product_id'];

                    /** total price equal quantity of product to buy * product_price */
                    $total_price = $quantityToBuy * $product_data['p_price'];

                    /** regex for user full name  */
                    if(preg_match('#^[a-zA-ZÀ-ÿ ]{4,}$#', $full_name)) {
                        foreach($set_user->getUserData() as $full_name_verify) {
                            if($full_name === $full_name_verify['u_full-name']) {
                                throw new SetUserNSetProductInCartExceptions($full_name.SetUserNSetProductInCartExceptions::errorFullNameAlreadyExist());
                            }
                        }
                    }
                    else {
                        throw new SetUserNSetProductInCartExceptions(SetUserNSetProductInCartExceptions::errorFormatFullName());
                    }

                    /** regex for user email  */
                    if(preg_match('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {
                        foreach($set_user->getUserData() as $email_verify) {
                            if($email === $email_verify['u_email']) {
                                throw new SetUserNSetProductInCartExceptions($email.SetUserNSetProductInCartExceptions::errorEmailAlreadyExist());
                            }
                        }
                    }
                    else {
                        throw new SetUserNSetProductInCartExceptions(SetUserNSetProductInCartExceptions::errorFormatEmail());
                    }


                    /** regex for user phone  */
                    if(preg_match('#^0[157]([- ]?[0-9]{2}){4}$#', $phone)) {
                        foreach($set_user->getUserData() as $phone_verify) {
                            if($phone === $phone_verify['u_number']) {
                                throw new SetUserNSetProductInCartExceptions($phone.SetUserNSetProductInCartExceptions::errorPhoneNumberAlreadyExist());
                            }
                        }
                    }
                    else {
                        throw new SetUserNSetProductInCartExceptions(SetUserNSetProductInCartExceptions::errorFormatPhoneNumber());
                    }

                    /** set user here */
                    $user = $set_user->setUser($full_name, $email, $phone);

                    /** set order here */
                    $productInCart = $set_productInCart->setProductInCart($full_name, $email, $phone, $purchased_product, $product_id, $quantityToBuy, $total_price, $product_image);

                    if($user && $productInCart) {
                        /** user session */
                        $_SESSION['full_name'] = $full_name;
                        $_SESSION['email'] = $email;
                        $_SESSION['phone'] = $phone;

                        foreach($set_user->getUserData() as $getId) {
                            $_SESSION['id'] = $getId['id'];
                        }

                        $new_product_quantity = $product_data['p_quantity'] - $quantityToBuy;

                        $set_productInCart->updatingProductQuantity($new_product_quantity, $product_id);
                    }
                }
                else {
                    throw new ProductInCartManagerExceptions(ProductInCartManagerExceptions::errorMissingProductId());
                }
            }
        }
        else {

            if($request == 'POST') {
                $quantityToBuy = strip_tags($_POST['quantityToBuy']);

                if(isset($_GET['product_id']) && $_GET['product_id'] > 0 && is_numeric($_GET['product_id'])) {
                    $product_id = $_GET['product_id'];

                    $total_price = $quantityToBuy * $product_data['p_price'];

                    /** set order here */
                    $setProductInCart = $set_productInCart->setProductInCart($_SESSION['full_name'], $_SESSION['email'], $_SESSION['phone'], $purchased_product, $product_id, $quantityToBuy, $total_price, $product_image);

                    if($setProductInCart) {
                        $newProductQuantity = $product_data['p_quantity'] - $quantityToBuy;

                        $set_productInCart->updatingProductQuantity($newProductQuantity, $product_id);
                    }
                }
            }
        }
    }
