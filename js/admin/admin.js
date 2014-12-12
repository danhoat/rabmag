(function($){

	RAB.Views = Backbone.View.extend({
		el : 'div#rab_backend',
		events : {
			'change input.option' 			: 'saveOption',
			'change select.option'	 		: 'saveOption',
			'change textarea.option' 		: 'saveOption',
			'submit form.save-opt-slider' 	: 'saveSlider',

		},
		initialize : function(){
			console.log('da vao');
			var button = 'pickfiles';
			var action = 'rab_upload_logo';
			var config = { 'multi_selection': false,
							filters : {
								max_file_size : '10mb',
								mime_types: [
									{title : "Image files", extensions : "jpeg,jpg,gif,png"},
									{title : "Zip files", extensions : "zip"}
								]
							}
						};

			var upload_logo = new RAB.Fiel_Uploader({button:button, action: action,config:config});
			
		},
		saveOption : function(event){
			event.preventDefault();

			var target 	= $(event.currentTarget),
				html 	= '';
			if(target.hasClass('select'))
				html = target.find(":selected").text();			

			$.ajax({
				url : rab_globals.ajaxUrl,
				type : 'post',
				data : {
					action :'save-option',
					name :target.attr('name'),
					value : target.val(),
					html : html,
				},
				beforeSend :function(){

				},
				success : function(res){
					console.log('success');
				}
			});
		},
		saveSlider : function(event){
			console.log(event);
			console.log(this);
			var target 	= $(event.currentTarget),
				data 	= target.serialize() ;

			$.ajax({
				url : rab_globals.ajaxUrl,
				type : 'post',
				data : data,
				beforeSend :function(){

				},
				success : function(res){
					console.log('success');
				}
			});
			
			return false;
		},

	});
	jQuery(document).ready(function(){
		
		new RAB.Views();
	})
})(jQuery);