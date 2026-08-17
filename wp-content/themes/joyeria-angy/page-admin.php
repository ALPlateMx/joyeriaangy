<?php
/**
 * Template Name: Portal de Administración e Inventario
 * Description: Portal independiente con login seguro para gestión de catálogo y existencias de Joyería Angy
 *
 * @package Joyeria_Angy
 */

// Si no está definido ABSPATH
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php _e( 'Portal ERP & Control de Inventario | Joyería Angy', 'joyeria-angy' ); ?></title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/main.css' ); ?>">
</head>
<body style="background-color: #120d0a;">

<!-- 1. PANTALLA DE LOGIN SEGURO -->
<div id="adminLoginScreen" class="login-screen-wrapper">
    <div class="login-card">
        
        <div class="login-brand">
            <h2>Joyería Angy</h2>
            <p><i class="fa-solid fa-shield-halved" style="color:var(--color-gold-bronze);"></i> Portal ERP & Almacén</p>
        </div>

        <div style="background: rgba(212, 163, 115, 0.08); border: 1px solid var(--border-gold); padding: 0.85rem; border-radius: var(--radius-sm); font-size: 0.82rem; margin-bottom: 1.5rem; text-align: left; color: #f3e9dc;">
            <strong><i class="fa-solid fa-key" style="color: var(--color-gold-bronze);"></i> Accesos Demo:</strong><br>
            • Usuario: <code style="color:#ffffff; background:rgba(0,0,0,0.3); padding:1px 5px; border-radius:3px;">admin@joyeriaangy.com</code> o <code style="color:#ffffff; background:rgba(0,0,0,0.3); padding:1px 5px; border-radius:3px;">admin</code><br>
            • Contraseña: <code style="color:#ffffff; background:rgba(0,0,0,0.3); padding:1px 5px; border-radius:3px;">angy2026</code>
        </div>

        <div id="loginErrorMsg" class="login-error-msg"></div>

        <form id="adminLoginForm" class="login-form">
            <div class="login-field">
                <label for="loginUsername"><i class="fa-solid fa-user"></i> Usuario o Correo Electrónico</label>
                <input type="text" id="loginUsername" class="login-input" placeholder="admin@joyeriaangy.com" required value="admin@joyeriaangy.com">
            </div>

            <div class="login-field">
                <label for="loginPassword"><i class="fa-solid fa-lock"></i> Contraseña de Acceso</label>
                <input type="password" id="loginPassword" class="login-input" placeholder="••••••••" required value="angy2026">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.82rem; margin-top: -0.25rem;">
                <label style="display: flex; align-items: center; gap: 0.45rem; color: var(--color-silver-mid); cursor: pointer;">
                    <input type="checkbox" id="rememberSession" checked> Recordar sesión
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;">
                <i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión en ERP
            </button>
        </form>

        <div style="margin-top: 2rem; border-top: 1px solid var(--border-glass); padding-top: 1.25rem;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="top-bar-link" style="justify-content: center; font-size: 0.85rem;">
                &larr; Volver a la Tienda Pública
            </a>
        </div>

    </div>
</div>

<!-- 2. DASHBOARD DE CONTROL DE INVENTARIO Y ERP -->
<div id="adminDashboardScreen" style="display: none;">
    
    <header class="admin-portal-header">
        <div class="container">
            <div class="site-brand" style="margin: 0;">
                <span class="brand-name" style="font-size: 1.6rem;">Joyería Angy</span>
                <span class="brand-subtitle" style="font-size: 0.58rem; color:var(--color-gold-bronze);"><i class="fa-solid fa-boxes-stacked"></i> Sistema ERP & Inventario</span>
            </div>

            <div style="display: flex; align-items: center; gap: 1.25rem;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="btn btn-outline-silver btn-sm">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Ver Tienda Pública
                </a>

                <div class="admin-user-profile">
                    <div class="admin-avatar">JA</div>
                    <div style="font-size: 0.85rem; line-height: 1.2;">
                        <strong style="color: #ffffff; display: block;">Administrador Angy</strong>
                        <span style="color: #4ade80; font-size: 0.75rem;">● En Línea</span>
                    </div>
                </div>

                <button id="adminLogoutBtn" class="btn btn-outline-silver btn-sm" style="border-color: #ef4444; color: #fca5a5;" title="Cerrar Sesión">
                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                </button>
            </div>
        </div>
    </header>

    <main class="admin-section">
        <div class="container">
            
            <div class="admin-header-row">
                <div>
                    <span class="section-subtitle"><i class="fa-solid fa-shield-halved" style="color:var(--color-gold-bronze);"></i> Almacén Central</span>
                    <h1 class="text-gradient-silver" style="font-size: 2.2rem;">Control de Inventario y Catálogo</h1>
                    <p style="font-size: 0.95rem;">Gestiona existencias de Plata Ley .925, piezas en acero quirúrgico, SKU y precios.</p>
                </div>
                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <button class="btn btn-primary btn-sm" onclick="openAddProductModal()">
                        <i class="fa-solid fa-plus"></i> Registrar Nueva Joya
                    </button>
                    <button class="btn btn-outline-silver btn-sm" onclick="exportInventoryJSON()">
                        <i class="fa-solid fa-download"></i> Exportar Inventario (JSON)
                    </button>
                </div>
            </div>

            <div class="admin-kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-icon-box"><i class="fa-solid fa-gem"></i></div>
                    <div class="kpi-data">
                        <h3 id="kpiTotalProducts">5</h3>
                        <p>Modelos Registrados</p>
                    </div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-icon-box" style="border-color:#4ade80; background:rgba(74,222,128,0.1); color:#4ade80;"><i class="fa-solid fa-boxes-stacked"></i></div>
                    <div class="kpi-data">
                        <h3 id="kpiTotalUnits">50 pzas</h3>
                        <p>Total Piezas en Stock</p>
                    </div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-icon-box" style="border-color:#fbbf24; background:rgba(251,191,36,0.1); color:#fbbf24;"><i class="fa-solid fa-sack-dollar"></i></div>
                    <div class="kpi-data">
                        <h3 id="kpiTotalValuation">$65,920.00</h3>
                        <p>Valuación de Almacén</p>
                    </div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-icon-box" style="border-color:#f87171; background:rgba(248,113,113,0.1); color:#f87171;"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="kpi-data">
                        <h3 id="kpiLowStockAlerts">1</h3>
                        <p>Stock Bajo (&le; 3 pzas)</p>
                    </div>
                </div>
            </div>

            <div class="inventory-toolbar">
                <div style="position:relative; flex-grow:1; max-width:320px;">
                    <i class="fa-solid fa-magnifying-glass search-icon-inside"></i>
                    <input type="text" placeholder="Buscar por joya o SKU..." class="search-input-header" id="inventorySearchInput" style="width:100%;">
                </div>

                <div class="inventory-filters">
                    <select class="admin-select" id="inventoryCategoryFilter">
                        <option value="all">Todas las Categorías</option>
                        <option value="anillos">Anillos de Compromiso</option>
                        <option value="collares">Collares & Dijes</option>
                        <option value="pulseras">Pulseras Finas</option>
                        <option value="aretes">Aretes & Arracadas</option>
                        <option value="parejas">Joyería para Parejas</option>
                    </select>

                    <select class="admin-select" id="inventoryStockFilter">
                        <option value="all">Todo el Estado de Stock</option>
                        <option value="in">En Stock (> 3)</option>
                        <option value="low">Stock Bajo (&le; 3)</option>
                        <option value="out">Agotados (0)</option>
                    </select>
                </div>
            </div>

            <div class="inventory-table-container">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Joya & Código SKU</th>
                            <th>Categoría</th>
                            <th>Metal / Pureza</th>
                            <th>Precio ($ MXN)</th>
                            <th>Control de Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTableBody"></tbody>
                </table>
            </div>

        </div>
    </main>
</div>

<div class="toast-container" id="toastContainer"></div>
<script src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/admin.js' ); ?>"></script>
</body>
</html>
