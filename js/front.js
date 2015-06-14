(function($){

	function showNotification(params) {

            // remove existing notification
            jQuery('div.notification').remove();
            var $class = 'success';
            if(!params.success)
            	$class = 'fail';
            $('body').prepend('<div class="notification '+$class+'"><div class="container"><div class="msg">'+params.msg+'</div></div></div>');
            $notification = $('div.notification');
            $notification.hide().prependTo('body')
                .fadeIn('fast')
                .delay(1000)
                .fadeOut(3000, function() {
                   jQuery(this).remove();
                });
    }

	$(document).ready(function(){

		var val = $('form.form-contact').validate({
				rules: {
                        user_name: "required",
                   },
                 messages: {
                 		user_name : rab_global.validate.required_user_name,
						user_email :{
                 			required : rab_global.validate.required_user_email,
                 		// 	email    : 'Chưa đúng định dạng email'
                 		},
                 		content 	: rab_global.validate.required_content,
                 		user_phone 	: rab_global.validate.required_phone,
                    }
			});

		var $btn = $('form.form-contact').find(".btn");

		$('form.form-contact').submit(function(){

			var data = $( this ).serialize();

			if(!val.form())
				return false;
			var $btn = $('form.form-contact').find(".btn");

			jQuery.ajax({

		        type : "POST",
		        url : rab_global.ajaxUrl,
		        data : data,
		        beforeSend: function(){
		        	$btn.button('loading');
		        },
		        success: function(response) {
		        	$btn.button('reset');
		        	showNotification(response);
		        }
		      });

			return false;
		})


	});
})(jQuery);