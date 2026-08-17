# 💍 Guía de Instalación y Configuración: Joyería Angy para WordPress & WooCommerce

¡Bienvenido al tema oficial de **Joyería Angy**! Este tema fue desarrollado específicamente para marcas de joyería fina de **Plata Ley .925** y **Acero Inoxidable / Quirúrgico 316L**, con enfoque en diseño de lujo, alta conversión e-commerce, integración de compras por WhatsApp, medidor virtual interactivo de tallas y **módulo integral de control de inventario**.

---

## 📦 1. Contenido del Paquete

1. **Archivo Instalable ZIP**: `joyeria-angy-tema-wordpress.zip` (Listo para subir desde el panel de WordPress).
2. **Carpeta Fuente del Tema**: `wp-content/themes/joyeria-angy/` (Para subir por FTP o modificar código).
3. **Prototipo Interactivo en Vivo**: `preview/index.html` (Para visualizar, probar la tienda y administrar el inventario inmediatamente en cualquier navegador sin servidor).
4. **Módulo de Administración & ERP**: Gestión de productos, SKU, costos, stock, alertas de stock bajo y exportación JSON.
5. **Activos Gráficos de Alta Resolución**: `assets/images/` (Fotografía de estudio para anillos, collares, pulseras, aretes, dúos de pareja y empaques con certificado de autenticidad).

---

## 🚀 2. Instalación en WordPress (Paso a Paso)

### Opción A: Desde el Panel de Administración de WordPress (Recomendada)
1. Inicia sesión en tu panel de WordPress (`tudominio.com/wp-admin`).
2. Ve a **Apariencia > Temas**.
3. Haz clic en el botón superior **Añadir nuevo tema** y luego en **Subir tema**.
4. Selecciona el archivo `joyeria-angy-tema-wordpress.zip` y haz clic en **Instalar ahora**.
5. Al finalizar la carga, haz clic en **Activar**.

### Opción B: Subida directa por FTP o Administrador de Archivos (cPanel / Plesk)
1. Descomprime o copia la carpeta `joyeria-angy` dentro de:
   ```
   wp-content/themes/joyeria-angy/
   ```
2. Ve a **Apariencia > Temas** en WordPress y haz clic en **Activar**.

---

## 💎 3. Módulo de Administración de Productos e Inventario

### En WordPress (`wp-admin`):
- Ve al menú lateral izquierdo: **Joyería Inventario**.
- Podrás monitorear de un vistazo:
  - Total de modelos registrados.
  - Piezas totales en existencia.
  - Alertas automáticas de stock bajo (≤ 3 unidades) para reordenar con tus plateros.
  - Actualización rápida de existencias por SKU.

### En la Demostración Interactiva (`preview/index.html`):
- Haz clic en el botón **"7. Admin & Inventario"** en la barra superior o en el enlace del menú/footer.
- **Acciones Disponibles**:
  - ➕ **Agregar Nueva Joya**: Registra título, SKU, categoría, metal/pureza, precio, precio regular, stock inicial y foto.
  - ✏️ **Editar / Eliminar**: Modifica cualquier parámetro en tiempo real.
  - ⚡ **Control de Stock Rápido**: Botones `+` y `-` para modificar existencias con 1 clic.
  - 📊 **Métricas KPI**: Valuación total del inventario en pesos mexicanos ($ MXN), piezas disponibles y alertas.
  - 📁 **Exportar Inventario**: Descarga en formato `.json` para respaldo y auditoría.

---

## 🔌 4. Plugins Recomendados para Máximo Rendimiento

| Plugin | Propósito | Configuración Recomendada |
| :--- | :--- | :--- |
| **WooCommerce** | Motor de tienda y catálogo | Moneda: Peso Mexicano (MXN). Habilitar gestión de inventario. |
| **Mercado Pago para WooCommerce** | Pasarela de pago líder en México | Tarjetas de crédito/débito, Meses Sin Intereses (MSI), OXXO y SPEI. |
| **Stripe Payment Gateway** | Pagos con tarjeta internacionales | Apple Pay y Google Pay con 1 clic. |
| **Rank Math SEO / Yoast SEO** | Posicionamiento en Google | Datos estructurados de joyería y fragmentos enriquecidos de producto. |
| **LiteSpeed Cache / WP Super Cache** | Velocidad de carga ultrarrápida | Optimización de imágenes WebP y caché en servidor. |

---

## ⚙️ 5. Personalización del Tema (Theme Customizer)

Ve a **Apariencia > Personalizar > Opciones de Joyería Angy**:

1. **Número de WhatsApp**: Ingresa tu número con código de país (ej: `5215512345678`).
2. **Barra de Anuncios Superior**: Personaliza el texto promocional.
3. **Monto Mínimo para Envío Gratis**: Por defecto `$1,499 MXN`.
4. **Logotipo de la Joyería**: En **Identidad del sitio**.

---

## 🖥️ 6. Cómo Probar la Vista Previa Inmediata

Abre el archivo [preview/index.html](file:///c:/Users/wendy/OneDrive/Documentos/IGR/ConquerBloks/Antigravity/joyeriaangy/preview/index.html) en tu navegador favorito:
- **1. Inicio (Home)**: Banners dinámicos, sellos de autenticidad y catálogo en vivo.
- **2. Catálogo**: Filtros por categoría y ordenamiento.
- **3. Ficha de Producto**: Selector de talla, cálculo de stock y compra por WhatsApp.
- **4. Medidor de Tallas**: Calibrador virtual interactivo.
- **5. Cuidados**: Guía para evitar la sulfuración de la plata .925.
- **6. Contacto & Mayoreo**: Formulario y cotizaciones.
- **7. Admin & Inventario**: Panel ERP interactivo para alta y control de existencias.
