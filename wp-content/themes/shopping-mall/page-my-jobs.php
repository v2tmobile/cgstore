<?php
/* Template Name: My Jobs Page */
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
		              <span itemprop="name">My Jobs</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
            </ul>
		</div>

		<div class="content-heading">
		   <h2 class="content-heading__title">My Jobs</h2>
		   <p class="content-heading__subtitle">Your applications for jobs 
		</div>

		<div class="product-search">
			<form action="/profile/products" accept-charset="UTF-8" method="get">
			   <div class="product-search__field">
			   	<input type="text" name="keywords" id="keywords" class="field field--full" placeholder="Job keywords">
			   </div>
			   <div class="product-search__type">
			      <select name="type" id="type" class="select">
			         <option value="all">Category</option>
			         <option value="cg">CG Models</option>
			         <option value="printable">Printable Models</option>
			      </select>
			   </div>
			   <div class="product-search__category">
			      <select name="category" id="category" class="select">
			         <option value="">Software Category</option>
			         <option value="1">Aircraft</option>
			         <option value="10">Animals</option>
			         <option value="18">Architectural</option>
			         <option value="27">Exterior</option>
			         <option value="40">Interior</option>
			         <option value="50">Car</option>
			         <option value="58">Character</option>
			         <option value="67">Electronics</option>
			         <option value="73">Food</option>
			      </select>
			    </div> 
			   <div class="product-search__action"><button name="button" type="submit" class="button button--full">Filter</button></div>
			</form>
		</div>
		<div class="product-price-change__note"><b>Note:</b> It might take some time to update the product prices, especially if you have hundreds or thousands of models. Please be patient.</div>
		<div class="products-list">
		   <div class="products-list__select-menu js-menu">
		   	<button name="button" type="submit" class="button button--horizontally-spaced select-button js-select-all-in-page">Select all jobs in this page</button>
		   	<button name="button" type="submit" class="button button--horizontally-spaced select-button js-select-filtered">Select all filtered models</button></div>
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
		               
		            </th>
		            <th style="width: 40%;" class="u-text-center"></th>
		            <th class="u-text-left" style="width: 20%;">Title</th>
		            <th style="width: 10%;">Category</th>
		            <th style="width: 10%;">Software</th>
		            <th style="width: 15%;">Actions</th>
		         </tr>
		      </thead>
		      <tbody>
		      	<tr>
		      		<td><div class="checkbox"><input type="checkbox" name="select_all" id="select_1" value="true" class="js-select-menu iCheckBox" ></div></td>
		      		<td>abc</td>
		      		<td>drf</td>
		      		<td>dsa</td>
		      		<td>$500</td>
		      		<td>
		      			<a href="#" class="btn">Edit</a>
		      		</td>
		      	</tr>
		      </tbody>
		   </table>
		</div>
	</div>
</div>

<?php get_footer(); ?>
