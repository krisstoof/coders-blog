<?php 
get_header();
pageBanner(array(
    'title'     => 'Poprzednie Wydarzenia',
    'subtitle'  => 'Spis minionych wydarzeń.'
  ));
?>

<div class="container container--narrow page-section">
    <?php
    $today = date('Ymd');
    $pastEvents = new WP_Query(array(
        'paged'           => get_query_var('paged', 1),
        'posts_per_page'  => 2,
        'post_type'       => 'event',
        'meta_key'        => 'event_date',
        'orderby'         => 'meta_value_num',
        'order'           => 'DESC',
        'meta_query'      => array(
        array(
            'key'       => 'event_date',
            'compare'   => '<',
            'value'     => $today,
            'type'      => 'numeric'
        )
      )
    ));
        while($pastEvents->have_posts()){
            $pastEvents->the_post();
            get_template_part('template-parts/content-event');
        } 
        echo paginate_links(array(
            'total'     => $pastEvents->max_num_pages
        ));
      ?>
</div>
<?php
get_footer();
?>