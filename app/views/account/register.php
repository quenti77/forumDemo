<div class="row text-center">
    <h1>Inscription</h1>
</div>

<div class="row">
    <form action="/register" method="post" class="col-sm-offset-2 col-sm-8">
        <!-- Le pseudo -->
        <div class="form-group">
            <label for="name">Votre pseudo :</label>
            <input type="text" class="form-control input-sm" name="name" id="name"
                   placeholder="Votre pseudo ..." value="<?= $post['name'] ?>">
        </div>

        <!-- L'adresse mail -->
        <div class="form-group">
            <label for="email">Votre adresse mail :</label>
            <input type="email" class="form-control input-sm" name="email" id="email"
                   placeholder="Votre@mail.tld ..." value="<?= $post['email'] ?>">
        </div>

        <!-- Le mot de passe -->
        <div class="form-group">
            <label for="pass">Votre mot de passe :</label>
            <input type="password" class="form-control input-sm" name="pass" id="pass"
                   placeholder="Entrez votre mot de passe ...">
        </div>

        <!-- Le mot de passe de confirmation -->
        <div class="form-group">
            <label for="pass_confirm">Confirmez votre mot de passe :</label>
            <input type="password" class="form-control input-sm" name="pass_confirm" id="pass_confirm"
                   placeholder="Confirmation du mot de passe ...">
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            S'inscrire
        </button>
    </form>
</div>