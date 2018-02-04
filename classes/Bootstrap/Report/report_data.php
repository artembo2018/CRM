<div class="report-data-block">
  <input type=hidden  data-id="report-data-month" value="<?= $month ?>" />
  <ul class="list-group">
   <li class="list-group-item"><label>День</label><span class="badge" data-id="report-data-day"><?= $day ?></span></li>
   <li class="list-group-item"><label>Часов</label><span class="badge" data-id="report-data-hours"><?= $hours ?></span></li>
   <li class="list-group-item"><label>Коментарий</label><span class="badge" data-id="report-data-comment"><?= strlen($comment) > 30? mb_substr($comment,0,30)."...<span style='display:none;'>".mb_substr($comment,30)."</span>":$comment ?></span></li>
   <li class="list-group-item"><label>Редактировать</label><span class="badge"><i data-toggle="modal" data-target="#change_modal<?= $this->sfx ?>" class="glyphicon glyphicon-pencil" ></i></span></li>
  </ul>
  
</div>