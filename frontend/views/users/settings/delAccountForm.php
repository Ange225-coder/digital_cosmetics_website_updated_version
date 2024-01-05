<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $email = $_SESSION['email'] ?? '';
    $full_name = $_SESSION['full_name'] ?? '';

    if(!$full_name || !$email) {
        header('location: ../regist_auth/login.php');
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suppression du compte</title>
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/delAccountForm.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
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

                <div class="logout">
                    <a href="../../../../backend/logout/logout.php">
                        <span>Déconnexion</span>

                        <span class="bi bi-power power-icon"></span>
                    </a>
                </div>
            </div>
        </nav>


        <section>
            <div class="main-content">
                <div class="logo-block">
                    <p class="img">
                        <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics">
                    </p>

                    <h1>
                        Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                    </h1>
                </div>

                <div class="text-block">
                    <h2>Suppression du compte</h2>

                    <p>Entrez votre email pour continuer</p>
                </div>

                <form method="POST" action="../../../../backend/router/router.php?action=delAccountCtrl">

                    <p class="error">
                        <?php if(isset($error_del_account)): ?>
                            <?= $error_del_account; ?>
                        <?php endif; ?>
                    </p>

                    <div class="input-block--grid">
                        <div>
                            <label for="email">
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </label>
                        </div>

                        <div>
                            <button type="submit">Supprimer votre compte</button>
                        </div>
                    </div>

                </form>

                <p class="notice">
                    <em>NB: Vous serez automatiquement redirigé vers la page d'accueil du site après suppression de votre compte</em>
                </p>
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