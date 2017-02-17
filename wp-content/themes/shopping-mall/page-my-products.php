<?php
/* Template Name: My Products Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="site-page--my-items">
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
		   <h2 class="content-heading__title">My Products</h2>
		   <p class="content-heading__subtitle">Browse through your uploaded products 
		</div>

		<div class="product-search">
			<form action="" method="get">
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
			          <?php 
		                 $product_cat = 'product_cat';
		                 $product_cats = get_terms( $product_cat, 'orderby=title&hide_empty=0');
		                 if($product_cats){
		                    $selected = '';
		                    foreach ($product_cats as $cat) {
		                        if($_GET['product_cat']){
		                           $selected = ($_GET['product_cat'] == $cat->slug) ? 'selected="selected"': '';  
		                        }
		                        echo '<option value="'.$cat->slug.'"'.$selected.'>'.$cat->name.'</option>';
		                    }
		                 }
             ?>
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
		   <!--<div class="products-list__select-menu js-menu">
		   		<button name="button" type="submit" class="button button--horizontally-spaced select-button js-select-all-in-page">Check all to delete All</button>
		   	</div>-->
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
				    query_posts($args);
				   if(have_posts()):
				    while( have_posts() ) : the_post();
				    	$_product = wc_get_product( get_the_ID() );
				    	
				 ?>
			      	<tr>
			      		<td><div class="checkbox"><input type="checkbox" name="select_product[]" id="select_<?php echo get_the_ID();?>" value="true" class="js-select-menu check_item iCheckBoxProduct" ></div></td>
			      		<td style="width:70px"><?php echo get_the_post_thumbnail(get_the_ID(), array(50,50))?></td>
			      		<td><?php echo $_product->post_title;?></td>
			      		<td><?php echo $_product->post_status; ?></td>
			      		<td><?php echo get_woocommerce_currency_symbol().$_product->get_price(); ?></td>
			      		<td class="tdaction">
			      			<a href="javascript:void(0);" data-id="<?php echo get_the_ID(); ?>" class="btn delete confirm_delete_product" ></a>
			      			<a href="<?php echo  WCVendors_Pro_Dashboard::get_dashboard_page_url('product/edit/' . get_the_ID() ); ?>" class="btn edit"></a>
			      		</td>
			      	</tr>
		      	<?php endwhile; endif; ?>
		      </tbody>
		   </table>
		</div>
	</div>
</div>
<style type="text/css">
	.jconfirm-box-container{
		width:33.33333333%;
		float: left;
	    position: relative;
	    margin-left: 33.33333333%;
	}
</style>
<script>
   function cgs_delete_product(PID,that){
   if( typeof PID !=='undefined'){
       $.ajax({
             type: "POST",
             url: CGSTORE_VARS.AJAX_URL,
             data:{
               action:'cgs-delete-product-custom',
               data:{UID:CGSTORE_VARS.UID,PID:PID}
             },
             dataType: 'json',
            beforeSend:function(){
                
            },
             success: function(res)
            { 

                if(res.success === true){
                	window.location.reload();
                 }else{
                     alert('Error. Please try again!');
                 }
              }
           });
     return false;
   } 

}     

$(document).on("click", ".confirm_delete_product", function(e) {
        	var id = $(this).attr('data-id');
        	var that = $(this);
            $.confirm({
			    title: 'Confirm!',
			    content: 'You want to delete this product!',
			    buttons: {
			        confirm: function () {
						cgs_delete_product_custom(id,that);
			        },
			        cancel: function () {
			            return false;
			        }   
            }
      });
  });
</script>
<?php get_footer(); ?>
