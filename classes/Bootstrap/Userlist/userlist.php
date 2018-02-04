<div class="container"><div id="exit<?= $this->sfx ?>" class="btn btn-primary exit-btn ">Выход</div></div>
<br/>
<table id="userlist<?= $this->sfx ?>" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Ник пользователя</th>
            <th>Пароль</th>
            <th>Сумма часов в текущем месяце</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach($data as $one): ?>    
        <tr data-id = "<?= $one['id'] ?>" >
            <td data-id="login"><?= $one['login'] ?></td>
            <td data-id="pwd"><?= $one['pwd'] ?></td>
            <td><?= $one['sum_hours'] ?></td>
            <td>
                <button data-id = "<?= $one['id'] ?>" class="btn open-btn btn-primary">Открыть</button>
                &nbsp;<span class="badge"><i data-toggle="modal" data-target="#dialog-change-login<?= $this->sfx ?>" title = "сменить логин" class="glyphicon glyphicon-edit" ></i></span>
                 &nbsp;<span class="badge"><i data-toggle="modal" data-target="#dialog-change-pwd<?= $this->sfx ?>" title = "сменить пароль" class="glyphicon glyphicon-pencil" ></i></span>
                 &nbsp;<span class="badge"><i data-toggle="modal" data-target="#dialog-remove<?= $this->sfx ?>" title = "удалить" class="glyphicon glyphicon-remove" ></i></span>
            </td>
        </tr>
      <?php endforeach; ?>    
       
    </tbody>
</table>
<div class="userview-container">
    <span class="user-label badge"></span>
    <div id="userlist-view<?= $this->sfx ?>" class="userlist userlist-view">Здесь будет отображаться личное содержимое выбранного пользователя</div>
</div>