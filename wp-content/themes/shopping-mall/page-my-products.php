<?php
/* Template Name: My Products Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="site-page--my-items">
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
		              <span itemprop="name">My Products</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
            </ul>
		</div>

		<div class="content-heading">
		   <h2 class="content-heading__title">My Products</h2>
		   <p class="content-heading__subtitle">Browse through your uploaded products 
		</div>

		<div class="product-search">
			<form action="/profile/products" accept-charset="UTF-8" method="get">
			   <div class="product-search__field">
			   	<input type="text" name="keywords" id="keywords" class="field field--full" placeholder="Product keywords">
			   </div>
			   <div class="product-search__type">
			      <select name="type" id="type" class="select">
			         <option value="all">All types</option>
			         <option value="cg">CG Models</option>
			         <option value="printable">Printable Models</option>
			      </select>
			   </div>
			   <div class="product-search__category">
			      <select name="category" id="category" class="select">
			         <option value="">All categories</option>
			         <option value="1">Aircraft</option>
			         <option value="10">Animals</option>
			         <option value="18">Architectural</option>
			         <option value="27">Exterior</option>
			         <option value="40">Interior</option>
			         <option value="50">Car</option>
			         <option value="58">Character</option>
			         <option value="67">Electronics</option>
			         <option value="73">Food</option>
			         <option value="78">Furniture</option>
			         <option value="90">Furniture Set</option>
			         <option value="98">Household</option>
			         <option value="102">Industrial</option>
			         <option value="107">Plant</option>
			         <option value="115">Science</option>
			         <option value="119">Space</option>
			         <option value="124">Sports</option>
			         <option value="130">Vehicle</option>
			         <option value="141">Watercraft</option>
			         <option value="147">Military</option>
			         <option value="158">Art</option>
			         <option value="164">Fashion</option>
			         <option value="169">Gadgets</option>
			         <option value="179">Games &amp; Toys</option>
			         <option value="186">Hobby &amp; DIY</option>
			         <option value="193">House</option>
			         <option value="201">Jewelry</option>
			         <option value="209">Miniatures</option>
			         <option value="217">Science</option>
			         <option value="228">Scanned 3D Models</option>
			         <option value="230">Scripts / Plugins</option>
			         <option value="237">Engineering Parts</option>
			         <option value="315">Various</option>
			      </select>
			    </div> 
			   <div class="product-search__action"><button name="button" type="submit" class="button button--full">Filter products</button></div>
			</form>
		</div>

		<div class="product-price-change__form">
			<form id="price-change-form" action="" method="">
				<div class="product-price-change__area">
					<div class="product-price-change__field">
						<select name="models" id="models" class="select" >
					      <option value="selected">With selected models</option>
					      <option value="all">All Models</option>
					   </select>
					</div>
					<div class="product-price-change__field">
					   <select name="units" id="units" class="select js-select-units" style="display: none;">
					      <option value="set">Set price to</option>
					      <option value="increase">Increase prices by</option>
					      <option value="decrease">Decrease prices by</option>
					   </select>
					</div>
					<div class="product-price-change__field">
					   <div class="field-wrapper">
					      <input type="number" name="price" id="price" value="" class="field js-price-field">
					      <div class="field-suffix js-change-units">$</div>
					   </div>
					</div>
					<div class="product-price-change__action">
						<button name="button" type="submit" class="button button--full" data-disable-with="<i class='fa fa-refresh fa-spin'></i> Submitting">Apply</button>
					</div>
				</div>
			</form>
		</div>
		<div class="product-price-change__note"><b>Note:</b> It might take some time to update the product prices, especially if you have hundreds or thousands of models. Please be patient.</div>
		<div class="products-list">
		   <div class="products-list__select-menu js-menu">
		   		<button name="button" type="submit" class="button button--horizontally-spaced select-button js-select-all-in-page">Check all to delete All</button>
		   	</div>
		   <table class="table">
		      <colgroup>
		         <col style="width: 3%;">
		         <col style="width: 40%;">
		         <col style="width: 10%;">
		         <col style="width: 10%;">
		         <col style="width: 35%;">
		      </colgroup>
		      <thead>
		         <tr>
		            <th  style="width: 3%;" class="u-text-center">
		               <div class="checkbox"><input type="checkbox" name="select_all" id="select_all" value="true" class="js-select-menu check_all iCheckBoxProduct" ></div>
		            </th>
		            <th style="width: 70px;" class="u-text-center"></th>
		            <th class="u-text-left" style="width: 45%;">Title</th>
		            <th style="width: 20%;">Status</th>
		            <th style="width: 10%;">Price</th>
		            <th style="width: 15%;">Actions</th>
		         </tr>
		      </thead>
		      <tbody>
		      	<?php 
		      		$args = array(
					    'author'        =>  get_current_user_id(),
					    'post_type' 	=>  'product',
					    'posts_per_page' => 15
				    );
				    $current_products = get_posts($args);
				    foreach ( $current_products as $g_current ) : setup_postdata( $g_current );
				    	$_product = wc_get_product( $g_current -> ID );
				 ?>
			      	<tr>
			      		<td><div class="checkbox"><input type="checkbox" name="select_product[]" id="select_<?php echo $g_current->ID;?>" value="true" class="js-select-menu check_item iCheckBoxProduct" ></div></td>
			      		<td style="width:70px"><?php echo get_the_post_thumbnail($g_current->ID, array(50,50))?></td>
			      		<td><?php echo get_the_title($g_current->ID);?></td>
			      		<td><?php echo $g_current->post_status; ?></td>
			      		<td><?php echo get_woocommerce_currency_symbol().$_product->get_price(); ?></td>
			      		<td class="tdaction">
			      			<a href="#" class="btn delete"></a>
			      			<a href="#" class="btn edit"></a>
			      		</td>
			      	</tr>
		      	<?php endforeach; ?>
		      </tbody>
		   </table>
		</div>
	</div>
</div>

<?php get_footer(); ?>
