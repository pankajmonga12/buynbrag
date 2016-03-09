//you need to include the jquery and the fileuploader.js before this part.
<div id="logos-uploader" class="file-uploader">
	<noscript><p>Please enable JavaScript to use image uploader.</p> <!-- or put a simple form for upload here -->
	</noscript>
</div>
<script>
	function createuploader() {
		var logo_uploader = new qq.FileUploader({
			element: document.getElementById('logos-uploader'),
			action: '<?=base_url()?>mycontroller/myuploader',
			debug: true,
			//params: { },
			//onSubmit: function(file, ext) {

			//},
			allowedExtensions: ['png', 'jpeg', 'jpg', 'gif', 'bmp'],
			sizeLimit: 1 * 1024 * 1024,
			onComplete: function (id, fileName, responseJSON) {
				if (responseJSON.success) {


					//do something
					$.log(responseJSON.filename, responseJSON.filesize);


				}
			}


		});
	}


	$(document).ready(function () {

		createuploader();

	});	// end of function


</script>