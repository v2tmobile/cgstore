<?php
/* Template Name: Post Tutorial Page */
/**
 * @package Shopping_Mall
 */
?>   
<?php get_header();?>
<div class="jobs-page site-page--tutorial-form">
	<div class="content-area">
	   <form method="post" action="" enctype="multipart/form-data" id="form-post-tutorial">
		    <div class="tutorial-form__content">
            <h1 class="tutorial-form__title">Post your Tutorial</h1>
             <div class="tutorial-form__block--left headline">
                <div class="input-container">
                  <label class="tutorial-form__label">Tutorial</label>
                  <input placeholder="How to make a 3D car model" class="field" type="text" name="tutorial[title]" id="tutorial_title">
                </div>
                <div class="input-container">
                  <label class="tutorial-form__label">Description</label>
                  <textarea class="field field--colored field--text tutorial-form__description" placeholder="We will build a beautiful car model" name="tutorial[description]" id="tutorial_description"></textarea>
                </div>
                <div class="input-container">
                  <label class="tutorial-form__label">Tags</label>
                  <input type="text" name="tags" required="required" class="field" id="tags">
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
                    <select multiple="multiple" name="tutorial[categories][]" class="tutorial_multi_select" id="tutorial_categories">
                       <option value="3D Animation">3D Animation</option>
                       <option value="3D Modeling">3D Modeling</option>
                       <option value="Low-poly 3D Modeling">Low-poly 3D Modeling</option>
                       <option value="3D Print Modeling">3D Print Modeling</option>
                       <option value="Game Development">Game Development</option>
                       <option value="Texturing">Texturing</option>
                       <option value="Matte Painting">Matte Painting</option>
                       <option value="Lighting">Lighting</option>
                       <option value="Rendering">Rendering</option>
                       <option value="Rigging">Rigging</option>
                       <option value="Beginner">Beginner</option>
                       <option value="Post-Production">Post-Production</option>
                       <option value="Video">Video</option>
                       <option value="Sculpting">Sculpting</option>
                       <option value="Intermediate">Intermediate</option>
                       <option value="Advanced">Advanced</option>
                    </select>
                </div>
                <div class="input-container">
                    <label class="tutorial-form__label">Software</label>
                    <select multiple="multiple" name="tutorial[software][]" class="tutorial_multi_select" id="tutorial_software" >
                       <option value="3ds Max">3ds Max</option>
                       <option value="Blender">Blender</option>
                       <option value="Cinema 4D">Cinema 4D</option>
                       <option value="Cryengine">Cryengine</option>
                       <option value="Element 3D">Element 3D</option>
                       <option value="Lightwave">Lightwave</option>
                       <option value="Mari">Mari</option>
                       <option value="Marmoset">Marmoset</option>
                       <option value="Maya">Maya</option>
                       <option value="Modo">Modo</option>
                       <option value="Motion Builder">Motion Builder</option>
                       <option value="Mudbox">Mudbox</option>
                       <option value="Photoshop">Photoshop</option>
                       <option value="Quixel Suite">Quixel Suite</option>
                       <option value="Sketchup">Sketchup</option>
                       <option value="Stringray">Stringray</option>
                       <option value="Substance Designer">Substance Designer</option>
                       <option value="Substance Painter">Substance Painter</option>
                       <option value="Unity 3D">Unity 3D</option>
                       <option value="Unreal Engine">Unreal Engine</option>
                       <option value="ZBrush">ZBrush</option>
                       <option value="After Effects">After Effects</option>
                       <option value="Vue">Vue</option>
                       <option value="AutoCAD">AutoCAD</option>
                       <option value="Inventor">Inventor</option>
                       <option value="Revit">Revit</option>
                       <option value="SolidWorks">SolidWorks</option>
                       <option value="Other">Other</option>
                       <option value="Vray">Vray</option>
                       <option value="Creo Parametric">Creo Parametric</option>
                       <option value="Pro/ENGINEER">Pro/ENGINEER</option>
                    </select>
                </div>
                <div class="primary-image-form__upload">
                  <label class="tutorial-form__label">Preview image</label>
                  <div class="upload-area">
                        <form id="upload" action="index.html" method="POST" enctype="multipart/form-data">
                          <input type="file" class="with-preview" id="fileUploadTutorial" name="fileselect[]" />
                          <div id="filedrag">
                              <div class="upload-area__text">
                                  Drag &amp; Drop
                                  <span>Browse Files</span>
                              </div>
                          </div>
                        </form>
                        <div id="fileTutorial"></div>
                    </div>
                    <p>Image will be cropped into a square.</p>
                </div>
            </div>
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