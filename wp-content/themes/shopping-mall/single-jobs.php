<?php
/* Template Name: Single Jobs Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<?php
	 if( have_posts() ) : the_post();
	 $id = get_the_ID();
	 $applicant = get_field(PREFIX_WEBSITE.'applicant_job',$id);
     $job_date = get_field(PREFIX_WEBSITE.'deadline_job',$id);
	 $number_day = getNumberDay($job_date);
	 $price_job = get_field(PREFIX_WEBSITE.'price_job',$id);
	?>
<div class="jobs-page">
	<div class="content-area">
		<div class="jobs-application__content">
		   <div class="jobs-application__job">
		      <div class="jobs__item">
		         <div class="jobs-item__image">
		         	<?php if ( has_post_thumbnail() ) : ?>
				      		<?php echo get_the_post_thumbnail(get_the_ID());?>
				      	<?php else: ?>
				      		<img src="<?php echo TEMPLATE_PATH ?>/images/no_image_thumb.png"/>
				      <?php endif; ?>
		         	
		         </div>
		         <div class="jobs-item__content">
		            <h3 class="jobs__title"><?php the_title();?></h3>
		            <ul class="label-list">
		               <li>
		                  <div class="jobs__aplicants"><span class="label--hexagon"><?php echo ($applicant) ? count($applicant) : 0; ?> applicants</span></div>
		               </li>
		               <li>
		                  <div class="jobs__deadline"><span class="label--hexagon"><?php echo $number_day; ?> days to finish</span></div>
		               </li>
		               <li>
		                  <div class="jobs__software"></div>
		               </li>
		            </ul>
		            <?php 
                            $job_formats = get_the_terms($id,'job_format');
                            if($job_formats):
				         ?>
				         <div class="tag-list">
				            <ul>
				               <?php foreach ($job_formats as $fomat):?>
				               <li><?php echo $fomat->name; ?></li>
				               <?php endforeach; ?>
				              
				            </ul>
				         </div>
				     <?php endif; ?>
		         </div>
		         <div class="jobs-price__content">
		            <h3 class="jobs__price u-text-right">$<?php echo ($price_job) ? $price_job : 0 ; ?></h3>
		         </div>
		         <div class="jobs-application-text">
		         	<?php the_content();?>
		         </div>
		         <?php
                  $attachments = get_posts( array(
			        'post_type'         => 'attachment',
			        'posts_per_page'    => -1,
			        'post_parent'       => $id,
			        'exclude'           => get_post_thumbnail_id(),
			    
			      ) );

		          ?>
		         <?php
		         	if ( $attachments) { 

		         	?>
		         		<a target="_blank" class="button button-primary view-attached-files" href="#"><i class="fa fa-file-text"></i>View attached files (<?php echo count($attachments); ?>)</a>
		         	
                       <ul class="attached-files-container is-hidden">
		         	<?php
		         	   foreach ( $attachments as $attachment){
		         	     $attachment_link = $attachment->guid;     
		         	     $ext = wp_check_filetype($attachment_link);
                         $attachment_mine = $ext['ext'];
              	         $attachment_title = $attachment->post_title;
		         	?>
		            <a target="_blank" href="<?php echo $attachment_link; ?>">
		               <li><span><?php echo $attachment_title.'.'.$attachment_mine; ?></span></li>
		            </a>
		            <?php } ?>
		         </ul>

		         	<?php } ?>
		         
		        
		      </div>
		   </div>
		</div>
		

		<div class="jobs-application__content">
		   <div class="jobs-application__application">
		      <div class="jobs-application__form">
		         <h3>Apply for this job</h3>
		         <label class="label--with-hexagon">Offer</label>
		         <textarea class="field field--colored field--textbox" placeholder="Please enter your offer details" name="job_application[offer]" id="job_application_offer"></textarea>
		         <div class="button-upload"><span>Browse</span><input class="file-upload--jobs" data-url="/attachments" id="fileupload" multiple="" name="files[]" type="file"></div>
		         <div class="files" id="files"></div>
		      </div>
		      <div class="jobs-application__tips">
		         <h3>Tips</h3>
		         <div class="input-container">
		            <h5>Make sure you:</h5>
		            <ul class="bullet--hexagon">
		               <li>Present your experience related to job offer</li>
		               <li>You are able work with required software</li>
		               <li>You are able to finish the job in time</li>
		               <li>Attach examples of your work</li>
		               <li>Do not provide any direct contact details</li>
		               <li>Provide the best  offer to fit the budget</li>
		            </ul>
		         </div>
		         <div class="input-container">
		            <h5>When you apply for a job:</h5>
		            <ul class="bullet--hexagon">
		               <li>Client will be informed about your offer</li>
		               <li>You will be informed if a client selected you and pre-paid for the job</li>
		               <li>Progress will be discussed in private workspace between you and client</li>
		               <li>CGTrader will pay out the royalties when the job is done and approved by client</li>
		            </ul>
		         </div>
		         <div class="icon-question-sign u-float-right"><a href="javascript:$zopim.livechat.window.show()">Questions?</a></div>
		      </div>
		   </div>
		</div>

		<div class="jobs-application__content jobs-application__content--footer">
		   <div class="jobs-application__earnings">
		      <label class="label--with-hexagon">Final Offer Price:</label><input value="100.0" class="field field--colored cgtrader_price" data-job-id="1105" data-application-id="null" data-country-code="DK" type="text" name="job_application[cgtrader_price]" id="job_application_cgtrader_price" style="text-align: right;"><label class="label--with-hexagon">My Earnings:</label><input value="0.0" class="field field--colored price" data-job-id="1105" data-application-id="null" data-country-code="DK" type="text" name="job_application[price]" id="job_application_price" style="text-align: right;"><i class="icon-question-sign has-tooltip tooltipstered"><i class="fa fa-question-circle-o fa-lg"></i></i>
		      <div class="jobs-application__terms">
		         <label class="terms-label">
		            <input name="job_application[agreed_to_terms_of_use]" type="hidden" value="0">
		            <div class="checkbox">
		            	<input class="checkbox iCheckBox" type="checkbox" value="1" name="job_application[agreed_to_terms_of_use]" id="job_application_agreed_to_terms_of_use"></div>
		            Agree with <a class="jobs-application__terms-link" id="" href="/pages/3d-jobs-agreement">Term of use</a>
		         </label>
		      </div>
		      <input type="submit" name="commit" value="Apply for this job" class="button u-float-right">
		   </div>
		</div>
	</div>
</div>
<?php
		endif; // End of the loop.
		?>
<?php get_footer(); ?>
