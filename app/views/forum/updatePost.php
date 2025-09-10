<?php
/**
 * @var string $csrf
 * @var array $forum
 * @var array $topic
 * @var array $post
 */
?>
<h3>
    Posté par <strong><?= $post['user_name'] ?></strong>
    le <?= postedAt($post)->format('d/m/Y à H:i:s') ?>
</h3>
<div class="row">
    <div class="col-sm-12">
        <a href="/forums/<?= $forum['id'] ?>" class="btn btn-primary">
            Revenir aux topics
        </a>
    </div>
</div>
<div class="row">
    <form action="/forums/<?= $forum['id'] ?>/topics/<?= $topic['id'] ?>/posts/<?= $post['post_id'] ?>/update"
          method="post" class="col-sm-12">

        <!-- Le token CSRF -->
        <input type="hidden" name="csrf" value="<?= $csrf ?>">

        <!-- Le contenu -->
        <div class="form-group">
            <label for="content">Votre réponse :</label>
            <textarea placeholder="Le contenu de votre réponse ..." rows="7" class="form-control input-sm" id="content"
                      name="content"><?= htmlentities($post['content']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Modifier votre message
        </button>

    </form>
</div>
