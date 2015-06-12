(function($){
	jQuery(document).ready(function(){
		jQuery('form.form-contact').validate({
			rules	: {
				user_name	: "required",
				user_email	: "required"
			},
			messages	: {
				user_name	: 'vui long nhap họ tên',
				user_pass	:'vui long nhập'
			},
			highlight: function(element, errorClass) {
				$(element).parent().addClass('error');
				$(element).parent().find('span.icon').show();
			},
			unhighlight: function(element, errorClass) {
				$(element).parent().removeClass('error');
				$(element).parent().find('span.icon').hide();
				//$(element).parent().find('span.line-correct').show();
			}
		});
	});
})(jQuery);