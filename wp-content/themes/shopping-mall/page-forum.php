<?php
/* Template Name: Forum Page */
/**
 * @package Shopping_Mall
 */

get_header(); ?>

<div class="forum-page">
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
		              <span itemprop="name">Forum</span>
		            </span>
		                <meta content="2" itemprop="position">
		        </li>
            </ul>
		</div>

		<div class="content-heading">
		   <h2 class="content-heading__title">Discussion Forum</h2>
		   <div class="content-heading__subtitle">Ask questions, showcase your work, give feedback and have fun chatting!</div>
		</div>
		
		<div class="forum-board-actions">
		   <div class="u-float-left"><a class="button button--alt js-auth-control" id="" href="/forum/topics/new">Create new discussion </a></div>
		   <div class="u-float-right">
		      <form action="" accept-charset="UTF-8" method="get">
		         <div class="forum-search">
		            <div class="forum-search__field"><input type="text" name="keywords" id="keywords" class="field field--full" placeholder="Search for topics..."></div>
		            <div class="forum-search__action"><button name="" type="submit" class="button button--full">Search</button></div>
		         </div>
		      </form>
		   </div>
		   <div class="clear"></div>	
		</div>

		<div class="tabs-container">
			<ul class="tabs">
			   <li class="tabs__item is-active"><a href="#forum-tab-boards">Forum Boards</a></li>
			   <li class="tabs__item"><a href="#forum-tab-newest">Newest Topics</a></li>
			   <li class="tabs__item"><a href="#forum-tab-popular">Popular</a></li>
			   <li class="tabs__item"><a href="#forum-tab-unanswered">Unanswered</a></li>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="forum-tabs__content">
			<div id="forum-tab-boards" class="is-active forum-tab">
				<div class="forum-boards">
					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>
				</div>
			</div>

			<div id="forum-tab-newest" class="forum-tab">
				<div class="forum-boards">
					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions 2</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>
				</div>
			</div>

			<div id="forum-tab-popular" class="forum-tab">
				<div class="forum-boards">
					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions 3</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>
				</div>
			</div>

			<div id="forum-tab-unanswered" class="forum-tab">
				<div class="forum-boards">
					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>

					<article class="forum-board">
						<div class="forum-board__icon"><i class="fa fa-commenting-o fa-2x"></i></div>
						<div class="forum-board__content">
							<h3 class="forum-board__title">
								<a id="" href="/forum/boards/1">General Discussions</a>
							</h3>
							<div class="forum-board__description">
								Place for your discussions on various topics: from CG industry to VR/AR world, to specific software. Post, discuss, communicate.
							</div>
						</div>
						<div class="forum-board__stats"><div class="forum-board__metric"><b>486</b>Topics </div></div>
						<div class="clear"></div>
					</article>
				</div>
			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>
