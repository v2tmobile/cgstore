<?php
/**
 * Created by v2tmobile.
 * Date: 11/28/16
 * Time: 12:16 AM
 * Copyright (c) Ahiho.,JSC. All right reserved.
 */

?>
<div class="publisher-container">

    <div class="uploads-section">
        <form enctype="multipart/form-data" method="post">
            <input id="item_file" name="item_file" type="file" multiple="true">
        </form>
    </div>

    <section class="details-section">
        <div class="input-section">
            <label for="title"><?php esc_html_e( 'Product title', 'woocommerce-product-vendors-frontend');?> *</label>
            <input minlength="5" maxlength="64" name="title" required="required" size="30" type="text" class="field field--important" placeholder="<?php esc_html_e( 'Keep the title informative and simple', 'woocommerce-product-vendors-frontends')?>" id="title">
        </div>
        <div class="input-section">
            <label for="category_id"><?php esc_html_e( 'Category', 'woocommerce-product-vendors-frontend')?> *</label>
            <select name="category_id" id="category_id" data-placeholder="Choose category" required="required">
                <?php foreach($categories as $cat) : ?>
                    <option value="<?php echo $cat->term_id;?>"><?php echo $cat->name; ?></option>
                <?php endforeach ?>
            </select>
            <label for="sub_category_id"><?php esc_html_e( 'Sub category', 'woocommerce-product-vendors-frontend')?></label>
            <select name="sub_category_id" id="sub_category_id" data-placeholder="Choose sub category" required="required">

            </select>
        </div>
        <div class="input-section">
            <label for="description"><?php esc_html_e( 'Description', 'woocommerce-product-vendors-frontend') ?> *</label>
            <textarea name="description" class="field field--text error" required="required" minlength="5" id="description"></textarea>
        </div>

        <div class="input-section">
            <label for="tags"><?php esc_html_e( 'Tags', 'woocommerce-product-vendors-frontend')?> *</label>
            <input type="text" name="tags" required="required" class="field" id="tags">
        </div>

        <section>
            <h2><?php esc_html_e( 'Pricing', 'woocommerce-product-vendors-frontend')?></h2>
            <div class="input-section">
                <label for="sell_source_files">
                    <input type="checkbox" name="sell_source_files" id="sell_source_files">
                    <?php esc_html_e( 'Allow downloading source files', 'woocommerce-product-vendors-frontend')?>
                </label>
                <input type="text" name="price" id="price" class="field valid" placeholder="10$">
                <label for="free">
                    <input type="checkbox" name="free" id="free" class="valid">
                    <?php esc_html_e( 'Share for free', 'woocommerce-product-vendors-frontend')?>
                </label>
            </div>
            <div class="input-section">
                <label for="streaming_price"><?php esc_html_e( 'Direct Printing', 'woocommerce-product-vendors-frontend')?></label>
                <input type="text" name="streaming_price" class="field valid" id="streaming_price" placeholder="5$">
            </div>
            <div class="input-section">
                <label for="print_markup"><?php esc_html_e( 'Printed Product', 'woocommerce-product-vendors-frontend')?></label>
                <input type="text" name="print_markup" class="field valid" id="print_markup" placeholder="50%">
            </div>
        </section>
        <section>
            <h2><?php esc_html_e( 'Challenges', 'woocommerce-product-vendors-frontend')?></h2>
        </section>
    </div>

</div>
