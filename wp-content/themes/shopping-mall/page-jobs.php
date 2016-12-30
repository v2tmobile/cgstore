<?php
/* Template Name: Jobs Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="jobs-page">
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
		              <span itemprop="name">Jobs</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
            </ul>
		</div>

		<div class="jobs-header">
		   <h1 class="jobs-header__title">3D Jobs</h1>
		   <div class="jobs-header__content">
		      <p class="jobs-header__annotation">Looking for a custom 3D model? Post your job offer below and get automatically connected with thousands of designers on CGTrader.</p>
		   </div>
		   <a class="button button--longer u-float-right" id="468bd2291391c7776b3a410877737c41" href="/jobs/new">Post a job!</a>
		</div>
		

		<div class="job-content">
			<div class="jobs-sidebar__content">
				<h5 class="section__title">Sort by</h5>
				<div class="jobs-sidebar__section">
				   <a href="/jobs?created_at=desc">
				      <div class="button button--full">Newest</div>
				   </a>
				   <a href="/jobs?price=asc">
				      <div class="button button--full">Lowest Budget</div>
				   </a>
				   <a href="/jobs?price=desc">
				      <div class="button button--full">Highest Budget</div>
				   </a>
				</div>
				<h5 class="section__title">Filter by type</h5>

				<div class="jobs-sidebar__section">
				   <a href="/jobs">
				      <div class="section__item">
				         <div class="checkbox is-checked"><input checked="checked" class="checkbox is-checked" type="checkbox" ></div>
				         <label>All types</label><span>68</span>
				      </div>
				   </a>
				   <a href="/jobs?job_category%5B%5D=1">
				      <div class="section__item">
				         <div class="checkbox"><input class="checkbox" type="checkbox" ></div>
				         <label>3D Computer Graphics</label><span>36</span>
				      </div>
				   </a>
				   <a href="/jobs?job_category%5B%5D=2">
				      <div class="section__item">
				         <div class="checkbox"><input class="checkbox" type="checkbox" ></div>
				         <label>3D Model for Printing</label><span>17</span>
				      </div>
				   </a>
				   <a  href="/jobs?job_category%5B%5D=4">
				      <div class="section__item">
				         <div class="checkbox"><input class="checkbox" type="checkbox"></div>
				         <label>Low-poly</label><span>15</span>
				      </div>
				   </a>
				</div>


			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
