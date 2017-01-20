<?php
/* Template Name: Post Tutorial Page */
/**
 * @package Shopping_Mall
 */

      $tutorial_id = ($_GET['id']) ? $_GET['id'] : '';
      $tu_title = '';
      $tu_des = '';
      $tu_tags = '';
      $tu_cat = 0;
      $tu_software = 0;
      $errors = [];
      $html_ms = '';
      $tags = array();
      $tutorial_software_out = 0 ;
      $tutorial_cat_out = 0;
      $thumb = '';
      $tutorial_step_data = array();
      if(!is_user_logged_in()){
           wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));exit();
         }
      if($tutorial_id){
          $tutorial_ob  = get_post($tutorial_id);
          if($tutorial_ob){
           if( !is_user_logged_in() || $tutorial_ob->post_author != get_current_user_id())
              {
                 wp_redirect(HOME_URL.'/tutorial/');exit();
              }
             
            $tu_title =  $tutorial_ob->post_title;
            $tu_des =    $tutorial_ob->post_content;
            $tutorial_step_data = get_post_meta($tutorial_id,PREFIX_WEBSITE.'tutorial_step');
            $thumb_src  = wp_get_attachment_image_src(get_post_thumbnail_id($tutorial_id),array(250,250));
            $thumb_src = isset($thumb_src) ? $thumb_src[0] : '';
            $thumb = '<div class="MultiFile-label"><a class="MultiFile-remove" href="#fileUploadTutorial"><i class="fa fa-times fa-24 fa-pull-right"></i><span class="remove-string">x</span></a> <span><span class="MultiFile-label" title=""><span class="MultiFile-title"></span><img class="MultiFile-preview" style="max-height:100px; max-width:100px;" src="'.$thumb_src.'"></span></span></div>';

            $tutorial_cat = get_the_terms($tutorial_id,'tutorial_cat');
            $tutorial_cat_out = isset($tutorial_cat) ? $tutorial_cat[0]->term_id : 0;
            $tutorial_software = get_the_terms($tutorial_id,'tutorial_software');
            $tutorial_software_out = isset($tutorial_software) ? $tutorial_software[0]->term_id : 0; 
            $tutorial_tag = get_the_terms($tutorial_id,'tutorial_tag');
            if($tutorial_tag){
                  foreach ($tutorial_tag as $tag) {
                     $tags[] = $tag->name;
                  }
               }
            }
         }

       if( wp_verify_nonce($_POST['post_tutorial'],'post_tutorial_action') && isset($_POST['tu'])){
         $tutorial = $_POST['tu'];
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
         if(empty($tu_tags)) $errors[] ='Please add stag';
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
                     
                  );
            if(!$tutorial_id){
              $tutorial_id = wp_insert_post($tutorial_ob);
            }else{
                $tutorial_ob['ID'] = $tutorial_id;
               $tutorial_id = wp_update_post($tutorial_ob);
            }

            $step_data = array();
            if($tutorial_id){
             wp_set_post_terms( $tutorial_id, array($tu_cat), 'tutorial_cat'); 
             wp_set_post_terms( $tutorial_id, array($tu_software), 'tutorial_software'); 
             wp_set_post_terms( $tutorial_id, $tu_tags, 'tutorial_tag' ); 
             $i = 1;
             foreach ($step_title as $key => $step) {
                 $step_data[] = array(
                    'step_title'=>$step,
                    'step_content'=>$step_des[$key]
                  );  
              }
              if ( ! add_post_meta( $tutorial_id, $prefix.'step_tutorial',$step_data, true ) ) { 
                 update_post_meta( $tutorial_id, $prefix.'step_tutorial',$step_data );
              }
              include_once('inc/upload-image.php');
              $upload_img = cgs_upload_image($tutorial_id,$_FILES['file']);
              echo 'successfull';
             
           }
                                   
         }
      }
     
 get_header();
 ?>
<div class="jobs-page site-page--tutorial-form">
	<div class="content-area">
   <?php  echo $html_ms; ?>
	<form method="post" action="" enctype="multipart/form-data" id="form-post-tutorial">
		    <div class="tutorial-form__content">
            <h1 class="tutorial-form__title">Post your Tutorial</h1>
             <div class="tutorial-form__block--left headline">
                <div class="input-container">
                  <label class="tutorial-form__label">Tutorial</label>
                  <input placeholder="How to make a 3D car model" class="field" type="text" name="tu[title]" id="tutorial_title" value="<?php echo $tu_title; ?>">
                </div>
                <div class="input-container">
                  <label class="tutorial-form__label">Description</label>
                  <textarea class="field field--colored field--text tutorial-form__description" placeholder="We will build a beautiful car model" name="tu[des]" id="tutorial_description"><?php echo wp_strip_all_tags($tu_des); ?></textarea>
                </div>
                <div class="input-container">
                  <label class="tutorial-form__label">Tags</label>
                  <input type="text" name="tu[tags]" class="field" id="tags" value="<?php echo implode(',',$tags); ?>">
                  <div class="input-container__note">Tags should be separated by entering key.</div>
               </div>
               <div class="input-container">
                  <label class="tutorial-form__label">Steps</label>
                  <div class="js-steps">
                      <div class="js-insert-steps" data-number-step = "1">
                        <div class="nested-fields">
                            <?php if($tutorial_step_data){
                               print_r($tutorial_step_data);
                                 foreach ($tutorial_step_data as $data) {
                                      
                               ?>
                              <div class="input-container">
                                <input class="step-position field" value="<?php echo $data['step_title']; ?>" maxlength="110" size="110" type="text" name="tu[step][title][]" id="tutorial_tutorial_steps_attributes__title">
                              </div>
                              <div class="redactor_box">
                                <textarea name="tu[step][content][]" class="tutorial-editor"><?php echo $data['step_content']; ?></textarea>
                              </div>

                              <?php 
                                  }
                               }else{ ?>
                              <div class="input-container">
                                <input class="step-position field" value="Step 1" maxlength="110" size="110" type="text" name="tu[step][title][]" id="tutorial_tutorial_steps_attributes__title">
                              </div>
                              <div class="redactor_box">
                                <textarea name="tu[step][content][]" class="tutorial-editor"></textarea>
                              </div> 
                              <?php } ?>
                              <a class="button button--alt remove_fields dynamic" href="#">Remove step</a>
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
                                  if($cat->term_id == $tutorial_cat_out){
                                    $selected ='selected="selected"';
                                  }else{
                                   $selected = '';
                                  }
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
                                  if($cat->term_id == $tutorial_software_out ){
                                    $selected ='selected="selected"';
                                  }else{
                                   $selected = '';
                                  }
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
                          <input type="file" class="with-preview" id="fileUploadTutorial" name="file" value="" data-file="<?php echo $tutorial_id; ?>" />
                          <div id="filedrag">
                              <div class="upload-area__text">
                                  Drag &amp; Drop
                                  <span>Browse Files</span>
                              </div>
                          </div>
                       
                        <div id="fileTutorial" <?php echo ($thumb_src) ? 'style="display:block;"' :''; ?>><?php echo $thumb; ?></div>
                    </div>
                    <p>Image will be cropped into a square.</p>
                </div>
            </div>
        <?php  wp_nonce_field('post_tutorial_action','post_tutorial'); ?>
          <input type="submit" id="btnTutorial" name="submit" value="Post job tutorial" class="button u-float-right">
        </div>
		<form>
	</div>
	
</div>

<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-post-tutorial").validate({
			rules: {
          'tu[title]':{
            required: true
          }
			  },
        submitHandler: function(form) {
          //this runs when the form validated successfully
          var fileedit = $('input#fileUploadTutorial').attr('data-file');
          console.log(fileedit);
          if(fileedit != ''){
            form.submit(); //submit it the form  
          }else{
            $('#fileUploadTutorial').append('<p class="error">This field is required.</p>');
          }
        }

		});

    $('#btnTutorial').click(function(){

    });
    SiteMain.createEditor();
    SiteMain.createCategorySelect();
    SiteMain.previewTutorialFile();
    SiteMain.insertAndDeteleStep();
    $('#tags').tagsInput({width:'auto'});
	});
</script>