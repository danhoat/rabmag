<form role="form" name="frm-contact" id="form-contact" class="form form-contact" method="POST">
    <div class="form-group">
        <div class="col-sm-2">
            <label for="email">Ho ten:</label>
        </div>
        <div class="col-sm-9">
            <input type="email" class="form-control require" id="user_name" name="user_name">
        </div>
    </div>
     <div class="form-group">
        <div class="col-sm-2">
            <label for="email">Dia chi:</label>
        </div>
        <div class="col-sm-9">
            <input type="email" class="form-control" id="user_address" name="user_address">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="pwd">Email :</label>
        </div>
        <div class="col-sm-9">
            <input type="password" class="form-control require" name="user_email" id="user_email">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="pwd">Nội dung</label>
        </div>
        <div class="col-sm-9">
            <textarea class="form-control" rows="8" cols="20" name="content"></textarea>
        </div>
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