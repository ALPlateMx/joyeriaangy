<?php
/**
 * Main Template File (Fallback)
 *
 * @package Joyeria_Angy
 */

get_header(); ?>

<main class="section-padding">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <header class="section-header">
                <h1 class="text-gradient-silver"><?php single_post_title(); ?></h1>
            </header>

            <div class="glass-panel" style="padding: 2.5rem; max-width: 900px; margin: 0 auto;">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="section-header">
                <h2 class="text-gradient-silver">No se encontró contenido</h2>
                <p>Por favor regresa a la <a href="<?php echo esc_url( home_url('/') ); ?>" style="color: #38bdf8; text-decoration: underline;">página principal</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
