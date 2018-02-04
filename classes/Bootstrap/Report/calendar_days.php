<div class="container-fluid">
	<div class="row">
        <div class="span12">
    		<table data-month="<?= $month ?>" class="table-calendar-days table-condensed table-bordered">
                <tbody>
                    <?php for($i = 1; $i <= $days; ++$i): ?>
                      <?php if($i % 7 == 1): ?>
                      <tr>
                      <?php endif; ?>
                        <td data-id = "<?= $i ?>"><?= $i ?></td>
                      <?php if($i % 7 == 0 ): ?>
                      </tr>
                      <?php endif; ?>
                    <?php endfor; ?>  
                    
                </tbody>
            </table>
        </div>
	</div>
</div>