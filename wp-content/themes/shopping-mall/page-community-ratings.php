<?php
/* Template Name: Community ratings Page */
/**
 * @package Shopping_Mall
 */

get_header();

if (isset($_POST['community_rating']) && isset($_POST['product_id'])) {
    global $wpdb;
    $community_rating = $_POST['community_rating'];
    $product_id = $_POST['product_id'];
    $user_id = get_current_user_id();

    $wc_product = new WC_product($product_id);
    $product_author = $wc_product->post->post_author;

    $table_name = $wpdb->prefix . "product_ratings";
    $table_name_vendor_rating =$wpdb->prefix . "vendor_ratings";

    $query  = "INSERT `{$table_name}` (`product_id`, `rating`, `product_author`, `user_id`, `created_at`) VALUES ('{$_POST['product_id']}', '{$_POST['community_rating']}', {$product_author}, {$user_id}, NOW())";
    $result = $wpdb->query( $query );

    $limit = 200;

    $query_get = "SELECT rating FROM {$table_name} WHERE `product_author` = {$product_author} ORDER BY created_at DESC LIMIT {$limit}";
    $rows = $wpdb->get_results($query_get, ARRAY_A);

    if (sizeof($rows) == $limit) {
        $total_rate = 0;

        foreach ($rows as $row) {
            $total_rate += $row['rating'];
        }

        $accuracy = round(10 * $total_rate / $limit);

        $query_get_vendor_rating = "SELECT point FROM {$table_name_vendor_rating} WHERE vendor_id = {$product_author}";
        $vendor = $wpdb->get_row($query_get_vendor_rating, ARRAY_A);

        $point = isset($vendor['point']) ? $vendor['point'] : 0;

        if ($accuracy >= 85) {
            $point += 2;
        } else if ($accuracy < 85 && $accuracy >= 80) {
            $point += 1;
        }

        if ($point > 0) {
            $query_replace = "REPLACE INTO {$table_name_vendor_rating} VALUES ({$product_author}, {$point}, {$accuracy}, NOW(), NOW())";
            $wpdb->query($query_replace);
        }
    }

    exit();
}

?>
<?php
    $args = array( 'post_type' => 'product', 'posts_per_page' => 1, 'orderby' => 'rand' );

    $loop = new WP_Query( $args );
    $product_id = '';
    $product_title = '';
    $attachment_ids = [];

    while ( $loop->have_posts() ) : $loop->the_post();
        global $product;

        $product_id = $product->id;
        $product_title = $product->post->post_title;
    endwhile;

    if ($product_id) {
        $wc_product = new WC_product($product_id);
        $attachment_ids = $wc_product->get_gallery_attachment_ids();
    }

    $point_rates = getRates('point');
    $accuracy_rates = getRates('accuracy');

    wp_reset_query();

?>

	<div class="content-area site-page--community-rating">
	  	<section class="content-section blog-post rating-wrapper is-spaced">
			<div class="container">
				<div class="content-heading"><h2 class="content-heading__title"><?php echo $product_title; ?></h2>
				</div>
				<div class="rating-content">
					<div class="card">
						<div class="card__content">
							<div class="product-preview">
								<div class="product-preview__image">
									<ul class="js-preview-images">
									   <?php foreach ($attachment_ids as $attachment_id) : ?>
										  <li class=""><img alt="<?php echo $product_title; ?>" src="<?php echo $Original_image_url = wp_get_attachment_url( $attachment_id ); ?>"></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<span class="product-preview__navigation-left"><div class="overlay-button overlay-button--big overlay-button--transparent js-preview-prev"><i class="fa fa-chevron-left fa-3x fa-not-spaced"></i></div></span>
								<span class="product-preview__navigation-right"><div class="overlay-button overlay-button--big overlay-button--transparent js-preview-next is-disabled"><i class="fa fa-chevron-right fa-3x fa-not-spaced"></i></div></span>
							</div>
						</div>
					</div>
					<div class="product-thumbs" style="overflow: hidden;">
						<ul class="js-thumbnail-images">
							<?php foreach ($attachment_ids as $attachment_id) : ?>
    							<li class=""><img alt="<?php echo $product_title; ?>" src="<?php echo $Original_image_url = wp_get_attachment_url( $attachment_id ); ?>"></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<ul class="product-thumb-navigation"><li class="product-thumb-navigation__item community-ratings-item-navigation is-prev js-preview-prev is-disabled navigation-without-scrollbar" data-trigger="manual"><i class="fa fa-chevron-left fa-not-spaced"></i></li><li class="product-thumb-navigation__item community-ratings-item-navigation is-next js-preview-next navigation-without-scrollbar" data-trigger="manual"><i class="fa fa-chevron-right fa-not-spaced"></i></li></ul>
				</div>
				<div class="rating-sidebar">
					<div class="card">
						<div class="card__content rating-top">
							<h2 class="card__heading">Top 10 Raters </h2>
							<div id="users-tabs">
								<ul class="tabs">
									<li class="tabs__item is-active tab-point"><a class="has-tooltip tooltipstered is-active" href="#tab-points">Points</a></li>
									<li class="tabs__item"><a class="has-tooltip tooltipstered" href="#tab-accuracy">Accuracy</a></li>
								</ul>
							</div>
							<div class="rating-top__table">
								<div class="tab-pane is-active" id="tab-points">
									<ul class="list list--stats">
									   <?php $i = 1; ?>
									   <?php foreach ($point_rates as $rate) : ?>
									   <li><span class="list__value"><?php echo $i ?></span><a href="/members/<?php echo $rate['member'] ?>"><?php echo $rate['author']; ?></a> <b class="rating-top__accuracy"><?php echo $rate['accuracy']; ?>%</b><b class="rating-top__points"><?php echo $rate['point']; ?></b></li>
									   <?php $i++; ?>
									   <?php endforeach; ?>
									</ul>
								</div>
								<div class="tab-pane" id="tab-accuracy" >
								   <ul class="list list--stats">
								      <?php $i = 1; ?>
								      <?php foreach ($accuracy_rates as $rate) : ?>
								      <li><span class="list__value"><?php echo $i; ?></span><a href="/members/<?php echo $rate['member'] ?>"><?php echo $rate['author']; ?></a> <b class="rating-top__accuracy"><?php echo $rate['accuracy']; ?>%</b><b class="rating-top__points"><?php echo $rate['point']; ?></b></li>
								      <?php endforeach; ?>
								   </ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="rating-action">
	    <div class="container">
	        <div class="rating-action__content">
	            <h3 class="rating-action__heading">How would you rate this model?</h3>
	            <form class="new_community_rating" id="new_community_rating" action="" accept-charset="UTF-8" method="post">
	                <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
	                <div class="rating-action__values js-rating-values">
	                    <div class="rating-action__label">Awful</div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">1</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="1" name="community_rating" id="community_rating_value_1">
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">2</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="2" name="community_rating" id="community_rating_value_2">
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">3</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="3" name="community_rating" id="community_rating_value_3" >
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">4</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="4" name="community_rating" id="community_rating_value_4">
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">5</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="5" name="community_rating" id="community_rating_value_5" >
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">6</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="6" name="community_rating" id="community_rating_value_6" >
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">7</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="7" name="community_rating" id="community_rating_value_7" >
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">8</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="8" name="community_rating" id="community_rating_value_8">
	                        </div>
	                    </div>
	                    <div class="rating-action__value">
	                        <div class="rating-action__value-label js-value-label">9</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="9" name="community_rating" id="community_rating_value_9" >
	                        </div>
	                    </div>
	                    <div class="rating-action__value is-last">
	                        <div class="rating-action__value-label js-value-label">10</div>
	                        <div class="radio">
	                            <input class="js-tooltip tooltipstered iCheckBox" type="radio" value="10" name="community_rating" id="community_rating_value_10" >
	                        </div>
	                    </div>
	                    <div class="rating-action__label">Excellent</div>
	                </div>
	                <button name="button" type="button" class="button button--material button--alt js-cast-rating" disabled="disabled">Rate</button>
	                <div class="rating-action__info"><b>50</b> left to rate today </div>
	            </form>
	        </div>
	        <div class="rating-selector">
	            <h3 class="rating-selector__heading">Choose model type to rate</h3>
	            <div class="rating-selector__form">
	                <form class="js-type-select" action="https://www.cgtrader.com/community_ratings/new" accept-charset="UTF-8" method="get">
	                    <div class="radio">
	                        <input class="iCheckBox" type="radio" name="product_type" id="product_type_cg" value="cg" checked="checked" >
	                    </div>
	                    <label class="rating-action__label" for="product_type_cg">3D models</label>
	                    <div class="radio">
	                        <input class="iCheckBox" type="radio" name="product_type" id="product_type_printable" value="printable" >
	                    </div>
	                    <label class="rating-action__label" for="product_type_printable">3D printable models</label>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	</div>


<?php
//get_sidebar();
get_footer();
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.js-preview-images').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: true,
		  fade: true,
		  asNavFor: '.js-thumbnail-images',
		  prevArrow: $('.js-preview-prev'),
  		  nextArrow: $('.js-preview-next')
		});
		$('.js-thumbnail-images').slick({
		  slidesToShow: 5,
		  slidesToScroll: 1,
		  asNavFor: '.js-preview-images',
		  dots: false,
		  focusOnSelect: true,
		  variableWidth: true
		});


		$('#users-tabs li a').click(function(){
			$('#users-tabs li, #users-tabs li a').removeClass('is-active');
			$(this).addClass('is-active');
			$(this).parent().addClass('is-active');
			$('.rating-top__table .tab-pane').removeClass('is-active');
			var href= $(this).attr('href');
			$(href).addClass('is-active');
		});

		$('.iradio').each(function() {
			$(this).find('input').attr('checked', false);
			$(this).removeClass('checked');
			$('button.js-cast-rating').attr('disabled', true);
		});

		$('#new_community_rating .iCheck-helper').click(function() {
			$('button.js-cast-rating').attr('disabled', false);
			$('.rating-action__value-label').removeClass('is-active');

			$(this).parent().parent().parent().find('.rating-action__value-label').addClass('is-active');
		});

		$('button.js-cast-rating').click(function() {
			$.ajax({
				url: '/community-ratings',
				method: 'POST',
				data: $('form#new_community_rating').serialize(),
				success: function() {
					alert('Rated successfull!');
				    location.reload();
				}
			});
		});
	});


</script>
<?php
function getRates($order = 'point') {
    global $wpdb;
    $table_name = $wpdb->prefix . "vendor_ratings";
    $rates = array();

    $query = "SELECT * FROM `{$table_name}` ORDER BY `{$order}` DESC LIMIT 10";
    $rows = $wpdb->get_results($query, ARRAY_A);

    foreach ($rows as $row) {
        $user = get_userdata($row['vendor_id']);
        $rates[$row['vendor_id']]['author'] = $user->data->display_name;
        $rates[$row['vendor_id']]['member'] = $user->data->user_login;
        $rates[$row['vendor_id']]['point'] = $row['point'];
        $rates[$row['vendor_id']]['accuracy'] = $row['accuracy'];
    }

    return $rates;
}