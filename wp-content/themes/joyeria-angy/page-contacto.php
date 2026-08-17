<?php
/**
 * Template Name: Contacto y Mayoreo
 *
 * @package Joyeria_Angy
 */

get_header(); ?>

<main class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Estamos a tu Servicio</span>
            <h1 class="text-gradient-silver">Contacto & Atención Personalizada</h1>
            <p>¿Tienes dudas sobre un modelo, requieres una talla especial o deseas catálogo de precios por mayoreo? Escríbenos.</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 3rem; max-width: 1100px; margin: 0 auto;">
            
            <!-- Tarjetas de Información Directa -->
            <div>
                <div class="glass-panel" style="padding: 2rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div class="trust-icon-box" style="background: rgba(37, 211, 102, 0.1); border-color: #25d366;">
                            <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.1rem; color: #ffffff;">WhatsApp Concierge</h4>
                            <p style="font-size: 0.85rem; color: #38bdf8;">Respuesta en menos de 10 minutos</p>
                        </div>
                    </div>
                    <p style="font-size: 0.92rem; margin-bottom: 1.25rem;">Atención inmediata de pedidos, fotos adicionales de las piezas y confirmación de stock en tiempo real.</p>
                    <a href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' ) ); ?>?text=Hola%20Joyer%C3%ADa%20Angy,%20deseo%20m%C3%A1s%20informaci%C3%B3n" target="_blank" class="btn btn-whatsapp" style="width: 100%;">
                        <i class="fa-brands fa-whatsapp"></i> Chatear por WhatsApp
                    </a>
                </div>

                <div class="glass-panel" style="padding: 2rem;">
                    <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1rem;">Ventas por Mayoreo</h4>
                    <p style="font-size: 0.92rem; margin-bottom: 1rem; color: var(--color-silver-mid);">Inicia o haz crecer tu negocio de joyería fina con nuestros paquetes especiales de mayoreo en plata .925 y acero con hasta 50% de margen de ganancia.</p>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.88rem; color: var(--color-silver-light); margin-bottom: 1.25rem;">
                        <li><i class="fa-solid fa-check" style="color: #38bdf8; margin-right: 6px;"></i> Mínimo de compra accesible ($3,000 MXN)</li>
                        <li><i class="fa-solid fa-check" style="color: #38bdf8; margin-right: 6px;"></i> Certificados .925 y empaques incluidos</li>
                        <li><i class="fa-solid fa-check" style="color: #38bdf8; margin-right: 6px;"></i> Envíos asegurados a toda la República</li>
                    </ul>
                </div>
            </div>

            <!-- Formulario de Mensaje -->
            <div class="glass-panel" style="padding: 2.5rem;">
                <h3 class="text-gradient-silver" style="font-size: 1.6rem; margin-bottom: 0.5rem;">Envíanos un Mensaje</h3>
                <p style="font-size: 0.9rem; margin-bottom: 1.5rem;">Completa el formulario y te responderemos por correo o WhatsApp hoy mismo.</p>

                <form onsubmit="event.preventDefault(); window.showToast('✨ Mensaje enviado con éxito. Te responderemos pronto.');" style="display: flex; flex-direction: column; gap: 1.2rem;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; color: var(--color-silver-glow); margin-bottom: 0.35rem;">Nombre Completo</label>
                        <input type="text" class="newsletter-input" style="width: 100%;" placeholder="Ej. Ana Martínez" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label style="display: block; font-size: 0.85rem; color: var(--color-silver-glow); margin-bottom: 0.35rem;">Teléfono / WhatsApp</label>
                            <input type="tel" class="newsletter-input" style="width: 100%;" placeholder="Ej. 55 1234 5678" required>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.85rem; color: var(--color-silver-glow); margin-bottom: 0.35rem;">Correo Electrónico</label>
                            <input type="email" class="newsletter-input" style="width: 100%;" placeholder="ana@ejemplo.com" required>
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.85rem; color: var(--color-silver-glow); margin-bottom: 0.35rem;">Motivo de tu consulta</label>
                        <select class="newsletter-input" style="width: 100%; background: #0f172a; color: #ffffff;">
                            <option value="duda">Duda sobre una pieza o modelo</option>
                            <option value="talla">Asesoría para elegir talla</option>
                            <option value="mayoreo">Información de catálogo por Mayoreo</option>
                            <option value="pedido">Estatus de mi pedido en curso</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.85rem; color: var(--color-silver-glow); margin-bottom: 0.35rem;">Mensaje o Comentarios</label>
                        <textarea rows="4" class="newsletter-input" style="width: 100%; resize: vertical;" placeholder="Escribe aquí tu consulta..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem;">
                        <i class="fa-solid fa-paper-plane"></i> Enviar Mensaje
                    </button>
                </form>
            </div>

        </div>
    </div>
</main>

<?php get_footer(); ?>
