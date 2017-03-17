<section class="content-header">
    <h1>Tableau de board</h1>
</section>

<section class="content">
    <div class="row">
        <!-- Nombre de personnes inscrites -->
        <div class="col-lg-4">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?= $count['users'] ?></h3>
                    <p>Utilisateurs inscrits</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="/admin/users" class="small-box-footer">
                    Voir la liste
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Nombre de topics -->
        <div class="col-lg-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $count['topics'] ?></h3>
                    <p>Topics</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a href="/admin/forums" class="small-box-footer">
                    Plus d'informations
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Nombre de posts -->
        <div class="col-lg-4">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $count['posts'] ?></h3>
                    <p>Posts</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                <a href="/admin/forums" class="small-box-footer">
                    Plus d'informations
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
