<?php
/* Template Name: Post Gallery Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="galleries-page site-page--profile-gallery-form">
	<div class="content-area">
		<div class="breadcrumb-wrapper" id="breadcrumb">
			<ul class="breadcrumb" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
               <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
	                <a href="http://localhost/cgstore" itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing" title="Home">
	                    <span itemprop="name">Home</span>
	                </a>
	                <meta content="1" itemprop="position">
            	</li>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
		            <span itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing">
		              <span itemprop="name">Galleries</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
		        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
		            <span itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing">
		              <span itemprop="name">New Project</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
            </ul>
		</div>

		<div class="content-heading">
		   <h2 class="content-heading__title">Create New Project</h2>
		   <p class="content-heading__subtitle">Use the publishing form down below to upload a new project. Your work will appear in CGTrader's <a id="" href="<?php echo HOME_URL?>/gallery/">gallery</a> among other top notch 3D designs! Note that this <b>IS NOT</b> the place to upload your saleable 3D models </p>
		</div>

		<div class="box gallery-form">
		 <?php
              $gallery_cat_out = 0;
              $gallery_title ='';
              $gallery_des ='';
              $gallery_cat  = 0;
              $gallery_tags = '';
             if( wp_verify_nonce($_POST['post_ga'],'post_ga_action') && isset($_POST['ga'])){
                $ga = isset($_POST['ga']) ? $_POST['ga'] :'';
                if($ga){
                      print_r($ga);
                 
                }
               
             }
 
		  ?>
			<div class="l-inner">
	<form id="gallery-form" class="new_gallery" action="" method="post">
		<div class="gallery-form__upload">
			<div class="upload-dropzone">
					 <label class="jobs-form__label">Drag files here to upload</label>
					         <div class="button-upload"><span>Select files... </span>
					         	<input class="file-upload--jobs with-preview" id="fileUploadGallery" name="files[]" type="file">
					     	 </div>
				     	 </div>
				     	 <div class="" id="gallery-form-container" style="">
				     	 	<div class="gallery-form__main-info">
				     	 		<div class="gallery-form__title">
							         <div class="input-container">
								         <label required="required" for="gallery_title">Title <b>*</b></label>
								         <input class="field" type="text" name="ga[title]" id="gallery_title">
							         </div>
							    </div>
							    <div class="gallery-form__category">
							    	<div class="input-container">
							    		<label for="gallery_category">Category</label>
							            <select class="select" name="gallery[cat]" id="gallery_category">
							               <?php
                        $gallery_cat = 'category_gallery';
                        $gallery_cats = get_terms( $gallery_cat, 'orderby=count&hide_empty=0');

                       if($gallery_cats):
                           $selected = '';
                               foreach ($gallery_cats as $cat) {
                                  if($cat->term_id == $gallery_cat_out){
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
							    </div>
							    <div class="clear"></div>
							    <div class="input-container">
						    		<label for="gallery_description">Description</label>
						    		<textarea class="field field--full field--text" cols="0" rows="0" name="ga[des]" id="gallery_description"></textarea>
						    	</div>
						    	<div class="input-container">
							      <label required="required" for="gallery_tags">Tags <b>*</b></label>
							      <input class="field" type="text" name="ga[tags]" id="gallery_tags">
							      <div class="input-container__note">Tags should be separated by a single space. Min 3 tags.</div>
							   </div>
				     	 	</div>
				     	 	<h4>Uploaded images</h4>
				     	 	<div class="files" id="fileGallery"></div>
				     	 	 <div class="u-text-right">
				     	 	 <?php  wp_nonce_field('post_ga_action','post_ga'); ?>
						      <p><button name="button" type="submit" class="button button--longer">Save </button> <a class="button button--dark" id="" href="/profile/gallery">Cancel</a></p>
						      <p>By submitting this form, you indicate that you have read and agree to the <a id="" href="https://www.cgtrader.com/pages/gallery-rules">gallery rules</a>. </p>
						   </div>
				     	 </div>
				         
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
