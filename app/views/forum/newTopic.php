<?php
/**
 * @var string $csrf
 * @var array $forum
 * @var array $post
 */
?>
<div class="row text-center">
    <h2>Création d'un topic</h2>
</div>

<div class="row">
    <div class="col-sm-12">
        <a href="/forums/<?= $forum['id'] ?>" class="btn btn-primary">
            Revenir à la liste des topics
        </a>
    </div>
</div>

<div class="row">
    <form action="/forums/<?= $forum['id'] ?>/newTopic" method="post" class="col-sm-12">

        <!-- Le token CSRF -->
        <input type="hidden" name="csrf" value="<?= $csrf ?>">

        <!-- Le nom -->
        <div class="form-group">
            <label for="name">Nom du topic :</label>
            <input type="text" class="form-control input-sm" name="name" id="name"
                   placeholder="Nom de votre topic ..." value="<?= $post['name'] ?>">
        </div>

        <!-- La description -->
        <div class="form-group">
            <label for="description">Description du topic : <em>(optionnel)</em></label>
            <input type="text" class="form-control input-sm" name="description" id="description"
                   placeholder="Description de votre topic ..." value="<?= $post['description'] ?>">
        </div>

        <!-- Le contenu -->
        <div class="form-group">
            <label for="content">Votre réponse :</label>
            <textarea placeholder="Le contenu de votre réponse ..." rows="7" id="content"
                      class="form-control input-sm" name="content"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Créer le topic
        </button>
    </form>
</div>