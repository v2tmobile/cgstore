<?php
/* Template Name: Post Job Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="jobs-page">
  
	<div class="content-area">

         <?php
           

           if( wp_verify_nonce($_POST['post_job'],'post_job_action') && isset($_POST['job'])){
               
               $job = $_POST['job'];
               $errors = [];
               if(empty($job['title'])) $errors[] = 'Title can\'t be blank'; else  $job_title = wp_strip_all_tags($job['title']);
               if(empty($job['description'])) $errors [] = 'Description can\'t be blank';else $job_des = $job['description'];
               if(empty($job['type_job'])) $errors[] ='Category can\'t be blank'; else $type_job = $job['type_job'];
               if(empty($job['job_format'])) $errors[] ='Software can\'t be blank'; else $job_format = $job['job_format'];
               if(empty($job['deadline'])) $errors[] ='Deadline is invalid'; else $job_deadline = $job['deadline'];

               if(empty($job['price'])) $errors [] = 'Please input price'; else {
               	  $job_price = $job['price'];
               } 

               $job_status = ($job['status']) ? 'publish' : 'draft';
               
               if(empty($job['terms_of_use'])) $errors[] ='Please check agree with terms and conditions';
               else $job_agree = 1;

             if($errors && count($errors) >0 ){
             	echo '<ul class="error">';
                 foreach ($errors as $error) {
                    echo '<li>'.$error.'</li>';
                 } 
                echo '</ul>';
              }else{

                 $job_ob = array(
                     'post_title'=>$job_title,
                     'post_content'=>$job_des,
                     'post_status'=>$job_status,
                     'post_type'=>'jobs',
                     'post_author'=>get_current_user_id(),
                     'tax_input'=>array(
                          'type_job'=>array($type_job),
                          'job_format'=>array($job_format)
                     	),
                      'meta_input'=> array(
                      	  PREFIX_WEBSITE.'deadline_job' =>$job_deadline,
                      	  PREFIX_WEBSITE.'price_job'=>$job_price,
                          PREFIX_WEBSITE.'terms_of_use_job'=>$job_agree
                      )
                  );

                 print_r($_FILES);
               
                // $job_id = wp_insert_post($job_ob);
                // if($job_id){
                	
                // 	if($_FILES['files']){
                // 		print_r($_FILES['files']);
                // 	   //include_once('inc/upload-file.php');
                // 	    //$upload = cgstore_upload($job_id,$_FILES['files']);
                //          //if($upload) print_r($upload);else echo 'uplaod success';
                //    }else{

                //    	  echo 'redirect';
                //    }
                // }

              }

           }


          ?>

	   <form method="post" action="" enctype="multipart/form-data" id="form-post-job">
		<div class="jobs-application__content">
		   <div class="jobs-application__application">
		      <div class="jobs-form__block--left headline">
				   <h3 class="jobs-form__content-title">Post your 3D job </h3>
				   <div class="input-container">
				   <label class="jobs-form__label">Job Title</label>
				   <input placeholder="3D design of Audi Car" class="field field--colored" type="text" name="job[title]" id="job_title"></div>
				   <div class="input-container">
				   <label class="jobs-form__label">Detailed job description</label>
				   <textarea rows="4" class="field field--colored field--textbox" placeholder="What we need is a simple model of the car made by cinema 4d or any other 3d modeling tool" name="job[description]" id="job_description"></textarea></div>
				   <div class="jobs-form__block--half">
				      <div class="input-container">
				         <label class="jobs-form__label">Select category</label>
				         <div class="jobs-form__category-block">
				           <?php
                              $type_job_tax = 'type_job';
        					  $type_jobs = get_terms( $type_job_tax, 'orderby=count&hide_empty=0' );
        					  if($type_jobs):
        					  	foreach ($type_jobs as $type_job):
                                  
				            ?>
				            <div class="jobs-form__category">
				               <label>
				                  <div class="radio">
				                  <input type="radio" value="<?php echo $type_job->term_id; ?>" name="job[type_job]" id="<?php echo $type_job->term_id; ?>"></div>
				                  <?php echo $type_job->name; ?>
				               </label>
				            </div>

				           <?php 
                              endforeach;
				           endif; ?>
				            
				         </div>
				      </div>
				      <div class="input-container">
				      	<div id="progress" class="progress">
					        <div class="progress-bar progress-bar-success"></div>
					    </div>
				         <label class="jobs-form__label">Add related files or images</label>
				         <div class="button-upload"><span>Browse</span>
				         <input class="file-upload--jobs" id="fileupload" multiple name="files[]" type="file"></div>
				         <div class="files" id="files"></div>
				         
				      </div>
				   </div>
				   <div class="jobs-form__block--half is-last">
				      <label class="jobs-form__label">Select or enter software needed</label><span class="jobs-form__list-title">
				      <select name="job[job_format]" id="format_job" class="field field--colored">
				      <?php
                          $format_job_tax = 'job_format';
        				  $format_jobs = get_terms( $format_job_tax, 'orderby=count&hide_empty=0');
        				  if($format_jobs):
                               foreach ($format_jobs as $format) {
                               	?>
                               	 <option value="<?php echo $format->term_id; ?>"><?php echo $format->name; ?></option>
                               	<?php 
                               }
        				  	endif;

				       ?>
				      </select> 
				   </div>
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
		   <div class="clear"></div>
		   <div class="deadline_line"></div>

		   <div class="jobs-form__offer">
			   <div class="jobs-form__deadline">
			      <div class="input-container">
			         <label class="jobs-form__label">Date when job needs to be done</label>
			         <div class="input-container--date"><input value="2017-01-31" class="field field--colored" id="datepicker" type="text" name="job[deadline]"></div>
			      </div>
			   </div>
			   <div class="jobs-offer__visibility">
			      <label class="jobs-form__label">Type of your job offer</label>
			      <div class="jobs-form__offer-item">
			         <label class="">
			            <div class="radio is-checked"><input type="radio" value="1" name="job[status]" id="job_public_true" checked="checked"></div>
			            Public<small>(Everyone will be able to see the offer)</small>
			         </label>
			      </div>
			      <div class="jobs-form__offer-item">
			         <label class="">
			            <div class="radio"><input type="radio" value="0" name="job[status]" id="job_public_false" ></div>
			            Private<small>(Only invited designers will see the offer)</small>
			         </label>
			      </div>
			   </div>
			</div>
		</div>

		<div class="jobs-application__content jobs-application__content--footer">
		   <div class="jobs-application__earnings">
		      <label class="label--with-hexagon">Budget:</label><input value="100.0" class="field field--colored cgtrader_price" data-job-id="1105" data-application-id="null" data-country-code="DK" type="text" name="job[price]" id="job_application_cgtrader_price" style="text-align: right;">
		      <div class="jobs-offer__budget--small-col">
			   <label class="jobs-form__term-of-use">
			      
			      <div class="checkbox">
			      <input type="checkbox" class="iCheckBox" value="1" name="job[terms_of_use]" id="job_agreed_to_terms_of_use" ></div>
			      I agree with <a id="" href="/pages/3d-jobs-agreement">Terms and Conditions</a> including waiving 14-days withdrawal right regarding the digital content.
			   </label>
			</div>
			  <?php wp_nonce_field('post_job_action','post_job'); ?>
		      <input type="submit" name="commit" value="Post job offer" class="button u-float-right">
		   </div>
		</div>
		<form>
	</div>
	
</div>

<?php get_footer(); ?>
