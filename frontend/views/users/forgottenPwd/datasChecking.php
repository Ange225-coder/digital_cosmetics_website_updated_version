<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réinitialiser votre email</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/emailChecking.css">
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

            <h2>Entrer votre nom complet utilisé pour les achats</h2>

            <form method="POST" action="../../../../backend/router/router.php?action=getFullNameCtrl">

                <p class="error">
                    <?php if(isset($errorGetFullName)): ?>
                        <?= $errorGetFullName; ?>
                    <?php endif; ?>
                </p>

                <div class="emailForm">
                    <label for="full_name">
                        <input type="text" name="full_name" id="full_name" placeholder="Ex: John Wick" required>
                    </label>
                </div>

                <div class="btn">
                    <button type="submit">Continuer</button>
                </div>
            </form>
        </section>

    </body>
</html>