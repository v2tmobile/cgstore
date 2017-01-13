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
						<?php do_action( 'wcv_before_media', $object_id ); ?>
							<?php WCVendors_Pro_Form_helper::product_media_uploader( $object_id ); ?>
						<?php do_action( 'wcv_after_media', $object_id ); ?>
					</div>
					<div class="show_if_downloadable" id="files_download">
									<!-- Downloadable files -->
						<?php WCVendors_Pro_Product_Form::download_files( $object_id ); ?>
						<!-- Download Limit -->
						<?php //WCVendors_Pro_Product_Form::download_limit( $object_id ); ?>
						<!-- Download Expiry -->
						<?php //WCVendors_Pro_Product_Form::download_expiry( $object_id ); ?>
						<!-- Download Type -->
						<?php //WCVendors_Pro_Product_Form::download_type( $object_id ); ?>
					</div>
	                <!-- <form id="upload" action="index.html" method="POST" enctype="multipart/form-data">
	                  <input type="file" class="with-preview" id="fileUploadNew" name="fileselect[]" multiple="multiple" />
	                  <div id="filedrag">
	                      <div class="upload-area__text">
	                          Drag &amp; Drop
	                          <span>model files and images or <b>browse files</b></span>
	                      </div>
	                  </div>
	                </form> -->
	          </div>
	          <div class="uploads-tab details-tab" id="step-details">
	              <div class="sectioned-content">
	              	<!-- Basic Product Details -->
						<div class="wcv-product-basic wcv-product"> 
							<!-- Product Title -->
							<?php WCVendors_Pro_Product_Form::title( $object_id, $product_title ); ?>
							<!-- Product Categories -->
							<div class="category-block">
								<div class="u-float-left u-left-category js-help-trigger wcv-product-basic wcv-product" data-target="#help-category">
		             <?php WCVendors_Pro_Product_Form::categories( $object_id, true ,25); ?>
								</div>
								<div class="">
									<select id="product_cat" name="product_cat[]">
										<option>Choose sub category</option>
									</select>
								</div>

							    <div class="units-container u-float-right js-help-trigger" data-target="#help-units">
			                         <label for="units" class="inline-label" data-position="inline">Units </label>
			                         <div class="category-container" id="unit_select_container">
			                            <select name="units" id="units" data-placeholder="Choose units" required="required">
			                               <option value="mm">millimeters (mm)</option>
			                               <option value="cm">centimeters (cm)</option>
			                               <option value="in">inches (in)</option>
			                               <option value="m">meters (m)</option>
			                            </select>
			                         </div>
			                      </div>
			                      <div class="clear"></div>
							</div>
						    <!--<div class="product-type-select wcv-product-type">
						    	<?php //WCVendors_Pro_Product_Form::product_type( $object_id ); ?>
						    </div>-->
							<!-- Product Description -->
							<?php WCVendors_Pro_Product_Form::description( $object_id, $product_description );  ?>
							<!-- Product Short Description -->
							<?php WCVendors_Pro_Product_Form::short_description( $object_id, $product_short_description );  ?>
							
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
								<input type="checkbox" name="_sale_price" value="0"><label>Share for free</label>
							</div>

							<?php WCVendors_Pro_Product_Form::form_data( $object_id, $post_status ); ?>
						
							</div>

	                  <h2 class="heading">Challenges</h2>
	                  <p class="challenges-explanation">If you have a right model for the challenge, simply check the box and you are
	  in.</p>
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

<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/class.popup.js"></script>
<script type="text/javascript">

 jQuery(document).ready(function($){
   
   $('#product-cat-parent').on("change", function(e) {
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
                    $('#product_cat').html(res.data);
                 }else{
                   alert('Error. Please try again!');
                 }
              }
           });
          return false;
        
   	  }
   });

 });	


</script>