<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $emailUpdatingDone = $_SESSION['emailUpdating_done'] ?? '';
    $phoneUpdatingDone = $_SESSION['phoneUpdating_done'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digital Cosmetics - connexion</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/user-login.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link rel="website icon" type="png" href="../../../../public/pics/logo/dc.png">
    </head>

    <body>

            <p class="success-msg">
                <?php if($emailUpdatingDone): ?>
                    <?= $emailUpdatingDone; ?>
                    <?php unset($emailUpdatingDone);
                        session_destroy();
                    ?>

                <?php elseif($phoneUpdatingDone): ?>
                    <?= $phoneUpdatingDone; ?>
                    <?php unset($phoneUpdatingDone);
                        session_destroy();
                    ?>

                <?php endif; ?>
            </p>

        <section>
            <h1>Connexion</h1>

            <form method="POST" action="../../../../backend/router/router.php?action=getUserDataForLoginCtrl">

                <p class="error">
                    <?php if(isset($error_user_login)): ?>
                        <?= $error_user_login; ?>
                    <?php endif; ?>
                </p>

                <div class="emailForm">
                    <label for="full_name">
                        <input type="text" name="full_name" id="full_name" placeholder="Nom complet" required>
                        <i class="bi bi-person"></i>
                    </label>

                    <hr >
                </div>


                <div class="pwdForm">
                    <label for="email">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                        <i class="bi bi-envelope-at"></i>
                    </label>

                    <hr >
                </div>



                <p class="forgottenPwd">
                    <a href="../../../../frontend/views/users/forgottenPwd/datasChecking.php">Aide à la connexion</a>
                </p>

                <div class="btn">
                    <button type="submit">Se connecter</button>
                </div>

            </form>
        </section>

    </body>
</html>