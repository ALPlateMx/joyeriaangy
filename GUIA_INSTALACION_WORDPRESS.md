# 💍 Guía de Instalación y Configuración: Joyería Angy para WordPress & WooCommerce

¡Bienvenido al tema oficial de **Joyería Angy**! Desarrollado específicamente para marcas de alta joyería en **Plata Ley .925** y **Acero Quirúrgico 316L**, con diseño editorial de lujo (estética *VERAE*), compras directas por WhatsApp, medidor virtual de anillos y **Portal de Administración e Inventario con Login Seguro e Independiente**.

---

## 📦 1. Contenido del Paquete

1. **Archivo Instalable ZIP**: `joyeria-angy-tema-wordpress.zip` (Listo para subir en WordPress).
2. **Carpeta del Tema**: `wp-content/themes/joyeria-angy/`.
3. **Tienda Pública de Clientes**: `preview/index.html` (Experiencia de compra 100% limpia y sin botones administrativos expuestos).
4. **Portal Administrativo & ERP Independiente**: `preview/admin.html` (Pantalla de login y dashboard de inventario autónomo).
5. **Activos Gráficos**: Fotografía editorial de modelo y catálogo macro de joyas en alta resolución.

---

## 🔒 2. Portal de Administración Independiente & Login

El panel de administración está desacoplado del sitio público para máxima seguridad y limpieza visual:

### 🔑 Credenciales Oficiales de Demostración:
- **Usuario / Correo**: `admin@joyeriaangy.com` (o simplemente `admin`)
- **Contraseña**: `angy2026`
- **Acceso Directo**: Abre el archivo [preview/admin.html](file:///c:/Users/wendy/OneDrive/Documentos/IGR/ConquerBloks/Antigravity/joyeriaangy/preview/admin.html) o haz clic en el enlace del pie de página *"Acceso Administrativo / ERP"*.

### 📊 Funcionalidades del Portal ERP:
- **Dashboard KPI en Tiempo Real**:
  - Modelos registrados.
  - Piezas físicas totales en existencia.
  - Valuación monetaria total del inventario en pesos mexicanos ($ MXN).
  - Alertas automáticas de stock bajo (≤ 3 unidades) y piezas agotadas.
- **Gestión de Catálogo (CRUD)**:
  - ➕ **Registrar Nueva Joya**: Título, SKU único (ej. `ANGY-PL-006`), categoría, pureza del metal, precios, existencias y fotos.
  - ✏️ **Editar / Eliminar**: Modificación en tiempo real.
  - ⚡ **Ajuste Rápido de Stock**: Botones `+` y `-` con actualización instantánea.
  - 📁 **Exportar Inventario**: Descarga en formato `.json` para respaldo y auditoría.
  - 🔒 **Cierre de Sesión Seguro (Logout)**.

---

## 🚀 3. Instalación en WordPress (Paso a Paso)

### Opción A: Desde el Panel de WordPress
1. Inicia sesión en tu panel de WordPress (`tudominio.com/wp-admin`).
2. Ve a **Apariencia > Temas**.
3. Haz clic en **Añadir nuevo tema** > **Subir tema**.
4. Selecciona `joyeria-angy-tema-wordpress.zip` y haz clic en **Instalar ahora**.
5. Haz clic en **Activar**.

### Opción B: Crear la Página de Portal Administrativo en WordPress
1. Ve a **Páginas > Añadir nueva**.
2. Titúlala `Admin` o `Portal ERP` (slug: `admin`).
3. En la barra lateral derecha, bajo **Atributos de página > Plantilla**, selecciona:
   `Portal de Administración e Inventario`.
4. Publica la página. Ahora estará disponible en `tudominio.com/admin` con su propia pantalla de login.

---

## ⚙️ 4. Personalización del Tema (Theme Customizer)

Ve a **Apariencia > Personalizar > Opciones de Joyería Angy**:
1. **Número de WhatsApp**: Tu número con código de país (ej: `5215512345678`).
2. **Barra de Anuncios Superior**: Texto promocional de envío gratis.
3. **Monto Mínimo de Envío Gratis**: Por defecto `$1,499 MXN`.
