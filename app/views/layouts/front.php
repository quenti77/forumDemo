<?php
/**
 * @var array|null $auth
 * @var string $content
 */
?>
<html lang="fr">
<head>
    <!-- Info principale de la page -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Info principale du site -->
    <meta name="author" content="quenti77">
    <meta name="description" content="Il s'agit de mon super forum">

    <!-- Style et Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous" rel="stylesheet">

    <link rel="stylesheet" href="https://bootswatch.com/3/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">

    <!-- Titre -->
    <title>Mon super forum</title>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuMobile">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">MonSuperForum</a>
        </div>

        <div class="collapse navbar-collapse" id="menuMobile">
            <ul class="nav navbar-nav navbar-right">
                <?php if ($auth): ?>
                    <?php if ($auth['rank'] >= ADMIN_RANK): ?>
                        <li><a href="/admin">Administration</a></li>
                    <?php endif; ?>
                    <li><a href="/">Mon profil</a></li>
                    <li><a href="/logout">Se déconnecter</a></li>
                <?php else: ?>
                    <li><a href="/login">Se connecter</a></li>
                    <li><a href="/register">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php $flash = $_SESSION['flash'] ?? null; ?>
    <?php if ($flash): ?>
        <?php unset($_SESSION['flash']); ?>
        <div class="alert alert-dismissible alert-<?= $flash['type'] ?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $flash['content'] ?>
        </div>
    <?php endif; ?>

    <?= $content ?>

    <div class="row">
        <div class="col-sm-6">
            <h2>La session :</h2>
            <?php /** @noinspection ForgottenDebugOutputInspection */
            var_dump($_SESSION); ?>
        </div>
        <div class="col-sm-6">
            <h2>Les cookie :</h2>
            <?php /** @noinspection ForgottenDebugOutputInspection */
            var_dump($_COOKIE); ?>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</body>
</html>