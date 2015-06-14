(function($){
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
		        	console.log(response);
		        }
		      });

			return false;
		})


	});
})(jQuery);