(function($){
	$(document).ready(function(){

		var val = $('form.form-contact').validate({
				rules: {
                        user_name: "required",
                   },
                 messages: {
                 		user_name : rab_global.validate.required,
						user_email :{
                 			required : rab_global.validate.required_user_email,
                 		// 	email    : 'Chưa đúng định dạng email'
                 		},
                 		content :rab_global.validate.required_content,
                    }
			});

		$('form.form-contact').submit(function(){

			var data = $( this ).serialize();

			if(!val.form())
				return false;

			jQuery.ajax({

		        type : "POST",
		        url : rab_global.ajaxUrl,
		        data : data,
		        success: function(response) {
		        	console.log(response);
		        }
		      });

			return false;
		})


	});
})(jQuery);