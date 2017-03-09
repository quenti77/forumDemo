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
                <tr>
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
                        <?= $post['content'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

