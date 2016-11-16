<?php
use \framework\School;
use \framework\App;

$urlManager = School::$app->urlManager;
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <?php
    if(!School::$app->user->isGuest):
        ?>
        <style>
            body{
                <?= School::$app->user->cssSettings;?>
            }
        </style>
        <?php
    endif;
    ?>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class=""><a href="<?=$urlManager->to('/');?>"><?=App::t('menu.home');?></a></li>
            <li class=""><a href="<?=$urlManager->to('pages/about');?>"><?=App::t('menu.about');?></a></li>
            <li class=""><a href="<?=$urlManager->to('pages/contacts');?>"><?=App::t('menu.contacts');?></a></li>
            <?php if(School::$app->user->isGuest):?>
            <li class=""><a href="<?=$urlManager->to('site/login');?>"><?=App::t('menu.login');?></a></li>
            <?php else:?>
                <li class=""><a href="<?=$urlManager->to('profile/index');?>"><?=App::t('menu.profile');?></a></li>
                <li class=""><a href="<?=$urlManager->to('site/logout');?>"><?=App::t('menu.logout');?></a></li>
            <?php endif;?>
        </ul>
    </div>
</nav>
<div class="container">
    <?=$content;?>
</div>
</body>
</html>