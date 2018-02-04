<div id="change_modal<?= $this->sfx ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Редактирование данных</h4>
      </div>
      <div class="modal-body">
        <input type=hidden data-id="data-month" />
        <input type=hidden data-id="data-day" />
        <div class="form-group">
            <label for="data-hours">Отработано часов</label><br/>
            <input required class="form-control" data-id="data-hours" type="number" size="40" />
        </div>
        <div class="form-group">
            <label for="data-comment">Оставить комментарий</label><br/>
            <textarea class="form-control" data-id="data-comment" rows="8"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-id="report-change-data" data-dismiss="modal">Заменить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>