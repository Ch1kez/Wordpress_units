<?php
/*
 * Template Name: Политика в отношении обработки персональных данных
 */
get_header();
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php the_title(); ?></title>
            <style>

            </style>
        </head>
        <body>
        <div class="container">
            <?php get_template_part('templates/breadcrumbs'); ?>
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <main class="main-content">
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-1 col-lg-10">
                                <h1 class="main-content__heading">
                                    <?php the_title(); ?>
                                </h1>
                                <div class="main-content__content article-content">
                                    <?php the_content(); ?>
                                    <div class="button-container">
                                        <?php get_template_part('templates/politica-confidencialnosti', 'doc'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        </body>
        </html>
    <?php
    endwhile;
endif;
get_footer();
?>
