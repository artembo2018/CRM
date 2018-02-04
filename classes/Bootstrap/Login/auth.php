<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-1 col-sm-11">
            <form method="post" action="<?= $action ?>">
                <input type=hidden name="auth" value="<?= $auth ?>" />
                <div class="form-group">
                    <label for="login">Логин:</label>
                    <input required type="text" name="login" class="form-control" id="auth_login_<?= $this->sfx ?>">
                </div>
                <div class="form-group">
                    <label for="pwd">Пароль:</label>
                    <input required type="password" name="pwd" class="form-control" id="auth_pwd<?= $this->sfx ?>">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember">Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-default">Вперед</button>
            </form>
        </div>
    </div>
</div>