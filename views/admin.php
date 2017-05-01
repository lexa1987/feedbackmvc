<?php 
    use feedback\lib\Config,
        feedback\lib\App,
        feedback\lib\Session,
        feedback\lib\Alert;
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=Config::get('site name') ?></title>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css"/>
        
        <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    <body>
        
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/admin"><?=Config::get('site name') ?> - Панель администратора</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <?php if(Session::get('login')) { ?>
                    <ul class="nav navbar-nav">
                        <li><a <?php if(App::getRouter()->getController() == 'contacts') {?>class='active' <?php } ?> href="/admin/contacts/">Сообщения</a></li>
                        <li><a href="/admin/users/logout">Выйти</a></li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="starter-template">
                <?php if( Alert::hasFlash() ) {?>
                <div class="alert alert-info" role="alert">
                    <?php Alert::flash(); ?>
                </div>
                <?php } ?>
                
                <?=$data['content'] ?>
            </div>
        </div>
        <script src="/js/admin.js" type="text/javascript"></script>
    </body>
</html>
