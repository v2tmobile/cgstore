<?php
/* Template Name: Post Gallery Page */
/**
 * @package Shopping_Mall
 */
              $gallery_id = ($_GET['pid']) ? $_GET['pid'] : '';
              $gallery_cat_out = 0;
              $gallery_title ='';
              $gallery_des ='';
              $gallery_cat  = 0;
              $gallery_tags = '';
              $errors = array();
              $html_ms = '';
              $tags = [];
              $gallery_ob = '';
              if(!is_user_logged_in()){
                wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));exit();
              }
        if($gallery_id){
          $gallery_ob  = get_post($gallery_id);
          if($gallery_ob){
           if( !is_user_logged_in() && $gallery_ob->post_author != get_current_user_id())
              {
                 wp_redirect(HOME_URL.'/gallery/');exit();
              }
             
            $gallery_title =  $gallery_ob->post_title;
            $gallery_des   =  $gallery_ob->post_content;
            $attachments = get_posts( array(
			        'post_type'         => 'attachment',
			        'posts_per_page'    => -1,
			        'post_parent'       => $gallery_id,
			        'exclude'           =>'',
			    
			      ) );
            
            if($attachments){
              foreach ($attachments as $attachment) {
	            $thumb_src  = wp_get_attachment_image_src($attachment->ID,array(250,250));
	            $thumb_src = isset($thumb_src) ? $thumb_src[0] : '';
                $thumb .= '<div class="MultiFile-label"><a class="MultiFile-remove" href="#fileUploadTutorial"><i class="fa fa-times fa-24 fa-pull-right"></i><span class="remove-string" data-id="'.$attachment->ID.'">x</span></a><span><span class="MultiFile-label" title=""><span class="MultiFile-title"></span><img class="MultiFile-preview"  style="max-height:100px; max-width:100px;" src="'.$thumb_src.'"></span></span></div>';
              }
          }

            $gallery_cat = get_the_terms($gallery_id,'category_gallery');
            $gallery_cat_out = isset($gallery_cat) ? $gallery_cat[0]->term_id : 0;
            $gallery_tag = get_the_terms($gallery_id,'gallery_tag');
            if($gallery_tag){
                  foreach ($gallery_tag as $tag) {
                     $tags[] = $tag->name;
                  }
               }
            }
         }

         if( wp_verify_nonce($_POST['post_gallery'],'post_gallery_action') && isset($_POST['Pgallery'])){
                 $ga = isset($_POST['Pgallery']) ? $_POST['Pgallery'] :'';
                if($ga){
                   $gallery_title = isset($ga['title']) ? trim($ga['title']) :'';
                   $gallery_des = isset($ga['des']) ? wp_strip_all_tags($ga['des']) :'';  
                   $gallery_cat = isset($ga['cat']) ? $ga['cat'] :0;
                   $gallery_tags = isset($ga['tags']) ? $ga['tags'] :'';
                  if(!$gallery_title) $errors[] ='Please input title';
                  if(!$gallery_des) $errors[] ='Please input description';
                  if(!$gallery_cat) $errors[] ='Please choose category';
                  if(!$gallery_tags) $errors[] ='Please input tag';
                  
                  if($errors && count($errors)>0){
          				$html_ms .='<ul class="error">';
                 foreach ($errors as $error) {
                     	$html_ms .='<li>'.$error.'</li>';
                 } 
           		  $html_ms .='</ul>';
         		}else{
         			$gallery_ob = array(
                       'post_title'=>$gallery_title,
                       'post_content'=>$gallery_des,
                       'post_status'=>'publish',
                       'post_type'=>'gallery',
                       'post_author'=>get_current_user_id(),
                     
                    );
                   if(!$gallery_id){
                      $gallery_id = wp_insert_post($gallery_ob);
                    }else{
                    	 $gallery_ob['ID'] = $gallery_id;
                    	 unset($gallery_ob['post_type'],$gallery_ob['post_author'],$gallery_ob['post_status']);
                         $gallery_id = wp_update_post($gallery_ob);
                         if(isset($ga['attachmentIds'])){
                         	$attachmentids = json_decode($ga['attachmentIds'],true);
                         	if($attachmentids && is_array($attachmentids)){
                         		foreach ($attachmentids as $attachmentID) {
                         			wp_delete_attachment($attachmentID);
                         		}
                         	}
                         }
                     }

                     if($gallery_id){
			             wp_set_post_terms( $gallery_id, array($gallery_cat), 'category_gallery'); 
			             wp_set_post_terms( $gallery_id, $gallery_tags, 'gallery_tag' ); 

                    }
                    
                    if($_FILES['files'] && $gallery_id){
                	   include_once('inc/upload-file.php');
                	   $upload = cgstore_upload_multi_image($gallery_id,$_FILES['files']);
                       if(!$upload){
                	         wp_redirect(get_permalink($gallery_id));
                     	}else{
                     	   $html_ms .='<ul class="error">';
                     		foreach ($upload as $er) {
                     		 $html_ms .='<li>'.$er.'<li>';
                     		}
                     		$html_ms = '</ul>';
                     	}
                	}
                    

         		}
 

               }
               
             }
            
get_header(); ?>

<div class="galleries-page site-page--profile-gallery-form">
	<div class="content-area">
		<div class="breadcrumb-wrapper" id="breadcrumb">
			<?php 
                    $args = array(
							'delimiter' => '/',
								'before' => '<span class="breadcrumb-title">' . __( '', 'woothemes' ) . '</span>'
					);
					echo woocommerce_breadcrumb($args);
				?>
		</div>

		<div class="content-heading">
		   <h2 class="content-heading__title">Create New Project</h2>
		   <p class="content-heading__subtitle">Use the publishing form down below to upload a new project. Your work will appear in CGTrader's <a id="" href="<?php echo HOME_URL?>/gallery/">gallery</a> among other top notch 3D designs! Note that this <b>IS NOT</b> the place to upload your saleable 3D models </p>
		</div>

		<div class="box gallery-form">
		   <?php echo $html_ms; ?>
			<div class="l-inner">
	<form id="gallery-form" class="new_gallery" action="" method="post" enctype="multipart/form-data">
		<div class="gallery-form__upload">
			<div class="upload-dropzone">
					 <label class="jobs-form__label">Drag files here to upload</label>
					         <div class="button-upload"><span>Select files... </span>
					         	<input class="file-upload--jobs with-preview" id="fileUploadGallery" name="files[]" type="file">
					     	 </div>
				     	 </div>
				     	 <div class="" id="gallery-form-container" <?php echo ($gallery_ob) ? 'style="display:block;"' :''; ?>>
				     	 	<div class="gallery-form__main-info">
				     	 		<div class="gallery-form__title">
							         <div class="input-container">
								         <label required="required" for="gallery_title">Title <b>*</b></label>
								         <input class="field" type="text" name="Pgallery[title]" id="gallery_title" value="<?php echo $gallery_title; ?>">
							         </div>
							    </div>
							    <div class="gallery-form__category">
							    	<div class="input-container">
							    		<label for="gallery_category">Category</label>
							            <select class="select" name="Pgallery[cat]" id="gallery_category">
							               <?php
                        $gallery_cat = 'category_gallery';
                        $gallery_cats = get_terms( $gallery_cat, 'orderby=count&hide_empty=0');

                       if($gallery_cats):
                           $selected = '';
                               foreach ($gallery_cats as $cat) {
                                  if($cat->term_id == ($gallery_cat) ? $gallery_cat : $gallery_cat_out){
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
						    		<textarea class="field field--full field--text" cols="0" rows="0" name="Pgallery[des]" id="gallery_description"><?php echo $gallery_des; ?></textarea>
						    	</div>
						    	<div class="input-container">
							      <label required="required" for="gallery_tags">Tags <b>*</b></label>
							      <input class="field" type="text" name="Pgallery[tags]" id="gallery_tags" value="<?php echo ($gallery_tags) ? $gallery_tags : implode(',',$tags) ; ?>">
							      <div class="input-container__note">Tags should be separated by a single space. Min 3 tags.</div>
							   </div>
				     	 	</div>
				     	 	<h4>Uploaded images</h4>
				     	 	<div class="files" id="fileGallery"><?php echo $thumb; ?></div>
				     	 	<?php
                               if($gallery_ob){
                               	echo '<input id="attachmentids" type="hidden" name="Pgallery[attachmentIds]" value="">';
                               }
				     	 	 ?>
				     	 	 <div class="u-text-right">
				     	 	 <?php  wp_nonce_field('post_gallery_action','post_gallery'); ?>
						      <p><button name="button" type="submit" class="button button--longer">Save </button> <a class="button button--dark" id="" href="<?php echo HOME_URL; ?>/gallery/">Cancel</a></p>
						      <p>By submitting this form, you indicate that you have read and agree to the <a id="" href="<?php echo HOME_URL; ?>/gallery-rules">gallery rules</a>. </p>
						   </div>
				     	 </div>
				         
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
