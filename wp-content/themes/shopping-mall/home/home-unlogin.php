
<div class="section section--low-poly">
   <div class="container">
      <h2 class="section__title">VR / AR Ready Low-poly 3D Models</h2>
      <div class="section__content" style="background:url(<?php echo get_field('low_poly', get_the_ID())?>) no-repeat center left">
         <div class="section__text">
            <h3 class="title">Low Poly 3D Models ready for video games, VR &amp; AR real-time applications</h3>
            <a class="button button--big button--full button--big-text" href="<?php echo HOME_URL; ?>/product-category/vr-low-poly-models/" >Low poly 3D models</a>
         </div>
      </div>
   </div>
</div>

<div class="section section--alt section--cg-models">
   <div class="container">
      <h2 class="section__title">3D Models</h2>
      <div class="section__content" style="background:url(<?php echo get_field('3d_models', get_the_ID())?>) no-repeat center right">
         <div class="section__text">
            <h3 class="title">Buy professional 3D Models for your project</h3>
            <a class="button button--big button--full button--big-text" href="<?php echo HOME_URL; ?>/product-category/3d-models/" id="">Buy 3D models</a>
         </div>
      </div>
   </div>
</div>
<div class="section section--dark section--jobs js-bg is-loaded" style="background: url(<?php echo get_field("gray_background", "option"); ?>) no-repeat;    background-size: cover; position: relative; z-index: 0;">
   <div class="container">
      <h2 class="section__title">3D Jobs</h2>
      <div class="section__content">
         <div class="jobs-content">
            <?php if( have_rows('3d_jobs') ): ?>
               <?php $i = -1;?>
               <?php while( have_rows('3d_jobs') ): the_row(); 

                  // vars
                  $desc = get_sub_field('description');
                  $img = get_sub_field('image');
                  $arr = ['find', 'hire'];
                  $i++;
                  ?>
                  <div class="jobs-content__<?php echo $arr[$i]?>" style="background: url(<?php echo $img;?>) no-repeat top center">
                     <h3 class="title"><?php echo $desc;?></h3>
                  </div>

               <?php endwhile; ?>

            <?php endif; ?>
         </div>
      </div>
      <p><a class="button button--big button--big-text button--longer" href="<?php echo HOME_URL; ?>/jobs/">Post or find 3D jobs</a></p>
   </div>
</div>
<div class="section section--community">
   <div class="container">
      <h2 class="section__title">3D Designer Community</h2>
      <div class="section__content">
         <div class="community-content">
            <?php if( have_rows('3d_designer') ): ?>
               <?php $i = -1;?>
               <?php while( have_rows('3d_designer') ): the_row(); 

                  // vars
                  $desc = get_sub_field('description');
                  $img = get_sub_field('image');
                  $title = get_sub_field('title');
                  $arr = ['designers', 'challenges', 'galleries', 'forum'];
                  $i++;
                  ?>
                  <div class="community-content__col community-content__col--<?php echo $arr[$i]?>" style="background: url(<?php echo $img;?>) no-repeat top center">
                     <h3 class="community-content__title"><?php echo $title; ?></h3>
                     <p class="title"><?php echo $desc;?></p>
                  </div>
               <?php endwhile; ?>

            <?php endif; ?>
         </div>
      </div>
      <p><a class="button button--big button--big-text button--longer" href="<?php echo HOME_URL; ?>/3d-community/" id="">Join the Community!</a></p>
   </div>
</div>