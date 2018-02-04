<script>
    jQuery(function($){
        
      function resetIf(value) {
          if(typeof value == 'undefined' || isNaN(value) || value == null || value == '') return 0;
          value = $.trim(value);
          return Number(value);
      }    
      
      var month_panel = $("#month_panel_<?= $this->sfx ?>");
      month_panel.find("ul li[data-id=Feb] a").click();
      var calendar_days = $("table.table-calendar-days");
      calendar_days.find("tr td").on('mouseover', function(){
          $(this).addClass('btn-primary');
          
      });
      
      calendar_days.find("tr td").on('mouseleave', function(){
          if(!$(this).hasClass('active'))
              $(this).removeClass('btn-primary');
      });
      
      calendar_days.find("tr td").on('click', function() {
          $(this).parents("table").find("td").removeClass("btn-primary active");
          if($(this).hasClass('active'));
          else {
              var active_month = $(this).closest("table.table-calendar-days").data('month');
              month_panel.find("ul li").removeClass('active');
              month_panel.find("ul li[data-id="+active_month+"]").addClass('active');
              month_panel.find("ul li[data-id="+active_month+"]").click();
              $(this).addClass('btn-primary active');
              
              var day = $(this).text();
              var month = $(this).closest("table").data('month');
              var params = {"sfx" : "<?= $this->sfx ?>", "user_id" : "<?= $this->user_id ?>", "day" : day, "month" : month };
              $.post("/userAjax/index",params,function(res){
                  $(".report-container").html(res);
              });
          }
      });
      
      $(".tab-pane.active table.table-calendar-days[data-month=<?= date("M") ?>] tr td[data-id=<?= date("j") ?>]").eq(0).click();
      
      var modal_change = $("div#change_modal<?= $this->sfx ?>");
      
      $(".report-container").on('click',".report-data-block .glyphicon", function(e) {
          var data_block = $(this).closest(".report-data-block");
          var month = data_block.find("input[data-id=report-data-month]").val();
          var day = resetIf(data_block.find("span[data-id=report-data-day]").text());
          var hours = resetIf(data_block.find("span[data-id=report-data-hours]").text());
          var comment = data_block.find("span[data-id=report-data-comment]").text();
          modal_change.find(".modal-body input[data-id=data-month]").val(month);
          modal_change.find(".modal-body input[data-id=data-day]").val(day);
          modal_change.find(".modal-body input[data-id=data-hours]").val(hours);
          modal_change.find(".modal-body textarea[data-id=data-comment]").val(comment);
      });
      
     
      var modal_replace_btn = modal_change.find("button[data-id='report-change-data']");
      modal_replace_btn.on('click', function() {
          var month = modal_change.find(".modal-body input[data-id=data-month]").val();
          var day = parseInt(modal_change.find(".modal-body input[data-id=data-day]").val());
          var hours = resetIf(modal_change.find(".modal-body input[data-id=data-hours]").val());
          var comment = $.trim(modal_change.find(".modal-body textarea[data-id=data-comment]").val());
          var params = { "isAjax": 1, "user_id": "<?= $this->user_id ?>", "month" : month, "day" : day, "hours" : hours , "comment" : comment };
          $.post("/userAjax/change", params, function(res) {
              var params = JSON.parse(res);
              var report_container = $(".report-container");
              report_container.find("*[data-id=report-data-hours]").text(params.hours);
              report_container.find("*[data-id=report-data-comment]").text(params.comment);
          });
         
      });
      
      var add_form = $("#add-time-form<?= $this->sfx ?>");
      add_form.on('submit', function(e){
          e.preventDefault();
          var data = $(this).serialize();
          data = "isAjax=1&" + data;
          $.post("/userAjax/add",data, function(res){
              $("table.table-calendar-days[data-month=<?= date("M") ?>] tr td[data-id=<?= date("j") ?>]").click();
          });
      });
      $("#exit<?= $this->sfx ?>").on('click', function(){
          $.post("/userAjax/exit", function(res) {
              location.href = "/default/index";
          });
      });
    });
</script>