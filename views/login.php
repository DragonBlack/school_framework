<div class="col-md-6 col-md-offset-3 col-sm-12">
<form action="/site/login" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="col-md-2 control-label" for="formlogin_login">Login</label>
        <div class="col-md-10">
            <input type="text" name="LoginForm[login]" id="formlogin_login" class="form-control" value="<?=$form->login;?>"/>
            <div class="has-error"><?=$form->getError('login');?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="formlogin_password">Password</label>
        <div class="col-md-10">
            <input type="password" name="LoginForm[password]" id="formlogin_password" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-primary" type="submit">Sing in</button>
        </div>
    </div>
</form>
</div>