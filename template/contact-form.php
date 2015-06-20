
<form role="form" name="frm-contact" id="form-contact" class="form form-contact" method="POST" style="display:none">
    <div class="form-group">
        <div class="col-sm-2">
            <label for="user_name"><?php _e('Your name: (*)',RAB_DOMAIN);?></label>
        </div>
        <div class="col-sm-9">
            <input class="form-control required" id="user_name" placeholder="<?php _e('your name',RAB_DOMAIN);?>" name="user_name">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="user_address"><?php _e('Address:',RAB_DOMAIN);?></label>
        </div>
        <div class="col-sm-9">
            <input class="form-control" id="user_address"  placeholder="<?php _e('Your address',RAB_DOMAIN);?>"  name="user_address">
        </div>
    </div>
     <div class="form-group">
        <div class="col-sm-2">
            <label for="user_phone"><?php _e('Your phone number: (*)',RAB_DOMAIN);?></label>
        </div>
        <div class="col-sm-9">
            <input type="text" class="form-control required"  placeholder="<?php _e('Your phone number',RAB_DOMAIN); ?>"  name="user_phone" id="user_phone">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="user_email"><?php _e('Email: (*)',RAB_DOMAIN);?></label>
        </div>
        <div class="col-sm-9">
            <input type="email" class="form-control required email"  placeholder="<?php _e('Your Email',RAB_DOMAIN);?>"  name="user_email" id="user_email">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2">
            <label for="content"><?php _e('Content: (*)',RAB_DOMAIN);?></label>
        </div>
        <div class="col-sm-9">
            <textarea class="form-control required" rows="8" cols="20" name="content"  placeholder="<?php _e('content',RAB_DOMAIN);?>" ></textarea>
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
