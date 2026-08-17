<?php
/**
 * Template Name: Guía de Cuidados de la Plata
 *
 * @package Joyeria_Angy
 */

get_header(); ?>

<main class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Consejos de Maestros Joyeros</span>
            <h1 class="text-gradient-silver">Guía de Cuidado de la Plata Ley .925</h1>
            <p>La plata esterlina es un metal noble que puede mantener su brillo radiante por generaciones. Sigue estos sencillos secretos para conservarla siempre como el primer día.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; max-width: 1100px; margin: 0 auto 4rem auto;">
            
            <!-- Tip 1 -->
            <div class="glass-panel" style="padding: 2rem;">
                <div class="trust-icon-box" style="margin-bottom: 1.25rem;">
                    <i class="fa-solid fa-sparkles" style="color: #38bdf8;"></i>
                </div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; color: #ffffff;">1. El Mejor Mantenimiento es Usarla</h3>
                <p style="font-size: 0.92rem; color: var(--color-silver-mid);">Los aceites naturales de tu propia piel ayudan a limpiar y mantener la plata pulida. Usar tus joyas Angy con frecuencia evita de forma natural que el metal se opaque.</p>
            </div>

            <!-- Tip 2 -->
            <div class="glass-panel" style="padding: 2rem;">
                <div class="trust-icon-box" style="margin-bottom: 1.25rem;">
                    <i class="fa-solid fa-spray-can-sparkles" style="color: #eab308;"></i>
                </div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; color: #ffffff;">2. La Regla de Oro: Lo Último en Ponerse</h3>
                <p style="font-size: 0.92rem; color: var(--color-silver-mid);">Colócate tus joyas después de aplicar perfumes, cremas corporales, fijadores de cabello o lociones. Los químicos cosméticos pueden acelerar la sulfuración de la plata.</p>
            </div>

            <!-- Tip 3 -->
            <div class="glass-panel" style="padding: 2rem;">
                <div class="trust-icon-box" style="margin-bottom: 1.25rem;">
                    <i class="fa-solid fa-box-archive" style="color: #25d366;"></i>
                </div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; color: #ffffff;">3. Almacenamiento Hermético</h3>
                <p style="font-size: 0.92rem; color: var(--color-silver-mid);">Cuando no estés usando tus piezas, guárdalas en la bolsa de terciopelo hermética que incluimos en tu paquete de Joyería Angy, en un lugar fresco y seco alejado del sol directo.</p>
            </div>

            <!-- Tip 4 -->
            <div class="glass-panel" style="padding: 2rem;">
                <div class="trust-icon-box" style="margin-bottom: 1.25rem;">
                    <i class="fa-solid fa-hand-sparkles" style="color: #cbd5e1;"></i>
                </div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; color: #ffffff;">4. Uso del Paño Abrillantador</h3>
                <p style="font-size: 0.92rem; color: var(--color-silver-mid);">Frota suavemente tus joyas en línea recta (nunca en círculos) con el paño especial micro-impregnado para remover huellas, polvo y devolver el reflejo tipo espejo al instante.</p>
            </div>

            <!-- Tip 5 -->
            <div class="glass-panel" style="padding: 2rem;">
                <div class="trust-icon-box" style="margin-bottom: 1.25rem;">
                    <i class="fa-solid fa-water-ladder" style="color: #ef4444;"></i>
                </div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; color: #ffffff;">5. Evita Albercas y Aguas Termales</h3>
                <p style="font-size: 0.92rem; color: var(--color-silver-mid);">El cloro de las piscinas y el azufre presente en aguas termales o saunas pueden obscurecer la plata en minutos. Retira tus piezas antes de nadar o entrar al vapor.</p>
            </div>

            <!-- Tip 6: Acero vs Plata -->
            <div class="glass-panel" style="padding: 2rem;">
                <div class="trust-icon-box" style="margin-bottom: 1.25rem;">
                    <i class="fa-solid fa-shield-halved" style="color: #38bdf8;"></i>
                </div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; color: #ffffff;">6. Joyería en Acero Quirúrgico 316L</h3>
                <p style="font-size: 0.92rem; color: var(--color-silver-mid);">Nuestras piezas en acero inoxidable 316L son 100% resistentes al agua, no se oxidan, no pierden color y son ideales para uso rudo, alberca o gimnasio sin preocupaciones.</p>
            </div>

        </div>

        <div class="glass-panel" style="padding: 2.5rem; max-width: 800px; margin: 0 auto; text-align: center;">
            <h3 class="text-gradient-silver" style="font-size: 1.6rem; margin-bottom: 0.75rem;">¿Tienes alguna duda sobre tu joya?</h3>
            <p style="margin-bottom: 1.5rem;">Nuestro equipo de maestros plateros está listo para asesorarte directamente por WhatsApp.</p>
            <a href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'joyeria_whatsapp_number', '5215512345678' ) ); ?>?text=Hola%20Joyer%C3%ADa%20Angy,%20tengo%20una%20duda%20sobre%20el%20cuidado%20de%20mi%20plata" target="_blank" class="btn btn-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> Hablar con un Asesor de Joyería
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
