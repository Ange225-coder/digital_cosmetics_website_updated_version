<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $email = $_SESSION['email'] ?? '';
    $full_name = $_SESSION['full_name'] ?? '';

    require_once('../../../../backend/controller/searchesManagerCtrl/getSearchedProductCtrl.php');
    require_once('../../../../backend/controller/usersManagerCtrl/getOrderInProcessCtrl.php');

    //counter of product found
    $product_counter = null;
    try {
        $product_counter = count(getSearchedProductCtrl());
    }
    catch(Throwable $t) {
        $error_product_counter = $t->getMessage();
    }

    //display of products found
    $display_product = array();
    try {
        $display_product = getSearchedProductCtrl();
    }
    catch(Throwable $t) {
        $error_display_product = $t->getMessage();
    }

    $product_searched = $_GET['product_searches'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rechercher un produit</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/search-bar.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
        <link rel="website icon" type="png" href="../../../../public/pics/logo/dc.png">
    </head>

    <body>

        <nav>

            <div class="nav-content">

                <div class="logo">
                    <h1>
                        <a href="../../../../index.php">
                            <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics_logo">
                        </a>
                    </h1>

                    <p class="logo-text">
                        Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                    </p>
                </div>


                <div class="nav-form-user">
                    <form method="GET" action=""  class="input">
                        <div>
                            <label for="product_searches">
                                <input type="search" name="product_searches" id="product_searches" placeholder="Entrer un mot clé Ex: savon, huile, dentifrice..." required autofocus>
                                <i class="bi bi-search"></i>
                            </label>
                        </div>
                    </form>

                    <div class="user">
                        <details>
                            <summary>
                                <span>
                                    <?php if(!$email || !$full_name): ?>

                                        <span class="login">
                                            <i class="bi bi-person --margR"></i> <span>Se connecter</span>
                                        </span>

                                    <?php else: ?>

                                        <span class="logged">
                                            <span class="bi bi-person-check --fontS"></span><span><?= $full_name; ?></span>
                                        </span>

                                    <?php endif; ?>
                                    <i class="bi bi-chevron-down --margL"></i>
                                </span>

                                <i class="bi bi-list" title="menu" id="menuHamburger"></i>
                            </summary>

                            <div>
                                <?php if(!$email): ?>
                                    <a href="../../../../frontend/views/users/regist_auth/login.php" class="login">Se connecter</a>

                                    <hr class="login-line">
                                <?php endif; ?>

                                <?php if($email): ?>
                                    <a href="../../../../frontend/views/users/settings/userSettings.php" class="logged"><i class="bi bi-gear-wide"></i> <span>Paramètres</span></a>
                                    <a href="../../../../frontend/views/users/products/cart.php" class="logged cart"><i class="bi bi-cart3"></i><sup><?= count(getOrderInProcessCtrl()); ?></sup> <span>Panier</span></a>
                                    <a href="../../../../frontend/views/users/products/orderProcessed.php" class="logged"><i class="bi bi-box-seam"></i> <span>Mes commandes</span></a>
                                <?php endif; ?>

                                <a href="../../../../frontend/views/users/suggestions/contact.php" class="contact"><i class="fa-regular fa-address-book"></i> <span>A propos de nous</span></a>

                                <?php if($email): ?>
                                    <hr class="logged-line">

                                    <a href="../../../../backend/logout/logout.php" class="--center">Déconnexion</a>
                                <?php endif; ?>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </nav>

        <div class="back-link-block">
            <a href="../../../../index.php" title="Accueil">
                <i class="bi bi-chevron-left"></i><span>Retour à l'accueil</span>
            </a>
        </div>








        <section class="searchs-done">

            <div class="counter-block">

                <p>
                    <?= $product_counter; ?>

                    <span>
                        <?php if(isset($product_counter) && $product_counter > 1): ?>
                            résultats trouvés pour "<?= $product_searched; ?>"
                        <?php elseif(!isset($product_counter)): ?>

                        <?php else :?>
                            résultat trouvé pour "<?= $product_searched; ?>"
                        <?php endif; ?>
                    </span>
                </p>
            </div>


            <?php if(!$product_counter): ?>
                <section class="empty-search">
                    <div class="img">
                        <img src="../../../../public/pics/medicine.svg" alt="digital_cosmetic">
                    </div>

                    <div class="text">
                        <h1>De quels produits avez-vous besoin ?</h1>

                        <h2>Les résultats de recherches s'afficheront ici...</h2>
                    </div>
                </section>
            <?php endif; ?>

            <article>
                <?php foreach($display_product as $product): ?>
                    <div class="products">
                        <div class="img">
                            <?php if(!empty($product['p_img'])): ?>
                                <?php $imgData = base64_encode($product['p_img']); ?>

                                <img src="data:;base64, <?= $imgData ?>" alt="longrich_<?= $product['p_name']; ?>" width="200">
                            <?php endif; ?>
                        </div>

                        <div class="features">
                            <p class="features--color">
                                <?= $product['p_category'] ?>
                            </p>

                            <h3><?= $product['p_name']; ?></h3>

                            <p class="features-description">
                                <?= $product['p_description']; ?>
                            </p>

                            <p class="features-price">
                                <?= $product['p_price']; ?> Fcfa
                            </p>

                            <p class="features-link">

                                <a href="../products/putAproductInCart.php?product_id=<?= $product['product_id']; ?>">
                                    <span class="material-symbols-outlined">add_shopping_cart</span>
                                    <span>Ajouter au panier</span>
                                </a>
                            </p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </article>
        </section>

        <!-- display it only if products are greater than 3 -->
        <?php if($product_counter >= 3): ?>
            <footer>
                <div>
                    <p>
                        Digital Cosmetics - Tous droits réservés
                    </p>
                </div>
            </footer>
        <?php endif; ?>
    </body>
</html>