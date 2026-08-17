<?php
/**
 * The Header template for Joyería Angy
 *
 * @package Joyeria_Angy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Barra Superior de Anuncios y Garantía -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-announcement">
            <span class="top-badge-pulse"></span>
            <span><?php echo esc_html( get_theme_mod( 'joyeria_announcement_text', '✨ Envío Gratis en compras mayores a $1,499 MXN | Plata Ley .925 Garantizada' ) ); ?></span>
        </div>
        <div class="top-bar-links">
            <a href="<?php echo esc_url( home_url( '/guia-de-tallas' ) ); ?>" class="top-bar-link open-ring-sizer-btn">
                <i class="fa-solid fa-ruler-combined"></i> Medidor de Anillos
            </a>
            <a href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' ) ); ?>" target="_blank" class="top-bar-link">
                <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i> Atención Personalizada
            </a>
        </div>
    </div>
</div>

<!-- Cabecera Principal Sticky con Glassmorphism -->
<header class="site-header" id="siteHeader">
    <div class="container">
        <div class="nav-wrapper">
            
            <!-- Logo de Joyería Angy -->
            <div class="site-brand">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="brand-name">Joyería Angy</span>
                    </a>
                    <span class="brand-subtitle">Plata Ley .925 & Acero</span>
                <?php endif; ?>
            </div>

            <!-- Menú de Navegación Principal -->
            <nav class="main-navigation" aria-label="<?php esc_attr_e( 'Menú Principal', 'joyeria-angy' ); ?>">
                <ul class="main-nav">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link active">Inicio</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="nav-link">Catálogo</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/anillos' ) ); ?>" class="nav-link">Anillos</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/cadenas-y-dijes' ) ); ?>" class="nav-link">Collares & Dijes</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/pulseras' ) ); ?>" class="nav-link">Pulseras</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/aretes' ) ); ?>" class="nav-link">Aretes</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/parejas' ) ); ?>" class="nav-link">Parejas <span class="nav-badge-new">HOT</span></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/cuidados-de-la-plata' ) ); ?>" class="nav-link">Cuidados</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" class="nav-link">Contacto</a></li>
                </ul>
            </nav>

            <!-- Acciones: Buscador, Favoritos, Carrito y WhatsApp -->
            <div class="header-actions">
                <div class="search-trigger-box">
                    <i class="fa-solid fa-magnifying-glass search-icon-inside"></i>
                    <input type="text" placeholder="Buscar joyas..." class="search-input-header" id="globalSearchInput">
                </div>

                <button class="icon-action-btn open-ring-sizer-btn" title="Medidor de Tallas de Anillos">
                    <i class="fa-solid fa-circle-dot"></i>
                </button>

                <button class="icon-action-btn cart-toggle-btn" title="Ver Carrito de Joyería">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="cart-count-badge">1</span>
                </button>

                <a href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' ) ); ?>" target="_blank" class="btn btn-whatsapp btn-sm" style="display: none;">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                </a>

                <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Abrir Menú">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

        </div>
    </div>
</header>
