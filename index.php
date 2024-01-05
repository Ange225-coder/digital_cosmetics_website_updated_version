<?php session_start();
    require_once('backend/controller/productsManagerCtrl/getProductsListForProductsListCtrl.php');
    require_once('backend/controller/paginationsCtrl/paginationManagerCtrl.php');
    require_once('backend/controller/usersManagerCtrl/getOrderInProcessCtrl.php');

    if(isset($_SESSION)) {
        $full_name = $_SESSION['full_name'] ?? '';
        $email = $_SESSION['email'] ?? '';
        $message = $_SESSION['message'] ?? '';

    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digital Cosmetics - Accueil</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="public/css-prefixed/index_style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Offside&display=swap" rel="stylesheet">
        <link rel="website icon" type="png" href="public/pics/logo/dc.png">

    </head>

    <body>

        <p class="message">

            <?php if(isset($message)): ?>
                <?= $message; ?>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </p>

        <div class="whatsapp-block" title="Discutez avec nous">
            <a href="https://api.whatsapp.com/send?phone=2250160318959" class="whats bi bi-whatsapp" target="_blank"></a>
        </div>

        <nav>

            <div class="nav-content">

                <div class="logo">
                    <h1>
                        <a href="index.php">
                            <img src="public/pics/logo/dc.png" alt="digital_cosmetics_logo">
                        </a>
                    </h1>

                    <p class="logo-text">
                        Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                    </p>
                </div>


                <div class="nav-input-user">

                    <div class="input">
                        <label for="search">
                            <input type="search" id="search" placeholder="Rechercher un produit" onclick="window.location.href='frontend/views/users/searches/productsSearches.php';">
                            <i class="bi bi-search"></i>
                        </label>
                    </div>

                    <div class="search-icon">
                        <span class="bi bi-search" onclick="window.location.href='frontend/views/users/searches/productsSearches.php';"></span>
                    </div>

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
                                            <span class="bi bi-person-check --fontS"></span><span> <?= $full_name; ?></span>
                                        </span>

                                    <?php endif; ?>
                                    <i class="bi bi-chevron-down --margL"></i>
                                </span>

                                <i class="bi bi-list" title="menu" id="menuHamburger"></i>
                            </summary>

                            <div>
                                <?php if(!$email): ?>
                                    <a href="frontend/views/users/regist_auth/login.php" class="login">Se connecter</a>

                                    <hr class="login-line">
                                <?php endif; ?>

                                <?php if($email): ?>
                                    <a href="frontend/views/users/settings/userSettings.php" class="logged"><i class="bi bi-gear-wide"></i> <span>Paramètres</span></a>
                                    <a href="frontend/views/users/products/cart.php" class="logged cart"><i class="bi bi-cart3"></i><sup><?= count(getOrderInProcessCtrl()); ?></sup> <span>Panier</span></a>
                                    <a href="frontend/views/users/products/orderProcessed.php" class="logged"><i class="bi bi-box-seam"></i> <span>Mes commandes</span></a>
                                <?php endif; ?>

                                <a href="frontend/views/users/suggestions/contact.php" class="contact"><i class="fa-regular fa-address-book"></i> <span>A propos de nous</span></a>

                                <?php if($email): ?>
                                    <hr class="logged-line">

                                    <a href="backend/logout/logout.php" class="--center">Déconnexion</a>
                                <?php endif; ?>
                            </div>
                        </details>
                    </div>
                </div>

            </div>
        </nav>



        <div class="banner">
            <div class="banner-content">

                <div class="banner-title">
                    <h1>
                        <img src="public/pics/logo/dc.png" alt="digital_cosmetics_logo">
                    </h1>

                    <h2>
                        Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                    </h2>
                </div>

                <div class="banner-description">
                    <p>
                        Digital Cosmetics est une entreprise filiale de l’entreprise Longrich en Côte d'Ivoire.
                    </p>

                    <p>
                        Notre Mission est de vous présenter des produits multi usages dans le domaine de la santé et des cosmétiques naturelles, bio et sans effets secondaires comprenant de nombreux avantages.
                    </p>
                </div>


                <div class="share-links">
                    <a href="https://wa.me/?text=Découvrez%20mon%20site%20web%20ici%3A%20https%3A%2F%2Fwww.digitalcosmetics.africa" class="bi bi-whatsapp"></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.digitalcosmetics.africa" target="_blank" class="bi bi-facebook"></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://www.digitalcosmetics.africa" class="bi bi-linkedin"></a>
                    <a href="https://twitter.com/intent/tweet?url=https://www.digitalcosmetics.africa&text=Découvrez mon site web ici!" class="bi bi-twitter"></a>
                </div>
            </div>
        </div>


        <div class="swiper-phone">
            <div class="swiper-phone--blur">

                <swiper-container class="mySwiper" pagination="true" pagination-dynamic-bullets="true">

                    <swiper-slide>
                        <div class="health-product-text">
                            <h1>
                                Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                            </h1>

                            <hr>

                            <p class="product-category">Santé</p>

                            <h2>Vos produits de santés à moindre cout</h2>

                            <div class="product-price">
                                <p>A partir de </p>
                                <p>1200 FCFA</p>
                            </div>
                        </div>

                        <div class="health-product">
                            <img src="public/pics/health_pics/liqueur.jpg" alt="digital_cosmetics_liqueur">
                        </div>
                    </swiper-slide>

                    <swiper-slide>
                        <div class="cosmetics-product-text">
                            <h1>
                                Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                            </h1>

                            <hr>

                            <p class="product-category">Cosmétique</p>

                            <h2>Les meilleures offres du moment</h2>

                            <div class="product-price">
                                <p>A partir de </p>
                                <p>3800 FCFA</p>
                            </div>
                        </div>

                        <div class="cosmetics-product">
                            <img src="public/pics/cosmetics_pics/long_baby.jpg" alt="digital_cosmetics_long_baby">
                        </div>
                    </swiper-slide>
                </swiper-container>

                <hr class="underSwiperLine">

                <div class="share-links">
                    <a href="https://wa.me/?text=Découvrez%20mon%20site%20web%20ici%3A%20https%3A%2F%2Fwww.digitalcosmetics.africa" class="bi bi-whatsapp"></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.digitalcosmetics.africa" target="_blank" class="bi bi-facebook"></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://www.digitalcosmetics.africa" class="bi bi-linkedin"></a>
                    <a href="https://twitter.com/intent/tweet?url=https://www.digitalcosmetics.africa&text=Découvrez mon site web ici!" class="bi bi-twitter"></a>
                </div>
            </div>

        </div>




        <section>
            <article class="category">

                <h1>Catégories</h1>

                <h2>Trier les produits selon les catégories suivantes : </h2>

                <form method="POST" action="backend/router/router.php?action=sortProductsCtrl">

                    <p>
                        <?php if(isset($error_sort_product)): ?>
                            <?= $error_sort_product; ?>
                        <?php endif; ?>
                    </p>

                    <div class="radio">
                        <label for="health">Santé</label>
                        <input type="radio" name="category" value="Santé" id="health" required>
                    </div>

                    <div class="radio marg">
                        <label for="cosmetics">Cosmetics</label>
                        <input type="radio" name="category" value="Cosmetics" id="cosmetics" required>
                    </div>

                    <div class="btn">
                        <button type="submit">Faire un trie</button>
                    </div>
                </form>
            </article>


            <article class="product-block">

                <h1>Nos articles</h1>

                <hr class="lineTop">

                <div class="product-block__content">
                    <?php foreach(getProductsListForProductListCtrl() as $getProducts): ?>
                        <div class="products">
                            <div class="products-img">
                                <?php if(!empty($getProducts['p_img'])): ?>
                                    <?php $imgData = base64_encode($getProducts['p_img']); ?>
                                    <?php $imgType = mime_content_type('data://image/jpeg;base64,'.$imgData); ?>
                                    <img src="data:<?= $imgType ?>;base64,<?= $imgData ?>" alt="longrich_<?= $getProducts['p_name']; ?>" width="200">
                                <?php endif; ?>
                            </div>

                            <div class="products-description">
                                <p class="name"> <?= $getProducts['p_name']; ?></p>

                                <p class="price"><?= $getProducts['p_price']; ?>  FCFA</p>

                                <h2>
                                    Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                                </h2>

                                <p class="cart-link">
                                    <a href="frontend/views/users/products/putAproductInCart.php?product_id=<?= $getProducts['product_id'] ?>">Ajouter au panier</a>
                                </p>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>

                <hr class="__lineBot" >

                <div class="user_pagination">
                    <?php for($i=1; $i<=getLinkForProductsPagination(); $i++): ?>
                        <?php if(getCurrentPage() != $i): ?>
                            <div>
                                <p>
                                    <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </p>
                            </div>

                        <?php else: ?>
                            <p>
                                <a><?= $i; ?></a>
                            </p>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

            </article>

        </section>




        <footer>
            <div>
                <p>
                    <span class="copyright">Digital Cosmetics - Tou<a href="frontend/views/admins/adminIndex.php" class="admin">s</a> droits réservés</span>
                </p>
            </div>
        </footer>
    </body>
</html>


<script src="vendor/hideMsgInIndex.js"></script>
