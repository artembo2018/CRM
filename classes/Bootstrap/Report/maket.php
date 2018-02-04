<div class="container">
    <?php if(empty($this->isAdmin)): ?>
        <div id="exit<?= $this->sfx ?>" class="btn btn-primary exit-btn ">Выход</div>
    <?php endif; ?>
    <h1 align=center>Мои Отчеты&nbsp;</h1>
</div>
<div id="month_panel_<?= $this->sfx ?>" class="container month-panel">	
    <ul  class="nav nav-pills col-md-8 col-sm-12">
         <?php foreach(BootstrapReport::month_days() as $key => $value):  ?>
			<li data-id="<?= $key ?>">
                <a  href="#<?= $key ?>_tab_<?= $this->sfx ?>" data-toggle="tab"><?= $value[1] ?></a>
			</li>
		 <?php endforeach ?>
	</ul>

    <div class="tab-content container col-md-8 col-sm-12">
        
        <?php foreach(BootstrapReport::month_days() as $key => $value):  ?>
		      <div class="tab-pane  <?php if($key =='Jan' ): ?> active <?php endif; ?> col-md-6 col-sm-12" id="<?= $key ?>_tab_<?= $this->sfx ?>">
                  <?php $this->month_report(array('month'=> $key, 'days' => $value[0])); ?>
			  </div>
		 <?php endforeach ?>

	</div>
</div>
<?php $this->add_record(); ?>
<?php $this->change_modal(); ?>
