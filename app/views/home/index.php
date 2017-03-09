<h2>Bienvenue sur le forum</h2>

<div class="row">
    <div class="col-sm-12">
        <?php foreach ($categories as $category): ?>
            <h3><?= $category['name'] ?></h3>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="width: 60%">Nom / Description</th>
                    <th style="width: 10%" class="text-center">Nombre de topics</th>
                    <th style="width: 10%" class="text-center">Nombre de posts</th>
                    <th style="width: 20%" class="text-center">Dernier post</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($category['forums'] as $forum): ?>
                    <tr>
                        <td>
                            <strong>
                                <a href="/forums/<?= $forum['id'] ?>">
                                    <?= $forum['name'] ?>
                                </a>
                            </strong>
                            <br>
                            <em>
                                <?= $forum['description'] ?>
                            </em>
                        </td>
                        <td class="text-center">
                            <?= $forum['topic_count'] ?>
                        </td>
                        <td class="text-center">
                            <?= $forum['post_count'] ?>
                        </td>
                        <td class="text-center">
                            <?php if ($forum['post_id']): ?>
                                <a href="/">
                                    <?= $forum['user_name'] ?>
                                </a>
                                <br>
                                <a href="/forums/<?= $forum['id'] ?>/topics/<?= $forum['topic_id'] ?>">
                                    <?= $forum['posted_at']->format('d/m/Y H:i:s') ?>
                                </a>
                            <?php else: ?>
                                Aucun post
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>
</div>
