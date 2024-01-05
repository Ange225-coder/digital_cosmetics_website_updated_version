<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $full_name = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nouvel email</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/resetPwdForm.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="website icon" type="png" href="../../../../public/pics/logo/dc.png">
    </head>

    <body>

        <section>
            <h1>Reinitialisation de l'email</h1>

            <span class="material-symbols-outlined person">person</span>

            <form method="POST" action="../../../../backend/router/router.php?action=resetEmailCtrl">

                <p class="error">
                    <?php if(isset($errorResetEmail)): ?>
                        <?= $errorResetEmail; ?>
                    <?php endif; ?>
                </p>

                <div class="emailForm">
                    <label for="email">
                        <input type="email" name="email" id="email" value="<?= $full_name; ?>" readonly>
                        <span class="material-symbols-outlined verified_user_icon">verified_user</span>
                    </label>
                </div>


                <div class="newPwdForms">
                    <h2>Nouvel email</h2>

                    <div>
                        <label for="email">
                            <input type="email" name="email" id="email" placeholder="Email" required>
                        </label>
                    </div>

                </div>


                <div class="btn">
                    <button type="submit">Mise à jour de l'email</button>
                </div>
            </form>

            <p class="notice">
                <em>NB : Vous serez redirigé vers la page de connexion afin de prendre en compte les modifications</em>
            </p>
        </section>

    </body>
</html>