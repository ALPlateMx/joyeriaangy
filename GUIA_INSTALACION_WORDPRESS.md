# 💍 Guía de Instalación y Configuración: Joyería Angy para WordPress & WooCommerce

¡Bienvenido al tema oficial de **Joyería Angy**! Este tema fue desarrollado específicamente para marcas de joyería fina de **Plata Ley .925** y **Acero Inoxidable / Quirúrgico 316L**, con enfoque en diseño de lujo, alta conversión e-commerce, integración de compras por WhatsApp y medidor virtual interactivo de tallas de anillos.

---

## 📦 1. Contenido del Paquete

1. **Archivo Instalable ZIP**: `joyeria-angy-tema-wordpress.zip` (Listo para subir desde el panel de WordPress).
2. **Carpeta Fuente del Tema**: `wp-content/themes/joyeria-angy/` (Para subir por FTP o modificar código).
3. **Prototipo Interactivo en Vivo**: `preview/index.html` (Para visualizar y probar la tienda inmediatamente en cualquier navegador sin necesidad de servidor).
4. **Activos Gráficos de Alta Resolución**: `assets/images/` (Fotografía de estudio para anillos, collares, pulseras, aretes, dúos de pareja y empaques con certificado de autenticidad).

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

## 🔌 3. Plugins Recomendados para Máximo Rendimiento

Para aprovechar todas las capacidades de venta y automatización:

| Plugin | Propósito | Configuración Recomendada |
| :--- | :--- | :--- |
| **WooCommerce** | Motor de tienda y catálogo | Moneda: Peso Mexicano (MXN). Habilitar gestión de inventario. |
| **Mercado Pago para WooCommerce** | Pasarela de pago líder en México | Tarjetas de crédito/débito, Meses Sin Intereses (MSI), OXXO y SPEI. |
| **Stripe Payment Gateway** | Pagos con tarjeta internacionales | Apple Pay y Google Pay con 1 clic. |
| **Rank Math SEO / Yoast SEO** | Posicionamiento en Google | Datos estructurados de joyería y fragmentos enriquecidos de producto. |
| **LiteSpeed Cache / WP Super Cache** | Velocidad de carga ultrarrápida | Optimización de imágenes WebP y caché en servidor. |

---

## ⚙️ 4. Personalización del Tema (Theme Customizer)

Ve a **Apariencia > Personalizar > Opciones de Joyería Angy**:

1. **Número de WhatsApp**:
   - Ingresa el número con el código de país (ejemplo: `5215512345678` para México).
   - Esto configurará automáticamente los botones de **"Pedir por WhatsApp"**, el carrito y el botón flotante.
2. **Barra de Anuncios Superior**:
   - Personaliza el mensaje promocional (ejemplo: `✨ Envío Gratis en compras mayores a $1,499 MXN | Plata Ley .925 Garantizada`).
3. **Monto Mínimo de Envío Gratis**:
   - Ajusta el valor para que la barra de progreso del carrito incentive la compra cruzada (por defecto `$1,499 MXN`).
4. **Logotipo de la Joyería**:
   - Ve a **Apariencia > Personalizar > Identidad del sitio** y sube tu logotipo en formato PNG transparente o SVG.

---

## 💍 5. Funcionalidades Exclusivas de Joyería Angy

### A. Medidor Virtual de Anillos (Ring Sizer)
- Funciona automáticamente mediante el botón de regla en la cabecera y fichas de anillos.
- Si deseas insertarlo en cualquier página o entrada de blog, utiliza el shortcode:
  ```
  [joyeria_ring_sizer]
  ```

### B. Botón de Compra Directa por WhatsApp con Mensaje Pre-cargado
- Cuando un cliente hace clic en el botón de WhatsApp de cualquier joya o desde el carrito de compras, se genera un mensaje formal y ordenado con:
  - Nombre del modelo.
  - Talla seleccionada (ej. Talla 7).
  - Precio unitario y total en pesos mexicanos ($ MXN).
  - Mención de Plata Ley .925 y empaque de regalo.

### C. Ficha de Garantía y Cuidados de la Plata
- Se incorpora automáticamente en la pestaña de especificaciones de producto de WooCommerce, educando al cliente sobre la pureza del quintado .925 y los cuidados preventivos para evitar la sulfuración.

---

## 🖥️ 6. Cómo Probar la Vista Previa Inmediata

Puedes abrir el archivo [preview/index.html](file:///c:/Users/wendy/OneDrive/Documentos/IGR/ConquerBloks/Antigravity/joyeriaangy/preview/index.html) en tu navegador favorito (Google Chrome, Microsoft Edge, Safari o Firefox) para navegar por:
- La página de **Inicio** con banners dinámicos y sellos de calidad.
- El **Catálogo** interactivo con filtros de joyas por categoría.
- La **Ficha de Producto** con selector de talla y cálculo de envío.
- El **Medidor de Tallas** interactivo con escala milimétrica.
- La **Guía de Cuidado de la Plata** y la página de **Contacto & Mayoreo**.
