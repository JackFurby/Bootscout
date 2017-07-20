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
        <header>
            <?php
            if ($options['carousel'] == true) {
                // get most recent posts (limit 3)
                $args = array( 'numberposts' => '3' );
                $recent_posts = wp_get_recent_posts( $args );
                $banner_count = 0; //sets banners to 0
                foreach( $recent_posts as $recent ){
                    $banner_count++; //adds 1 to banner count
                }
                wp_reset_query();

                //makes carousel with recent posts
                echo"
                <div id=\"carouselIndicators\" class=\"carousel slide\" data-ride=\"carousel\" data-interval=\"7000\">
                  <ol class=\"carousel-indicators\">";
                  //creats slides
                  for ( $i = 0; $i<$banner_count; $i++ ) { //makes banner Indicators for number of banners created from posts
                      if ($i == 0) {
                          echo"<li data-target=\"#carouselIndicators\" data-slide-to=\"$i\" class=\"active\"></li>";
                      } else {
                          echo"<li data-target=\"#carouselIndicators\" data-slide-to=\"$i\"></li>";
                      }
                  }
                  echo"
                  </ol>
                  <div class=\"carousel-inner\" role=\"listbox\">";
                  // get most recent posts (limit 3)
                  $args = array( 'numberposts' => '3' );
                  $recent_posts = wp_get_recent_posts( $args );
                  $j = 0; //set content of slide
                  foreach( $recent_posts as $recent ){
                      $current_post_title = $recent["post_title"];
                      $current_post_link = get_post_permalink( $recent["ID"] );
                      $current_post_img = wp_get_attachment_url( get_post_thumbnail_id( $recent["ID"] ) );
                      if ($j == 0) {
                          echo"<div class=\"carousel-item active\">";
                          $j++;
                          echo"<a href=\"$current_post_link\">
                                <div>
                                    <img class=\"d-block img-fluid carousel_background\" src=\"$current_post_img\" alt=\"\">
                                    <div class=\"carousel-caption d-md-block\">
                                        <h3 class=\"carousel_caption\">$current_post_title</h3>
                                    </div>
                                </div>
                                </a>
                                </div>";
                        } else {
                            echo"<div class=\"carousel-item\">";
                            $j++;
                            echo"<a href=\"$current_post_link\">
                                  <div>
                                      <img class=\"d-block img-fluid carousel_background\" src=\"$current_post_img\" alt=\"\">
                                      <div class=\"carousel-caption d-md-block\">
                                          <h3 class=\"carousel_caption\">$current_post_title</h3>
                                      </div>
                                  </div>
                                  </a>
                                  </div>";
                          }
                    }
                  wp_reset_query();

                  //banner buttons
                  echo"
                  </div>
                  <a class=\"carousel-control-prev\" href=\"#carouselIndicators\" role=\"button\" data-slide=\"prev\">
                    <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Previous</span>
                  </a>
                  <a class=\"carousel-control-next\" href=\"#carouselIndicators\" role=\"button\" data-slide=\"next\">
                    <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Next</span>
                  </a>
                </div>";
            }
            ?>
            <?php if ( function_exists( 'the_custom_logo' ) ) {
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                $link = esc_url( home_url('/') );
                if ( has_custom_logo() ) {
                    echo"<div><a href=\"$link\"><img class=\"site-logo\" src=\"$image[0]\" alt=\"\"></a></div>";
                }
            }?>
        </header>
        <?php get_template_part('loops/content', 'page'); ?>
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