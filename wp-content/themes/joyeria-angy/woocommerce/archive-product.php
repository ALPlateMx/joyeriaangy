<?php
/**
 * The Template for displaying product archives (Shop page)
 *
 * @package Joyeria_Angy
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<main class="section-padding">
    <div class="container">
        
        <header class="section-header">
            <span class="section-subtitle">Alta Joyería en Plata .925 & Acero</span>
            <h1 class="text-gradient-silver"><?php woocommerce_page_title(); ?></h1>
            <p>Piezas exclusivas con certificado de autenticidad, acabados de espejo y empaque de regalo incluido.</p>
        </header>

        <!-- Filtros Rápidos -->
        <div class="product-tabs" style="margin-bottom: 3rem;">
            <button class="tab-btn active" data-category="all">Todas las Joyas</button>
            <button class="tab-btn" data-category="anillos">Anillos</button>
            <button class="tab-btn" data-category="collares">Collares & Dijes</button>
            <button class="tab-btn" data-category="pulseras">Pulseras</button>
            <button class="tab-btn" data-category="aretes">Aretes</button>
            <button class="tab-btn" data-category="parejas">Parejas & Boda</button>
        </div>

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="products-grid">
                <?php
                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                        wc_get_template_part( 'content', 'product' );
                    }
                }
                ?>
            </div>

            <div style="margin-top: 3.5rem; display: flex; justify-content: center;">
                <?php woocommerce_pagination(); ?>
            </div>

        <?php else : ?>

            <div class="glass-panel" style="padding: 3rem; text-align: center; max-width: 600px; margin: 0 auto;">
                <i class="fa-solid fa-gem" style="font-size: 2.5rem; color: #38bdf8; margin-bottom: 1rem;"></i>
                <h3 class="text-gradient-silver" style="margin-bottom: 0.5rem;">No hay productos en esta categoría</h3>
                <p style="margin-bottom: 1.5rem;">Pronto añadiremos nuevas piezas de plata .925 a esta colección.</p>
                <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="btn btn-primary">
                    Ver Toda la Tienda
                </a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer( 'shop' ); ?>
