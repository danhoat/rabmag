<form role="form" name="frm-contact" id="form-contact" class="form form-contact" method="POST">
    <div class="form-group">
        <div class="col-sm-2">
            <label for="user_name">Họ và tên (*):</label>
        </div>
        <div class="col-sm-9">
            <input class="form-control required" id="user_name" placeholder="Họ và tên" name="user_name">
        </div>
    </div>
     <div class="form-group">
        <div class="col-sm-2">
            <label for="user_address">Địa chỉ:</label>
        </div>
        <div class="col-sm-9">
            <input class="form-control" id="user_address"  placeholder="Địa chỉ"  name="user_address">
        </div>
    </div>
     <div class="form-group">
        <div class="col-sm-2">
            <label for="user_email">Số điện thoại:</label>
        </div>
        <div class="col-sm-9">
            <input type="text" class="form-control required"  placeholder="Số điện thoại"  name="user_phone" id="user_phone">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="user_email">Email:</label>
        </div>
        <div class="col-sm-9">
            <input type="email" class="form-control required email"  placeholder="Email của bạn"  name="user_email" id="user_email">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2">
            <label for="content">Nội dung:</label>
        </div>
        <div class="col-sm-9">
            <textarea class="form-control required" rows="8" cols="20" name="content"  placeholder="Nội dung" ></textarea>
        </div>
        <input type="hidden" name="action" value="rab_contact">
    </div>
    <div class="form-group">
        <div class="col-sm-9">
        </div>
        <div class="col-sm-2">
            <button  type="submit" data-loading-text="<?php _e('Sending...',RAB_DOMAIN);?>" autocomplete="off"  class="btn btn btn-primary"><?php _e('Send',RAB_DOMAIN);?></button>
        </div>
    </div>
</form>
<?php
add_action('wp_enqueue_scripts','add_validate_form');
function add_validate_form(){

}
?>