# 💍 Guía de Instalación y Configuración: Joyería Angy para WordPress & WooCommerce

¡Bienvenido al tema oficial de **Joyería Angy**! Desarrollado específicamente para marcas de alta joyería en **Plata Ley .925** y **Acero Quirúrgico 316L**, con diseño editorial de lujo (estética *VERAE*), compras directas por WhatsApp, medidor virtual de anillos y **Portal de Administración e Inventario con Gestión de Usuarios y Roles de Joyería**.

---

## 📦 1. Contenido del Paquete

1. **Archivo Instalable ZIP**: `joyeria-angy-tema-wordpress.zip` (Listo para subir en WordPress).
2. **Carpeta del Tema**: `wp-content/themes/joyeria-angy/`.
3. **Tienda Pública de Clientes**: `preview/index.html` (Experiencia de compra 100% limpia para clientes).
4. **Portal ERP Autónomo & Usuarios**: `preview/admin.html` (Pantalla de login, control de inventario y módulo de usuarios & roles).
5. **Activos Gráficos**: Fotografía editorial de modelo y catálogo macro de joyas en alta resolución.

---

## 🔒 2. Portal de Administración, Usuarios & Roles

El portal cuenta con un sistema de control de accesos basado en roles especializados para el negocio de joyería:

### 👑 Cuentas de Acceso Preconfiguradas:
| Rol | Correo / Usuario | Contraseña | Nivel de Permisos |
| :--- | :--- | :--- | :--- |
| **Super Administrador** | `admin@joyeriaangy.com` (o `admin`) | `angy2026` | Acceso total: inventario, finanzas, creación y suspensión de usuarios. |
| **Gerente de Almacén** | `almacen@joyeriaangy.com` (o `almacen`) | `almacen2026` | Control de stock físico, altas, edición y alertas de existencias. |
| **Asesor de Ventas** | `ventas@joyeriaangy.com` (o `ventas`) | `ventas2026` | Consulta de catálogo y stock en tiempo real para atención y WhatsApp. |
| **Auditor Financiero** | `auditoria@joyeriaangy.com` (o `auditoria`) | `auditor2026` | Valuación monetaria de almacén y descarga de reportes JSON. |

### 👥 Funcionalidades del Módulo de Usuarios:
- **Alta de Nuevos Colaboradores**: Formulario con nombre, correo, usuario único, rol asignado, estado y generador de contraseñas seguras.
- **Edición y Cambio de Rol**: Modificación en tiempo real.
- **Suspensión / Reactivación de Cuentas**: Bloqueo inmediato de acceso al ERP.
- **Eliminación Segura**: Revocación definitiva de accesos.
- **Autenticación Dinámica**: Cualquier usuario registrado puede iniciar sesión inmediatamente en la pantalla de login.

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
4. Publica la página. Ahora estará disponible en `tudominio.com/admin` con su propia pantalla de login y selector de módulos.

---

## ⚙️ 4. Personalización del Tema (Theme Customizer)

Ve a **Apariencia > Personalizar > Opciones de Joyería Angy**:
1. **Número de WhatsApp**: Tu número con código de país (ej: `5215512345678`).
2. **Barra de Anuncios Superior**: Texto promocional de envío gratis.
3. **Monto Mínimo de Envío Gratis**: Por defecto `$1,499 MXN`.
