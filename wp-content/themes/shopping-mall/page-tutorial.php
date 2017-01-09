<?php
/* Template Name: Tutorial Page */
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
		   <h1 class="jobs-header__title">3D Tutorials</h1>
		   <div class="jobs-header__content">
		      <p class="jobs-header__annotation">Quality 3D content and examples to learn from.</p>
		   </div>
		   <a class="button button--longer u-float-right" href="">Create Tutorial</a>
		   <div class="clear"></div>
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
				         <div class="checkbox is-checked"><input checked="checked" class="iCheckBox is-checked" type="checkbox" ></div>
				         <label>All types</label><span>68</span>
				      </div>
				   </a>
				   <a href="/jobs?job_category%5B%5D=1">
				      <div class="section__item">
				         <div class="checkbox"><input class="iCheckBox" type="checkbox" ></div>
				         <label>3D Computer Graphics</label><span>36</span>
				      </div>
				   </a>
				   <a href="/jobs?job_category%5B%5D=2">
				      <div class="section__item">
				         <div class="checkbox"><input class="iCheckBox" type="checkbox" ></div>
				         <label>3D Model for Printing</label><span>17</span>
				      </div>
				   </a>
				   <a  href="/jobs?job_category%5B%5D=4">
				      <div class="section__item">
				         <div class="checkbox"><input class="iCheckBox" type="checkbox"></div>
				         <label>Low-poly</label><span>15</span>
				      </div>
				   </a>
				</div>

				<h5 class="section__title">Filter by format</h5>
				<div class="jobs-sidebar__section">
					<a rel="nofollow"  href="/jobs"><div class="section__item"><div class="checkbox is-checked"><div class="checkbox is-checked"><input checked="checked" class="iCheckBox is-checked" type="checkbox" ></div></div><label>All formats</label><span>68</span></div></a>
				</div>
			</div>

			<div class="jobs__content">
			   <div class="jobs__item">
			      <div class="jobs-item__image"><a id="27a46fe580c1ba538150f62edd1c2755" href="/jobs/1104/applications/new"><img alt="Animation, compositing, 3d model to b..." src="https://assets.cgtrader.com/assets/no_image_thumb.png"></a></div>
			      <div class="jobs-item__content">
			         <h3 class="jobs__title"><a id="27a46fe580c1ba538150f62edd1c2755" href="/jobs/1104/applications/new">Animation, compositing, 3d model to b...</a></h3>
			         <ul class="label-list">
			            <li>
			               <div class="jobs__software">
			                  <div class="label--hexagon"><span>3D Computer Graphics</span></div>
			               </div>
			            </li>
			            <li>
			               <div class="jobs__deadline"><span class="label--hexagon">28 days to finish</span></div>
			            </li>
			            <li>
			               <div class="jobs__aplicants">
			                  <div class="label--hexagon"><span>1 applicant</span></div>
			               </div>
			            </li>
			         </ul>
			         <div class="clear"></div>
			         <div class="tag-list">
			            <ul>
			               <li>Lightwave</li>
			               <li>Maya</li>
			               <li>3D Studio Max</li>
			            </ul>
			         </div>
			      </div>
			      <div class="jobs-price__content">
			         <h3 class="jobs__price u-text-right">$800</h3>
			         <a id="27a46fe580c1ba538150f62edd1c2755" href="/jobs/1104/applications/new">
			            <div class="button button--longer u-float-right">View</div>
			         </a>
			      </div>
			   </div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
