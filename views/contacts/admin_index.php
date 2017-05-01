<h3>Сообщения:</h3><br>
<?php foreach($data as $item) { ?>
<div class="list-group col-md-10">
    <div class="list-group-item row" id="messageItem<?=$item['id']?>">
        <div class="col-md-2">
            <div class="row">
            <center>
                <?php if ($item['image']!==NULL) { ?>
                    <img class="img-responsive img-thumbnail" src="/uploads/<?=$item['image']?>"/>
                 <?php } else { ?>
                    <img class="img-responsive img-thumbnail" src="/img/noimg.png"/>
                 <?php } ?>
            </center>
            </div>
            <div class="row">
            <center>
                 <?php if ($item['status']==1) { ?>
                    <div id="messageLabel<?=$item['id']?>" class="label label-success">Принят</div>
                 <?php } else { ?>
                    <div id="messageLabel<?=$item['id']?>" class="label label-danger">Отклонено</div>
                 <?php } ?>
                    <?php if ($item['markAdmin']==1) { ?>
                    <div class="label label-info">Изменено</div>
                 <?php } ?>
            </center>
            </div>
        </div>
        <div class="col-md-7 admin-message-body">
        <div class="row list-group-item-heading"><?=$item['name'] ?> &lt;<?=$item['email'] ?>&gt; (<?=$item['pubDate'] ?>)</div>
        <div class="row list-group-item-text"><small>
            <?php
              if (strlen($item['messages'])>200)
                {
                    $text = substr ($item['messages'], 0,strpos ($item['messages'], " ", 200)); echo $text.'...';
                } else {
                    echo $text; 
                };          
              ?></small></div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <a href="/admin/contacts/edit/<?=$item['id'] ?>">
                   <button type="button" class="btn btn-primary btn-block admin-button">Редактировать</button>
                </a>
            </div>
            <div class="row">
                <?php if ($item['status']==1) { ?>
                <button type="button" id="messageButton<?=$item['id']?>" onclick="moderation(<?=$item['id']?>,<?=$item['status']?>)" class="btn btn-danger btn-block admin-button">Отклонить</button>
                 <?php } else { ?>
                <button type="button" id="messageButton<?=$item['id']?>" onclick="moderation(<?=$item['id']?>,<?=$item['status']?>)" class="btn btn-success btn-block admin-button">Принять</button>
                 <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>