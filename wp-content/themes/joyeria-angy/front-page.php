<?php
/**
 * The Front Page template for Joyería Angy
 *
 * @package Joyeria_Angy
 */

get_header(); ?>

<!-- 1. HERO SECTION EDITORIAL (ESTÉTICA VERAE) -->
<section class="hero-editorial">
    <div class="container">
        <div class="hero-editorial-grid">
            
            <!-- Lado Izquierdo: Textos y Botones Píldora -->
            <div class="hero-text-side">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(212, 163, 115, 0.12); border: 1px solid var(--border-gold); padding: 0.35rem 1rem; border-radius: var(--radius-full); font-size: 0.8rem; color: #f3e9dc; margin-bottom: 1.5rem;">
                    <span class="top-badge-pulse"></span> Colección Exclusiva 2026 • Plata Ley .925
                </div>
                <h1 class="hero-editorial-title">
                    Elegance On<br>Your Terms.
                </h1>
                <p class="hero-editorial-desc">
                    Piezas de alta joyería en auténtica Plata Esterlina Ley .925 y Acero Quirúrgico 316L, esculpidas con acabados de espejo y gemas de brillo eterno para elevar tu estilo diario.
                </p>
                <div class="hero-pill-group">
                    <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary">
                        <i class="fa-solid fa-sparkles"></i> Descubrir Colección
                    </a>
                    <a href="#medidor-tallas" class="btn btn-outline-silver open-ring-sizer-btn">
                        <i class="fa-solid fa-ruler-combined"></i> Medir mi Talla
                    </a>
                </div>
            </div>

            <!-- Lado Derecho: Retrato de Modelo y Widget Flotante Glassmorphism -->
            <div class="hero-visual-side">
                <div class="hero-model-container">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-model.jpg' ); ?>" alt="Joyería Angy Colección Editorial Plata .925">
                </div>

                <!-- Widget Flotante Glassmorphism (Como en la Imagen de Referencia) -->
                <div class="hero-floating-widget">
                    <div class="widget-product-row">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/anillo-solitario.jpg' ); ?>" alt="Anillo Solitario" class="widget-thumb">
                        <div>
                            <h5 class="widget-p-title">Solitario Diamante .925</h5>
                            <span class="widget-p-meta"><i class="fa-solid fa-star" style="color: #d4a373;"></i> 4.9 • $1,290 MXN</span>
                        </div>
                    </div>
                    <div class="widget-stats-grid">
                        <div class="widget-stat-box">
                            <strong>+25k</strong>
                            <span>Clientes</span>
                        </div>
                        <div class="widget-stat-box">
                            <strong>.925</strong>
                            <span>Quintada</span>
                        </div>
                        <div class="widget-stat-box">
                            <strong>100%</strong>
                            <span>Garantía</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 2. SELLOS DE GARANTÍA Y VALOR -->
<section class="trust-banner">
    <div class="container">
        <div class="trust-grid">
            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-solid fa-certificate"></i>
                </div>
                <div class="trust-text">
                    <h4>Plata Ley .925 Quintada</h4>
                    <p>Cada pieza incluye su sello oficial .925 y certificado de pureza garantizada.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-solid fa-gift"></i>
                </div>
                <div class="trust-text">
                    <h4>Empaque de Regalo Gratis</h4>
                    <p>Estuche rígido de lujo, morral de terciopelo y moño de regalo en cada orden.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div class="trust-text">
                    <h4>Envío Asegurado Express</h4>
                    <p>Envíos rápidos a todo México con guía de rastreo y seguro contra extravío.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i>
                </div>
                <div class="trust-text">
                    <h4>Atención Personalizada</h4>
                    <p>Asesoría inmediata por WhatsApp para elegir la talla y modelo ideal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. CATEGORÍAS DESTACADAS -->
<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Explora por Categoría</span>
            <h2 class="text-gradient-silver">Joyas para Cada Momento Especial</h2>
            <p>Diseños contemporáneos trabajados con precisión milimétrica en plata fina y acero 316L.</p>
        </div>

        <div class="categories-grid">
            <!-- Categoría 1: Anillos -->
            <div class="category-card" onclick="window.location.href='<?php echo esc_url( home_url( '/categoria/anillos' ) ); ?>'">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/anillo-solitario.jpg' ); ?>" alt="Anillos de Plata .925">
                <div class="category-overlay">
                    <h3 class="category-title">Anillos & Solitarios</h3>
                    <span class="category-count">Ver 24 Modelos &rarr;</span>
                </div>
            </div>

            <!-- Categoría 2: Collares y Dijes -->
            <div class="category-card" onclick="window.location.href='<?php echo esc_url( home_url( '/categoria/cadenas-y-dijes' ) ); ?>'">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/collar-corazon.jpg' ); ?>" alt="Collares y Dijes Plata .925">
                <div class="category-overlay">
                    <h3 class="category-title">Collares & Dijes</h3>
                    <span class="category-count">Ver 18 Modelos &rarr;</span>
                </div>
            </div>

            <!-- Categoría 3: Pulseras -->
            <div class="category-card" onclick="window.location.href='<?php echo esc_url( home_url( '/categoria/pulseras' ) ); ?>'">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pulsera-eslabones.jpg' ); ?>" alt="Pulseras de Plata .925">
                <div class="category-overlay">
                    <h3 class="category-title">Pulseras & Eslabones</h3>
                    <span class="category-count">Ver 16 Modelos &rarr;</span>
                </div>
            </div>

            <!-- Categoría 4: Aretes -->
            <div class="category-card" onclick="window.location.href='<?php echo esc_url( home_url( '/categoria/aretes' ) ); ?>'">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/aretes-arracadas.jpg' ); ?>" alt="Aretes y Arracadas Plata .925">
                <div class="category-overlay">
                    <h3 class="category-title">Aretes & Arracadas</h3>
                    <span class="category-count">Ver 20 Modelos &rarr;</span>
                </div>
            </div>

            <!-- Categoría 5: Parejas -->
            <div class="category-card" onclick="window.location.href='<?php echo esc_url( home_url( '/categoria/parejas' ) ); ?>'">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/anillos-pareja.jpg' ); ?>" alt="Anillos para Pareja Plata .925">
                <div class="category-overlay">
                    <h3 class="category-title">Dúos de Promesa & Boda</h3>
                    <span class="category-count">Ver 12 Dúos &rarr;</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. CATÁLOGO DESTACADO / MÁS VENDIDOS -->
<section class="section-padding" style="background: rgba(15, 23, 42, 0.4);">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Lo Más Deseado</span>
            <h2 class="text-gradient-silver">Piezas Más Vendidas de Joyería Angy</h2>
            <p>Joyería con alta demanda, disponibilidad limitada y acabados pulidos a mano.</p>
        </div>

        <!-- Filtros de Pestañas -->
        <div class="product-tabs">
            <button class="tab-btn active" data-category="all">Todos</button>
            <button class="tab-btn" data-category="anillos">Anillos</button>
            <button class="tab-btn" data-category="collares">Collares</button>
            <button class="tab-btn" data-category="pulseras">Pulseras</button>
            <button class="tab-btn" data-category="aretes">Aretes</button>
            <button class="tab-btn" data-category="parejas">Parejas</button>
        </div>

        <!-- Grid de Productos -->
        <div class="products-grid">
            
            <!-- Producto 1: Anillo Solitario -->
            <div class="product-card" data-category="anillos">
                <div class="product-image-wrap">
                    <span class="product-badges">
                        <span class="badge badge-hot">Más Vendido</span>
                        <span class="badge badge-silver">Plata .925</span>
                    </span>
                    <div class="product-actions-hover">
                        <button class="action-icon-btn wishlist-btn" data-id="p1" onclick="toggleWishlist('p1', 'Anillo Solitario Brillante .925')"><i class="fa-regular fa-heart"></i></button>
                        <button class="action-icon-btn open-ring-sizer-btn"><i class="fa-solid fa-ruler"></i></button>
                    </div>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/anillo-solitario.jpg' ); ?>" alt="Anillo Solitario Plata .925">
                </div>
                <div class="product-info">
                    <span class="product-meta-tag">Anillos de Compromiso</span>
                    <h4 class="product-title">Anillo Solitario Diamante Simulado Plata .925</h4>
                    <div class="product-rating">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="rating-count">(48 reseñas)</span>
                    </div>
                    <div class="product-price-row">
                        <span class="current-price">$1,290 MXN</span>
                        <span class="regular-price">$1,650 MXN</span>
                    </div>
                    <div class="product-btn-group">
                        <button class="btn btn-primary btn-sm add-to-cart-quick" data-id="prod-1" data-price="1290">
                            <i class="fa-solid fa-bag-shopping"></i> Agregar
                        </button>
                        <a href="#" class="btn btn-whatsapp btn-sm btn-whatsapp-product" data-title="Anillo Solitario Plata .925" data-price="1290">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Producto 2: Collar Corazón Zafiro -->
            <div class="product-card" data-category="collares">
                <div class="product-image-wrap">
                    <span class="product-badges">
                        <span class="badge badge-sale">-20% OFF</span>
                        <span class="badge badge-silver">Plata .925</span>
                    </span>
                    <div class="product-actions-hover">
                        <button class="action-icon-btn wishlist-btn" data-id="p2" onclick="toggleWishlist('p2', 'Gargantilla Corazón de Cristal Zafiro')"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/collar-corazon.jpg' ); ?>" alt="Gargantilla Corazón de Cristal Zafiro">
                </div>
                <div class="product-info">
                    <span class="product-meta-tag">Collares & Dijes</span>
                    <h4 class="product-title">Gargantilla Corazón de Cristal Zafiro Plata .925</h4>
                    <div class="product-rating">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="rating-count">(35 reseñas)</span>
                    </div>
                    <div class="product-price-row">
                        <span class="current-price">$1,150 MXN</span>
                        <span class="regular-price">$1,450 MXN</span>
                    </div>
                    <div class="product-btn-group">
                        <button class="btn btn-primary btn-sm add-to-cart-quick" data-id="prod-2" data-price="1150">
                            <i class="fa-solid fa-bag-shopping"></i> Agregar
                        </button>
                        <a href="#" class="btn btn-whatsapp btn-sm btn-whatsapp-product" data-title="Gargantilla Corazón Cristal Zafiro" data-price="1150">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Producto 3: Pulsera Tenis y Eslabones -->
            <div class="product-card" data-category="pulseras">
                <div class="product-image-wrap">
                    <span class="product-badges">
                        <span class="badge badge-hot">Edición Limitada</span>
                        <span class="badge badge-silver">Plata .925</span>
                    </span>
                    <div class="product-actions-hover">
                        <button class="action-icon-btn wishlist-btn" data-id="p3" onclick="toggleWishlist('p3', 'Brazalete Tennis & Eslabón Combinado')"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pulsera-eslabones.jpg' ); ?>" alt="Brazalete Tennis de Plata .925">
                </div>
                <div class="product-info">
                    <span class="product-meta-tag">Pulseras Finas</span>
                    <h4 class="product-title">Brazalete Tennis & Eslabón Doble Plata Italiana .925</h4>
                    <div class="product-rating">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        <span class="rating-count">(29 reseñas)</span>
                    </div>
                    <div class="product-price-row">
                        <span class="current-price">$1,590 MXN</span>
                        <span class="regular-price">$1,990 MXN</span>
                    </div>
                    <div class="product-btn-group">
                        <button class="btn btn-primary btn-sm add-to-cart-quick" data-id="prod-3" data-price="1590">
                            <i class="fa-solid fa-bag-shopping"></i> Agregar
                        </button>
                        <a href="#" class="btn btn-whatsapp btn-sm btn-whatsapp-product" data-title="Brazalete Tennis Eslabón Plata" data-price="1590">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Producto 4: Aretes Arracadas Micro-Pavé -->
            <div class="product-card" data-category="aretes">
                <div class="product-image-wrap">
                    <span class="product-badges">
                        <span class="badge badge-silver">Plata .925</span>
                    </span>
                    <div class="product-actions-hover">
                        <button class="action-icon-btn wishlist-btn" data-id="p4" onclick="toggleWishlist('p4', 'Arracadas Huggies Pavé Plata')"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/aretes-arracadas.jpg' ); ?>" alt="Arracadas Huggies Pavé Plata .925">
                </div>
                <div class="product-info">
                    <span class="product-meta-tag">Aretes & Arracadas</span>
                    <h4 class="product-title">Arracadas Huggies Micro-Pavé Circonias Plata .925</h4>
                    <div class="product-rating">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="rating-count">(42 reseñas)</span>
                    </div>
                    <div class="product-price-row">
                        <span class="current-price">$890 MXN</span>
                        <span class="regular-price">$1,100 MXN</span>
                    </div>
                    <div class="product-btn-group">
                        <button class="btn btn-primary btn-sm add-to-cart-quick" data-id="prod-4" data-price="890">
                            <i class="fa-solid fa-bag-shopping"></i> Agregar
                        </button>
                        <a href="#" class="btn btn-whatsapp btn-sm btn-whatsapp-product" data-title="Arracadas Huggies Micro-Pavé" data-price="890">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Producto 5: Anillos Dúo Pareja -->
            <div class="product-card" data-category="parejas">
                <div class="product-image-wrap">
                    <span class="product-badges">
                        <span class="badge badge-hot">Dúo Especial</span>
                        <span class="badge badge-silver">Plata .925</span>
                    </span>
                    <div class="product-actions-hover">
                        <button class="action-icon-btn wishlist-btn" data-id="p5" onclick="toggleWishlist('p5', 'Dúo de Anillos de Pareja Eternidad')"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/anillos-pareja.jpg' ); ?>" alt="Dúo de Anillos de Pareja Plata .925">
                </div>
                <div class="product-info">
                    <span class="product-meta-tag">Joyería para Parejas</span>
                    <h4 class="product-title">Dúo Anillos de Promesa 'Forever & Always' Plata .925</h4>
                    <div class="product-rating">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="rating-count">(64 reseñas)</span>
                    </div>
                    <div class="product-price-row">
                        <span class="current-price">$2,190 MXN</span>
                        <span class="regular-price">$2,790 MXN</span>
                    </div>
                    <div class="product-btn-group">
                        <button class="btn btn-primary btn-sm add-to-cart-quick" data-id="prod-5" data-price="2190">
                            <i class="fa-solid fa-bag-shopping"></i> Agregar
                        </button>
                        <a href="#" class="btn btn-whatsapp btn-sm btn-whatsapp-product" data-title="Dúo Anillos Pareja Forever" data-price="2190">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 5. BANNER INTERACTIVO MEDIDOR DE TALLAS -->
<section class="section-padding" id="medidor-tallas">
    <div class="container">
        <div class="ring-sizer-cta">
            <div class="ring-sizer-content">
                <span class="section-subtitle">¿No conoces tu talla exacta?</span>
                <h2 class="text-gradient-silver">Medidor Virtual de Anillos en Pantalla</h2>
                <p>Nuestra herramienta interactiva te permite conocer tu talla precisa en segundos. Solo coloca tu anillo sobre la pantalla o calibra el círculo milimétrico.</p>
                <button class="btn btn-primary open-ring-sizer-btn">
                    <i class="fa-solid fa-circle-dot"></i> Abrir Medidor Interactivo
                </button>
            </div>
            <div class="sizer-preview-visual">
                <div class="virtual-ring-sample">
                    <span>Talla 7</span>
                </div>
                <p style="font-size:0.85rem; color:var(--color-silver-mid);">Calibración milimétrica para México y USA</p>
            </div>
        </div>
    </div>
</section>

<!-- 6. PRESENTACIÓN DE EMPAQUE Y CERTIFICADO -->
<section class="section-padding" style="background: rgba(11, 15, 25, 0.85);">
    <div class="container">
        <div class="product-detail-grid" style="align-items: center;">
            <div class="product-gallery-main">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/empaque-certificado.jpg' ); ?>" alt="Empaque de Regalo y Certificado Joyería Angy">
            </div>
            <div>
                <span class="section-subtitle">Experiencia Unboxing Premium</span>
                <h2 class="text-gradient-silver" style="margin-bottom: 1.25rem;">Listo para Regalar o Sorprender</h2>
                <p style="margin-bottom: 1.25rem;">En Joyería Angy creemos que cada detalle cuenta. Por eso, cada joya se entrega cuidadosamente empacada en nuestro estuche rígido con moño de satén, bolsa de regalo y certificado oficial de autenticidad.</p>
                
                <div class="detail-specs-box">
                    <div class="spec-item">
                        <span class="spec-name"><i class="fa-solid fa-check" style="color:#38bdf8;"></i> Estuche Rígido Acolchado</span>
                        <span class="spec-val">Incluido</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-name"><i class="fa-solid fa-check" style="color:#38bdf8;"></i> Bolsa de Terciopelo Protectora</span>
                        <span class="spec-val">Incluida</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-name"><i class="fa-solid fa-check" style="color:#38bdf8;"></i> Certificado Plata Ley .925</span>
                        <span class="spec-val">Firmado</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-name"><i class="fa-solid fa-check" style="color:#38bdf8;"></i> Paño Abrillantador Especial</span>
                        <span class="spec-val">De Regalo</span>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-gem"></i> Explorar Catálogo de Regalos
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 7. RESEÑAS Y TESTIMONIOS DE CLIENTES -->
<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Opiniones de Nuestra Comunidad</span>
            <h2 class="text-gradient-silver">Lo Que Dicen Quienes Ya Brillan Con Angy</h2>
            <p>Más de 12,000 pedidos entregados con 99.8% de satisfacción garantizada.</p>
        </div>

        <div class="reviews-grid">
            <!-- Reseña 1 -->
            <div class="glass-panel review-card">
                <div>
                    <div class="product-rating" style="margin-bottom: 1rem;">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-quote">"El anillo solitario superó por completo mis expectativas. El brillo de la circonia con la plata pulida es impresionante. A mi prometida le fascinó el estuche con el certificado."</p>
                </div>
                <div class="reviewer-profile">
                    <div class="reviewer-avatar">CR</div>
                    <div class="reviewer-info">
                        <h5>Carlos Ramírez</h5>
                        <span class="verified-buyer-badge"><i class="fa-solid fa-circle-check"></i> Comprador Verificado • CDMX</span>
                    </div>
                </div>
            </div>

            <!-- Reseña 2 -->
            <div class="glass-panel review-card">
                <div>
                    <div class="product-rating" style="margin-bottom: 1rem;">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-quote">"Compré las arracadas y la gargantilla de corazón. La atención por WhatsApp fue súper rápida y me asesoraron con la talla. Llegó en 2 días a Guadalajara."</p>
                </div>
                <div class="reviewer-profile">
                    <div class="reviewer-avatar">MG</div>
                    <div class="reviewer-info">
                        <h5>Mariana Gómez</h5>
                        <span class="verified-buyer-badge"><i class="fa-solid fa-circle-check"></i> Comprador Verificado • Guadalajara</span>
                    </div>
                </div>
            </div>

            <!-- Reseña 3 -->
            <div class="glass-panel review-card">
                <div>
                    <div class="product-rating" style="margin-bottom: 1rem;">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-quote">"La calidad de la plata .925 es legítima. Llevo 4 meses usándolo diario y se mantiene brillante e impecable. El medidor de la página acertó exactamente."</p>
                </div>
                <div class="reviewer-profile">
                    <div class="reviewer-avatar">AV</div>
                    <div class="reviewer-info">
                        <h5>Andrea Villarreal</h5>
                        <span class="verified-buyer-badge"><i class="fa-solid fa-circle-check"></i> Comprador Verificado • Monterrey</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
