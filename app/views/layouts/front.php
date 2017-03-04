<html>
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

    <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
                <li><a href="/">Administration</a></li>
                <li><a href="/">Mon profile</a></li>
                <li><a href="/">Se déconnecter</a></li>
                <li><a href="/">Se connecter</a></li>
                <li><a href="/">S'inscrire</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?= $content ?>
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