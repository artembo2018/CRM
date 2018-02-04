<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-1 col-sm-11">
            <form method="post" action="<?= $action ?>">
                <input type="hidden" name="auth" value="<?= $auth ?>" />
                <div class="form-group">
                    <label for="email">Логин:</label>
                    <input required type="text" class="form-control" name="login" id="login_<?= $this->sfx ?>">
                </div>
                <div class="form-group">
                    <label for="pwd">Пароль:</label>
                    <input required type="password" class="form-control" name="pwd" id="pwd_<?= $this->sfx ?>">
                </div>
                <div class="form-group">
                    <label for="pwd">Повторите пароль:</label>
                    <input required type="password" class="form-control" name="pwd_repeat" id="pwd_repeat_<?= $this->sfx ?>">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name = "remember">Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-default">Вперед</button>
            </form>
        </div>
    </div>
</div>