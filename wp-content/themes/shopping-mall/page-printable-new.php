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
    </div>

</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/jQuery.MultiFile.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH;?>/js/class.popup.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //Popup.getMultiFiles();
    });
</script>