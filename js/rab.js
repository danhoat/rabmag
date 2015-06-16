	var RAB = {};
	RAB.Views = {};

(function($){

	RAB.Fiel_Uploader = Backbone.View.extend({

		initialize	: function(args){
			//_.bindAll(this,'update_config');

			this.refig = null;
			var view = this;
			this.config = {

				runtimes 			: 'html5,flash,silverlight,html4',
				browse_button 		: args.button, // you can pass in id...
				container 			: document.getElementById('container'), // ... or DOM Element itself
				url 				: rab_globals.ajaxUrl+'?action=' + args.action,
				flash_swf_url 		: rab_globals.flash_swf_url,
				silverlight_xap_url : rab_globals.silverlight_xap_url,

				filters : {
					max_file_size : '10mb',
					mime_types: [
						{title : "Image files", extensions : "jpg,gif,png"},
						{title : "Zip files", extensions : "zip"}
					]
				}

			};

			if(typeof args.config !== 'undefined' ){
				$.each(args.config, function( key, value ) {
					view.config[key] = value;
				});
			}

			this.uploader  = new plupload.Uploader(this.config);
			this.uploader.init();
			this.uploader.bind('FilesAdded', function(up, files) {
				up.start();
			});
			//this.uploader.bind('BeforeUpload', this.update_config);

			this.uploader.bind('UploadComplete', function(up,files){

			});

			this.uploader.bind('Error', function(up,err){
				alert(err.message);
			});
			            
			this.uploader.bind('FileUploaded', function(up, file, resp) {
				var myData;
				try {
			        myData = resp.response;
			    } catch(err) {
			        myData = resp.response;
			    }
				var arr = JSON.parse(myData)

				var button = $(this.settings.browse_button).attr('id');
				$("#"+button).closest(".form-item").find("img").attr('src',arr.attach[0]);
			});


		},

		update_config : function(up, file, object) {

		}

	});

})(jQuery)