<div id="modal-new-visual" class="popup hidepopup">
	<div class="overlay"></div>
	<div class="popup-content">
		<div class="modal__header">
		   <h3 class="modal__title heading">New visual</h3>
		   <button aria-hidden="true" class="modal__close js-modal-close" data-dismiss="modal" type="button"><i class="fa fa-times-circle-o fa-2x"></i></button>
		</div>
		<form id="new-visual-form" action="" method="post">
			<div class="modal__body">
					<div class="input-container">
						<label for="external_url">
			                Provide
			                <a href="//youtube.com" target="_blank">youtube</a>,
			                <a href="//vimeo.com" target="_blank">vimeo</a>,
			                <a href="//sketchfab.com" target="_blank">sketchfab</a> or
			                <a href="//verold.com" target="_blank">verold</a> URL</label>
			                <input class="field" type="text" name="external_url" id="external_url">
					</div>
					<div class="preview-container">
						<iframe style="width: 100%" src="" width="100%" height="315" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
					</div>
			</div>
			<div class="modal__footer"><input type="submit" class="button js-submit" value="Attach"/></div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		

		$("#contact-message").validate({
			rules: {
			    'contact-subject': {
			      required: true
			    },
			    'contact-message': {
			      required: true
			    }
			  }
		});
		function openContactUser(){
			$('.js-contact').click(function(){
				SiteMain.openPopup('#modal-contact-user');
			});
			$('.js-modal-close').click(function(){
				SiteMain.closePopup('#modal-contact-user');
			});
		}
		openContactUser();
	});
</script>
