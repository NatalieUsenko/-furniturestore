<?php
?>
<form>
    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <input id="form_name" name="form_name" type="text" placeholder="Имя" class="form-control" required="required">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input id="form_email" name="form_email" type="text" placeholder="E-mail" class="form-control" required="required">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <textarea class="form-control" id="form_message" name="form_message" placeholder="Сообщение" rows="4" required="required"></textarea>
        </div>
    </div>
    <div class="col-md-6">
        Я не робот (Google)
    </div>
    <div class="col-md-6 text-right">
        <button type="submit">Отправить</button>
    </div>
    </div>
</form>

