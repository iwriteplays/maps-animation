<?php /* Template Name: Home Page  */ get_header(); ?>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <main role="main" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <section class="marquee retina-img" <?php echo retinaMarquee( "marquees", "",true); ?>>
                <div class="inner">
                    <h1>
                    			<span>Welcome to</span>
                    			    Northern Colorado
                    			    </h1>
                    <h2><?php the_field('tagline'); ?></h2>
                    <p>
                        <?php the_field('intro_text'); ?>
                    </p>
                    <a href="<?php echo get_the_permalink(50); ?>" class="btn btn-info">Why Northern Colorado</a>
                </div>
            </section>
            <!-- section.marquee-->

            <div class="sep dropshadow"></div>

            <section class="why-noco ">
                <div class="container-fluid animated">
                    <div class="map ">
                        <h3 class="under">Why Northern Colorado</h3>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/map-noco-fade.jpg" alt="Colorado Map">
                    </div>

                    <div class="reasons">
                        <?php if(have_rows('reasons')): $i = 0; while(have_rows('reasons')): the_row(); $i++; ?>
                            <div class="reason reason-<?php echo $i ?>">
                                <div class="count animated">
                                    <?php echo $i; ?>
                                </div>
                                <div class="inner">
                                    <div class="title">
                                        <?php the_sub_field('title'); ?>
                                    </div>
                                    <div class="reason">
                                        <?php the_sub_field('copy'); ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php endwhile; endif; ?>
                    </div>
                </div>
            </section>


            <section class="ctas">
                <div class="container">
                    <?php if(have_rows('cta')): $i = 0; while(have_rows('cta')): the_row(); $i++; ?>
                        <div class="cta cta-<?php echo $i ?>">
                            <div class="inner">
                                <div class="cta-icon" <?php echo bgImg( 'thumbnail', "full",true, ""); ?>></div>
                                <h5 class="title"><?php the_sub_field('title'); ?></h5>
                                <p>
                                    <?php the_sub_field('description'); ?>
                                </p>
                                <a href="<?php the_sub_field('link'); ?>" class="btn btn-info">Read More</a>
                            </div>

                        </div>
                        <?php endwhile; endif; ?>
                </div>
            </section>


            <?php get_template_part('inc/rankings'); ?>

                <?php endwhile; endif; ?>

                    <section class="key-industries flush">
                        <h3 class="under intro">Key <br>Industries</h3>
                        <?php get_template_part('loops/industries-home'); ?>
                            <a href="<?php echo site_url(); ?>/industries" class="inner blur-out more" <?php echo bgImg( "industries_marquee", "",false, "options"); ?> ></a>

                    </section>

                    <?php  if (have_posts()): while (have_posts()) : the_post();  ?>

                        <section class="about-ncea" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/green-bg.png)">
                            <div class="logo">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/logo-mark-color.svg" alt="NCEA Logo">
                            </div>
                            <div class="content">
                                <h3><?php the_field('headline'); ?></h3>
                                <h4><?php the_field('subhead'); ?></h4>

                                <?php the_field('copy'); ?>
                                    <a href="<?php echo get_the_permalink(59); ?>" class="btn btn-info">About One NoCo</a>
                            </div>
                        </section>

                        <section class="connected retina-img" <?php echo retinaMarquee( "marquee",57,false); ?> >

                            <h3>Contact Us</h3>
                            <a href="<?php echo get_the_permalink(57); ?>" class="btn btn-info">Get in touch</a>
                        </section>


                        <div class="sep"></div>

                        <?php endwhile; ?>

                            <?php else: ?>

                                <!-- article -->
                                <article>

                                    <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

                                </article>
                                <!-- /article -->
        </main>
        <?php endif; ?>




            <?php get_footer(); ?>
