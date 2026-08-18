import os
import time
from playwright.sync_api import sync_playwright

def capture_screenshots():
    base_dir = r"c:\Users\wendy\OneDrive\Documentos\IGR\ConquerBloks\Antigravity\joyeriaangy"
    output_dir = os.path.join(base_dir, "capturas_pantallas")
    os.makedirs(output_dir, exist_ok=True)

    index_html = os.path.join(base_dir, "preview", "index.html")
    admin_html = os.path.join(base_dir, "preview", "admin.html")

    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        # Tamaño de pantalla desktop HD
        page = browser.new_page(viewport={"width": 1400, "height": 900})

        # -------------------------------------------------------------
        # 1. CAPTURAS DE LA TIENDA PÚBLICA (INDEX.HTML)
        # -------------------------------------------------------------
        page.goto(f"file:///{index_html.replace(os.sep, '/')}")
        page.wait_for_load_state("networkidle")
        time.sleep(1)

        # 1.1 Inicio / Home
        page.evaluate("window.switchView('inicio')")
        time.sleep(0.5)
        path_inicio = os.path.join(output_dir, "01_pantalla_inicio_home.png")
        page.screenshot(path=path_inicio, full_page=False)
        print(f"Capturado: {path_inicio}")

        # 1.2 Catálogo & Colecciones
        page.evaluate("window.switchView('catalogo')")
        time.sleep(0.5)
        path_catalogo = os.path.join(output_dir, "02_pantalla_catalogo_tienda.png")
        page.screenshot(path=path_catalogo, full_page=False)
        print(f"Capturado: {path_catalogo}")

        # 1.3 Ficha Detallada de Producto
        page.evaluate("window.switchView('producto')")
        time.sleep(0.5)
        path_producto = os.path.join(output_dir, "03_pantalla_ficha_producto.png")
        page.screenshot(path=path_producto, full_page=False)
        print(f"Capturado: {path_producto}")

        # 1.4 Medidor Virtual de Tallas de Anillos
        page.evaluate("window.switchView('tallas')")
        time.sleep(0.5)
        path_tallas = os.path.join(output_dir, "04_pantalla_medidor_tallas.png")
        page.screenshot(path=path_tallas, full_page=False)
        print(f"Capturado: {path_tallas}")

        # 1.5 Guía de Cuidados de la Plata .925
        page.evaluate("window.switchView('cuidados')")
        time.sleep(0.5)
        path_cuidados = os.path.join(output_dir, "05_pantalla_cuidados_plata.png")
        page.screenshot(path=path_cuidados, full_page=False)
        print(f"Capturado: {path_cuidados}")

        # 1.6 Contacto & Ventas por Mayoreo
        page.evaluate("window.switchView('contacto')")
        time.sleep(0.5)
        path_contacto = os.path.join(output_dir, "06_pantalla_contacto_mayoreo.png")
        page.screenshot(path=path_contacto, full_page=False)
        print(f"Capturado: {path_contacto}")

        # 1.7 Mini-Carrito Drawer Deslizable
        page.evaluate("document.querySelector('.cart-toggle-btn').click()")
        time.sleep(0.5)
        path_cart = os.path.join(output_dir, "07_pantalla_carrito_drawer.png")
        page.screenshot(path=path_cart, full_page=False)
        print(f"Capturado: {path_cart}")

        # -------------------------------------------------------------
        # 2. CAPTURAS DEL PORTAL ERP & ADMIN (ADMIN.HTML)
        # -------------------------------------------------------------
        page.goto(f"file:///{admin_html.replace(os.sep, '/')}")
        page.wait_for_load_state("networkidle")
        time.sleep(1)

        # 2.1 Pantalla de Login Autónomo
        path_login = os.path.join(output_dir, "08_pantalla_login_admin.png")
        page.screenshot(path=path_login, full_page=False)
        print(f"Capturado: {path_login}")

        # Iniciar sesión como Super Admin
        page.click("button[type='submit']")
        time.sleep(1)

        # 2.2 Dashboard ERP - Control de Inventario & KPIs
        page.evaluate("window.switchAdminTab('inventario')")
        time.sleep(0.5)
        path_inv = os.path.join(output_dir, "09_pantalla_admin_inventario_kpis.png")
        page.screenshot(path=path_inv, full_page=False)
        print(f"Capturado: {path_inv}")

        # 2.3 Dashboard ERP - Gestión de Usuarios & Roles
        page.evaluate("window.switchAdminTab('usuarios')")
        time.sleep(0.5)
        path_users = os.path.join(output_dir, "10_pantalla_admin_usuarios_roles.png")
        page.screenshot(path=path_users, full_page=False)
        print(f"Capturado: {path_users}")

        # 2.4 Modal de Alta de Nueva Joya
        page.evaluate("window.openAddProductModal()")
        time.sleep(0.5)
        path_modal_prod = os.path.join(output_dir, "11_pantalla_admin_modal_joya.png")
        page.screenshot(path=path_modal_prod, full_page=False)
        print(f"Capturado: {path_modal_prod}")

        # Cerrar modal joya y abrir modal usuario
        page.evaluate("document.getElementById('productAdminModal').classList.remove('active')")
        page.evaluate("window.openAddUserModal()")
        time.sleep(0.5)
        path_modal_user = os.path.join(output_dir, "12_pantalla_admin_modal_usuario.png")
        page.screenshot(path=path_modal_user, full_page=False)
        print(f"Capturado: {path_modal_user}")

        browser.close()
        print("\n🎉 Todas las capturas de pantalla han sido generadas con éxito.")

if __name__ == "__main__":
    capture_screenshots()
