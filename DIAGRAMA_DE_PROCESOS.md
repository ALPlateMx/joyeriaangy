# 📊 Diagrama de Procesos del Proyecto: Joyería Angy

Este documento describe la arquitectura de flujos y procesos de la solución digital de **Joyería Angy**, desarrollada por **Gaona Consultores TI**, cubriendo tanto la experiencia de compra del cliente en la tienda pública como la operativa interna en el portal ERP administrativo.

---

## 1. Diagrama de Flujo Global del Sistema

```mermaid
flowchart TD
    %% Estilos de Nodos
    classDef client fill:#140E0B,stroke:#D4A373,stroke-width:2px,color:#ffffff;
    classDef erp fill:#1C1410,stroke:#38BDF8,stroke-width:2px,color:#ffffff;
    classDef decision fill:#2B1D16,stroke:#F59E0B,stroke-width:2px,color:#ffffff;
    classDef success fill:#064E3B,stroke:#10B981,stroke-width:2px,color:#ffffff;
    classDef role fill:#311042,stroke:#C084FC,stroke-width:2px,color:#ffffff;

    Start([Inicio: Visitante / Usuario]) --> RoleCheck{¿Tipo de Usuario?}

    %% ==========================================
    %% FLUJO CLIENTE (TIENDA PÚBLICA)
    %% ==========================================
    RoleCheck -->|Cliente / Comprador| FrontEnd[1. Tienda Pública: Joyería Angy]:::client
    
    FrontEnd --> Browse[2. Explorar Catálogo & Colecciones<br/>Anillos, Collares, Pulseras, Aretes, Parejas]:::client
    
    Browse --> NeedSize{¿Requiere conocer su talla de anillo?}:::decision
    NeedSize -->|Sí| Sizer[3. Medidor Virtual de Anillos<br/>Calibración milimétrica en pantalla]:::client
    NeedSize -->|No| AddCart[4. Seleccionar Joya & Metal<br/>Plata Ley .925 / Acero 316L]:::client
    Sizer --> AddCart

    AddCart --> Drawer[5. Mini-Carrito Drawer<br/>Cálculo dinámico de Subtotal]:::client
    
    Drawer --> FreeShipCheck{¿Subtotal >= $1,499 MXN?}:::decision
    FreeShipCheck -->|Sí| FreeShip[Envío Gratis Express Desbloqueado]:::success
    FreeShipCheck -->|No| BarFill[Barra indica monto faltante]:::client
    
    FreeShip --> CheckoutWhatsApp[6. Clic en 'Finalizar Pedido por WhatsApp']:::client
    BarFill --> CheckoutWhatsApp

    CheckoutWhatsApp --> WAPayload[7. Mensaje estructurado automático:<br/>Joyas, SKUs, Tallas, Metales y Total]:::success
    WAPayload --> CloseSale[8. Cierre de Venta con Asesor & Envío Asegurado]:::success

    %% ==========================================
    %% FLUJO BACK-OFFICE / ERP INDEPENDIENTE
    %% ==========================================
    RoleCheck -->|Colaborador / Admin| AdminPortal[1. Portal de Administración Independiente<br/>preview/admin.html o /admin]:::erp
    
    AdminPortal --> Login[2. Pantalla de Login Seguro]:::erp
    Login --> AuthCheck{¿Credenciales Válidas & Usuario Activo?}:::decision
    
    AuthCheck -->|No o Suspendido| LoginFail[Denegar Acceso / Mostrar Alerta]:::decision
    LoginFail --> Login

    AuthCheck -->|Sí| RoleEval[3. Identificación de Rol del Colaborador]:::role

    RoleEval --> RoleChoice{Rol Asignado}:::role
    
    %% Acciones por Rol
    RoleChoice -->|Super Administrador| FullAccess[Acceso Total:<br/>• Inventario & Precios<br/>• Gestión de Usuarios & Roles<br/>• Valuación Financiera & JSON]:::success
    
    RoleChoice -->|Gerente de Almacén| StockAccess[Gestión de Almacén:<br/>• Alta/Edición de Joyas<br/>• Ajuste de Stock +/-<br/>• Alertas de Stock Bajo]:::erp
    
    RoleChoice -->|Asesor de Ventas| SalesAccess[Consulta de Stock:<br/>• Ver existencias en tiempo real<br/>• Catálogo para cotizaciones]:::client
    
    RoleChoice -->|Auditor Financiero| AuditAccess[Auditoría:<br/>• Monitoreo de Valuación $ MXN<br/>• Descarga de respaldos JSON]:::role

    %% Módulos ERP
    FullAccess --> ModuleSelect{Seleccionar Módulo ERP}:::erp
    StockAccess --> ModInventory[Pestaña 1: Control de Inventario]:::erp
    ModuleSelect -->|Pestaña 1| ModInventory
    ModuleSelect -->|Pestaña 2| ModUsers[Pestaña 2: Gestión de Usuarios & Roles]:::role

    ModInventory --> InvActions[• CRUD de Joyas<br/>• Botones +/- de Stock<br/>• Filtros y Búsqueda por SKU<br/>• Exportar Catálogo JSON]:::erp
    
    ModUsers --> UserActions[• Crear nuevo Colaborador<br/>• Generar Clave Segura<br/>• Asignar/Cambiar Rol<br/>• Suspender / Activar Acceso]:::role

    InvActions --> SyncStore[(Sincronización Instantánea con Catálogo Público)]:::success
    UserActions --> SyncAuth[(Actualización Inmediata de Base de Usuarios)]:::success
```

---

## 2. Diagrama de Secuencia: Experiencia de Compra por WhatsApp

```mermaid
sequenceDiagram
    autonumber
    actor Cliente as 🛍️ Cliente
    participant Tienda as 🌐 Tienda Joyería Angy
    participant Sizer as 💍 Medidor Virtual
    participant Drawer as 🛒 Carrito Drawer
    participant WhatsApp as 💬 WhatsApp Business
    actor Asesor as 👩‍💼 Asesor de Ventas

    Cliente->>Tienda: Ingresa a la tienda y explora catálogo
    Tienda-->>Cliente: Muestra piezas en Plata .925 y Acero 316L
    
    opt Cliente no sabe su talla
        Cliente->>Sizer: Abre medidor virtual
        Sizer-->>Cliente: Calibra diámetro y muestra talla exacta (ej. Talla 7)
    end

    Cliente->>Drawer: Agrega joya seleccionada al carrito
    Drawer-->>Cliente: Actualiza subtotal y progreso de Envío Gratis
    
    Cliente->>Drawer: Clic en "Finalizar Pedido por WhatsApp"
    Drawer->>WhatsApp: Envía datos formateados (Joya, SKU, Metal, Talla, Monto)
    WhatsApp->>Asesor: Recibe pedido estructurado listo para confirmar
    
    Asesor-->>Cliente: Confirma existencias, dirección y método de pago
    Cliente->>Asesor: Realiza pago (SPEI / Tarjeta / OXXO)
    Asesor-->>Cliente: Envía guía de rastreo y certificado .925
```

---

## 3. Diagrama de Secuencia: Gestión Operativa en el Portal ERP

```mermaid
sequenceDiagram
    autonumber
    actor Admin as 👤 Administrador / Colaborador
    participant LoginScreen as 🔒 Pantalla Login
    participant AuthEngine as ⚙️ Motor de Autenticación
    participant Dashboard as 📊 Dashboard ERP
    participant Inventario as 📦 Módulo de Inventario
    participant Usuarios as 👥 Módulo de Usuarios

    Admin->>LoginScreen: Ingresa usuario y contraseña
    LoginScreen->>AuthEngine: Valida credenciales y estado (Activo)
    
    alt Credenciales incorrectas o suspendido
        AuthEngine-->>LoginScreen: Muestra alerta de acceso denegado
    else Acceso correcto
        AuthEngine-->>Dashboard: Concede acceso y carga perfil con rol asignado
    end

    Dashboard-->>Admin: Muestra KPIs (Modelos, Stock físico, Valuación $ MXN, Alertas)

    alt Gestión de Existencias (Stock)
        Admin->>Inventario: Ajusta unidades (+ / -) o registra nueva joya
        Inventario-->>Dashboard: Recalcula KPIs y existencias en tiempo real
        Inventario->>Inventario: Sincroniza catálogo para tienda de clientes
    else Gestión de Colaboradores
        Admin->>Usuarios: Registra nuevo colaborador con rol y clave generada
        Usuarios-->>Dashboard: Actualiza tabla de usuarios activos
        Usuarios->>AuthEngine: Permite login inmediato al nuevo usuario
    end
```

---

## 4. Matriz de Entidades y Estados

```mermaid
stateDiagram-v2
    [*] --> PiezaRegistrada: Alta con SKU único
    
    state "Estado del Stock de Joyas" as StockState {
        PiezaRegistrada --> EnStock: Stock > 3 unidades
        EnStock --> StockBajo: Stock entre 1 y 3 unidades (Alerta ERP)
        StockBajo --> Agotado: Stock = 0 unidades (Badge 'Agotado')
        Agotado --> EnStock: Reabastecimiento (+ unidades)
    }

    state "Estado de Cuentas de Usuario" as UserState {
        UsuarioCreado --> Activo: Permite inicio de sesión en ERP
        Activo --> Suspendido: Administrador bloquea acceso
        Suspendido --> Activo: Administrador reactiva cuenta
        Activo --> Eliminado: Revocación definitiva
    }
```
