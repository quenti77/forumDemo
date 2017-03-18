<section class="content-header">
    <h1>Gestion des catégories et forums</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    Ajouter une catégorie
                </div>

                <form action="/admin/categories/new" method="post" role="form">

                    <!-- Le token CSRF -->
                    <input type="hidden" name="csrf" value="<?= $csrf ?>">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">
                                Nom de la catégorie :
                            </label>
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Le nom de la nouvelle catégorie">
                        </div>

                        <div class="form-group">
                            <label for="name">
                                Index :
                            </label>
                            <input type="number" name="order" id="order" class="form-control"
                                   placeholder="La nouvelle position (ou 0 si vous ne voulez pas changer)">
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            Créer la catégorie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    Liste des catégories
                </div>


                <div class="box-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th style="width: 5%" class="text-center">Numéro d'ordre</th>
                            <th class="text-center">Nom de la catégorie</th>
                            <th style="width: 9%" class="text-center"></th>
                            <th style="width: 9%" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <form action="/admin/categories/<?= $category['id'] ?>/edit" method="post">

                                    <!-- Le token CSRF -->
                                    <input type="hidden" name="csrf" value="<?= $csrf ?>">

                                    <td class="text-center">
                                        <input type="number" name="order" value="<?= $category['sorted'] ?>"
                                               class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="name" value="<?= $category['name'] ?>"
                                               class="form-control">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-pencil"></i>
                                            Modifier
                                        </button>
                                    </td>
                                </form>
                                <td>
                                    <form action="/admin/categories/<?= $category['id'] ?>/remove" method="post">

                                        <!-- Le token CSRF -->
                                        <input type="hidden" name="csrf" value="<?= $csrf ?>">

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    Ajouter un forum
                </div>

                <form action="/admin/forums/new" method="post" role="form">

                    <!-- Le token CSRF -->
                    <input type="hidden" name="csrf" value="<?= $csrf ?>">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="category">
                                Catégorie :
                            </label>
                            <select name="category" id="category" class="form-control">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>">
                                        <?= $category['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">
                                Nom du forum :
                            </label>
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Le nom de votre forum">
                        </div>

                        <div class="form-group">
                            <label for="name">
                                Description du forum :
                            </label>
                            <input type="text" name="description" id="description" class="form-control"
                                   placeholder="La description de votre forum">
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            Créer le forum
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    Liste des forums
                </div>

                <div class="box-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th style="width: 20%" class="text-center">Catégorie</th>
                            <th class="text-center">Nom du forum</th>
                            <th style="width: 9%" class="text-center"></th>
                            <th style="width: 9%" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($forums as $forum): ?>
                            <tr>
                                <form action="/admin/forums/<?= $forum['id'] ?>/edit" method="post">

                                    <!-- Le token CSRF -->
                                    <input type="hidden" name="csrf" value="<?= $csrf ?>">

                                    <td class="text-center">
                                        <select name="category" id="category" class="form-control">
                                            <?php foreach ($categories as $category): ?>
                                                <?php if ($category['id'] == $forum['category_id']): ?>
                                                    <option value="<?= $category['id'] ?>" selected>
                                                        <?= $category['name'] ?>
                                                    </option>
                                                <?php else: ?>
                                                    <option value="<?= $category['id'] ?>">
                                                        <?= $category['name'] ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="name" value="<?= $forum['name'] ?>"
                                               class="form-control"><br>
                                        <input type="text" name="description" value="<?= $forum['description'] ?>"
                                               class="form-control">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-pencil"></i>
                                            Modifier
                                        </button>
                                    </td>
                                </form>
                                <td>
                                    <form action="/admin/forums/<?= $forum['id'] ?>/remove" method="post">

                                        <!-- Le token CSRF -->
                                        <input type="hidden" name="csrf" value="<?= $csrf ?>">

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
