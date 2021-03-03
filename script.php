 <?php
                    // задаем нужные нам критерии выборки данных из БД
                        $args = array(
                            'post_type' => 'designs',
                            'posts_per_page' => 6,
                            'order' => 'DESK',
                            'orderby' => 'date',
                            'paged' => get_query_var('paged') ?: 1 // страница пагинации
                        );

                        $query = new WP_Query( $args );
                        
                        // Цикл
                        
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post(); ?>
                        <div class="col-sm-4">
                        <a href="<?php the_permalink(); ?>">
                            <div class="designItem bg-set"
                                style="background-image: url('<?php the_post_thumbnail_url();?>');">
                                <div class="designItemTitleBlock">
                                    <h6 class="designItemTitleBlock__title"><?php the_title(); ?></h6>
                                </div>
                                <?php $terms = get_the_terms( $post->ID, 'mrp_style'); ?>
                                <div class="designItemStyle">
                                    <?php foreach ($terms as $term):?>
                                        <span><?=$term -> name;?></span>
                                    <?endforeach?>
                                </div>
                        </div>
                        </a>
                    </div>
                    <!-- end item  -->
                    <?php } ?>
                   
                       <?php } else {
                            // Постов не найдено
                        }
                        // Возвращаем оригинальные данные поста. Сбрасываем $post.
                        wp_reset_postdata(); ?>


                </div>
                <div class="pag-wrap">
                    <div class="pagination">
                        <?php 
                            echo paginate_links( array(
                                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                'total'        => $query->max_num_pages,
                                'current'      => max( 1, get_query_var( 'paged' ) ),
                                'format'       => '?paged=%#%',
                                'show_all'     => false,
                                'type'         => 'plain',
                                'end_size'     => 2,
                                'mid_size'     => 1,
                                'prev_next'    => true,
                                'prev_text'    => 'Предыдущая страница',
                                'next_text'    => 'Следующая страница',
                                'add_args'     => false,
                                'add_fragment' => '',
                            ) );
                        ?>
