<?php
/**
 * The template for displaying the Product edit form  
 *
 * Override this template by copying it to yourtheme/wc-vendors/dashboard/
 *
 * @package    WCVendors_Pro
 * @version    1.3.2
 */
/**
 *   DO NOT EDIT ANY OF THE LINES BELOW UNLESS YOU KNOW WHAT YOU'RE DOING 
 *   
*/

$title = 	( is_numeric( $object_id ) ) ? __('Save Changes', 'wcvendors-pro') : __('Add Product', 'wcvendors-pro'); 
$product = 	( is_numeric( $object_id ) ) ? wc_get_product( $object_id ) : null;

// Get basic information for the product 
$product_title     			= ( isset($product) && null !== $product ) ? $product->post->post_title    : ''; 
$product_description        = ( isset($product) && null !== $product ) ? $product->post->post_content  : ''; 
$product_short_description  = ( isset($product) && null !== $product ) ? $product->post->post_excerpt  : ''; 
$post_status				= ( isset($product) && null !== $product ) ? $product->post->post_status   : ''; 
 $prefix ='_shopping_mall_';

/**
 *  Ok, You can edit the template below but be careful!
*/
?>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_PATH;?>/css/all.css">
<style type="text/css">
html{ 
    background: #f7f6f3 ;
}
</style>
<form method="post" action="" id="wcv-product-edit" class="wcv-form wcv-formvalidator"> 
	<div class="site-page--product-publisher">
	  <div class="publisher-container">
	      <div class="printable-new">
	          <div class="action-bar is-positioned js-sticky" style="position: fixed; top: 0px;">
	              <div class="container" data-easytabs="true">
	                  <ul class="publishing-steps u-float-left">
	                    <li class="js-publishing-step-btn js-publishing-step-first is-active">
	                      <a href="#step-presentation" class="is-active">
	                        Files &amp; Previews
	                        <span>Upload files and images</span>
	                      </a>
	                    </li>
	                    <li class="js-publishing-step-btn js-publishing-step-second">
	                      <a href="#step-details">
	                        Details
	                        <span>Product details and information</span>
	                      </a>
	                    </li>
	                  </ul>

	                  <div class="u-float-right btn-control-product">
							
	                          <button class="button button--transparent button--compact js-preview js-action">
	                            <i class="fa fa-eye fa-24"></i>
	                            <?php WCVendors_Pro_Product_Form::draft_button( __('Save Draft','wcvendors-pro') ); ?>
	                          </button>

	                          <div class="inlineblock btn-box">
	                            <i class="fa fa-rocket fa-lg"></i>
	                            <?php WCVendors_Pro_Product_Form::save_button( $title ); ?>
	                          </div>
	                  </div>
	              </div>
	          </div>
	          <div class="uploads-tab is-active" id="step-presentation">
	               
	            	<div class="wcv-product-media">
						<?php //do_action( 'wcv_before_media', $object_id ); ?>
							<?php //WCVendors_Pro_Form_helper::product_media_uploader( $object_id ); ?>
						<?php //do_action( 'wcv_after_media', $object_id ); ?>
						<div id="drag-and-drop-zone" class="upload-area">
				            <div id="filedrag">
			                      <div class="upload-area__text">
			                          Drag &amp; Drop
			                          <span>model files and images or <b>browse files</b></span>
			                      </div>
			                  </div>
				            <div class="browser">
				              <label>
				                <input type="file" name="files[]" multiple="multiple">
				              </label>
				            </div>
	          			</div>
	          			<div class="error-upload-file"></div>
	          			<div class="upload-progress">
	          				
	          			</div>
	          			<div class="input-container files-count-label">
						    <label class="error">Please upload at least one file format of your 3D model.</label>
						</div>
						<?php
						   $download = ''; 
						  if( isset($product) && null !== $product ){
               			     $downloads= $product->get_files();
               			  }
         
       					?>
						<div class="files-panel" <?php echo ($downloads) ? 'style="display: block;"' : ''; ?> >
							<h2 class="heading heading--compact heading--files">Files</h2>
						
							<div class="files" id="file-display" file-counter>
						<?php
                             if($downloads){
						            
						             foreach ($downloads as $download) {
						             	  
						                 echo '<div class="file__info" id="file-'.$download['id'].'"> Uploaded file: <span class="file__filename">'.$download['name'].'</span><a href="javascript:;" onclick="$.danidemo.removeFile('.$download['id'].')" class="file__remove remove-file js-remove-file"><i class="fa fa-trash fa-24"></i>Remove</a><input type="hidden" name="_wc_file_names[]" value="'.$download['name'].'"><input type="hidden" name="_wc_file_ids[]" value="'.$download['id'].'"><input type="hidden" name="_wc_file_urls[]" value="'.$download['file'].'"></div>';
						             }

						             
         						}
								 ?>
							</div>
						</div>
						<div class="input-container images-count-label">
						    <label class="error">Please upload at least one preview image.</label>
						</div>
	          			<div class="visuals-panel" style="display:block;">
				          <div class="panel panel-default">
				            <div class="panel-heading">
				              <h2 class="heading heading--compact">Previews</h2>
				              <p class="explanation">Product images and embedded previews (videos, 3D viewers, etc).</p>
				            </div>
				    <?php
				       $attachment_ids = [];
				        if( isset($product) && null !== $product ){
                          $attachment_ids = $product->get_gallery_attachment_ids();
                       }

					 ?>
				            <ul class="visuals" id='demo-files' file-counter="<?php echo ($attachment_ids) ? count($attachment_ids) : 0; ?>">
				              	<?php 
                   			if ( sizeof( $attachment_ids ) > 0 ) {   	
					          foreach( $attachment_ids as $attachment_id ) {
                                      
                                  echo '<li class="sortable__item" id="gallery-'.$attachment_id.'">
                                       '.wp_get_attachment_image( $attachment_id, array(150,150)).'<span onclick="$.danidemo.removeImage('.$attachment_id.')" class="sortable__item-remove has-tooltip tooltipstered"><i class="fa fa-times fa-12 fa-not-spaced"></i></span></li>'; 
					                 }
				                  }
				              	?>
				              
				            </ul>
				          </div>
				        </div>
					</div>
					
					<input type="hidden" id="product_image_gallery" name="product_image_gallery" value="<?php echo ( ( sizeof( $attachment_ids ) > 0 ) ? '['.($product->product_image_gallery).']' : '' ); ?>">
					<input type="hidden" name="_downloadable" value="1">
					
	          </div>
	          <div class="uploads-tab details-tab" id="step-details">
	              <div class="sectioned-content">
	              	<!-- Basic Product Details -->
						<div class="wcv-product-basic wcv-product"> 
							<!-- Product Title -->
							<?php WCVendors_Pro_Product_Form::title( $object_id, $product_title ); ?>
				
					<?php
                        $cat = isset($_GET['cat']) ? $_GET['cat'] : 0;
                        $catID = 25;
                        if($cat) {
                        	$catID = 24;  
                         ?>
                         <div class="input-container">
	                         <ul class="product-cat-list">
	                         	<li><input type="checkbox" name="animated" id="ckanimated"><label for="ckanimated">Animated</label></li>
	                         	<li><input type="checkbox" name="low_poly" id="cklow_poly"><label for="cklow_poly"> Low-poly (game-ready)</label></li>
	                         	<li><input type="checkbox" name="textures" id="cktextures"><label for="cktextures">Textures</label></li>
	                         	<li><input type="checkbox" name="materials" id="ckmaterials"><label for="ckmaterials">Materials</label></li>
	                         	<li><input type="checkbox" name="rigged" id="ckrigged"><label for="ckrigged">Rigged</label></li>
	                         	<li><input type="checkbox" name="plugins_used" id="ckplugins_used"><label for="ckplugins_used">Plugins used</label></li>
	                         	<li><input type="checkbox" name="collection" id="cklow_poly"><label for="cklow_poly">Collection</label></li>
	                         </ul>
	                     </div>
                         <div class="input-container">
                         	<div class="col-1 uvw-mapping">
                         		<input type="checkbox" name="uvw_mapping"><label>UVW mapping</label>
                         		<div class="pull-right" id="uvw-mapping-block" style="margin-top: -7px;">
	                         		Unwrapped UVs:
	                         		<select name="unwrapped_uvs" id="unwrapped_uvs" class="select">
					                  <option value="unknown">Unknown</option>
					                  <option value="non_overlapping">Non-overlapping</option>
					                  <option value="overlapping">Overlapping</option>
					                  <option value="mixed">Mixed</option>
					                  <option value="no">No</option>
	              					</select>
	                         	</div>
                         	</div>
                         </div>
                         <div class="input-container">
                         	<div class="geometry-type">
                         		Geometry:
                         		<select name="geometry" id="geometry_type">
					                <option>Choose geometry</option>
					                <option value="polygon_mesh">Polygon mesh</option>
					                <option value="subdivision_ready">Subdivision-ready</option>
					                <option value="nurbs">Nurbs</option>
					                <option value="other">Other</option>
           					 </select>
                         	</div>
                         	<div class="geometry-values">
                         		<img class="icon" src="<?php echo TEMPLATE_PATH; ?>/images/polygon.png" alt="Polygon">
                         		<input type="text" name="polygons" placeholder="polygons" class="field" number="true" min="0">
                         		
                         	</div>
                         	<div class="geometry-values is-last">
                         		<img class="icon" src="<?php echo TEMPLATE_PATH; ?>/images/vertices.png" alt="Polygon">
                         		<input type="text" name="vertices" placeholder="vertices" class="field" number="true" min="0">
                         	</div>
                         	<div class="clear"></div>
                         </div>
                         <?php 
                          
                        }
					 ?>

							<!-- Product Categories -->
							<div class="category-block">
								<div class="u-float-left u-left-category js-help-trigger wcv-product-basic wcv-product" data-target="#help-category">
					
		             <?php WCVendors_Pro_Product_Form::categories( $object_id, true ,$catID); ?>
								</div>
								<div class="chosen-container">
									<select id="product_cat_sub" name="product_cat[]">
									  <?php
									   if( isset($product) && null !== $product ){

                                         // $sub_cats = get_terms($tax,array(
									           //'hide_empty'=>0,
									          // 'parent'=>$catID
									        //));
                                              
                                       }
									   ?>
										<option>Choose sub category</option>
									</select>
								</div>
                           <?php if(!$cat){ ?>
							    <div class="units-container u-float-right js-help-trigger" data-target="#help-units">
			                         <label for="units" class="inline-label" data-position="inline">Units </label>
			                         <div class="category-container" id="unit_select_container">
			                            <select name="units" id="units" data-placeholder="Choose units" required="required">
			                            <?php
			                              
                                        $units = ( isset($product) && null !== $product ) ? get_field($prefix.'units',$object_id) : '';
                                        $ar_units = array(
                                              'mm'=>'millimeters (mm)',
                                              'cm'=>'centimeters (cm)',
                                              'in'=>'inches (in)',
                                              'm'=>'meters (m)'
                                          	);
                                          $checked = '';
                                           foreach ($ar_units as $key => $value) {
                                           	 if($units == $key) $checked ="checked='checked'"; else $checked ='';

                                           	 echo '<option '.$checked.' value="'.$key.'">'.$value.'</option>';
                                           }

			                             ?>
			                               
			                            </select>
			                         </div>
			                      </div>
			                   <?php } ?>
			                      <div class="clear"></div>
							</div>
						    <!--<div class="product-type-select wcv-product-type">
						    	<?php //WCVendors_Pro_Product_Form::product_type( $object_id ); ?>
						    </div>-->
							<!-- Product Description -->
							<?php WCVendors_Pro_Product_Form::description( $object_id, $product_description );  ?>
							<!-- Product Short Description -->
							<?php //WCVendors_Pro_Product_Form::short_description( $object_id, $product_short_description );  ?>
							
						    <!-- Product Tags -->
						    <div class="tag-block js-help-trigger" data-target="#help-tags">
						    	<?php WCVendors_Pro_Product_Form::tags( $object_id, true ); ?>
						    </div>
						    
						</div>

						<div class="wcv-tabs top wcv-tabs-upload" data-prevent-url-change="true">

							<?php //WCVendors_Pro_Product_Form::product_meta_tabs( ); ?>

							<?php //do_action( 'wcv_before_general_tab', $object_id ); ?>
					
							<!-- General Product Options -->
							<div class="wcv-product-general tabs-content" id="general">
							
								<div class="options_group show_if_external">
									<?php WCVendors_Pro_Product_Form::external_url( $object_id ); ?>
									<?php WCVendors_Pro_Product_Form::button_text( $object_id ); ?>
								</div>

								<div class="show_if_simple show_if_external price-block-js js-help-trigger" style="display:block !important;">
									<!-- Price and Sale Price -->
									<?php WCVendors_Pro_Product_Form::prices( $object_id ); ?>
								</div>
								<div class="shareforfree">
									<label for="share-for-free"><input id="share-for-free" type="checkbox" name="_sale_price" value="0">Share for free</label>
								</div>
								<div class="Clear"></div>
							</div>

							<?php WCVendors_Pro_Product_Form::form_data( $object_id, $post_status ); ?>
						
							</div>

	                  <h2 class="heading">Challenges</h2>
	                  <p class="challenges-explanation">If you have a right model for the challenge, simply check the box and you are
	  in.</p>
	  				
	    <?php if($cat){
                $challenges = get_posts('post_type=challenge&posts_per_page=-1');
                if($challenges){
                	echo '<div class="input-container ul-challenge"><ul>';
                	foreach ($challenges as $challenge) {
                		echo '<li><input type="checkbox" value="'.$challenge->ID.'" name="challenges[]"><label>'.$challenge->post_title.'</label><div class="pull-right" style="position: relative;top:-2px;text-decoration: underline;"><a href="'.get_permalink($challenge->ID).'">details</a></div></li>';
                	}
                   echo '</ul></div>';
                }

	    	} ?>
	    
	                  <div class="input-container">
	                    <div class="challenges-list"></div>
	                  </div>
	                  <h2 class="heading">Licensing &amp; Legal Information</h2>

	                  <div class="input-container">
	                     <label for="license" class="inline-label">License <b>*</b></label>
	                     <div class="license-options">
	                        <label for="license_general" class="inline-label">
	                           <div class="radio is-checked"><input type="radio" name="license" value="general" id="license_general" checked></div>
	                           General
	                        </label>
	                        <label for="license_editorial" class="inline-label">
	                           <div class="radio"><input type="radio" name="license" value="editorial" id="license_editorial"></div>
	                           Editorial
	                        </label>
	                        <label for="license_custom" class="inline-label">
	                           <div class="radio"><input type="radio" name="license" value="custom" id="license_custom"></div>
	                           Custom
	                        </label>
	                     </div>
	                     <div class="custom-license-container" style="display: none;">
	                        <textarea name="custom_license" class="field field--text"></textarea>
	                     </div>
	                  </div>

	                  <div class="input-container is-last">
	                     <label for="adult_content" class="">
	                        <div class="checkbox"><input type="checkbox" name="adult_content" value="1" id="adult_content" ></div>
	                        This item contains violence, nudity or sexual content
	                     </label>
	                     <p class="sensitive-content-explanation">All models with nudity or violent content will be reviewed by CGTrader
	                        team prior to publishing. CGTrader uses RSACi standards to evaluate content. Level 0 content is available to
	                        everyone, Level 1-3 content is placed under age lock while Level 4 content is not approved on the
	                        marketplace.
	                     </p>
	                  </div>

	              </div>

	              <div class="help-section">
	                <div class="help-bubble is-left help-bubble--product-title" id="help-title" style="display: block; top: 75px;">
	                  <h4 class="help-bubble__title">Product title</h4>

	                  <div class="help-bubble__content">
	                    <p>
	                      Title is the most important information for all search engines to find your model. Write 4-6 words that are
	                      relevant, specific and clearly represent your model.
	                    </p>

	                    <p>
	                      Write a few relevant and specific words that target your model, and a few category words which will generalize
	                      it. Also add certain characteristics which clearly distinguish it from the group it belongs to. Try always think
	                      how well the title characterize your model to a customer who might be looking for something like it.
	                    </p>

	                    <p>
	                      Examples:
	                      <br> * Wooden country villa house
	                      <br> * Ford Mondeo Sedan 2015
	                      <br> * V4 cylinder combustion car engine
	                      <br> * Modern commercial office skyscraper building
	                    </p>
	                  </div>
	                </div>
	                <div class="help-bubble is-left help-bubble--product-category" id="help-category" style="top: 136px; display: none;">
	                  <h4 class="help-bubble__title">Category</h4>

	                  <div class="help-bubble__content">
	                    <p>Choose the category which best fits your product. If it is difficult to put the product under one specific
	                      category, try to think of the category in which consumers are most likely to browse such products.</p>
	                  </div>
	                </div>
	                <div class="help-bubble is-left help-bubble--product-units" id="help-units" style="top: 136px; display: none;">
	                  <h4 class="help-bubble__title">Units of measure</h4>

	                  <div class="help-bubble__content">
	                    <p>Since not all 3D file formats contain information about units, it is necessary to define them here.</p>

	                    <p>Choose units which represent 3D object dimensions.</p>
	                  </div>
	                </div>
	                <div class="help-bubble is-left help-bubble--product-description" id="help-description" style="display: none; top: 306px;">
	                  <h4 class="help-bubble__title">Description</h4>

	                  <div class="help-bubble__content">
	                    <p>
	                      Products with a description of 50-100 word on average have 3 times more sales than models without the
	                      description. Write proper description with relevant technical information about the model and scene to drive
	                      more traffic and customers from Google. Products with short descriptions get much less pageviews and sales. Also
	                      rich description increase buyers' confidence to purchase your model. Check other models in the marketplace to
	                      get ideas for good descriptions.
	                    </p>
	                  </div>
	                </div>
	                <div class="help-bubble is-left help-bubble--product-tags" id="help-tags" style="display: none;top:470px;">
	                  <h4 class="help-bubble__title">Tags</h4>

	                  <div class="help-bubble__content">
	                    <p>
	                      Tags help the customers discover your products. We highly recommend to write at least 10-15 tags that best
	                      define your product. Products with 20 tags on average have 2 times more sales than those with only 5 tags.
	                    </p>

	                    <p>
	                      Write specific words that target your model, broad words which will generalize it and qualities or
	                      characteristics (like color, material, condition, etc). However, avoid adding unrelated tags that have little to
	                      do with the given product. Use tag suggestions that will help you identify related tags.
	                    </p>
	                  </div>
	                </div>
	                <div class="help-bubble is-left help-bubble--product-price" id="help-price" style="display: none;top: 610px; ">
	                  <h4 class="help-bubble__title">Product price</h4>
	                  <div class="help-bubble__content">
	                    <p>Choose this option if you would like to sell or share 3D model source files. Note that people will be able to purchase and download 3D source files for the price that you specify.</p>
	                  </div>
	                </div>
	              </div>

	          </div>

	          <div class="action-bar is-positioned js-sticky" style="position: fixed; bottom: 0px;">
	              <div class="container" data-easytabs="true">
	                  <ul class="publishing-steps u-float-left">
	                    <li class="js-publishing-step-btn js-publishing-step-first is-active">
	                      <a href="#step-presentation" class="is-active">
	                        Files &amp; Previews
	                        <span>Upload files and images</span>
	                      </a>
	                    </li>
	                    <li class="js-publishing-step-btn js-publishing-step-second">
	                      <a href="#step-details">
	                        Details
	                        <span>Product details and information</span>
	                      </a>
	                    </li>
	                  </ul>

	                  <div class="u-float-right btn-control-product">
							
	                          <button class="button button--transparent button--compact js-preview js-action">
	                            <i class="fa fa-eye fa-24"></i>
	                            <?php WCVendors_Pro_Product_Form::draft_button( __('Save Draft','wcvendors-pro') ); ?>
	                          </button>

	                          <div class="inlineblock btn-box">
	                            <i class="fa fa-rocket fa-lg"></i>
	                            <?php WCVendors_Pro_Product_Form::save_button( $title ); ?>
	                          </div>
	                  </div>
	              </div>
	          </div>
	  </div>
	</div>
</form>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/product-preview.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/dmuploader.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/class.popup.js"></script>
<script type="text/javascript">

 jQuery(document).ready(function($){


   /*$("#wcv-product-edit").validate({
		onkeyup: false,
        errorClass: "error",

        //put error message behind each form element
        errorPlacement: function (error, element) {
            var elem = $(element);
            error.insertAfter(element);
        },

        //When there is an error normally you just add the class to the element.
        // But in the case of select2s you must add it to a UL to make it visible.
        // The select element, which would otherwise get the class, is hidden from
        // view.
        highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
            } else {
                elem.addClass(errorClass);
            }
        },

        //When removing make the same adjustments as when adding
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            } else {
                elem.removeClass(errorClass);
            }
        }
	});*/
   $('select.select2').on("change", function(e) {
   	  var catid = $(this).val();
   	  if(catid && catid !== 'undefined'){
       $.ajax({
             type: "POST",
             url: CGSTORE_VARS.AJAX_URL,
             data:{
               action:'cgs-load-sub-cat',
               catID:catid
             },
             dataType: 'json',
            beforeSend:function(){
                
            },
             success: function(res)
            {
                if(res.success === true){
                    $('#product_cat_sub').html(res.data);
                 }else{
                   alert('Error. Please try again!');
                 }
              }
           });
          return false;
        
   	  }
   });

 });	


var attachment_id = [];
  $('#drag-and-drop-zone').dmUploader({
        url:CGSTORE_VARS.AJAX_URL,
        extraData:{
          action:'cgs-upload-file',
        },
        dataType: 'json',
        allowedTypes: '*',
        onInit: function(){
          $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
        },
        onBeforeUpload: function(id){
          $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);

          $.danidemo.updateFileStatus(id, 'default', 'Uploading...');
        },
        onNewFile: function(id, file){
          $.danidemo.addProgressBar();
          //$('.upload-progress div.progress ').show();
          /*** Begins Image preview loader ***/
          /*if (typeof FileReader !== "undefined"){
            
            var reader = new FileReader();

            // Last image added
            var img = $('#demo-files').find('.demo-image-preview').eq(0);

            reader.onload = function (e) {
              img.attr('src', e.target.result);
            }

            reader.readAsDataURL(file);

          } else {
            // Hide/Remove all Images if FileReader isn't supported
            $('#demo-files').find('.demo-image-preview').remove();
          }*/
          /*** Ends Image preview loader ***/

        },
        onComplete: function(){
          $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
         
        },
        onUploadProgress: function(id, percent){
          var percentStr = percent + '%';
          $.danidemo.updateFileProgress(id, percentStr);
        },
        onUploadSuccess: function(id, data){
          //$.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');
         // $.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
          $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
          $.danidemo.updateFileProgress(id, '100%');
          if(data.status){
          if(data.data.type =='image'){
          	$('.images-count-label').hide();
          	 $('.visuals-panel').show();
          	 
          	  $.danidemo.addImageFile('#demo-files', id, data);
          	  var gallery = $('#product_image_gallery').val();
          	  if(gallery == ''){
          	  	gallery = [];
          	  }else{
          	  	gallery = JSON.parse(gallery);
          	  }
          	  console.log(gallery);
	      	 	gallery.push(data.data.attachmentID);
	      	 	$('#product_image_gallery').val(JSON.stringify(gallery));

          }else{
          	 // add file
          	 $('.files-panel').show();
          	 $('.files-count-label').hide();
			
            $.danidemo.addFile('#file-display', id, data); 
           }
         }else{
         	$('.error-upload-file').html(data.msg);
         }
        },
        onUploadError: function(id, message){
          $.danidemo.updateFileStatus(id, 'error', message);

          $.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
        },
        onFileTypeError: function(file){
          $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
        },
        onFileSizeError: function(file){
          $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
        },
        onFallbackMode: function(message){
          $.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
        }
      });


</script>
<style type="text/css">
.uploader
{
	border: 2px dotted #A5A5C7;
	width: 100%;
	color: #92AAB0;
	text-align: center;
	vertical-align: middle;
	padding: 30px 0px;
	margin-bottom: 10px;
	font-size: 200%;

	cursor: default;

	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

.uploader div.or {
	font-size: 50%;
	font-weight: bold;
	color: #C0C0C0;
	padding: 10px;
}

.uploader div.browser label {
	background-color: #5a7bc2;
	padding: 5px 15px;
	color: white;
	padding: 6px 0px;
	font-size: 40%;
	font-weight: bold;
	cursor: pointer;
	border-radius: 2px;
	position: relative;
	overflow: hidden;
	display: block;
	width: 300px;
	margin: 20px auto 0px auto;

	box-shadow: 2px 2px 2px #888888;
}

.uploader div.browser span {
	cursor: pointer;
}


.uploader div.browser input {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	border: solid transparent;
	border-width: 0 0 100px 200px;
	opacity: .0;
	filter: alpha(opacity= 0);
	-o-transform: translate(250px,-50px) scale(1);
	-moz-transform: translate(-300px,0) scale(4);
	direction: ltr;
	cursor: pointer;
}

.uploader div.browser label:hover {
	background-color: #427fed;
}

</style>