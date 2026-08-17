<?php
/**
 * Joyería Angy Theme Functions & Definitions
 * Plata Ley .925 y Acero Inoxidable
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
    // Soporte para traducción
    load_theme_textdomain( 'joyeria-angy', get_template_directory() . '/languages' );

    // Soporte para etiquetas del título automáticas
    add_theme_support( 'title-tag' );

    // Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 600, 600, true );
    add_image_size( 'joyeria-large', 1200, 1200, false );
    add_image_size( 'joyeria-catalog', 600, 600, true );

    // Registro de menús de navegación
    register_nav_menus( array(
        'primary' => __( 'Menú Principal de Joyería', 'joyeria-angy' ),
        'footer'  => __( 'Menú del Pie de Página', 'joyeria-angy' ),
        'categories' => __( 'Menú de Categorías de Plata', 'joyeria-angy' ),
    ) );

    // Soporte para logo personalizado
    add_theme_support( 'custom-logo', array(
        'height'      => 90,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Soporte para HTML5 semántico
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Soporte completo para WooCommerce
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
    // Fuentes Google Fonts: Cormorant Garamond (Editorial) y Outfit (Moderna)
    wp_enqueue_style( 'joyeria-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap', array(), null );
    
    // Iconos FontAwesome 6
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );

    // Estilos del tema
    wp_enqueue_style( 'joyeria-style', get_stylesheet_uri(), array(), '1.0.0' );
    wp_enqueue_style( 'joyeria-main-css', get_template_directory_uri() . '/assets/css/main.css', array('joyeria-style'), '1.0.0' );

    // JavaScript Principal
    wp_enqueue_script( 'joyeria-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

    // Pasar variables dinámicas al JS (WhatsApp, URLs, AJAX)
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
    // Sección: Ajustes de Joyería Angy
    $wp_customize->add_section( 'joyeria_angy_options', array(
        'title'    => __( 'Opciones de Joyería Angy', 'joyeria-angy' ),
        'priority' => 30,
    ) );

    // Teléfono de WhatsApp
    $wp_customize->add_setting( 'joyeria_whatsapp_number', array(
        'default'           => '5215512345678',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'joyeria_whatsapp_number', array(
        'label'    => __( 'Número de WhatsApp (con código de país ej: 521...)', 'joyeria-angy' ),
        'section'  => 'joyeria_angy_options',
        'type'     => 'text',
    ) );

    // Barra de Anuncio Superior
    $wp_customize->add_setting( 'joyeria_announcement_text', array(
        'default'           => '✨ Envío Gratis en compras mayores a $1,499 MXN | Plata Ley .925 Certificada',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'joyeria_announcement_text', array(
        'label'    => __( 'Texto de la Barra Superior', 'joyeria-angy' ),
        'section'  => 'joyeria_angy_options',
        'type'     => 'text',
    ) );

    // Monto mínimo para envío gratis
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
 * 4. Integraciones y Hooks de WooCommerce para Joyería
 */
if ( class_exists( 'WooCommerce' ) ) {
    
    // Botón de WhatsApp en la Ficha de Producto Individual
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

    // Pestaña personalizada de Garantía y Cuidados de la Plata .925
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
 * 5. Shortcode para Medidor de Anillos: [joyeria_ring_sizer]
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
 * 6. Datos Estructurados Schema.org JSON-LD para SEO de Joyería
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
