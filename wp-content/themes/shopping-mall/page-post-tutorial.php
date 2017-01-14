<?php
/* Template Name: Post Tutorial Page */
/**
 * @package Shopping_Mall
 */
 get_header();
 ?>
<div class="jobs-page site-page--tutorial-form">
	<div class="content-area">
   <?php
      $tu_title = '';
      $tu_des = '';
      $tu_tags = '';
      $tu_cat = 0;
      $tu_software = 0;
      $errors = [];
      $html_ms = '';
       if( wp_verify_nonce($_POST['post_tutorial'],'post_tutorial_action') && isset($_POST['tu'])){
         $tutorial = $_POST['tu'];
         print_r($tutorial);
         $tu_title = ($tutorial['title']) ? $tutorial['title'] :'';
         if(empty($tu_title)) $errors[] = 'Please input title';
         $tu_des = ($tutorial['des']) ? wp_strip_all_tags($tutorial['des']) :'';
         if(empty($tu_des)) $errors[] ='Please input description';
         $tu_cat = ($tutorial['cat']) ? $tutorial['cat'] : 0;
         $tu_software = ($tutorial['software']) ? $tutorial['software'] :'';
         $tu_tags = ($tutorial['tags']) ? wp_strip_all_tags($tutorial['tags']) :'';
         $step_title = isset($tutorial['step']['title']) ? $tutorial['step']['title'] : [];
         $step_des = isset($tutorial['step']['content']) ? $tutorial['step']['content'] : [];
         if(empty($tu_cat)) $errors[] ='Please choose category';
         if(empty($tu_software)) $errors[] ='Please choose Software';
         if(empty($tu_tags)) $errors[] ='Please choose software';
         if(empty($step_title)) $errors[] ='Please input step title';
         if(empty($step_des)) $errors[] ='Please input step content';
         if($errors && count($errors)>0){
          $html_ms .='<ul class="error">';
                 foreach ($errors as $error) {
                     $html_ms .='<li>'.$error.'</li>';
                 } 
            $html_ms .='</ul>';
         }else{
               
               $tutorial_ob = array(
                     'post_title'=>$tu_title,
                     'post_content'=>$tu_des,
                     'post_status'=>'publish',
                     'post_type'=>'tutorial',
                     'post_author'=>get_current_user_id(),
                     'tax_input'=>array(
                          'tutorial_cat'=>array($tu_cat),
                          'tutorial_software'=>array($tu_software),
                          //'tutorial_tags'=>$tu_tags  
                      ),
                      // 'meta_input'=> array(
                      //     PREFIX_WEBSITE.'deadline_job' =>$job_deadline,
                      //     PREFIX_WEBSITE.'price_job'=>$job_price,
                      //     PREFIX_WEBSITE.'terms_of_use_job'=>$job_agree
                      // )
                  );
            //$tutorial_id = wp_insert_post($tutorial_ob);
             foreach ($step_title as $key=>$step) {
                 $step_data = array(
                    'step_title'=>$step,
                    'step_content'=>$step_des[$key]
                  );
                print_r($step_data);
               // add_row(PREFIX_WEBSITE.'step_tutorial',$step_data,$tutorial_id); 

             }
             
                                   
         }
      }
    echo $html_ms;    

    ?>
	<form method="post" action="" enctype="multipart/form-data" id="form-post-tutorial">
		    <div class="tutorial-form__content">
            <h1 class="tutorial-form__title">Post your Tutorial</h1>
             <div class="tutorial-form__block--left headline">
                <div class="input-container">
                  <label class="tutorial-form__label">Tutorial</label>
                  <input placeholder="How to make a 3D car model" class="field" type="text" name="tu[title]" id="tutorial_title">
                </div>
                <div class="input-container">
                  <label class="tutorial-form__label">Description</label>
                  <textarea class="field field--colored field--text tutorial-form__description" placeholder="We will build a beautiful car model" name="tu[des]" id="tutorial_description"></textarea>
                </div>
                <div class="input-container">
                  <label class="tutorial-form__label">Tags</label>
                  <input type="text" name="tu[tags]" class="field" id="tags">
                  <div class="input-container__note">Tags should be separated by entering key.</div>
               </div>
               <div class="input-container">
                  <label class="tutorial-form__label">Steps</label>
                  <div class="js-steps">
                      <div class="js-insert-steps" data-number-step = "1">
                        <div class="nested-fields">
                          <?php get_template_part('steps/step');?>
                        </div>
                      </div>
                      <div class="links"><a href="javascript:void(0)" class="addStep button button--small add_fields">Add step</a></div>
                  </div>
               </div>
               
             </div>
             <div class="tutorial-form__block--right">
                <div class="input-container">
                    <label class="tutorial-form__label">Categories</label>
                    <select multiple="multiple" name="tu[cat]" class="tutorial_multi_select" id="tutorial_categories">
                       <?php
                        $tutorial_cat = 'tutorial_cat';
                        $tutorial_cats = get_terms( $tutorial_cat, 'orderby=count&hide_empty=0');
                       if($tutorial_cats):
                           $selected = '';
                               foreach ($tutorial_cats as $cat) {
                                  //if(in_array($cat->term_id, )){
                                   //  $selected ='selected="selected"';
                                  //}else{
                                   // $selected = '';
                                  //}
                         ?>
                                 <option <?php echo $selected; ?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
                                 <?php 
                               }
                    endif;

               ?>
                    </select>
                </div>
                <div class="input-container">
                    <label class="tutorial-form__label">Software</label>
                    <select multiple="multiple" name="tu[software]" class="tutorial_multi_select" id="tutorial_software" >
                        <?php
                        $tutorial_software = 'tutorial_software';
                        $tutorial_softwares = get_terms( $tutorial_software, 'orderby=count&hide_empty=0');
                       if($tutorial_softwares):
                           $selected = '';
                               foreach ($tutorial_softwares as $cat) {
                                  //if(in_array($cat->term_id, )){
                                   //  $selected ='selected="selected"';
                                  //}else{
                                   // $selected = '';
                                  //}
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
                               <?php 
                              }
                     endif;

               ?>
                    </select>
                </div>
                <div class="primary-image-form__upload">
                  <label class="tutorial-form__label">Preview image</label>
                  <div class="upload-area">
                        
                          <input type="file" class="with-preview" id="fileUploadTutorial" name="files[]" />
                          <div id="filedrag">
                              <div class="upload-area__text">
                                  Drag &amp; Drop
                                  <span>Browse Files</span>
                              </div>
                          </div>
                       
                        <div id="fileTutorial"></div>
                    </div>
                    <p>Image will be cropped into a square.</p>
                </div>
            </div>
        <?php  wp_nonce_field('post_tutorial_action','post_tutorial'); ?>
          <input type="submit" name="submit" value="Post job tutorial" class="button u-float-right">
        </div>
		<form>
	</div>
	
</div>

<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		/*$("#form-post-job").validate({
			rules: {
			    'job[price]': {
			      required: true,
			      number: true
			    }
			  }
		});*/
    SiteMain.createEditor();
    SiteMain.createCategorySelect();
    SiteMain.previewTutorialFile();
    SiteMain.insertAndDeteleStep();
    $('#tags').tagsInput({width:'auto'});
	});
</script>