<?php get_header(); ?>

    <main role="main">



        <section class="community-map marquee">
            <?php include_once('inc/community-map.php'); ?>
        </section>

        <section class="community-mobile visible-xs marquee">
            <h1 class="under"><?php _e( 'Communities', 'html5blank' ); ?></h1>
            <div class="intro">
                <?php the_field('communities_tagline','option'); ?>
                    <?php the_field('communities_blurb','option'); ?>
            </div>
        </section>

        <div class="sep"></div>

        <section class="loop">
            <?php get_template_part('loops/community'); ?>

        </section>

        <?php get_template_part('inc/get-in-touch'); ?>
    </main>








    <?php get_footer(); ?>
