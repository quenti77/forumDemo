<!DOCTYPE html>
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="/css/admin-lte.css">
    <link rel="stylesheet" href="/css/admin-all-skins.css">

    <!-- Titre -->
    <title>Administration</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <header class="main-header">
        <!-- Logo pour revenir au site -->
        <a href="/" class="logo">
            <span class="logo-mini">
                <strong>MSF</strong>
            </span>
            <span class="logo-lg">
                MonSuperForum
            </span>
        </a>

        <!-- Navbar du dessus -->
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </nav>
    </header> <!-- header.main-header -->

    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header">
                    Menu principale
                </li>
                <li>
                    <a href="/admin">
                        <i class="fa fa-tachometer"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/users">
                        <i class="fa fa-user"></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/forums">
                        <i class="fa fa-book"></i>
                        <span>Forums</span>
                    </a>
                </li>
            </ul>
        </section> <!-- section.sidebar -->
    </aside> <!-- aside.mainsidebar -->

    <div class="content-wrapper">
        <?php $flash = (isset($_SESSION['flash'])) ? $_SESSION['flash'] : null; ?>
        <?php if ($flash): ?>
            <?php unset($_SESSION['flash']); ?>
            <div class="alert alert-dismissible alert-<?= $flash['type'] ?>" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                <?= $flash['content'] ?>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </div> <!-- div.content-wrapper -->

    <footer class="main-footer" style="margin-top: 0;">
        <div class="pull-right hidden-xs">
            <strong>Version</strong> 2.3.0 (All rights reserved)
        </div>

        <strong>Copyright &copy; 2015 Almsaeed Studio</strong>
    </footer> <!-- footer.main-footer -->

</div> <!-- div.wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script src="/js/admin-lte.js"></script>

</body>
</html>
