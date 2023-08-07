add_shortcode('trending_posts_blogs', 'trending_posts_blogs');
if (!function_exists('trending_posts_blogs')) {
    function trending_posts_blogs($atts)
    {
        ob_start(); // Turn output buffering on
        global $paged;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $atts = shortcode_atts(
            array(
                'post_type' => 'post',
                // whatever you like
            ),
            $atts
        );
        $args = array(
            'posts_per_page' => 2,
            'paged' => $paged,
            'post_type' => $atts['post_type'],
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {
           while ( $the_query->have_posts() ) {
$the_query->the_post();
$category_detail=get_the_category();
$thumbnail = '<div class="thumbnail">'.get_the_post_thumbnail().'</div>';
echo '<div class="items"><div><a href="'.get_permalink().'">'. $thumbnail . '</a><div class="detadesc"><div class="meta">
</div><h4><a href="'.get_permalink().'">'.get_the_title() . '</a></h4>
<div class="posted"> <span> POSTED ON</span>
<div>'.get_the_date(). '</div>  </div>
<div class="cat_author">
<a class="catdesc" href="/category/'.$category_detail[0]->slug.'/"> Category:'.$category_detail[0]->name.'</a> | <a class="post_author">Author: '.get_the_author().'</a>
</div>
<p>'.wp_trim_words(get_the_excerpt(),25).'</p>

</div></div></div>';

}

            $big = 999999999; // need an unlikely integer
            echo paginate_links(
                array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(
                        1,
                        get_query_var('paged')
                    ),
                    'total' => $the_query->max_num_pages //$q is your custom query
                )
            );
        } // Pagination inside the endif
        return ob_get_clean(); // Silently discard the buffer contents
        wp_reset_query(); // Lets go back to the main_query() after returning our buffered content
    }
}
