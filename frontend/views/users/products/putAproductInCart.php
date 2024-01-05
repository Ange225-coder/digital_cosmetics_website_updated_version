<?php
    if(!isset($_SESSION)) {
        session_start();

        //if(!$name || !$email) {
            //header('location: ../regist_auth/login.php');
        //}
    }

    $full_name = $_SESSION['full_name'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $phone = $_SESSION['phone'] ?? '';

    require_once(__DIR__.'/../../../../backend/controller/productsManagerCtrl/getAProductDatasCtrl.php');
    require_once(__DIR__.'/../../../../backend/controller/usersManagerCtrl/getOrderInProcessCtrl.php');

    try {
        $get_product_data = getAProductDatasCtrl();
    }
    catch(\Throwable $t) {
        $error_missing_productId = $t->getMessage();
    }


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mise en panier de <?= $get_product_data['p_name']; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/putProductInCart.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link rel="website icon" type="png" href="../../../../public/pics/logo/dc.png">
    </head>

    <body>

        <nav>
            <div class="nav-content">
                <div class="logo">
                    <h1>
                        <a href="../../../../index.php">
                            <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics">
                        </a>
                    </h1>

                    <p class="logo-text">
                        Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                    </p>
                </div>

                <div class="user-block">

                    <details>
                        <summary>
                            <span>
                                <?php if(!$full_name): ?>

                                    <span class="login">
                                        <i class="bi bi-person --margR"></i> <span>Se connecter</span>
                                    </span>

                                <?php endif; ?>


                                <?php if($full_name): ?>

                                    <span class="logged">
                                        <span class="bi bi-person-check --fontS"></span><span> <?= $full_name; ?></span>
                                    </span>

                                <?php endif; ?>
                                <i class="bi bi-chevron-down --margL"></i>
                            </span>

                            <i class="bi bi-list" title="menu" id="menuHamburger"></i>
                        </summary>

                        <div>
                            <?php if(!$email): ?>
                                <a href="../regist_auth/login.php" class="login">Se connecter</a>

                                <hr class="login-line">
                            <?php endif; ?>

                            <?php if($email): ?>
                                <a href="../settings/userSettings.php" class="logged"><i class="bi bi-gear-wide"></i> <span>Paramètres</span></a>
                                <a href="../products/cart.php" class="logged cart"><i class="bi bi-cart3"></i><sup><?= count(getOrderInProcessCtrl()); ?></sup> <span>Panier</span></a>
                                <a href="../products/orderProcessed.php" class="logged"><i class="bi bi-box-seam"></i> <span>Mes commandes</span></a>
                            <?php endif; ?>

                            <a href="../suggestions/contact.php" class="contact"><i class="fa-regular fa-address-book"></i> <span>A propos de nous</span></a>

                            <?php if($email): ?>
                                <hr class="logged-line">

                                <a href="../../../../backend/logout/logout.php" class="--center">Déconnexion</a>
                            <?php endif; ?>
                        </div>
                    </details>
                </div>
            </div>
        </nav>


        <section>
            <div class="product-presentation">

                <div class="product-presentation__img">
                    <?php if(!empty($get_product_data['p_img'])): ?>
                        <?php $imgData = base64_encode($get_product_data['p_img']); ?>

                        <img src="data:;base64, <?= $imgData ?>" alt="<?= $get_product_data['p_name'] ?>">
                    <?php endif; ?>
                </div>

                <div class="product-presentation__features">
                    <h1><?= $get_product_data['p_name']; ?></h1>

                    <p class="description"><?= $get_product_data['p_description']; ?></p>

                    <?php if($get_product_data['p_quantity'] == 0): ?>
                        <p>
                            <span class="unavailable">Stock épuisé</span>
                        </p>
                    <?php else :?>
                        <p>
                            <span class="available">Disponible</span>
                        </p>
                    <?php endif; ?>

                    <hr >

                    <h2><?= $get_product_data['p_price']; ?> Fcfa</h2>

                    <p class="remaining-items">

                        <span>

                            <?php if($get_product_data['p_quantity'] > 1) :?>

                                <?= $get_product_data['p_quantity'] ?>
                                articles restant
                            <?php elseif($get_product_data['p_quantity'] == 1): ?>

                                <?= $get_product_data['p_quantity'] ?>
                                article restant
                            <?php endif; ?>
                        </span>


                        <?php if($get_product_data['p_quantity'] == 0): ?>
                            <span>Indisponible pour l'instant</span>
                        <?php endif;?>
                    </p>


                    <?php if($get_product_data['p_quantity'] == 0): ?>

                    <?php else: ?>
                        <p class="delivery">Livraison gratuite si quantité achetée est supérieur à 3.</p>
                    <?php endif; ?>




                    <?php if($get_product_data['p_quantity'] == 0): ?>
                        <div class="notice">
                            <p>
                                Le stock du produit est épuisé.
                                Contacter le fournisseur pour obtenir la procédure d'achat de ce produit.
                            </p>

                            <p class="notice--bg">
                                <a href="https://api.whatsapp.com/send?phone=2250160318959" target="_blank"><i class="bi bi-whatsapp"></i> <span>Contacter le fournisseur</span></a>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- fin de presentation du produit -->

            <div class="finalize-purchase">
                <h1>Finaliser l'achat du produit</h1>

                <hr class="first-line">

                <form method="POST" action="../../../../backend/router/router.php?action=setUserNSetProductInCartCtrl&amp;product_id=<?= $get_product_data['product_id']; ?>">

                    <p class="error">
                        <?php if(isset($error_setUser_n_setProductInCart)): ?>
                            <?= $error_setUser_n_setProductInCart ?>
                        <?php endif; ?>
                    </p>


                    <?php if(!$full_name): ?>
                        <div class="user-block-without-info">

                            <p>Informations acheteur</p>

                            <div class="input-block">
                                <div>
                                    <label for="fullName">
                                        <input type="text" name="fullName" placeholder="Nom complet" id="fullName" maxlength="24" required>
                                    </label>
                                </div>

                                <div>
                                    <label for="email">
                                        <input type="email" name="email" id="email" placeholder="Email" required>
                                    </label>
                                </div>

                                <div>
                                    <label for="phoneNumber">
                                        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Contact téléphonique" required>
                                    </label>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>

                    <?php if($full_name): ?>
                        <div class="user-block-with-info">
                            <p>
                                Nom complet : <span><?= $full_name ?></span>
                            </p>

                            <hr class="second-line">

                            <p>
                                Email: <span><?= $email; ?></span>
                            </p>

                            <hr class="second-line">

                            <p>
                                Contact: <span><?= $phone; ?></span>
                            </p>

                            <hr class="second-line">
                        </div>
                    <?php endif; ?>

                    <div class="quantity">
                        <label for="quantityToBuy">
                            <p>Quantité de produit à acheter</p>
                            <input type="number" name="quantityToBuy" id="quantityToBuy" min="1" max="<?= $get_product_data['p_quantity']; ?>" required>
                        </label>
                    </div>

                    <?php if($get_product_data['p_quantity'] == 0): ?>

                    <?php else: ?>
                        <div class="btn">
                            <i class="bi bi-cart-plus"></i>
                            <button type="submit">J'achète</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>

        </section>


        <footer>
            <div>
                <p>
                    Digital Cosmetics - Tous droits réservés
                </p>
            </div>
        </footer>

    </body>
</html>