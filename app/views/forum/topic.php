<h3>
    <?= $forum['name'] ?>
</h3>
<p>
    <em>
        <?= $forum['description'] ?>
    </em>
</p>
<div class="row">
    <div class="col-sm-12">
        <a href="/" class="btn btn-primary">
            Revenir à l'accueil
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width: 5%">Status</th>
                <th style="width: 70%">Nom / Description</th>
                <th style="width: 15%" class="text-center">Auteur</th>
                <th style="width: 10%" class="text-center">Nombre de réponse</th>
            </tr>
            </thead>
            <tbody>
            <?php $topicLoop = false; ?>
            <?php foreach ($topics as $topic): ?>
                <?php $topicLoop = true; ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle;">
                        <?= getStatus($topic) ?>
                    </td>
                    <td>
                        <strong>
                            <a href="/forums/<?= $forum['id'] ?>/topics/<?= $topic['topic_id'] ?>">
                                <?= $topic['topic_name'] ?>
                            </a>
                        </strong>
                        <br>
                        <em>
                            <?= $topic['description'] ?>
                        </em>
                    </td>
                    <td class="text-center">
                        <a href="/">
                            <?= $topic['user_name'] ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <?= $topic['reply_count'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$topicLoop): ?>
                <tr>
                    <td colspan="4" class="text-center">
                        Aucun topic dans ce forum
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
