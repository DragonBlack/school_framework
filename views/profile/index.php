<div>
    <div>
        <label>Логин</label>
        <span><?=$user->login;?></span>
    </div>

    <div>
        <label>E-mail</label>
        <span><?=$user->email;?></span>
    </div>

    <div>
        <label>Статус</label>
        <span><?=$user->statusText();?></span>
    </div>
    <div>
        <a href="<?=\framework\School::$app->urlManager->to('profile/edit', ['id'=>$user->id])?>"
            class="btn btn-success"
        >
            Изменить
        </a>
    </div>
</div>