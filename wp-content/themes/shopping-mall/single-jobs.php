<?php
/* Template Name: Single Jobs Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<?php
	 if( have_posts() ) : the_post(); 
	 $id = get_the_ID();
	 $applicant = getApplicants($id);
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
		         		<a class="button button-primary view-attached-files" href="javascript:void(0)"><i class="fa fa-file-text"></i>View attached files (<?php echo count($attachments); ?>)</a>
		         	
                       <ul class="attached-files-container is-hidden" id="attached-job-files">
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
    <?php
    $job_offer = '';
    $job_price_offer = ($price_job) ? $price_job : 0;
    $job_price_earning = $job_price_offer;
    $terms_of_use = 0;
    $errors = [];
    $html_ms = '';
    if( wp_verify_nonce($_POST['apply_job'],'apply_job_action') && isset($_POST['job'])){
       
       if(!is_user_logged_in()){
         	wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));exit();
         }

       $apply_job = $_POST['job'];
       $job_offer = ($apply_job['offer']) ? wp_strip_all_tags($apply_job['offer']) : '';
       if(!$job_offer) $errors[] ='Please input offer';
       $job_price_offer = ($apply_job['price_job']) ? $apply_job['price_job'] : 0;
       if(!$job_price_offer) $errors[] ='Please input price offer';
       $terms_of_use = ($apply_job['terms_of_use']) ? $apply_job['terms_of_use']: 0;
       if(!$terms_of_use) $errors[] ='Please agreed to terms of use';
       
       if($errors && count($errors) > 0 ){
       	  $html_ms .='<ul class="error">';
                 foreach ($errors as $error) {
                     $html_ms .='<li>'.$error.'</li>';
                 } 
          $html_ms .='</ul>';
       }else{
       	   $user = wp_get_current_user();
           $apply_job_ob =array(
              'post_type'=>'apply-job',
              'post_title'=>$user->user_firstname.' '.$user->user_lastname.' apply job',
              'post_content'=>$job_offer,
              'post_status'=>'publish',
              'post_author'=>get_current_user_id(),
              'meta_input'=> array(
                      	  PREFIX_WEBSITE.'price_offer_job' =>$job_price_offer,
                      	  PREFIX_WEBSITE.'earning_price_job'=>$job_price_earning,
                      	  PREFIX_WEBSITE.'parent_job_id'=>$id
                      )
           	);

          $apply_job_id = wp_insert_post($apply_job_ob);
          if($apply_job_id){
          	if($_FILES['files']){
                    include_once('inc/upload-file.php');
                    cgstore_upload($job_id,$_FILES['files']);      
             }
             echo '<p>Apply job succesful.</p>';
             $job_offer = '';
          }
       }

    }
     
     echo $html_ms;
     ?>
    
	<form action="" method="post" id="form-apply-job">
		<div class="jobs-application__content">
		   <div class="jobs-application__application">
		      <div class="jobs-application__form">
		         <h3>Apply for this job</h3>
		         <label class="label--with-hexagon">Offer</label>
		         <textarea class="field field--colored field--textbox" placeholder="Please enter your offer details" name="job[offer]" id="job_application_offer"></textarea>
		         <div class="button-upload"><span>Browse</span>
		         <input class="file-upload--jobs" id="fileupload" multiple="" name="files[]" type="file"></div>
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
		         <div class="icon-question-sign u-float-right"><a href="#">Questions?</a></div>
		      </div>
		   </div>
		</div>

		<div class="jobs-application__content jobs-application__content--footer">
		   <div class="jobs-application__earnings">
		      <label class="label--with-hexagon">Final Offer Price:</label>
		      <input value="<?php echo $job_price_offer; ?>" class="field field--colored cgtrader_price" type="text" name="job[price_job]" id="job_application_cgtrader_price" style="text-align: right;"><label class="label--with-hexagon">My Earnings:</label><input value="<?php echo $job_price_earning; ?>" class="field field--colored price" type="text" name="job[earning_price]" id="job_application_price" style="text-align: right;">
		      <i class="icon-question-sign has-tooltip tooltipstered"><i class="fa fa-question-circle-o fa-lg"></i></i>
		      <div class="jobs-application__terms">
		         <label class="terms-label">
		            <div class="checkbox">
		            	<input class="checkbox iCheckBox" type="checkbox" value="1" name="job[terms_of_use]" id="job_application_agreed_to_terms_of_use"></div>
		            Agree with <a class="jobs-application__terms-link" id="" href="#">Term of use</a>
		         </label>
		      </div>
		       <?php wp_nonce_field('apply_job_action','apply_job'); ?>
		      <input type="submit" name="commit" value="Apply for this job" class="button u-float-right">
		   </div>
		</div>
	</form>
	</div>
</div>
<?php
		endif; // End of the loop.
		?>
<?php get_footer(); ?>
