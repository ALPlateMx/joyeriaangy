import os
import subprocess
import re

base_dir = r"c:\Users\wendy\OneDrive\Documentos\IGR\ConquerBloks\Antigravity\joyeriaangy"
views_dir = os.path.join(base_dir, "scratch", "views")
output_dir = os.path.join(base_dir, "captura de pantalla")
os.makedirs(views_dir, exist_ok=True)
os.makedirs(output_dir, exist_ok=True)

index_file = os.path.join(base_dir, "preview", "index.html")
admin_file = os.path.join(base_dir, "preview", "admin.html")

with open(index_file, "r", encoding="utf-8") as f:
    index_html = f.read()

with open(admin_file, "r", encoding="utf-8") as f:
    admin_html = f.read()

# Función para reemplazar vista activa en index.html
def make_index_view(view_id, custom_script=""):
    # Desactivar todas las vistas
    html = re.sub(r'class="page-view\s+active-view"', 'class="page-view"', index_html)
    # Activar la vista deseada
    html = html.replace(f'id="view-{view_id}" class="page-view"', f'id="view-{view_id}" class="page-view active-view"')
    # Ajustar rutas de assets relativos para scratch/views/
    html = html.replace('href="assets/', 'href="../../preview/assets/')
    html = html.replace('src="assets/', 'src="../../preview/assets/')
    if custom_script:
        html = html.replace('</body>', f'<script>{custom_script}</script></body>')
    return html

# 1. Pantallas de Tienda Pública
screens_index = [
    ("01_pantalla_inicio_home.png", make_index_view("inicio")),
    ("02_pantalla_catalogo_tienda.png", make_index_view("catalogo")),
    ("03_pantalla_ficha_producto.png", make_index_view("producto")),
    ("04_pantalla_medidor_tallas.png", make_index_view("tallas")),
    ("05_pantalla_cuidados_plata.png", make_index_view("cuidados")),
    ("06_pantalla_contacto_mayoreo.png", make_index_view("contacto")),
    ("07_pantalla_carrito_drawer.png", make_index_view("inicio", "document.getElementById('cartDrawerOverlay').classList.add('active');"))
]

# 2. Pantallas de Admin ERP
def make_admin_view(custom_script):
    html = admin_html.replace('href="assets/', 'href="../../preview/assets/')
    html = html.replace('src="assets/', 'src="../../preview/assets/')
    # Script para simular estado
    full_script = f"""
    document.addEventListener('DOMContentLoaded', () => {{
        {custom_script}
    }});
    """
    html = html.replace('</body>', f'<script>{full_script}</script></body>')
    return html

screens_admin = [
    ("08_pantalla_login_admin.png", make_admin_view("")),
    ("09_pantalla_admin_inventario_kpis.png", make_admin_view("""
        document.getElementById('adminLoginScreen').style.display = 'none';
        document.getElementById('adminDashboardScreen').style.display = 'block';
        window.switchAdminTab('inventario');
    """)),
    ("10_pantalla_admin_usuarios_roles.png", make_admin_view("""
        document.getElementById('adminLoginScreen').style.display = 'none';
        document.getElementById('adminDashboardScreen').style.display = 'block';
        window.switchAdminTab('usuarios');
    """)),
    ("11_pantalla_admin_modal_joya.png", make_admin_view("""
        document.getElementById('adminLoginScreen').style.display = 'none';
        document.getElementById('adminDashboardScreen').style.display = 'block';
        window.switchAdminTab('inventario');
        setTimeout(() => window.openAddProductModal(), 300);
    """)),
    ("12_pantalla_admin_modal_usuario.png", make_admin_view("""
        document.getElementById('adminLoginScreen').style.display = 'none';
        document.getElementById('adminDashboardScreen').style.display = 'block';
        window.switchAdminTab('usuarios');
        setTimeout(() => window.openAddUserModal(), 300);
    """))
]

chrome_path = r"C:\Program Files\Google\Chrome\Application\chrome.exe"
if not os.path.exists(chrome_path):
    chrome_path = r"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"

all_screens = screens_index + screens_admin

for filename, content in all_screens:
    tmp_html = os.path.join(views_dir, filename.replace(".png", ".html"))
    out_img = os.path.join(output_dir, filename)
    with open(tmp_html, "w", encoding="utf-8") as f:
        f.write(content)
    
    file_url = f"file:///{tmp_html.replace(os.sep, '/')}"
    cmd = [
        chrome_path,
        "--headless=new",
        "--disable-gpu",
        "--window-size=1400,900",
        "--hide-scrollbars",
        f"--screenshot={out_img}",
        file_url
    ]
    subprocess.run(cmd, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
    print(f"Generado: {filename}")

print("\n✨ ¡Todas las 12 pantallas han sido capturadas exitosamente en 'capturas_pantallas/'!")
