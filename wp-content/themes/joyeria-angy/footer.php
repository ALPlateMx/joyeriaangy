<?php
/**
 * The Footer template for Joyería Angy
 *
 * @package Joyeria_Angy
 */
?>

<!-- Sección VIP Newsletter -->
<section class="section-padding" style="background: linear-gradient(180deg, var(--bg-main) 0%, rgba(15, 23, 42, 0.5) 100%);">
    <div class="container">
        <div class="newsletter-banner">
            <span class="section-subtitle">Únete al Club Exclusivo</span>
            <h2 class="text-gradient-silver">Recibe 10% OFF en tu Primera Compra</h2>
            <p>Suscríbete para acceder a lanzamientos secretos de piezas en plata .925, promociones de aniversario y guías de joyería fina.</p>
            <form class="newsletter-form" onsubmit="event.preventDefault(); window.showToast('✨ ¡Gracias por suscribirte! Código: ANGY10');">
                <input type="email" placeholder="Ingresa tu correo electrónico..." class="newsletter-input" required>
                <button type="submit" class="btn btn-primary">Obtener Descuento</button>
            </form>
        </div>
    </div>
</section>

<!-- Footer Principal -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            
            <!-- Info de Marca -->
            <div class="footer-col">
                <div class="site-brand" style="margin-bottom: 1.25rem;">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="brand-name">Joyería Angy</span>
                    </a>
                    <span class="brand-subtitle">Plata Ley .925 & Acero</span>
                </div>
                <p style="margin-bottom: 1.5rem; font-size: 0.92rem;">Especialistas en joyería fina de plata esterlina ley .925 y acero quirúrgico 316L. Diseños exclusivos, acabados de alta gama y brillo garantizado de por vida.</p>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="https://instagram.com" target="_blank" class="icon-action-btn" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://facebook.com" target="_blank" class="icon-action-btn" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://tiktok.com" target="_blank" class="icon-action-btn" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' ) ); ?>" target="_blank" class="icon-action-btn" title="WhatsApp" style="color:#25d366;"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Colecciones -->
            <div class="footer-col">
                <h4>Colecciones</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/categoria/anillos' ) ); ?>" class="footer-link">Anillos de Compromiso y Promesa</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/cadenas-y-dijes' ) ); ?>" class="footer-link">Gargantillas y Dijes con Cristal</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/pulseras' ) ); ?>" class="footer-link">Pulseras y Brazaletes Eslabón</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/aretes' ) ); ?>" class="footer-link">Aretes y Arracadas Micro-Pavé</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/parejas' ) ); ?>" class="footer-link">Dúos y Anillos para Pareja</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/categoria/acero' ) ); ?>" class="footer-link">Joyería en Acero Inoxidable</a></li>
                </ul>
            </div>

            <!-- Servicio & Asistencia -->
            <div class="footer-col">
                <h4>Servicio al Cliente</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/guia-de-tallas' ) ); ?>" class="footer-link open-ring-sizer-btn">Medidor Virtual de Anillos</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/cuidados-de-la-plata' ) ); ?>" class="footer-link">Guía de Limpieza de Plata .925</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/envios-y-devoluciones' ) ); ?>" class="footer-link">Tiempos de Envío y Paqueterías</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/garantia-autenticidad' ) ); ?>" class="footer-link">Certificado de Autenticidad</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/mayoreo' ) ); ?>" class="footer-link">Ventas por Mayoreo</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/admin' ) ); ?>" class="footer-link" style="color:var(--color-gold-bronze);"><i class="fa-solid fa-shield-halved"></i> Acceso Administrativo / ERP</a></li>
                </ul>
            </div>

            <!-- Contacto Directo -->
            <div class="footer-col">
                <h4>Contacto & Pedidos</h4>
                <p style="font-size: 0.9rem; margin-bottom: 0.6rem;"><i class="fa-solid fa-location-dot" style="color:#38bdf8; margin-right:6px;"></i> Envíos Seguros a Todo México</p>
                <p style="font-size: 0.9rem; margin-bottom: 0.6rem;"><i class="fa-brands fa-whatsapp" style="color:#25d366; margin-right:6px;"></i> +52 1 (55) 1234-5678</p>
                <p style="font-size: 0.9rem; margin-bottom: 0.6rem;"><i class="fa-solid fa-envelope" style="color:#cbd5e1; margin-right:6px;"></i> contacto@joyeriaangy.com</p>
                <p style="font-size: 0.9rem;"><i class="fa-regular fa-clock" style="color:#cbd5e1; margin-right:6px;"></i> Lun - Sáb: 9:00 AM - 8:00 PM</p>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p style="font-size: 0.85rem;">&copy; <?php echo date('Y'); ?> <strong>Joyería Angy</strong>. Todos los derechos reservados. Plata Ley .925 y Acero Inoxidable.</p>
            <div class="payment-badges">
                <span class="pay-badge"><i class="fa-brands fa-cc-visa"></i> Visa</span>
                <span class="pay-badge"><i class="fa-brands fa-cc-mastercard"></i> Mastercard</span>
                <span class="pay-badge"><i class="fa-brands fa-paypal"></i> PayPal</span>
                <span class="pay-badge">Mercado Pago</span>
                <span class="pay-badge">OXXO / SPEI</span>
            </div>
        </div>
    </div>
</footer>

<!-- -------------------------------------------------------------
     MINI-CARRITO DRAWER LATERAL
------------------------------------------------------------- -->
<div class="cart-drawer-overlay" id="cartDrawerOverlay">
    <div class="cart-drawer">
        <div class="cart-drawer-header">
            <h3 class="cart-drawer-title"><i class="fa-solid fa-bag-shopping" style="color: #38bdf8; margin-right: 8px;"></i> Tu Carrito de Joyas</h3>
            <button class="close-drawer-btn" id="closeDrawerBtn" aria-label="Cerrar"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="cart-shipping-bar">
            <span id="shippingProgressText">Agrega <strong>$209.00 MXN</strong> más para <strong>Envío Gratis Express</strong></span>
            <div class="progress-track">
                <div class="progress-fill" style="width: 75%;"></div>
            </div>
        </div>

        <div class="cart-items-list" id="cartItemsList">
            <!-- Renderizado dinámico vía JavaScript -->
        </div>

        <div class="cart-drawer-footer">
            <div class="cart-subtotal-row">
                <span>Subtotal:</span>
                <strong id="cartSubtotal">$1,290.00 MXN</strong>
            </div>
            <p style="font-size:0.75rem; color:var(--color-silver-glow); margin-bottom:1rem; text-align:center;">✨ Incluye estuche de regalo, bolsa de terciopelo y certificado .925</p>
            <div class="cart-footer-buttons">
                <a href="#" id="whatsappCartBtn" target="_blank" class="btn btn-whatsapp" style="width: 100%;">
                    <i class="fa-brands fa-whatsapp"></i> Finalizar Pedido por WhatsApp
                </a>
                <a href="<?php echo esc_url( home_url( '/checkout' ) ); ?>" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-solid fa-lock"></i> Pagar con Tarjeta / Mercado Pago
                </a>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------------------------------
     MODAL INTERACTIVO: MEDIDOR VIRTUAL DE ANILLOS (RING SIZER)
------------------------------------------------------------- -->
<div class="modal-overlay" id="ringSizerModal">
    <div class="modal-box">
        <button class="close-modal-btn" id="closeRingSizerBtn"><i class="fa-solid fa-xmark"></i></button>
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <span class="section-subtitle">Herramienta Interactiva</span>
            <h2 class="text-gradient-silver" style="font-size: 2rem;">Medidor Virtual de Anillos</h2>
            <p style="font-size: 0.92rem; margin-top: 0.4rem;">Coloca un anillo que te quede bien sobre la pantalla o ajusta el control deslizante hasta que el círculo coincida exactamente con el borde interior de tu anillo.</p>
        </div>

        <div class="sizer-calibration-tool">
            <div class="interactive-circle-target" id="sizerCircle" style="width: 99px; height: 99px;">
                <span style="font-size: 0.8rem; color: #94a3b8;"><i class="fa-solid fa-ring"></i></span>
            </div>
            <p style="font-size: 0.82rem; color: var(--color-silver-glow); margin-bottom: 0.8rem;">Desliza para calibrar el diámetro interior:</p>
            <input type="range" min="0" max="15" value="6" class="sizer-slider-input" id="sizerSlider">
            
            <div class="sizer-values-display">
                <div class="sizer-box-val">
                    <h3 id="sizerSizeValue">Talla 7</h3>
                    <p>Estándar México / USA</p>
                </div>
                <div class="sizer-box-val">
                    <h3 id="sizerMmValue">17.3 mm</h3>
                    <p>Diámetro Interior Exacto</p>
                </div>
            </div>
        </div>

        <div style="background: rgba(255,255,255,0.03); border: 1px solid var(--border-glass); border-radius: var(--radius-sm); padding: 1rem; font-size: 0.85rem; color: var(--color-silver-mid);">
            <strong style="color: #ffffff;"><i class="fa-solid fa-lightbulb" style="color:#eab308; margin-right: 5px;"></i> Consejo de Joyero Experto:</strong> Si estás entre dos tallas, siempre te recomendamos elegir la talla más grande para mayor comodidad al colocar y retirar el anillo.
        </div>

        <div style="text-align: center; margin-top: 1.5rem;">
            <button class="btn btn-primary" onclick="document.getElementById('closeRingSizerBtn').click(); showToast('Talla memorizada con éxito');">Guardar mi Talla</button>
        </div>
    </div>
</div>

<!-- -------------------------------------------------------------
     BOTÓN FLOTANTE DE WHATSAPP DIRECTO
------------------------------------------------------------- -->
<a href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' ) ); ?>?text=Hola%20Joyer%C3%ADa%20Angy,%20quisiera%20asesor%C3%ADa%20para%20elegir%20una%20joya%20en%20plata%20.925" target="_blank" class="whatsapp-floating-btn" title="Atención Inmediata por WhatsApp">
    <div class="whatsapp-pulse-ring"></div>
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- Contenedor de Notificaciones Toast -->
<div class="toast-container" id="toastContainer"></div>

<?php wp_footer(); ?>
</body>
</html>
