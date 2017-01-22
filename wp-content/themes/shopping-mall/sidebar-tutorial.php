<div class="jobs-sidebar__content">
 <form method="get" action="" class="filter-tutorial">
    <h5 class="section__title">By Category</h5>

	<div class="jobs-sidebar__section">
	 <?php
         $tutorial_cat = 'tutorial_cat';
         $cats = get_terms( $tutorial_cat, 'orderby=count&hide_empty=0' );
         $get_tutorial_cat= ($_GET['tutorial_cat']) ? $_GET['tutorial_cat'] : [];
         $is_checked ="checked='checked'";
         if($cats):
           
           foreach ($cats as $cat):
            
            if(in_array($cat->slug, $get_tutorial_cat)) $is_checked ="checked='checked'"; else $is_checked = '';
	  ?>
	   
	      <div class="section__item">
	         <div class="checkbox is-checked">
	         <input name="tutorial_cat[]" <?php echo $is_checked; ?> class="iCheckBox is-checked" type="checkbox" ></div>
	         <label><?php echo $cat->name; ?></label>
	      </div>
	   
	  <?php
         endforeach;
	   endif; ?>
	</div>

	<h5 class="section__title">By Software</h5>
	<div class="jobs-sidebar__section">
      <?php
         $tutorial_sf_tax = 'tutorial_software';
         $softwares = get_terms( $tutorial_sf_tax, 'orderby=count&hide_empty=0' );
         $get_software = ($_GET['tutorial_software']) ? $_GET['tutorial_software'] : [];
         $is_checked ="checked='checked'";
         if($softwares):
           foreach ($softwares as $software):
            
            if(in_array($software->slug, $get_software)) $is_checked ="checked='checked'"; else $is_checked = '';
	  ?>
	   
	      <div class="section__item">
	         <div class="checkbox is-checked">
	         <input name="tutorial_software[]" <?php echo $is_checked; ?> class="iCheckBox is-checked" type="checkbox" ></div>
	         <label><?php echo $software->name; ?></label>
	      </div>
	   
	  <?php
         endforeach;
	   endif; ?>

	</div>
  </form>
</div>