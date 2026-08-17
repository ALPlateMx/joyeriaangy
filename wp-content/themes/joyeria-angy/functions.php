<?php
/**
 * Joyería Angy Theme Functions & Definitions
 * Plata Ley .925 y Acero Inoxidable con Módulo de Administración e Inventario
 *
 * @package Joyeria_Angy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * 1. Configuración Básica del Tema
 */
function joyeria_angy_setup() {
    load_theme_textdomain( 'joyeria-angy', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 600, 600, true );
    add_image_size( 'joyeria-large', 1200, 1200, false );
    add_image_size( 'joyeria-catalog', 600, 600, true );

    register_nav_menus( array(
        'primary' => __( 'Menú Principal de Joyería', 'joyeria-angy' ),
        'footer'  => __( 'Menú del Pie de Página', 'joyeria-angy' ),
        'categories' => __( 'Menú de Categorías de Plata', 'joyeria-angy' ),
    ) );

    add_theme_support( 'custom-logo', array(
        'height'      => 90,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 1000,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 6,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'joyeria_angy_setup' );

/**
 * 2. Carga de Estilos y Scripts
 */
function joyeria_angy_scripts() {
    wp_enqueue_style( 'joyeria-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap', array(), null );
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
    wp_enqueue_style( 'joyeria-style', get_stylesheet_uri(), array(), '1.0.0' );
    wp_enqueue_style( 'joyeria-main-css', get_template_directory_uri() . '/assets/css/main.css', array('joyeria-style'), '1.0.0' );

    wp_enqueue_script( 'joyeria-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );
    wp_localize_script( 'joyeria-main-js', 'joyeriaAngyData', array(
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
        'whatsapp'   => get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' ),
        'currency'   => 'MXN',
        'free_ship'  => get_theme_mod( 'joyeria_free_shipping_min', '1499' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'joyeria_angy_scripts' );

/**
 * 3. Opciones del Personalizador (Theme Customizer)
 */
function joyeria_angy_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'joyeria_angy_options', array(
        'title'    => __( 'Opciones de Joyería Angy', 'joyeria-angy' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'joyeria_whatsapp_number', array(
        'default'           => '5215512345678',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'joyeria_whatsapp_number', array(
        'label'    => __( 'Número de WhatsApp (con código de país ej: 521...)', 'joyeria-angy' ),
        'section'  => 'joyeria_angy_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'joyeria_announcement_text', array(
        'default'           => '✨ Envío Gratis en compras mayores a $1,499 MXN | Plata Ley .925 Certificada',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'joyeria_announcement_text', array(
        'label'    => __( 'Texto de la Barra Superior', 'joyeria-angy' ),
        'section'  => 'joyeria_angy_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'joyeria_free_shipping_min', array(
        'default'           => '1499',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'joyeria_free_shipping_min', array(
        'label'    => __( 'Monto mínimo para Envío Gratis ($ MXN)', 'joyeria-angy' ),
        'section'  => 'joyeria_angy_options',
        'type'     => 'number',
    ) );
}
add_action( 'customize_register', 'joyeria_angy_customize_register' );

/**
 * 4. Módulo de Administración de Inventario en el Panel de WordPress (WP-Admin)
 */
function joyeria_angy_register_admin_menu() {
    add_menu_page(
        __( 'Inventario Joyería Angy', 'joyeria-angy' ),
        __( 'Joyería Inventario', 'joyeria-angy' ),
        'manage_options',
        'joyeria-inventario',
        'joyeria_angy_render_admin_inventory_page',
        'dashicons-tag',
        56
    );
}
add_action( 'admin_menu', 'joyeria_angy_register_admin_menu' );

function joyeria_angy_render_admin_inventory_page() {
    ?>
    <div class="wrap" style="max-width: 1200px; margin-top: 20px;">
        <h1 style="display:flex; align-items:center; gap:10px;">
            <span class="dashicons dashicons-gem" style="font-size:32px; width:32px; height:32px; color:#2563eb;"></span>
            <?php _e( 'Control de Inventario y Catálogo - Joyería Angy', 'joyeria-angy' ); ?>
        </h1>
        <p><?php _e( 'Gestiona rápidamente existencias de plata ley .925, piezas en acero quirúrgico, SKU y precios.', 'joyeria-angy' ); ?></p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0;">
            <div style="background:#fff; border-left: 4px solid #38bdf8; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin:0; font-size: 24px; color:#0f172a;" id="wpKpiTotal">5</h3>
                <p style="margin:5px 0 0 0; color:#64748b; font-size:12px; text-transform:uppercase;"><?php _e( 'Modelos Registrados', 'joyeria-angy' ); ?></p>
            </div>
            <div style="background:#fff; border-left: 4px solid #10b981; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin:0; font-size: 24px; color:#0f172a;" id="wpKpiStock">50</h3>
                <p style="margin:5px 0 0 0; color:#64748b; font-size:12px; text-transform:uppercase;"><?php _e( 'Piezas Totales en Stock', 'joyeria-angy' ); ?></p>
            </div>
            <div style="background:#fff; border-left: 4px solid #f59e0b; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin:0; font-size: 24px; color:#0f172a;" id="wpKpiAlerts">1</h3>
                <p style="margin:5px 0 0 0; color:#64748b; font-size:12px; text-transform:uppercase;"><?php _e( 'Stock Bajo (≤ 3 pzas)', 'joyeria-angy' ); ?></p>
            </div>
        </div>

        <div style="background:#fff; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 6px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 15px;">
                <h2 style="margin:0; font-size:18px;"><?php _e( 'Listado de Joyas en Almacén', 'joyeria-angy' ); ?></h2>
                <a href="<?php echo esc_url( admin_url('post-new.php?post_type=product') ); ?>" class="button button-primary">+ <?php _e( 'Crear Producto WooCommerce', 'joyeria-angy' ); ?></a>
            </div>

            <table class="wp-list-table widefat fixed striped table-view-list">
                <thead>
                    <tr>
                        <th style="width: 100px;"><?php _e( 'SKU', 'joyeria-angy' ); ?></th>
                        <th><?php _e( 'Nombre de la Joya', 'joyeria-angy' ); ?></th>
                        <th><?php _e( 'Material / Pureza', 'joyeria-angy' ); ?></th>
                        <th><?php _e( 'Precio ($ MXN)', 'joyeria-angy' ); ?></th>
                        <th><?php _e( 'Stock Disponible', 'joyeria-angy' ); ?></th>
                        <th><?php _e( 'Estado', 'joyeria-angy' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>ANGY-AN-001</strong></td>
                        <td>Anillo Solitario Diamante Simulado Plata .925</td>
                        <td>Plata Ley .925 Quintada</td>
                        <td>$1,290.00</td>
                        <td><input type="number" value="14" style="width:70px;" min="0"></td>
                        <td><span style="color:#059669; font-weight:600;">● Disponible</span></td>
                    </tr>
                    <tr>
                        <td><strong>ANGY-CO-002</strong></td>
                        <td>Gargantilla Corazón de Cristal Zafiro Plata .925</td>
                        <td>Plata Ley .925 & Baño Rodio</td>
                        <td>$1,150.00</td>
                        <td><input type="number" value="8" style="width:70px;" min="0"></td>
                        <td><span style="color:#059669; font-weight:600;">● Disponible</span></td>
                    </tr>
                    <tr>
                        <td><strong>ANGY-PU-003</strong></td>
                        <td>Brazalete Tennis & Eslabón Doble Plata Italiana .925</td>
                        <td>Plata Italiana Ley .925</td>
                        <td>$1,590.00</td>
                        <td><input type="number" value="3" style="width:70px; border-color:#f59e0b;" min="0"></td>
                        <td><span style="color:#d97706; font-weight:600;">▲ Stock Bajo</span></td>
                    </tr>
                    <tr>
                        <td><strong>ANGY-AR-004</strong></td>
                        <td>Arracadas Huggies Micro-Pavé Circonias Plata .925</td>
                        <td>Plata Ley .925 Hipoalergénica</td>
                        <td>$890.00</td>
                        <td><input type="number" value="19" style="width:70px;" min="0"></td>
                        <td><span style="color:#059669; font-weight:600;">● Disponible</span></td>
                    </tr>
                    <tr>
                        <td><strong>ANGY-PA-005</strong></td>
                        <td>Dúo Anillos de Promesa 'Forever & Always' Plata .925</td>
                        <td>Plata Ley .925 & Titanio</td>
                        <td>$2,190.00</td>
                        <td><input type="number" value="6" style="width:70px;" min="0"></td>
                        <td><span style="color:#059669; font-weight:600;">● Disponible</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

/**
 * 5. Integraciones y Hooks de WooCommerce para Joyería
 */
if ( class_exists( 'WooCommerce' ) ) {
    add_action( 'woocommerce_after_add_to_cart_button', 'joyeria_add_whatsapp_product_button', 15 );
    function joyeria_add_whatsapp_product_button() {
        global $product;
        if ( ! $product ) return;
        $title = rawurlencode( $product->get_name() );
        $price = $product->get_price();
        $phone = get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' );
        $msg = rawurlencode( "💍 *¡Hola Joyería Angy!* Me gustaría ordenar la pieza: *{$product->get_name()}* ($" . number_format($price, 2) . " MXN) en Plata Ley .925. ¿Tienen disponible para envío?" );
        
        echo '<a href="https://wa.me/' . esc_attr( $phone ) . '?text=' . $msg . '" target="_blank" class="btn btn-whatsapp" style="width: 100%; margin-top: 0.75rem;"><i class="fa-brands fa-whatsapp"></i> ' . __( 'Pedir Directo por WhatsApp', 'joyeria-angy' ) . '</a>';
    }

    add_filter( 'woocommerce_product_tabs', 'joyeria_custom_silver_care_tab' );
    function joyeria_custom_silver_care_tab( $tabs ) {
        $tabs['silver_guarantee_tab'] = array(
            'title'    => __( 'Garantía Plata .925 & Cuidados', 'joyeria-angy' ),
            'priority' => 50,
            'callback' => 'joyeria_silver_care_tab_content',
        );
        return $tabs;
    }

    function joyeria_silver_care_tab_content() {
        echo '<h3>' . __( 'Certificado de Autenticidad Plata Ley .925', 'joyeria-angy' ) . '</h3>';
        echo '<p>' . __( 'Cada una de nuestras joyas está elaborada con auténtica Plata Esterlina Ley .925 (92.5% de plata pura y 7.5% de aleación de metales finos para máxima durabilidad y brillo). Cuenta con quintado oficial .925 grabado en la pieza.', 'joyeria-angy' ) . '</p>';
        echo '<h4>' . __( 'Recomendaciones de cuidado:', 'joyeria-angy' ) . '</h4>';
        echo '<ul>';
        echo '<li>' . __( 'Evita el contacto directo con perfumes, cloro, blanqueadores o productos químicos agresivos.', 'joyeria-angy' ) . '</li>';
        echo '<li>' . __( 'Guarda tus piezas en su estuche o bolsa hermética de Joyería Angy cuando no las uses para prevenir la oxidación natural.', 'joyeria-angy' ) . '</li>';
        echo '<li>' . __( 'Limpia periódicamente con nuestro paño de microfibra abrillantador de plata.', 'joyeria-angy' ) . '</li>';
        echo '</ul>';
    }
}

/**
 * 6. Shortcode para Medidor de Anillos: [joyeria_ring_sizer]
 */
function joyeria_ring_sizer_shortcode() {
    ob_start();
    ?>
    <div class="sizer-calibration-tool">
        <div class="interactive-circle-target" id="sizerCircle" style="width: 99px; height: 99px;"></div>
        <input type="range" min="0" max="15" value="6" class="sizer-slider-input" id="sizerSlider">
        <div class="sizer-values-display">
            <div class="sizer-box-val">
                <h3 id="sizerSizeValue">Talla 7</h3>
                <p>Estándar México / USA</p>
            </div>
            <div class="sizer-box-val">
                <h3 id="sizerMmValue">17.3 mm</h3>
                <p>Diámetro Interior</p>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'joyeria_ring_sizer', 'joyeria_ring_sizer_shortcode' );

/**
 * 7. Datos Estructurados Schema.org JSON-LD para SEO de Joyería
 */
function joyeria_angy_schema_seo() {
    if ( is_front_page() ) {
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'JewelryStore',
            'name'        => get_bloginfo( 'name' ),
            'description' => 'Venta de joyería fina de Plata Ley .925 y Acero Inoxidable en México.',
            'url'         => home_url(),
            'priceRange'  => '$$',
            'telephone'   => get_theme_mod( 'joyeria_whatsapp_number', '+5215512345678' ),
            'paymentAccepted' => 'Cash, Credit Card, Mercado Pago, PayPal, OXXO, SPEI',
            'currenciesAccepted' => 'MXN',
        );
        echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'joyeria_angy_schema_seo' );
