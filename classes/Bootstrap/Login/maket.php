<div class="container"><h1>Вход в CRM</h1></div>
<?php if(!empty($this->errorMessage)): ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12">
          <div class="alert alert-danger">
            <strong>Oops, error!</strong>
            <?= $this->errorMessage ?>
          </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div id="login_panel_<?= $this->sfx ?>" class="container login-panel">	
    <ul  class="nav nav-pills">
			<li >
                <a  href="#auth_tab_<?= $this->sfx ?>" data-toggle="tab">Авторизация</a>
			</li>
			<li >
			    <a href="#reg_tab_<?= $this->sfx ?>" data-toggle="tab">Регистрация</a>
			</li>
	</ul>

    <div class="tab-content container col-md-8 col-sm-12">
            
			  <div class="tab-pane active col-md-6 col-sm-12" id="auth_tab_<?= $this->sfx ?>">
                  <?php $this->auth_form(array('action' => '/user/index','auth'=> 1)); ?>
			  </div>
			  <div class="tab-pane col-md-6 col-sm-12" id="reg_tab_<?= $this->sfx ?>">
                  <?php $this->reg_form(array('action' => '/user/index', 'auth'=> 0)); ?>
			  </div>
	</div>
</div>