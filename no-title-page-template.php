<?php /* Template Name: no title */ ?>
<?php get_header(); ?>

<div class="container">
  <div class="row">
      <?php
          if ($options['sidebar'] != true) {
              if (is_active_sidebar('sidebar-widget-area')) {
                  echo"<div class=col-sm-8>";
              } else {
                  echo"<div class=col-sm-12>";
              }
          } else {
              echo"<div class=col-sm-12>";
          }
      ?>
      <div id="content" role="main">
             <?php if ( function_exists( 'the_custom_logo' ) ) {
                 $custom_logo_id = get_theme_mod( 'custom_logo' );
                 $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                 $link = esc_url( home_url('/') );
                 if ( has_custom_logo() ) {
                     echo"<div><a href=\"$link\"><img class=\"site-logo\" src=\"$image[0]\" alt=\"\"></a></div>";
                 }
             }?>
        <?php get_template_part('loops/content', 'page'); ?>
        <!-- left and right banner images start -->
        <?php
        if ($bootscout['banner_2_image'] != "") {
            echo "<div class=\"leftImg\">";
            $imgSrc = wp_get_attachment_image_src( $bootscout['banner_2_image'], 'full');
            $img = $imgSrc[0];
            echo "<img class=\"bannerSideImgLeft\" src=\"$img\" />";
            echo "</div>";
        }
        if ($bootscout['banner_1_image'] != "") {
            echo "<div class=\"rightImg\">";
            $imgSrc = wp_get_attachment_image_src( $bootscout['banner_1_image'], 'full');
            $img = $imgSrc[0];
            echo "<img class=\"bannerSideImgRight\" src=\"$img\" />";
            echo "</div>";
        }
         ?>
      <!-- left and right banner images end -->
      </div><!-- /#content -->
  </div>
  <?php if ($options['sidebar'] != true) {
    echo"
      <div class=\"col-sm-4\" id=\"sidebar\" role=\"navigation\">";
          get_sidebar();
      echo"</div>";
  }
  ?>
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
