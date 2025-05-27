<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection</title>
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="public/css/redirect_page.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div id="message">
        <h1>Bienvenue parmi nous <?= $_SESSION['user'] ?> !</h1>
    </div>
    <div id="inscription">
        <a id="signup_sinscrir_button" href="welcome">Page d'accueil</a>
        <a id="connexion_button" href="already_has_account">Connexion</a>
    </div>
</body>
</html>
