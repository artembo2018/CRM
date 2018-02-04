<div id="dialog-remove<?= $this->sfx ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <input type=hidden data-id="user_id" />
        <h4 class="modal-title">Вы действительно хотите удалить пользователя?</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="data-pwd">Ваш пароль(требуется для выполнения операции)</label><br/>
            <input required class="form-control" data-id="data-pwd" type="text" size="40" />
        </div>
      </div>    
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-id="dialog-change-data" data-dismiss="modal">Выполнить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
      </div>
    </div>

  </div>
</div>