<?php
/**
 * Template Name: Guía y Medidor de Tallas
 *
 * @package Joyeria_Angy
 */

get_header(); ?>

<main class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Precisión y Comodidad</span>
            <h1 class="text-gradient-silver">Guía y Medidor Virtual de Tallas</h1>
            <p>Descubre tu talla exacta de anillo o medida de cadena con nuestras herramientas interactivas y tablas de equivalencia oficial para México y USA.</p>
        </div>

        <div class="glass-panel" style="padding: 3rem 2rem; max-width: 850px; margin: 0 auto 4rem auto; text-align: center;">
            <h2 style="font-size: 1.8rem; margin-bottom: 0.5rem;" class="text-gradient-silver">1. Calibrador Virtual en Pantalla</h2>
            <p style="font-size: 0.95rem; margin-bottom: 2rem;">Coloca un anillo que uses habitualmente sobre el círculo y ajusta el deslizador hasta que el círculo interior encaje exactamente con tu pieza.</p>

            <?php echo do_shortcode( '[joyeria_ring_sizer]' ); ?>

            <div style="margin-top: 2rem;">
                <a href="<?php echo esc_url( home_url('/tienda') ); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-gem"></i> Explorar Anillos con mi Talla
                </a>
            </div>
        </div>

        <!-- Tabla de Equivalencias de Tallas -->
        <div class="glass-panel" style="padding: 2.5rem; max-width: 950px; margin: 0 auto;">
            <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center;" class="text-gradient-silver">Tabla Oficial de Medidas de Anillos</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--border-silver); color: #ffffff;">
                            <th style="padding: 0.85rem 1rem;">Talla (MX / USA)</th>
                            <th style="padding: 0.85rem 1rem;">Diámetro Interior (mm)</th>
                            <th style="padding: 0.85rem 1rem;">Circunferencia del Dedo (mm)</th>
                            <th style="padding: 0.85rem 1rem;">Recomendación Típica</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid var(--border-glass);">
                            <td style="padding: 0.85rem 1rem; font-weight: 600; color: #38bdf8;">Talla 5</td>
                            <td style="padding: 0.85rem 1rem;">15.7 mm</td>
                            <td style="padding: 0.85rem 1rem;">49.3 mm</td>
                            <td style="padding: 0.85rem 1rem; color: var(--color-silver-mid);">Dedo meñique o manos muy delgadas</td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border-glass);">
                            <td style="padding: 0.85rem 1rem; font-weight: 600; color: #38bdf8;">Talla 6</td>
                            <td style="padding: 0.85rem 1rem;">16.5 mm</td>
                            <td style="padding: 0.85rem 1rem;">51.8 mm</td>
                            <td style="padding: 0.85rem 1rem; color: var(--color-silver-mid);">Talla promedio mujer (anular)</td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border-glass); background: rgba(56, 189, 248, 0.05);">
                            <td style="padding: 0.85rem 1rem; font-weight: 700; color: #ffffff;">Talla 7 (Más Común)</td>
                            <td style="padding: 0.85rem 1rem; font-weight: 700; color: #ffffff;">17.3 mm</td>
                            <td style="padding: 0.85rem 1rem; font-weight: 700; color: #ffffff;">54.4 mm</td>
                            <td style="padding: 0.85rem 1rem; color: #ffffff;">Talla estándar mujer (anular / medio)</td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border-glass);">
                            <td style="padding: 0.85rem 1rem; font-weight: 600; color: #38bdf8;">Talla 8</td>
                            <td style="padding: 0.85rem 1rem;">18.1 mm</td>
                            <td style="padding: 0.85rem 1rem;">56.9 mm</td>
                            <td style="padding: 0.85rem 1rem; color: var(--color-silver-mid);">Talla mujer medio / Talla hombre delgado</td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border-glass);">
                            <td style="padding: 0.85rem 1rem; font-weight: 600; color: #38bdf8;">Talla 9</td>
                            <td style="padding: 0.85rem 1rem;">18.9 mm</td>
                            <td style="padding: 0.85rem 1rem;">59.5 mm</td>
                            <td style="padding: 0.85rem 1rem; color: var(--color-silver-mid);">Talla promedio hombre (anular)</td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border-glass); background: rgba(56, 189, 248, 0.05);">
                            <td style="padding: 0.85rem 1rem; font-weight: 700; color: #ffffff;">Talla 10 (Hombre Común)</td>
                            <td style="padding: 0.85rem 1rem; font-weight: 700; color: #ffffff;">19.8 mm</td>
                            <td style="padding: 0.85rem 1rem; font-weight: 700; color: #ffffff;">62.1 mm</td>
                            <td style="padding: 0.85rem 1rem; color: #ffffff;">Talla estándar hombre (anular / medio)</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.85rem 1rem; font-weight: 600; color: #38bdf8;">Talla 11 - 12</td>
                            <td style="padding: 0.85rem 1rem;">20.6 - 21.4 mm</td>
                            <td style="padding: 0.85rem 1rem;">64.6 - 67.2 mm</td>
                            <td style="padding: 0.85rem 1rem; color: var(--color-silver-mid);">Manos masculinas robustas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
