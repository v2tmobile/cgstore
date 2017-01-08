<div class="jobs-sidebar__content">
	<h5 class="section__title">Sort by</h5>
	<div class="jobs-sidebar__section">
	   <a href="<?php echo HOME_URL ?>/jobs/?order_by=asc">
	      <div class="button button--full">Newest</div>
	   </a>
	   <a href="<?php echo HOME_URL ?>/jobs/?job_price=asc">
	      <div class="button button--full">Lowest Budget</div>
	   </a>
	   <a href="<?php echo HOME_URL ?>/jobs/?job_price=desc">
	      <div class="button button--full">Highest Budget</div>
	   </a>
	</div>

	<h5 class="section__title">Filter by type</h5>

	<div class="jobs-sidebar__section">
	 <?php
         $type_job_tax = 'type_job';
         $type_jobs = get_terms( $type_job_tax, 'orderby=count&hide_empty=0' );
         $get_type_job = ($_GET['type_job']) ? $_GET['type_job'] : '';
         $is_checked ="checked='checked'";
         if($type_jobs):
             if($get_type_job) $is_checked = '';
              $jobs = wp_count_posts('jobs');
              
         	?>
		     <a href="<?php echo HOME_URL; ?>/jobs">
			      <div class="section__item">
			         <div class="checkbox is-checked">
			         <input <?php echo $is_checked; ?> class="iCheckBox is-checked" type="checkbox" ></div>
			         <label>All types</label><span><?php echo $jobs->publish; ?></span>
			      </div>
			   </a>
           <?php
           $is_checked = '';
           foreach ($type_jobs as $job):
            $link = HOME_URL.'/jobs/?'.$type_job_tax.'='.$job->slug; 
            if($get_type_job == $job->slug) $is_checked ="checked='checked'"; else $is_checked = '';
	  ?>
	   <a href="<?php echo $link;?>">
	      <div class="section__item">
	         <div class="checkbox is-checked">
	         <input <?php echo $is_checked; ?> class="iCheckBox is-checked" type="checkbox" ></div>
	         <label><?php echo $job->name; ?></label><span><?php echo $job->count; ?></span>
	      </div>
	   </a>
	  <?php
         endforeach;
	   endif; ?>
	</div>

	<h5 class="section__title">Filter by format</h5>
	<div class="jobs-sidebar__section">
      <?php
         $format_job_tax = 'job_format';
         $format_jobs = get_terms( $format_job_tax, 'orderby=count&hide_empty=0' );
         $get_job_format = ($_GET['job_format']) ? $_GET['job_format'] : '';
         $is_checked ="checked='checked'";
         if($format_jobs):
             if($get_job_format) $is_checked = '';
         	?>
		     <a href="/jobs">
			      <div class="section__item">
			         <div class="checkbox is-checked">
			         <input <?php echo $is_checked; ?> class="iCheckBox is-checked" type="checkbox" ></div>
			         <label>All Formats</label><span>0</span>
			      </div>
			   </a>
           <?php
           $is_checked = '';
           foreach ($format_jobs as $job):
            $link = HOME_URL.'/jobs/?'.$format_job_tax.'='.$job->slug; 
            if($get_job_format == $job->slug) $is_checked ="checked='checked'"; else $is_checked = '';
	  ?>
	   <a href="<?php echo $link;?>">
	      <div class="section__item">
	         <div class="checkbox is-checked">
	         <input <?php echo $is_checked; ?> class="iCheckBox is-checked" type="checkbox" ></div>
	         <label><?php echo $job->name; ?></label><span><?php echo $job->count; ?></span>
	      </div>
	   </a>
	  <?php
         endforeach;
	   endif; ?>

	</div>
</div>