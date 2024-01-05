<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aidez nous à nous améliorer</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/contact.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link rel="website icon" type="png" href="../../../../public/pics/logo/dc.png">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <section class="enterprise-info">
            <div class="title">
                <h1>
                    <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics">
                </h1>

                <h2>
                    Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                </h2>
            </div>

            <div class="text">
                <p>
                    Situé à Cocody Corniche Abidjan Rue B5  Digital Cosmétics est  spécialisé dans la revente et la distribution des produits Longrich  sur le territoire ivoirien  et dans le monde, ainsi que dans la formation en marketing réseau.
                </p>

                <p>
                    Notre Mission est de vous présenter des produits multi usages dans le domaine de la santé et des cosmétiques naturelles, bio et sans effets secondaires comprenant de nombreux avantages.
                </p>

                <p>
                    Nos produits sont recommandables à toute tranche d’âge en fonction de vos intérêts.
                </p>

                <p>
                    Bien portant ou malade, nous sommes en mesure de vous proposer des produits qui vous satisferont et qui vous permettrons de vous sentir bien dans votre corps.
                </p>

                <p>
                    Nous disposons de commerciaux pour vous entretenir et répondre à vos interrogations pendant les procédures d’achats et après les livraisons pour un suivi. Nous disposons également d'un service de livraison prêt à vous livrer peu importe votre commune ou votre District.
                </p>

                <p>
                    Pour plus d'informations, n'hésitez pas à nous contacter à l'adresse suivante : Service client : 0160318959 via téléphone ou WhatsApp  ou  email : <a href="mailto:digitalcosmetics01@gmail.com">digitalcosmetics01@gmail.com</a>
                </p>


            </div>
        </section>

        <hr >

        <section class="user-suggestions">
            <article>
                <div class="text">
                    <h1>Dites comment nous pouvons nous améliorer</h1>

                    <p>
                        Faite nous des suggestions amélioratives, où contactez-nous pour plus d'informations sur un de nos produits
                    </p>
                </div>

                <div class="img">
                    <img src="../../../../public/pics/health.svg" alt="digital_cosmetics_contact">
                </div>
            </article>

            <article>
                <form method="POST" action="../../../../backend/router/router.php?action=setSuggestionCtrl">

                    <p class="error">
                        <?php if(isset($error_set_suggestion)): ?>
                            <?=  $error_set_suggestion; ?>
                        <?php endif; ?>
                    </p>


                    <div class="inputs-block">
                        <div>
                            <label for="full_name">
                                <input type="text" name="full_name" id="full_name" placeholder="Nom complet" required>
                            </label>
                        </div>

                        <div>
                            <label for="email">
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </label>
                        </div>

                        <div>
                            <label for="phone_number">
                                <input type="tel" name="phone_number" id="phone_number" placeholder="Numéro de téléphone" required>
                            </label>
                        </div>

                        <div class="message">
                            <label for="message">
                                <textarea name="message" id="message" placeholder="Message" maxlength="255" required></textarea>
                            </label>
                        </div>
                    </div>

                    <div class="btn">
                        <button type="submit">Envoyer le message</button>
                    </div>
                </form>
            </article>
        </section>

    </body>
</html>