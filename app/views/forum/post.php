<h3>
    <?= $topic['name'] ?>
</h3>
<p>
    <em>
        <?= $topic['description'] ?>
    </em>
</p>
<div class="row">
    <div class="col-sm-12">
        <a href="/forums/<?= $forum['id'] ?>" class="btn btn-primary">
            Revenir aux topics
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width: 15%">Informations</th>
                <th style="width: 85%">Contenu</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr class="<?= $post['resolved'] ? 'bg-success' : '' ?>">
                    <td class="text-center">
                        <div>
                            <a href="/">
                                <?= $post['user_name'] ?>
                            </a>
                        </div>
                        <div>
                            Posté le : <br>
                            <?= postedAt($post)->format('d/m/Y H:i:s') ?>
                        </div>
                    </td>
                    <td>
                        <?php if (checkPermit($auth, $post)): ?>
                            <div class="text-right">
                                <form action="/forums/<?= $forum['id'] ?>/topics/<?= $topic['id'] ?>/posts/<?= $post['post_id'] ?>/remove"
                                      method="post">

                                    <!-- Le token CSRF -->
                                    <input type="hidden" name="csrf" value="<?= $csrf ?>">

                                    <a href="/forums/<?= $forum['id'] ?>/topics/<?= $topic['id'] ?>/posts/<?= $post['post_id'] ?>/update"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <div>
                            <?= nl2br(htmlentities($post['content'])) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($auth): ?>
    <div class="row">
        <form action="/forums/<?= $forum['id'] ?>/topics/<?= $topic['id'] ?>"
              method="post" class="col-sm-12">

            <!-- Le token CSRF -->
            <input type="hidden" name="csrf" value="<?= $csrf ?>">

            <!-- Le contenu -->
            <div class="form-group">
                <label for="content">Votre réponse :</label>
                <textarea placeholder="Le contenu de votre réponse ..." rows="7"
                          class="form-control input-sm" name="content"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Répondre
            </button>

        </form>
    </div>
<?php endif; ?>
