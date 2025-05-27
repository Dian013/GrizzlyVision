<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="public/css/sign_up-already_has_account.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>
    <section id="message">
        <h1>Déjà chez nous ?</h1>
        <span>Merci de nous soutenir dans cette aventure dégringolante</span>
    </section>
    <section id="inscription">
        <h2>Connexion</h2>
        <a href="/GrizzlyVision/sign_up" id="hasaccount_sinscrire_button">S'inscrire</a>
        <form method="post" action="" id="formulaire">

            <input type="text" placeholder="Nom d'utilisateur" name="username">
            <span><?= $errors['username'] ?></span>

            <input type="text" placeholder="Mot de passe" name="password">
            <span><?= $errors['password'] ?></span>

            <a href="" id="mdp_oublie">Mot de passe oublié ?</a>

            <input type="submit" id="connexion_button" value="Connexion"></input>
        </form>
        <?= $message ?>
    </section>
</body>
</html>