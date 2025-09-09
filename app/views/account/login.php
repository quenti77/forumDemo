<div class="row text-center">
    <h1>Connexion</h1>
</div>

<div class="row">
    <form action="/login" method="post" class="col-sm-offset-2 col-sm-8">
        <!-- Le pseudo -->
        <div class="form-group">
            <label for="name">Votre pseudo ou adresse mail :</label>
            <input type="text" class="form-control input-sm" name="name" id="name"
                   placeholder="Votre pseudo ou votre adresse mail ..." value="<?= $post['name'] ?>">
        </div>

        <!-- Le mot de passe -->
        <div class="form-group">
            <label for="pass">Votre mot de passe :</label>
            <input type="password" class="form-control input-sm" name="pass" id="pass"
                   placeholder="Entrez votre mot de passe ...">
        </div>

        <div class="row">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember">
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                    Se souvenir de moi
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Se connecter
        </button>
    </form>
</div>