<?php
/**
 * The Template for displaying all single products
 *
 * @package Joyeria_Angy
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<main class="section-padding">
    <div class="container">
        
        <?php while ( have_posts() ) : the_post(); global $product; ?>
            
            <div class="product-detail-grid">
                
                <!-- Galería de Joyería -->
                <div class="product-gallery-main">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'full' ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/anillo-solitario.jpg' ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                </div>

                <!-- Información del Producto -->
                <div class="product-detail-info">
                    <span class="product-meta-tag">Joyería Fina Certificada</span>
                    <h1 class="hero-title text-gradient-silver" style="font-size: clamp(2rem, 3.5vw, 2.8rem); margin-bottom: 0.8rem;">
                        <?php the_title(); ?>
                    </h1>

                    <div class="product-rating" style="margin-bottom: 1.2rem;">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="rating-count">(Calificación 4.9/5 • 48 compradores)</span>
                    </div>

                    <div class="product-price-row" style="margin-bottom: 1.5rem;">
                        <span class="current-price" style="font-size: 2rem;">
                            <?php echo $product ? $product->get_price_html() : '$1,290.00 MXN'; ?>
                        </span>
                    </div>

                    <p style="margin-bottom: 1.5rem; line-height: 1.7;">
                        <?php echo $product ? $product->get_short_description() : 'Elegante joya forjada en auténtica Plata Esterlina Ley .925 con acabado pulido brillante. Incluye quintado de autenticidad, estuche de regalo acolchado y certificado oficial.'; ?>
                    </p>

                    <!-- Selector de Tallas con botón a Guía -->
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem;">
                            <label style="font-size: 0.9rem; font-weight:600; color:#ffffff;">Selecciona tu Talla:</label>
                            <a href="#" class="open-ring-sizer-btn" style="font-size: 0.82rem; color: #38bdf8; text-decoration: underline;">
                                <i class="fa-solid fa-ruler-combined"></i> ¿Cómo saber mi talla?
                            </a>
                        </div>
                        <div class="size-selector-grid">
                            <button type="button" class="size-pill">Talla 5</button>
                            <button type="button" class="size-pill">Talla 6</button>
                            <button type="button" class="size-pill selected">Talla 7</button>
                            <button type="button" class="size-pill">Talla 8</button>
                            <button type="button" class="size-pill">Talla 9</button>
                            <button type="button" class="size-pill">Talla 10</button>
                        </div>
                    </div>

                    <!-- Ficha de Especificaciones Rápidas -->
                    <div class="detail-specs-box">
                        <div class="spec-item">
                            <span class="spec-name">Pureza de Metal:</span>
                            <span class="spec-val">Plata Ley .925 (Quintado Grabado)</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-name">Empaque:</span>
                            <span class="spec-val">Estuche Rígido + Bolsa Terciopelo</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-name">Envío:</span>
                            <span class="spec-val">Express a todo México (24-48 hrs)</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-name">Garantía:</span>
                            <span class="spec-val">Autenticidad de por vida</span>
                        </div>
                    </div>

                    <!-- Botones de Acción de Compra -->
                    <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1.5rem;">
                        <button type="button" class="btn btn-primary add-to-cart-quick" data-id="<?php echo get_the_ID(); ?>" data-price="<?php echo $product ? $product->get_price() : '1290'; ?>" style="width: 100%;">
                            <i class="fa-solid fa-bag-shopping"></i> Añadir a mi Carrito
                        </button>
                        <a href="#" class="btn btn-whatsapp btn-whatsapp-product" data-title="<?php the_title_attribute(); ?>" data-price="<?php echo $product ? $product->get_price() : '1290'; ?>" style="width: 100%;">
                            <i class="fa-brands fa-whatsapp"></i> Comprar Directo por WhatsApp
                        </a>
                    </div>

                </div>

            </div>

            <!-- Pestañas Adicionales de WooCommerce -->
            <div style="margin-top: 4.5rem;">
                <?php woocommerce_output_product_data_tabs(); ?>
            </div>

            <!-- Productos Relacionados -->
            <div style="margin-top: 4.5rem;">
                <?php woocommerce_output_related_products(); ?>
            </div>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer( 'shop' ); ?>
