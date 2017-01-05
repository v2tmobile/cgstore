<?php
/* Template Name: Post Job Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="jobs-page">
  
	<div class="content-area">

         <?php
           


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
				                  <input type="radio" value="1" name="job[type_job]" id="<?php echo $type_job->term_id; ?>"></div>
				                  <?php echo $type_job->name; ?>
				               </label>
				            </div>

				           <?php 
                              endforeach;
				           endif; ?>
				            
				         </div>
				      </div>
				      <div class="input-container">
				         <label class="jobs-form__label">Add related files or images</label>
				         <div class="button-upload"><span>Browse</span><input class="file-upload--jobs" data-url="/attachments" id="fileupload" multiple="" name="files[]" type="file"></div>
				         <div class="files" id="files"></div>
				      </div>
				   </div>
				   <div class="jobs-form__block--half is-last">
				      <label class="jobs-form__label">Select or enter software needed</label><span class="jobs-form__list-title">
				      <input type="text" name="job[format_job]" id="format_job" placeholder="Filter" class="field field--colored" data-path="" data-job="null"></span>
				      <ul class="jobs-form__software-list"></ul>
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
			            <div class="radio is-checked"><input type="radio" value="true" name="job[public]" id="job_public_true" checked="checked"></div>
			            Public<small>(Everyone will be able to see the offer)</small>
			         </label>
			      </div>
			      <div class="jobs-form__offer-item">
			         <label class="">
			            <div class="radio"><input type="radio" value="false" name="job[public]" id="job_public_false" ></div>
			            Private<small>(Only invited designers will see the offer)</small>
			         </label>
			      </div>
			   </div>
			</div>
		</div>

		<div class="jobs-application__content jobs-application__content--footer">
		   <div class="jobs-application__earnings">
		      <label class="label--with-hexagon">Budget:</label><input value="100.0" class="field field--colored cgtrader_price" data-job-id="1105" data-application-id="null" data-country-code="DK" type="text" name="job_application[cgtrader_price]" id="job_application_cgtrader_price" style="text-align: right;">
		      <div class="jobs-offer__budget--small-col">
			   <label class="jobs-form__term-of-use">
			      <input name="job[agreed_to_terms_of_use]" type="hidden" value="0">
			      <div class="checkbox"><input type="checkbox" class="iCheckBox" value="1" name="job[agreed_to_terms_of_use]" id="job_agreed_to_terms_of_use" ></div>
			      I agree with <a id="" href="/pages/3d-jobs-agreement">Terms and Conditions</a> including waiving 14-days withdrawal right regarding the digital content.
			   </label>
			</div>
		      <input type="submit" name="commit" value="Post job offer" class="button u-float-right">
		   </div>
		</div>
		<form>
	</div>
	
</div>

<?php get_footer(); ?>
