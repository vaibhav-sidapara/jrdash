<form id="login_form" method="post" class="form-horizontal" style="padding: 10px 0;" action="<?=site_url('api/login')?>" >
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
            <input type="text" name="login" class="form-control" id="inputEmail3" placeholder="Username" />
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success active" name="submit" value="Login" />
            <a href="<?=site_url('home/register')?>" class="btn btn-info" >Register Here</a>
        </div>
    </div>
</form>



<script type="text/javascript">

    $(function(){
        Result = new Result();
        $('#login_form').submit(function(evt){
            evt.preventDefault();

            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function(o){
                if(o.result == 1){
                    window.location.href = '<?=site_url('dashboard')?>';
                }else {
                    Result.error(o);
                }
            }, 'json');
        });
    });

</script>