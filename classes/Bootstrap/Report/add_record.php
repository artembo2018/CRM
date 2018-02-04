<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
<h3 align=center>Добавить время</h3>
<div><?= date("j")." ".mb_substr(BootstrapReport::month_days()[date("M")][1],0,3) ?></div>
<form id="add-time-form<?= $this->sfx ?>">
    <input type=hidden name="user_id" value="<?= $this->user_id ?>" />
    <input type=hidden name="month" value ="<?= date("M") ?>" />
    <input type=hidden name="day" value = "<?= date("j") ?>" />
    <div class="form-group">
        <label for="hours">Отработано часов</label>
        <input type="number" required class="form-control" id="add-hours<?= $this->sfx ?>" name="hours">
    </div>
    <div class="form-group">
        <label for="comment">Комментарий</label>
        <textarea required class="form-control" id="add-comment<?= $this->sfx ?>" name="comment"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Добавить</button>
</form>
</div>
</div>

</div>