import os
import sys
from reportlab.lib.pagesizes import letter
from reportlab.lib.units import inch
from reportlab.lib.colors import HexColor
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.platypus import (
    SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle, PageBreak, KeepTogether, HRFlowable
)
from reportlab.pdfgen import canvas

class NumberedCanvas(canvas.Canvas):
    def __init__(self, *args, **kwargs):
        super(NumberedCanvas, self).__init__(*args, **kwargs)
        self._saved_page_states = []

    def showPage(self):
        self._saved_page_states.append(dict(self.__dict__))
        self._startPage()

    def save(self):
        num_pages = len(self._saved_page_states)
        for state in self._saved_page_states:
            self.__dict__.update(state)
            self.draw_page_decorations(num_pages)
            super(NumberedCanvas, self).showPage()
        super(NumberedCanvas, self).save()

    def draw_page_decorations(self, page_count):
        if self._pageNumber == 1:
            # Portada: no dibuja header/footer estándar
            return

        self.saveState()
        self.setFont("Helvetica", 8)
        self.setFillColor(HexColor("#8c6a49"))

        # Header
        self.drawString(54, 11 * inch - 36, "Joyería Angy  |  Documento de Especificación de Requerimientos Funcionales")
        self.setStrokeColor(HexColor("#d4a373"))
        self.setLineWidth(0.75)
        self.line(54, 11 * inch - 42, 8.5 * inch - 54, 11 * inch - 42)

        # Footer
        self.setStrokeColor(HexColor("#e5d5c5"))
        self.setLineWidth(0.5)
        self.line(54, 45, 8.5 * inch - 54, 45)
        self.drawString(54, 32, "Confidencial - Para uso interno de Joyería Angy y equipo directivo")
        page_str = f"Página {self._pageNumber} de {page_count}"
        self.drawRightString(8.5 * inch - 54, 32, page_str)
        self.restoreState()


def build_pdf():
    pdf_path = r"c:\Users\wendy\OneDrive\Documentos\IGR\ConquerBloks\Antigravity\joyeriaangy\DOCUMENTO_EJECUTIVO_REQUERIMIENTOS_JOYERIA_ANGY.pdf"
    
    doc = SimpleDocTemplate(
        pdf_path,
        pagesize=letter,
        leftMargin=54,
        rightMargin=54,
        topMargin=54,
        bottomMargin=54
    )

    styles = getSampleStyleSheet()

    # Colores corporativos
    c_espresso = HexColor("#140E0B")
    c_gold = HexColor("#D4A373")
    c_gold_dark = HexColor("#8C5A2B")
    c_bg_card = HexColor("#FBF9F6")
    c_border = HexColor("#DFD7CE")
    c_text = HexColor("#2B231D")
    c_text_muted = HexColor("#665E57")

    # Estilos de texto
    title_cover_style = ParagraphStyle(
        'CoverTitle',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=30,
        leading=34,
        textColor=HexColor("#FFFFFF"),
        alignment=0,
        spaceAfter=8
    )

    subtitle_cover_style = ParagraphStyle(
        'CoverSubTitle',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=13,
        leading=17,
        textColor=HexColor("#E5D5C5"),
        alignment=0,
        spaceAfter=25
    )

    badge_cover_style = ParagraphStyle(
        'CoverBadge',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=8.5,
        leading=11,
        textColor=c_gold,
        alignment=0,
        spaceAfter=15
    )

    h1_style = ParagraphStyle(
        'DocH1',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=16,
        leading=20,
        textColor=c_espresso,
        spaceBefore=14,
        spaceAfter=8,
        keepWithNext=True
    )

    h2_style = ParagraphStyle(
        'DocH2',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=12,
        leading=15,
        textColor=c_gold_dark,
        spaceBefore=12,
        spaceAfter=6,
        keepWithNext=True
    )

    body_style = ParagraphStyle(
        'DocBody',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=9,
        leading=13.5,
        textColor=c_text,
        spaceAfter=8
    )

    body_bold = ParagraphStyle(
        'DocBodyBold',
        parent=body_style,
        fontName='Helvetica-Bold'
    )

    bullet_style = ParagraphStyle(
        'DocBullet',
        parent=body_style,
        leftIndent=15,
        firstLineIndent=-10,
        spaceAfter=4
    )

    table_header_style = ParagraphStyle(
        'TableHeader',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=8,
        leading=10,
        textColor=HexColor("#FFFFFF"),
        alignment=0
    )

    table_cell_style = ParagraphStyle(
        'TableCell',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=8,
        leading=11,
        textColor=c_text
    )

    table_cell_bold = ParagraphStyle(
        'TableCellBold',
        parent=table_cell_style,
        fontName='Helvetica-Bold',
        textColor=c_espresso
    )

    rf_badge_style = ParagraphStyle(
        'RFBadge',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=7.5,
        leading=9,
        textColor=HexColor("#734822")
    )

    story = []

    # =========================================================================
    # 1. PORTADA EJECUTIVA
    # =========================================================================
    cover_data = [
        [
            Paragraph("DOCUMENTO DE ESPECIFICACIÓN TÉCNICA Y FUNCIONAL", badge_cover_style)
        ],
        [
            Paragraph("Joyería Angy", title_cover_style)
        ],
        [
            Paragraph("Plataforma de E-commerce & Sistema ERP de Inventario y Roles", subtitle_cover_style)
        ],
        [
            HRFlowable(width="100%", thickness=1.5, color=c_gold, spaceAfter=20)
        ],
        [
            Paragraph(
                "<b>Resumen del Proyecto:</b> Implementación de la solución digital de alta gama para "
                "<b>Joyería Angy</b>, especializada en joyería fina de <b>Plata Esterlina Ley .925 quintada</b> y "
                "<b>Acero Quirúrgico 316L</b>. La plataforma integra una tienda virtual con estética editorial de lujo "
                "(paleta espresso/bronce estilo <i>VERAE</i>), compras directas vía WhatsApp, medidor virtual de anillos y un "
                "portal ERP autónomo con control de existencias en tiempo real y asignación de roles para colaboradores.",
                ParagraphStyle('CoverDesc', parent=body_style, textColor=HexColor("#F3E9DC"), fontSize=9.5, leading=14)
            )
        ]
    ]

    cover_table = Table(cover_data, colWidths=[7.0 * inch])
    cover_table.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, -1), c_espresso),
        ('TOPPADDING', (0, 0), (-1, -1), 16),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 16),
        ('LEFTPADDING', (0, 0), (-1, -1), 22),
        ('RIGHTPADDING', (0, 0), (-1, -1), 22),
        ('BOX', (0, 0), (-1, -1), 1.5, c_gold),
    ]))
    story.append(cover_table)
    story.append(Spacer(1, 20))

    # Meta-datos de la portada
    meta_info = [
        [
            Paragraph("<b>PROYECTO:</b>", body_bold),
            Paragraph("E-commerce & Portal ERP Joyería Angy", body_style),
            Paragraph("<b>VERSIÓN:</b>", body_bold),
            Paragraph("v1.0 (Producción 2026)", body_style)
        ],
        [
            Paragraph("<b>METALES:</b>", body_bold),
            Paragraph("Plata Ley .925 y Acero Quirúrgico 316L", body_style),
            Paragraph("<b>ESTADO:</b>", body_bold),
            Paragraph("Aprobado para Producción", body_style)
        ],
        [
            Paragraph("<b>AUTOR:</b>", body_bold),
            Paragraph("Gaona Consultores TI", body_style),
            Paragraph("<b>FECHA:</b>", body_bold),
            Paragraph("Agosto 2026", body_style)
        ]
    ]
    t_meta = Table(meta_info, colWidths=[1.1 * inch, 2.4 * inch, 1.1 * inch, 2.4 * inch])
    t_meta.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, -1), c_bg_card),
        ('BOX', (0, 0), (-1, -1), 0.75, c_border),
        ('INNERGRID', (0, 0), (-1, -1), 0.5, c_border),
        ('TOPPADDING', (0, 0), (-1, -1), 6),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 6),
        ('LEFTPADDING', (0, 0), (-1, -1), 8),
        ('RIGHTPADDING', (0, 0), (-1, -1), 8),
    ]))
    story.append(t_meta)
    story.append(PageBreak())

    # =========================================================================
    # 2. PÁGINA 1: RESUMEN Y ARQUITECTURA
    # =========================================================================
    story.append(Paragraph("1. Resumen Ejecutivo & Objetivos del Negocio", h1_style))
    story.append(HRFlowable(width="100%", thickness=0.75, color=c_gold, spaceAfter=8))
    
    story.append(Paragraph(
        "El presente documento formaliza los <b>Requerimientos Funcionales y Técnicos</b> implementados "
        "en la solución integral de <b>Joyería Angy</b>. La plataforma fue desarrollada para cumplir con dos pilares estratégicos:",
        body_style
    ))
    story.append(Paragraph("• <b>Canal de Ventas Digital de Alta Conversión:</b> Experiencia de compra inmersiva de alta gama, medidor interactivo de anillos y cierre ágil de pedidos por WhatsApp Business y pasarelas de pago.", bullet_style))
    story.append(Paragraph("• <b>Control Operativo & ERP Independiente:</b> Sistema administrativo autónomo protegido con login seguro, control de inventario de piezas quintadas, alertas de stock bajo y asignación de permisos según el rol del colaborador.", bullet_style))
    
    story.append(Paragraph("1.1. Arquitectura Desacoplada del Sistema", h2_style))
    
    arch_data = [
        [
            Paragraph("<b>Módulo A: Tienda Pública de Clientes (Front-End)</b><br/>"
                      "Interfaz de usuario limpia sin controles administrativos expuestos. Diseñada bajo la estética <i>VERAE</i> "
                      "(paleta espresso y bronce, tipografía Cormorant Garamond, fotografía macro). Incluye navegación por colecciones, "
                      "carrito drawer con barra de envío gratis ($1,499 MXN) y medidor virtual.", body_style)
        ],
        [
            Paragraph("<b>Módulo B: Portal ERP Autónomo & Almacén (Back-Office)</b><br/>"
                      "Panel independiente accesible vía <code>admin.html</code> o <code>/admin</code> con pantalla de autenticación segura. "
                      "Permite el registro de joyas, asignación de SKUs, ajuste rápido de existencias (+ / -), control de usuarios y "
                      "monitoreo de la valuación económica total del almacén.", body_style)
        ]
    ]
    t_arch = Table(arch_data, colWidths=[7.0 * inch])
    t_arch.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, -1), c_bg_card),
        ('BOX', (0, 0), (-1, -1), 0.75, c_border),
        ('INNERGRID', (0, 0), (-1, -1), 0.5, c_border),
        ('LINELEFT', (0, 0), (0, -1), 3.0, c_gold),
        ('TOPPADDING', (0, 0), (-1, -1), 8),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 8),
        ('LEFTPADDING', (0, 0), (-1, -1), 10),
        ('RIGHTPADDING', (0, 0), (-1, -1), 10),
    ]))
    story.append(t_arch)
    story.append(Spacer(1, 10))

    # =========================================================================
    # 3. PÁGINA 2: REQUERIMIENTOS FUNCIONALES (FRONT-END CLIENTES)
    # =========================================================================
    story.append(Paragraph("2. Matriz de Requerimientos Funcionales: Tienda Pública", h1_style))
    story.append(HRFlowable(width="100%", thickness=0.75, color=c_gold, spaceAfter=8))

    rf_store_data = [
        [
            Paragraph("Código", table_header_style),
            Paragraph("Requerimiento", table_header_style),
            Paragraph("Descripción Funcional", table_header_style),
            Paragraph("Prioridad", table_header_style)
        ],
        [
            Paragraph("<b>RF-01</b>", rf_badge_style),
            Paragraph("Catálogo & Colecciones", table_cell_bold),
            Paragraph("Filtros instantáneos por categoría: Anillos de Compromiso, Collares & Dijes, Pulseras, Aretes, Parejas y Acero Quirúrgico.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-02</b>", rf_badge_style),
            Paragraph("Mini-Carrito Drawer", table_cell_bold),
            Paragraph("Panel lateral deslizante con cálculo dinámico de subtotal y barra de progreso de Envío Gratis ($1,499 MXN).", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-03</b>", rf_badge_style),
            Paragraph("Checkout por WhatsApp", table_cell_bold),
            Paragraph("Generación de mensaje pre-estructurado con joyas, tallas, metales y total para confirmación de pedido por WhatsApp.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-04</b>", rf_badge_style),
            Paragraph("Medidor Virtual de Anillos", table_cell_bold),
            Paragraph("Herramienta interactiva de calibración milimétrica para obtener la talla exacta (5 al 12) sobre la pantalla.", table_cell_style),
            Paragraph("<font color='#d97706'><b>Alta</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-05</b>", rf_badge_style),
            Paragraph("Ficha de Producto", table_cell_bold),
            Paragraph("Vista con selector de talla, especificación de metal (.925/Acero), fotografía en alta resolución y stock.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-06</b>", rf_badge_style),
            Paragraph("Guía Cuidados Plata .925", table_cell_bold),
            Paragraph("Módulo informativo sobre limpieza, paño abrillantador y certificado de autenticidad.", table_cell_style),
            Paragraph("Media", table_cell_style)
        ]
    ]

    t_rf_store = Table(rf_store_data, colWidths=[0.8 * inch, 1.8 * inch, 3.5 * inch, 0.9 * inch])
    t_rf_store.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), c_espresso),
        ('BOX', (0, 0), (-1, -1), 0.75, c_border),
        ('INNERGRID', (0, 0), (-1, -1), 0.5, c_border),
        ('TOPPADDING', (0, 0), (-1, -1), 5),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 5),
        ('LEFTPADDING', (0, 0), (-1, -1), 6),
        ('RIGHTPADDING', (0, 0), (-1, -1), 6),
        ('ROWBACKGROUNDS', (0, 1), (-1, -1), [HexColor('#FFFFFF'), c_bg_card])
    ]))
    story.append(t_rf_store)
    story.append(PageBreak())

    # =========================================================================
    # 4. PÁGINA 3: PORTAL ERP & ROLES DE USUARIOS
    # =========================================================================
    story.append(Paragraph("3. Matriz de Requerimientos: Portal ERP & Usuarios", h1_style))
    story.append(HRFlowable(width="100%", thickness=0.75, color=c_gold, spaceAfter=8))

    rf_erp_data = [
        [
            Paragraph("Código", table_header_style),
            Paragraph("Requerimiento", table_header_style),
            Paragraph("Descripción Funcional", table_header_style),
            Paragraph("Prioridad", table_header_style)
        ],
        [
            Paragraph("<b>RF-07</b>", rf_badge_style),
            Paragraph("Login & Autenticación", table_cell_bold),
            Paragraph("Pantalla de inicio de sesión autónoma. Valida credenciales contra la base de usuarios y bloquea accesos suspendidos.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-08</b>", rf_badge_style),
            Paragraph("KPIs de Almacén & Finanzas", table_cell_bold),
            Paragraph("Métricas en tiempo real: modelos registrados, existencias físicas totales, <b>valuación económica ($ MXN)</b> y alertas de stock bajo.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-09</b>", rf_badge_style),
            Paragraph("Control de Catálogo (CRUD)", table_cell_bold),
            Paragraph("Alta, edición y baja de joyas con SKU único (ej. <code>ANGY-PL-006</code>), precio, categoría, pureza y fotos.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-10</b>", rf_badge_style),
            Paragraph("Ajuste Rápido de Stock", table_cell_bold),
            Paragraph("Botones (+ / -) para actualizar unidades disponibles inmediatamente tras ventas de mostrador.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-11</b>", rf_badge_style),
            Paragraph("Módulo de Usuarios & Roles", table_cell_bold),
            Paragraph("Creación de colaboradores, asignación de permisos, generador de contraseñas seguras y suspensión de cuentas.", table_cell_style),
            Paragraph("<font color='#b91c1c'><b>Crítica</b></font>", table_cell_style)
        ],
        [
            Paragraph("<b>RF-12</b>", rf_badge_style),
            Paragraph("Exportación JSON", table_cell_bold),
            Paragraph("Descarga de respaldos completos del inventario en formato estructurado JSON con un solo clic.", table_cell_style),
            Paragraph("<font color='#d97706'><b>Alta</b></font>", table_cell_style)
        ]
    ]

    t_rf_erp = Table(rf_erp_data, colWidths=[0.8 * inch, 1.8 * inch, 3.5 * inch, 0.9 * inch])
    t_rf_erp.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), c_espresso),
        ('BOX', (0, 0), (-1, -1), 0.75, c_border),
        ('INNERGRID', (0, 0), (-1, -1), 0.5, c_border),
        ('TOPPADDING', (0, 0), (-1, -1), 5),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 5),
        ('LEFTPADDING', (0, 0), (-1, -1), 6),
        ('RIGHTPADDING', (0, 0), (-1, -1), 6),
        ('ROWBACKGROUNDS', (0, 1), (-1, -1), [HexColor('#FFFFFF'), c_bg_card])
    ]))
    story.append(t_rf_erp)
    story.append(Spacer(1, 10))

    story.append(Paragraph("3.1. Matriz de Roles y Niveles de Permiso", h2_style))

    roles_data = [
        [
            Paragraph("Rol de Joyería", table_header_style),
            Paragraph("Acceso a Inventario", table_header_style),
            Paragraph("Gestión de Usuarios", table_header_style),
            Paragraph("Valuación Financiera", table_header_style)
        ],
        [
            Paragraph("<b>👑 Super Administrador</b>", table_cell_bold),
            Paragraph("Total (Crear, Editar, Borrar)", table_cell_style),
            Paragraph("Total (Crear, Suspender, Borrar)", table_cell_style),
            Paragraph("Total y Exportación JSON", table_cell_style)
        ],
        [
            Paragraph("<b>📦 Gerente de Almacén</b>", table_cell_bold),
            Paragraph("Operativo (Altas, Stock, Edición)", table_cell_style),
            Paragraph("Solo Lectura", table_cell_style),
            Paragraph("Visualización de Existencias", table_cell_style)
        ],
        [
            Paragraph("<b>💬 Asesor de Ventas</b>", table_cell_bold),
            Paragraph("Consulta de Catálogo y Stock", table_cell_style),
            Paragraph("Sin Acceso", table_cell_style),
            Paragraph("Solo Precios de Venta", table_cell_style)
        ],
        [
            Paragraph("<b>📊 Auditor Financiero</b>", table_cell_bold),
            Paragraph("Lectura de Catálogo", table_cell_style),
            Paragraph("Sin Acceso", table_cell_style),
            Paragraph("Valuación Total & Descargas", table_cell_style)
        ]
    ]

    t_roles = Table(roles_data, colWidths=[1.8 * inch, 1.8 * inch, 1.8 * inch, 1.6 * inch])
    t_roles.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), c_espresso),
        ('BOX', (0, 0), (-1, -1), 0.75, c_border),
        ('INNERGRID', (0, 0), (-1, -1), 0.5, c_border),
        ('TOPPADDING', (0, 0), (-1, -1), 5),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 5),
        ('LEFTPADDING', (0, 0), (-1, -1), 6),
        ('RIGHTPADDING', (0, 0), (-1, -1), 6),
        ('ROWBACKGROUNDS', (0, 1), (-1, -1), [HexColor('#FFFFFF'), c_bg_card])
    ]))
    story.append(t_roles)
    story.append(PageBreak())

    # =========================================================================
    # 5. PÁGINA 4: REQUERIMIENTOS NO FUNCIONALES Y APROBACIONES
    # =========================================================================
    story.append(Paragraph("4. Requerimientos No Funcionales (RNF)", h1_style))
    story.append(HRFlowable(width="100%", thickness=0.75, color=c_gold, spaceAfter=8))

    rnf_data = [
        [
            Paragraph("<b>RNF-01: Velocidad y Rendimiento</b><br/>"
                      "Carga ultra-rápida (inferior a 1.2 segundos). Arquitectura ligera sin sobrecarga de dependencias.", body_style)
        ],
        [
            Paragraph("<b>RNF-02: Diseño Responsivo Multiplataforma</b><br/>"
                      "Compatibilidad total con dispositivos móviles (smartphones), tabletas y pantallas de escritorio 4K.", body_style)
        ],
        [
            Paragraph("<b>RNF-03: Seguridad y Desacoplamiento</b><br/>"
                      "Separación estricta entre la tienda pública de clientes y el portal de administración e inventario.", body_style)
        ],
        [
            Paragraph("<b>RNF-04: Compatibilidad con WordPress & WooCommerce</b><br/>"
                      "Estructura estandarizada de archivos PHP y CSS para integración en cualquier servidor WordPress.", body_style)
        ]
    ]
    t_rnf = Table(rnf_data, colWidths=[7.0 * inch])
    t_rnf.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, -1), c_bg_card),
        ('BOX', (0, 0), (-1, -1), 0.75, c_border),
        ('INNERGRID', (0, 0), (-1, -1), 0.5, c_border),
        ('LINELEFT', (0, 0), (0, -1), 3.0, c_gold),
        ('TOPPADDING', (0, 0), (-1, -1), 6),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 6),
        ('LEFTPADDING', (0, 0), (-1, -1), 8),
        ('RIGHTPADDING', (0, 0), (-1, -1), 8),
    ]))
    story.append(t_rnf)
    story.append(Spacer(1, 10))

    story.append(Paragraph("5. Entregables y Aprobación Formal", h1_style))
    story.append(HRFlowable(width="100%", thickness=0.75, color=c_gold, spaceAfter=8))

    story.append(Paragraph("• <b>Paquete Instalable WordPress:</b> <code>joyeria-angy-tema-wordpress.zip</code>", bullet_style))
    story.append(Paragraph("• <b>Portal Web & Prototipo:</b> <code>preview/index.html</code> y <code>preview/admin.html</code>", bullet_style))
    story.append(Paragraph("• <b>Guía de Instalación:</b> <code>GUIA_INSTALACION_WORDPRESS.md</code>", bullet_style))
    story.append(Paragraph("• <b>Control de Versiones:</b> Repositorio oficial en GitHub (Rama <code>main</code>).", bullet_style))
    story.append(Spacer(1, 25))

    sig_data = [
        [
            Paragraph("____________________________________________<br/><b>Joyería Angy</b><br/><font size=7.5 color='#666666'>Dirección General & Aprobación</font>", body_style),
            Paragraph("____________________________________________<br/><b>Equipo de Ingeniería & Arquitectura</b><br/><font size=7.5 color='#666666'>Gaona Consultores TI</font>", body_style)
        ]
    ]
    t_sig = Table(sig_data, colWidths=[3.5 * inch, 3.5 * inch])
    t_sig.setStyle(TableStyle([
        ('ALIGN', (0, 0), (-1, -1), 'CENTER'),
        ('VALIGN', (0, 0), (-1, -1), 'MIDDLE'),
        ('TOPPADDING', (0, 0), (-1, -1), 10),
    ]))
    story.append(t_sig)

    doc.build(story, canvasmaker=NumberedCanvas)
    print(f"PDF generado con éxito en: {pdf_path}")

if __name__ == "__main__":
    build_pdf()
