<script>
var a=<?= json_encode($data) ?>;
console.log(a);
</script>
<h3>Сообщения:</h3>
<div class="row sortOption">
    <div class="col-md-5 col-md-offset-7">
        Сортировать по:
        <a href="/contacts/index/" class="btn  <?=$data['sort']=='default' ? 'btn-primary' : 'btn-default' ?>">Дата</a>
        <a href="/contacts/index/sortbyname" class="btn <?=$data['sort']=='sortbyname' ? 'btn-primary' : 'btn-default' ?> ">Имя</a>
        <a href="/contacts/index/sortbyemail" class="btn <?=$data['sort']=='sortbyemail' ? 'btn-primary' : 'btn-default' ?>">Почта</a>
    </div>
</div>
<div id="message-list">
<?php foreach ($data['db'] as $item) { ?>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
            <div class="col-md-10"><?=$item['name']?> &lt;<?=$item['email'] ?>&gt; (<?=$item['pubDate']?>)</div>
            <?php if($item['markAdmin']) { ?>
            <div class="col-md-2">
                <div class="label label-info">изменен администратором</div>
            </div>
            <?php } ?>
            </div>
        </div>
        <?php if($item['image']===null) { ?>
            <div class="panel-body">
                <?=$item['messages']?>
            </div>
        <?php } else { ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <center>
                        <img class="img-responsive img-thumbnail" src="/uploads/<?=$item['image']?>"/>
                    </center>
                </div>
                <div class="col-md-9">
                    <?=$item['messages']?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
</div>
<center><h3>Напишите нам:</h3></center>
<form id="feedbackForm" action="" method="post">
    <div class="form-group">
        <label class="control-label col-md-8 col-md-offset-2" for="name">Ваше имя</label>
        <div class="col-md-8 col-md-offset-2">
            <input type="text" class="form-control" id="name" name="name" placeholder="Ваше имя"  required/><br> 
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-8 col-md-offset-2" for="email">Электронная почта</label>
        <div class="col-md-8 col-md-offset-2">
            <input type="email" class="form-control" id="email" name="email" placeholder="Электронная почта" required/><br>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-8 col-md-offset-2" for="fileImg">Картинка</label>
        <div class="col-md-8 col-md-offset-2">
            <input type="file" id="fileImg" name="fileImg" accept="image/jpeg,image/png,image/gif" /><br>
            <input type="hidden" id="imgData" name="imgData" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-8 col-md-offset-2" for="message">Сообщение</label>
        <div class="col-md-8 col-md-offset-2">
            <textarea rows="7" id="message" name="message" class="form-control" placeholder="Сообщение" required></textarea><br>
        </div>
    </div>
    <center>
        <button class="btn btn-lg btn-primary form-button" type="button" onclick="addPrewview()" >Предварительный просмотр</button>
        <button class="btn btn-lg btn-success form-button" type="button" onclick="sendForm()">Отправить</button>
    </center>
</form>