<div class="col-md-6 col-md-offset-3 col-sm-12">
    <form action="<?=\framework\School::$app->urlManager->to('profile/edit', ['id'=>$form->id])?>" method="post" class="form-horizontal">
        <input type="hidden" name="UserEditForm[id]" value="<?=$form->id;?>"/>
        <div class="form-group">
            <label class="col-md-2 control-label" for="formlogin_login">Login</label>
            <div class="col-md-10">
                <input type="text" name="UserEditForm[login]" id="formlogin_login" class="form-control" value="<?=$form->login;?>"/>
                <div class="has-error"><?=$form->getError('login');?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="formlogin_email">Email</label>
            <div class="col-md-10">
                <input type="email" name="UserEditForm[email]" id="formlogin_email" class="form-control" value="<?=$form->email;?>"/>
                <div class="has-error"><?=$form->getError('email');?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="formlogin_password">Password</label>
            <div class="col-md-10">
                <input type="password" name="UserEditForm[password]" id="formlogin_password" class="form-control"/>
                <div class="has-error"><?=$form->getError('password');?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="formlogin_confirm">Confirm</label>
            <div class="col-md-10">
                <input type="password" name="UserEditForm[confirm]" id="formlogin_confirm" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
</div>