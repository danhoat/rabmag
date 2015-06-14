(function($){
	$(document).ready(function(){

		var val = $('form.form-contact').validate();
		$('form.form-contact').submit(function(){
			var val = $('form.form-contact').validate();
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