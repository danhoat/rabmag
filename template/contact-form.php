<form role="form" name="frm-contact" id="form-contact" class="form form-contact" method="POST">
    <div class="form-group">
        <div class="col-sm-2">
            <label for="user_name">Ho ten:</label>
        </div>
        <div class="col-sm-9">
            <input class="form-control required" id="user_name" name="user_name">
        </div>
    </div>
     <div class="form-group">
        <div class="col-sm-2">
            <label for="user_address">Dia chi:</label>
        </div>
        <div class="col-sm-9">
            <input class="form-control" id="user_address" name="user_address">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="user_email">Email :</label>
        </div>
        <div class="col-sm-9">
            <input type="email" class="form-control required email" name="user_email" id="user_email">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="content">Nội dung</label>
        </div>
        <div class="col-sm-9">
            <textarea class="form-control required" rows="8" cols="20" name="content"></textarea>
        </div>
        <input type="hidden" name="action" value="rab_contact">
    </div>
    <div class="form-group">
        <div class="col-sm-9">
        </div>
        <div class="col-sm-2">
            <button  type="submit" class="btn btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<?php
add_action('wp_enqueue_scripts','add_validate_form');
function add_validate_form(){

}
?>