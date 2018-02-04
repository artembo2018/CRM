<script>
    jQuery(function($){
        var userview = $("#userlist-view<?= $this->sfx ?>");
        var userlist = $("#userlist<?= $this->sfx ?>");
        var open_btn = userlist.find("tr td .open-btn");
        var remove =$("#dialog-remove<?= $this->sfx ?>").find(".modal-footer button[data-id=dialog-change-data]");
        var change_login =$("#dialog-change-login<?= $this->sfx ?>").find(".modal-footer button[data-id=dialog-change-data]");
        var change_pwd =$("#dialog-change-pwd<?= $this->sfx ?>").find(".modal-footer button[data-id=dialog-change-data]");
        var exit_btn = $("#exit<?= $this->sfx ?>");
        open_btn.click(function() {
            userlist.find("tr td").removeClass("active-class");
            $(this).closest("td").addClass("active-class");
            var id = $(this).data('id');
            var login =$(this).closest("tr").find("td[data-id=login]").text();
            var pwd =$(this).closest("tr").find("td[data-id=pwd]").text();
            var params = { "login" : login, "pwd" : pwd, "auth" : 1, "partial" : 1 } ;
            $.post("/user/index", params, function(res) {
                userview.closest(".userview-container").find(".user-label").html("Страница пользователя <b>"+login+"</b>");
                userview.html(res);
                
            });
        });
        userlist.find("tr").click(function() {
            var id = $(this).find("td .open-btn").data('id');
            $("#dialog-change-login<?= $this->sfx ?>").find(".modal-body input[data-id=user_id]").val(id);
            $("#dialog-change-pwd<?= $this->sfx ?>").find(".modal-body input[data-id=user_id]").val(id);
            $("#dialog-remove<?= $this->sfx ?>").find(".modal-header input[data-id=user_id]").val(id); 
        });
       remove.click(function() {
            var id = $(this).closest(".modal-content").find("input[data-id=user_id]").val();
            var pwd = $(this).closest(".modal-content").find("input[data-id=data-pwd]").val();
            $.post("/userAjax/remove", { "admin_id" :"<?= $this->admin_id ?>", "id" : id , "pwd" : pwd, "isAjax" : 1  }, function(res){
                var result = JSON.parse(res);
                if(result.status == 'success') userlist.find("tr[data-id="+id+"]").remove();
                else alert('Ошибка, повторите попытку');
            });
            
        });
        change_login.click(function(){
            var id = $(this).closest(".modal-content").find("input[data-id=user_id]").val();
            var login = $(this).closest(".modal-content").find("input[data-id=data-login]").val();
            var pwd = $(this).closest(".modal-content").find("input[data-id=data-pwd]").val();
            $.post("/userAjax/changelogin", { "admin_id" :"<?= $this->admin_id ?>", "id" : id , "login" : login, "pwd" : pwd, "isAjax" : 1  }, function(res){
                var result = JSON.parse(res);
                if(result.status == 'success') { userlist.find("tr[data-id="+id+"] td[data-id=login]").html(login); }
                else alert('Ошибка, повторите попытку');
            });
        });
        
        change_pwd.click(function(){
            var id = $(this).closest(".modal-content").find("input[data-id=user_id]").val();
            var pwd = $(this).closest(".modal-content").find("input[data-id=data-pwd]").val();
            var pwd_admin = $(this).closest(".modal-content").find("input[data-id=data-pwd-admin]").val();
            $.post("/userAjax/changepwd", { "admin_id" :"<?= $this->admin_id ?>", "id" : id , "pwd" : pwd, "pwd-admin" : pwd_admin, "isAjax" : 1  }, function(res){
                var result = JSON.parse(res);
                if(result.status == 'success') { userlist.find("tr[data-id="+id+"] td[data-id=pwd]").html(pwd); }
                else alert('Ошибка, повторите попытку');
            });
        });
        
        exit_btn.on('click', function() {
            $.post("/userAjax/exit", function(res) {
              location.href = "/default/index";
            });
        });
    });
</script>