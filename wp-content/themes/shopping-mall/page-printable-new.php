<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_PATH;?>/css/all.css">
<style type="text/css">
html{
    background: #f7f6f3 ;
}
</style>
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

                      <div class="u-float-right">
                          <div class="publishing-status" style="display: none;">
                            <span class="icon">
                              <img src="https://assets.cgtrader.com/assets/preloader-2f402224caf664d169e63ee63eb94dc0129fdf7cf2be29f9adeea5f0e39df6bd.gif" alt="Preloader 2f402224caf664d169e63ee63eb94dc0129fdf7cf2be29f9adeea5f0e39df6bd">
                            </span>

                            Updating ..
                          </div>

                              <div class="button-section">
                                <a href="/profile/items/672299" class="button button--transparent button--compact button--icon js-clear has-tooltip js-action tooltipstered" data-method="delete">
                                  <i class="fa fa-trash-o fa-24"></i>
                                </a>
                              </div>

                              <button class="button button--transparent button--compact js-preview js-action">
                                <i class="fa fa-eye fa-24"></i>

                                Preview
                              </button>

                              <button class="button button--dark button--compact publish-button js-action is-disabled">
                                <i class="fa fa-rocket fa-lg"></i>

                                Publish
                              </button>
                      </div>
                  </div>
              </div>
              <div class="uploads-tab is-active">
                <div class="upload-area">
                    <form id="upload" action="index.html" method="POST" enctype="multipart/form-data">
                      <input type="file" class="with-preview" id="fileUploadNew" name="fileselect[]" multiple="multiple" />
                      <div id="filedrag">
                          <div class="upload-area__text">
                              Drag &amp; Drop
                              <span>model files and images or <b>browse files</b></span>
                          </div>
                      </div>
                    </form>
                </div>
                
                <div id="image-holder"></div>
                <div class="input-container files-count-label">
                    <label class="error">Please upload at least one file format of your 3D model.</label>
                </div>
                <div  class="visuals-panel">
                    <h2 class="heading heading--compact">Previews</h2>
                    <p class="explanation">Product images and embedded previews (videos, 3D viewers, etc).</p>
                    <ul id="messages"></ul>
                </div>
              </div>
              <div class="uploads-tab details-tab">
                  <div class="sectioned-content">
                      <form action="" novalidate="novalidate">
                        <div class="input-container js-help-trigger" data-target="#help-title">
                           <label for="title" class="block-label">Product title <b>*</b></label>
                           <input minlength="5" maxlength="64" name="title" required="required" size="30" type="text" class="field field--important" placeholder="Keep the title informative and simple" id="title">
                        </div>
                        <div class="input-container">
                           <div class="js-help-trigger u-float-left" data-target="#help-category">
                             <label for="category_id" class="inline-label" data-position="inline">Category <b>*</b></label>
                             <div class="category-container" id="category_select_container">
                                <select name="category_id" id="category_id" data-placeholder="Choose category" required="required">
                                   <option value="158">Art</option>
                                   <option value="164">Fashion</option>
                                   <option value="169">Gadgets</option>
                                   <option value="179">Games &amp; Toys</option>
                                   <option value="186">Hobby &amp; DIY</option>
                                   <option value="193">House</option>
                                   <option value="201">Jewelry</option>
                                   <option value="209">Miniatures</option>
                                   <option value="217">Science</option>
                                </select>
                             </div>
                             <div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100px;" title="" id="category_id_chosen">
                                <select name="sub_category_id" id="sub_category_id" data-placeholder="Choose sub category" required="required" >
                                  <option>Choose sub category</option>
                                </select>
                            </div>
                           </div>
                           
                           <div class="units-container js-help-trigger" data-target="#help-units">
                             <label for="units" class="inline-label" data-position="inline">Units <b>*</b></label>
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

                        <div class="input-container js-help-trigger" data-target="#help-description">
                           <label for="description" class="block-label">Description <b>*</b></label>
                           <textarea name="description" class="field field--text" required="required" minlength="5" id="description"></textarea>
                        </div>

                        <div class="input-container js-help-trigger" data-target="#help-tags">
                           <label for="tags" class="block-label">Tags <b>*</b></label>
                           <input type="text" name="tags" required="required" class="field" id="tags" style="display: none;">
                           <div id="tags_tagsinput" class="tagsinput" style="width: 100%; min-height: auto; height: 100%;">
                              <div id="tags_addTag"><input id="tags_tag" value="" data-default="add a tag" style="width: 80px;"></div>
                              <div class="tags_clear"></div>
                           </div>
                           <input type="hidden" name="tags_count" value="0">
                           <div id="tags_errorbox"></div>
                           <div class="tag-list"></div>
                        </div>

                        <section class="js-help-trigger" data-target="#help-price">
                         <h2 class="heading">Pricing</h2>
                         <div class="input-container" data-position="section">
                            <div class="pricing-options">
                               <div class="pricing-options__price">
                                  <div class="field-wrapper">
                                     <input type="text" name="price" id="price" class="field" disabled="disabled">
                                     <div class="field-suffix">$</div>
                                  </div>
                               </div>
                               <div class="pricing-options__free">
                                  <label for="free" class="">
                                     <div class="checkbox is-checked"><input type="checkbox" name="free" id="free" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                     Share for free
                                  </label>
                               </div>
                            </div>
                         </div>
                      </section>
                      <h2 class="heading">Challenges</h2>
                      <p class="challenges-explanation">If you have a right model for the challenge, simply check the box and you are
      in.</p>

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

                      </form>
                  </div>
              </div>
          </div>
      </div>
</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/jQuery.MultiFile.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/icheck.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/select2.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/class.popup.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //Popup.getMultiFiles();
    });
</script>