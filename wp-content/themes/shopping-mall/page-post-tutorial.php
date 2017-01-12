<?php
/* Template Name: Post Tutorial Page */
/**
 * @package Shopping_Mall
 */
?>   
<?php get_header();?>
<div class="jobs-page site-page--tutorial-form">
	<div class="content-area">
   <?php
      $tu_title = '';
      $tu_des = '';
      $tu_tags = '';
      $tu_cat = 0;
      $tu_software = 0;
      $errors = [];
       if( wp_verify_nonce($_POST['post_tutorial'],'post_tutorial_action') && isset($_POST['tu'])){
         $tutorial = $_POST['tu'];
         $tu_title = ($tutorial['title']) ? $tutorial['title'] :'';
         if(empty($tu_title)) $errors[] = 'Please input title';
         $tu_des = ($tutorial['des']) ? wp_strip_all_tags($tu_de['des']) :'';
         if(empty($tu_des)) $errors[] ='Please input description';
         $tu_cat = ($tutorial['cat']) ? $tutorial['cat'] ? 0;
         $tu_software ($tutorial['software']) ? $tutorial['software'] :'';
         $tu_tags = ($tutorial['tags']) ? $tutorial['tags'] :'';
         
         

       }    

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
                  <input type="text" name="tu[tags][]" required="required" class="field" id="tags">
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
<?php //wp_nonce_field('post_tutorial_action','post_tutorial'); ?>
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