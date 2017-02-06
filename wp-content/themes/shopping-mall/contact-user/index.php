<div id="modal-contact-user" class="popup hidepopup">
	<div class="overlay"></div>
	<div class="popup-content">
		<div class="modal__header">
		   <h3 class="modal__title heading">Contact user</h3>
		   <button aria-hidden="true" class="modal__close js-modal-close" data-dismiss="modal" type="button"><i class="fa fa-times-circle-o fa-2x"></i></button>
		</div>
		<form id="contact-message" action="" method="post">
			<div class="modal__body">
					<div class="input-container">
						<label required="required" for="contact-message-subject">Subject <b>*</b></label>
						<input class="field" id="contact-message-subject" type="text" name="contact-subject" required>
					</div>
					<div class="input-container is-last message-body">
						<label required="required" for="contact-message-message">Message <b>*</b></label>
						<textarea class="field field--text" rows="0" id="contact-message-message" name="contact-message" required></textarea>
					</div>
			</div>
			<div class="modal__footer"><input type="submit" class="button js-submit" value="Send Message"/></div>
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
