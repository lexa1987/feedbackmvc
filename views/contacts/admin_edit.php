<h3>Редактировать:</h3><br />
<form method="post" action="">
    <input type="hidden" name="id" value="<?=$data['contacts']['id'] ?>" />
    <div class="form-group">
        <label for="alias">Имя</label>
        <input type="text" id="name" name="name" value="<?=$data['contacts']['name'] ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="title">Электронная почта</label>
        <input type="text" id="email" name="email" value="<?=$data['contacts']['email'] ?>" class="form-control"/>
    </div>    
    <div class="form-group">
        <label for="content">Сообщение</label>
        <textarea name="message" id="message" class="form-control"><?=$data['contacts']['messages'] ?></textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Изменить"/>
    <a href="/admin/contacts"><button type="button" class="btn btn-danger">Отмена</button></a>
</form>