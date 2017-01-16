<?php
/* Template Name: Gallery New Page */
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
			<div class="l-inner">
				<form id="gallery-form" class="new_gallery" action="" accept-charset="UTF-8" data-remote="true" method="post">
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
								         <input class="field" type="text" name="gallery[title]" id="gallery_title">
							         </div>
							    </div>
							    <div class="gallery-form__category">
							    	<div class="input-container">
							    		<label for="gallery_category">Category</label>
							            <select class="select" name="gallery[category]" id="gallery_category">
							               <option value="3">Scene</option>
							               <option value="4">Abstract</option>
							               <option value="5">Architecture</option>
							               <option value="6">Car</option>
							               <option value="7">Character</option>
							               <option value="8">Creature</option>
							               <option value="9">Fantasy</option>
							               <option value="10">Interior</option>
							               <option value="11">Industrial Design</option>
							               <option value="12">Landscape</option>
							               <option value="13">Realism</option>
							               <option value="14">Sci-Fi</option>
							               <option value="15">Surrealism</option>
							               <option value="16">Vehicle</option>
							               <option value="17">Electronics</option>
							            </select>
							    	</div>
							    </div>
							    <div class="clear"></div>
							    <div class="input-container">
						    		<label for="gallery_description">Description</label>
						    		<textarea class="field field--full field--text" cols="0" rows="0" name="gallery[description]" id="gallery_description"></textarea>
						    	</div>
						    	<div class="input-container">
							      <label required="required" for="gallery_tags">Tags <b>*</b></label>
							      <input class="field" type="text" name="gallery[tags]" id="gallery_tags">
							      <div class="input-container__note">Tags should be separated by a single space. Min 3 tags.</div>
							   </div>
				     	 	</div>
				     	 	<h4>Uploaded images</h4>
				     	 	<div class="files" id="fileGallery"></div>
				     	 	 <div class="u-text-right">
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
