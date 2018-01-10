<?php 
get_header();
?>
<!-- Banner -->
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/front-end-skills.png'); ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Front-end Blog</h1>
      <h2 class="headline headline--medium">Hej ten blog jest dla osób, które zamierzają wkroczyć do świata Web masterki</h2>
      <h3 class="headline headline--small">Sprawdź co Cię zainteresuje.</h3>
      <a href="<?php echo get_post_type_archive_link('program'); ?>" class="btn btn--large btn--blue">Kategorie</a>
    </div>
  </div>
  <!-- Events -->
  <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Nadchodzące wydarzenia</h2>
        <?php
          $today = date('Ymd');
          $homepageEvents = new WP_Query(array(
            'posts_per_page'  => 2,
            'post_type'       => 'event',
            'meta_key'        => 'event_date',
            'orderby'         => 'meta_value_num',
            'order'           => 'ASC',
            'meta_query'      => array(
              array(
                'key'       => 'event_date',
                'compare'   => '>=',
                'value'     => $today,
                'type'      => 'numeric'
              )
            )
          ));

          while($homepageEvents->have_posts()){
            $homepageEvents->the_post(); 
            get_template_part('template-parts/content', 'event');
          }
        ?>
        
        
        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>

      </div>
    </div>
    <!-- Blog new posts -->
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Najnowsze wpisy</h2>
        <?php
          $homepagePosts = new WP_Query(array(
            'posts_per_page' => 2
          ));
          
          while($homepagePosts->have_posts()){
            $homepagePosts->the_post();?>
            
        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php the_time('M') ?></span>
            <span class="event-summary__day"><?php the_time('d') ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php if(has_excerpt()){
              the_excerpt();
            }else{
              echo wp_trim_words(get_the_content(), 18);
            } ?><a href="<?php the_permalink(); ?>" class="nu gray"> Read more</a></p>
          </div>
        </div>
        <?php
          } wp_reset_postdata();
        ?>
        <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
      </div>
    </div>
  </div>
  <!-- Slider -->
  <div class="hero-slider">
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg'); ?>">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Zasada #1</h2>
        <p class="t-center">Szukaj nowoczesnego kodu</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue"> Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/apples.jpg'); ?>">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Zasada #2</h2>
        <p class="t-center">Pracuj z nowoczesnymi wzorcami</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg'); ?>">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Zasada #3</h2>
        <p class="t-center">Zdobądź wiedzę potrzebną w zawodzie.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue"> Learn more</a></p>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
?>