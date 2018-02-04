<script>
    jQuery(function($){
        <?php if(!$this->auth): ?>
            $("a[href='#reg_tab_<?= $this->sfx ?>']").click();
        <?php else: ?>
            $("a[href='#auth_tab_<?= $this->sfx ?>']").click();
        <?php endif; ?>
    });
</script>