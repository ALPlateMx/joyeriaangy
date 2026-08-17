/**
 * JOYERÍA ANGY - SISTEMA DE AUTENTICACIÓN Y PORTAL ERP INDEPENDIENTE (ADMIN.JS)
 * Control de Acceso Seguro, Sesión de Administrador y Gestión de Inventario
 */

document.addEventListener('DOMContentLoaded', () => {
  // Credenciales Oficiales de Demostración
  const VALID_USER = 'admin@joyeriaangy.com';
  const VALID_USER_SHORT = 'admin';
  const VALID_PASS = 'angy2026';
  const VALID_PASS_ALT = 'admin123';

  // Elementos DOM de Login y Dashboard
  const loginScreen = document.getElementById('adminLoginScreen');
  const dashboardScreen = document.getElementById('adminDashboardScreen');
  const loginForm = document.getElementById('adminLoginForm');
  const userInput = document.getElementById('loginUsername');
  const passInput = document.getElementById('loginPassword');
  const rememberCheckbox = document.getElementById('rememberSession');
  const errorMsg = document.getElementById('loginErrorMsg');
  const logoutBtn = document.getElementById('adminLogoutBtn');

  // Elementos del Modal de Joyas
  const productModal = document.getElementById('productAdminModal');
  const closeProductModalBtn = document.getElementById('closeProductModalBtn');
  const productForm = document.getElementById('productAdminForm');
  const toastContainer = document.getElementById('toastContainer');

  // Catálogo Base Inicial
  const DEFAULT_PRODUCTS = [
    {
      id: 'prod-1',
      sku: 'ANGY-AN-001',
      title: 'Anillo Solitario Diamante Simulado Plata .925',
      category: 'anillos',
      categoryLabel: 'Anillos de Compromiso',
      metal: 'Plata Ley .925 Quintada',
      price: 1290,
      oldPrice: 1650,
      stock: 14,
      image: 'assets/images/anillo-solitario.jpg',
      badge: 'Más Vendido',
      badgeClass: 'badge-hot',
      desc: 'Forjado a mano por expertos orfebres en auténtica Plata Esterlina Ley .925 con un deslumbrante centro de corte brillante redondo y micropavé en los laterales.'
    },
    {
      id: 'prod-2',
      sku: 'ANGY-CO-002',
      title: 'Gargantilla Corazón de Cristal Zafiro Plata .925',
      category: 'collares',
      categoryLabel: 'Collares & Dijes',
      metal: 'Plata Ley .925 con Baño de Rodio',
      price: 1150,
      oldPrice: 1450,
      stock: 8,
      image: 'assets/images/collar-corazon.jpg',
      badge: '-20% OFF',
      badgeClass: 'badge-sale',
      desc: 'Collar de cadena veneciana en plata esterlina .925 con un dije de corazón en cristal azul zafiro facetado.'
    },
    {
      id: 'prod-3',
      sku: 'ANGY-PU-003',
      title: 'Brazalete Tennis & Eslabón Doble Plata Italiana .925',
      category: 'pulseras',
      categoryLabel: 'Pulseras Finas',
      metal: 'Plata Italiana Ley .925',
      price: 1590,
      oldPrice: 1990,
      stock: 3,
      image: 'assets/images/pulsera-eslabones.jpg',
      badge: 'Edición Limitada',
      badgeClass: 'badge-hot',
      desc: 'Fusión de lujo entre un clásico brazalete tennis con circonias engastadas y eslabones dobles de plata italiana.'
    },
    {
      id: 'prod-4',
      sku: 'ANGY-AR-004',
      title: 'Arracadas Huggies Micro-Pavé Circonias Plata .925',
      category: 'aretes',
      categoryLabel: 'Aretes & Arracadas',
      metal: 'Plata Ley .925 Hipoalergénica',
      price: 890,
      oldPrice: 1100,
      stock: 19,
      image: 'assets/images/aretes-arracadas.jpg',
      badge: 'Plata .925',
      badgeClass: 'badge-silver',
      desc: 'Arracadas huggies de diseño curvo con triple hilera de circonias micropavé en plata hipoalergénica.'
    },
    {
      id: 'prod-5',
      sku: 'ANGY-PA-005',
      title: "Dúo Anillos de Promesa 'Forever & Always' Plata .925",
      category: 'parejas',
      categoryLabel: 'Joyería para Parejas',
      metal: 'Plata Ley .925 & Titanio',
      price: 2190,
      oldPrice: 2790,
      stock: 6,
      image: 'assets/images/anillos-pareja.jpg',
      badge: 'Dúo Especial',
      badgeClass: 'badge-hot',
      desc: 'Par de anillos de promesa para pareja en auténtica plata .925 con grabado de texto interior.'
    }
  ];

  // Cargar base de datos compartida con la tienda
  let products = JSON.parse(localStorage.getItem('joyeria_angy_products_inventory'));
  if (!products || !Array.isArray(products) || products.length === 0) {
    products = DEFAULT_PRODUCTS;
    localStorage.setItem('joyeria_angy_products_inventory', JSON.stringify(products));
  }

  function formatCurrency(amount) {
    return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(amount);
  }

  // 1. Verificación de Estado de Autenticación
  function checkAuthState() {
    const isAuth = localStorage.getItem('joyeria_angy_admin_auth') === 'true' || 
                   sessionStorage.getItem('joyeria_angy_admin_auth') === 'true';

    if (isAuth) {
      loginScreen.style.display = 'none';
      dashboardScreen.style.display = 'block';
      updateKPIs();
      renderInventoryTable();
    } else {
      loginScreen.style.display = 'flex';
      dashboardScreen.style.display = 'none';
    }
  }

  // 2. Procesar Login
  loginForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const user = userInput.value.trim().toLowerCase();
    const pass = passInput.value.trim();

    if ((user === VALID_USER || user === VALID_USER_SHORT) && (pass === VALID_PASS || pass === VALID_PASS_ALT)) {
      if (errorMsg) errorMsg.style.display = 'none';
      
      const remember = rememberCheckbox?.checked;
      if (remember) {
        localStorage.setItem('joyeria_angy_admin_auth', 'true');
      } else {
        sessionStorage.setItem('joyeria_angy_admin_auth', 'true');
      }

      showToast('🔑 ¡Sesión iniciada con éxito! Bienvenido al ERP de Joyería Angy.');
      checkAuthState();
    } else {
      if (errorMsg) {
        errorMsg.textContent = '❌ Usuario o contraseña incorrectos. Verifica tus accesos.';
        errorMsg.style.display = 'block';
      }
      passInput.value = '';
      passInput.focus();
    }
  });

  // 3. Procesar Logout
  window.adminLogout = function() {
    localStorage.removeItem('joyeria_angy_admin_auth');
    sessionStorage.removeItem('joyeria_angy_admin_auth');
    showToast('🔒 Sesión cerrada con seguridad.');
    checkAuthState();
  };

  logoutBtn?.addEventListener('click', window.adminLogout);

  // 4. Actualización de KPIs en Tiempo Real
  function updateKPIs() {
    const totalCount = products.length;
    const totalUnits = products.reduce((acc, p) => acc + (parseInt(p.stock, 10) || 0), 0);
    const totalValuation = products.reduce((acc, p) => acc + ((parseInt(p.stock, 10) || 0) * p.price), 0);
    const lowStockCount = products.filter(p => p.stock > 0 && p.stock <= 3).length;
    const outOfStockCount = products.filter(p => p.stock <= 0).length;

    const kpiTotalEl = document.getElementById('kpiTotalProducts');
    const kpiUnitsEl = document.getElementById('kpiTotalUnits');
    const kpiValuationEl = document.getElementById('kpiTotalValuation');
    const kpiAlertsEl = document.getElementById('kpiLowStockAlerts');

    if (kpiTotalEl) kpiTotalEl.textContent = totalCount;
    if (kpiUnitsEl) kpiUnitsEl.textContent = `${totalUnits} pzas`;
    if (kpiValuationEl) kpiValuationEl.textContent = formatCurrency(totalValuation);
    if (kpiAlertsEl) {
      kpiAlertsEl.innerHTML = `${lowStockCount} <span style="font-size:0.85rem; color:#ef4444; font-weight:normal;">(${outOfStockCount} agotados)</span>`;
    }
  }

  // 5. Renderizado de Tabla de Inventario
  function renderInventoryTable() {
    const tableBody = document.getElementById('inventoryTableBody');
    if (!tableBody) return;

    const searchQ = (document.getElementById('inventorySearchInput')?.value || '').toLowerCase().trim();
    const filterCat = document.getElementById('inventoryCategoryFilter')?.value || 'all';
    const filterStock = document.getElementById('inventoryStockFilter')?.value || 'all';

    let list = products;
    if (filterCat !== 'all') {
      list = list.filter(p => p.category === filterCat);
    }
    if (filterStock === 'in') {
      list = list.filter(p => p.stock > 3);
    } else if (filterStock === 'low') {
      list = list.filter(p => p.stock > 0 && p.stock <= 3);
    } else if (filterStock === 'out') {
      list = list.filter(p => p.stock <= 0);
    }
    if (searchQ) {
      list = list.filter(p => p.title.toLowerCase().includes(searchQ) || p.sku.toLowerCase().includes(searchQ));
    }

    if (list.length === 0) {
      tableBody.innerHTML = `
        <tr>
          <td colspan="7" style="text-align:center; padding: 2.5rem; color:var(--color-silver-mid);">
            <i class="fa-solid fa-box-open" style="font-size: 2.2rem; margin-bottom: 0.5rem; color:var(--color-gold-bronze); display:block;"></i>
            No se encontraron piezas con los filtros seleccionados.
          </td>
        </tr>
      `;
      return;
    }

    tableBody.innerHTML = list.map(p => {
      let statusBadge = '';
      if (p.stock <= 0) {
        statusBadge = `<span class="stock-badge stock-out"><i class="fa-solid fa-circle-xmark"></i> Agotado (0)</span>`;
      } else if (p.stock <= 3) {
        statusBadge = `<span class="stock-badge stock-low"><i class="fa-solid fa-triangle-exclamation"></i> Bajo (${p.stock})</span>`;
      } else {
        statusBadge = `<span class="stock-badge stock-in"><i class="fa-solid fa-circle-check"></i> En Stock (${p.stock})</span>`;
      }

      return `
        <tr data-id="${p.id}">
          <td style="width: 70px;">
            <img src="${p.image}" alt="${p.title}" style="width:50px; height:50px; border-radius:6px; object-fit:cover; border:1px solid var(--border-glass);" onerror="this.src='assets/images/anillo-solitario.jpg'">
          </td>
          <td>
            <div style="font-weight:600; color:#ffffff; font-size:0.95rem;">${p.title}</div>
            <div style="font-size:0.78rem; color:var(--color-gold-bronze); font-family:monospace;"><i class="fa-solid fa-barcode"></i> ${p.sku}</div>
          </td>
          <td><span style="background:rgba(255,255,255,0.06); padding:3px 8px; border-radius:4px; font-size:0.8rem; color:var(--color-silver-light);">${p.categoryLabel}</span></td>
          <td style="font-size:0.85rem; color:var(--color-silver-mid);">${p.metal}</td>
          <td>
            <div style="font-weight:700; color:#ffffff;">${formatCurrency(p.price)}</div>
            ${p.oldPrice ? `<div style="font-size:0.75rem; color:var(--color-silver-dark); text-decoration:line-through;">${formatCurrency(p.oldPrice)}</div>` : ''}
          </td>
          <td>
            <div style="display:flex; align-items:center; gap:0.6rem;">
              <div class="stock-stepper">
                <button class="stock-step-btn" onclick="adjustStock('${p.id}', -1)" title="Reducir 1 unidad">-</button>
                <span style="font-weight:700; min-width:24px; text-align:center; color:#ffffff;">${p.stock}</span>
                <button class="stock-step-btn" onclick="adjustStock('${p.id}', 1)" title="Aumentar 1 unidad">+</button>
              </div>
              ${statusBadge}
            </div>
          </td>
          <td>
            <div style="display:flex; gap:0.4rem;">
              <button class="icon-action-btn" style="width:34px; height:34px; font-size:0.82rem;" onclick="openEditProductModal('${p.id}')" title="Editar Joya">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button class="icon-action-btn" style="width:34px; height:34px; font-size:0.82rem; color:#ef4444;" onclick="deleteProduct('${p.id}')" title="Eliminar Joya">
                <i class="fa-solid fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  }

  function saveProducts() {
    localStorage.setItem('joyeria_angy_products_inventory', JSON.stringify(products));
    renderInventoryTable();
    updateKPIs();
  }

  // 6. Funciones CRUD
  window.adjustStock = function(id, delta) {
    const prod = products.find(p => p.id === id);
    if (!prod) return;
    const newStock = Math.max(0, (parseInt(prod.stock, 10) || 0) + delta);
    prod.stock = newStock;
    saveProducts();
    showToast(`📦 Stock de ${prod.sku} ajustado a ${newStock} piezas`);
  };

  window.deleteProduct = function(id) {
    const prod = products.find(p => p.id === id);
    if (!prod) return;
    if (confirm(`¿Estás seguro de eliminar "${prod.title}" (${prod.sku}) de tu catálogo e inventario?`)) {
      products = products.filter(p => p.id !== id);
      saveProducts();
      showToast('🗑️ Joya eliminada del inventario');
    }
  };

  window.openAddProductModal = function() {
    document.getElementById('productModalTitle').textContent = '➕ Registrar Nueva Joya en Inventario';
    productForm.reset();
    document.getElementById('editProductId').value = '';
    document.getElementById('formSku').value = `ANGY-PL-${String(products.length + 1).padStart(3, '0')}`;
    document.getElementById('formStock').value = '10';
    productModal?.classList.add('active');
  };

  window.openEditProductModal = function(id) {
    const p = products.find(prod => prod.id === id);
    if (!p) return;

    document.getElementById('productModalTitle').textContent = `✏️ Editar Joya: ${p.sku}`;
    document.getElementById('editProductId').value = p.id;
    document.getElementById('formTitle').value = p.title;
    document.getElementById('formSku').value = p.sku;
    document.getElementById('formCategory').value = p.category;
    document.getElementById('formMetal').value = p.metal;
    document.getElementById('formPrice').value = p.price;
    document.getElementById('formOldPrice').value = p.oldPrice || '';
    document.getElementById('formStock').value = p.stock;
    document.getElementById('formImage').value = p.image;
    document.getElementById('formDesc').value = p.desc || '';
    document.getElementById('formBadge').value = p.badge || 'Plata .925';

    productModal?.classList.add('active');
  };

  closeProductModalBtn?.addEventListener('click', () => productModal?.classList.remove('active'));
  productModal?.addEventListener('click', (e) => {
    if (e.target === productModal) productModal.classList.remove('active');
  });

  productForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const editId = document.getElementById('editProductId').value;
    const title = document.getElementById('formTitle').value.trim();
    const sku = document.getElementById('formSku').value.trim();
    const category = document.getElementById('formCategory').value;
    const metal = document.getElementById('formMetal').value.trim();
    const price = parseFloat(document.getElementById('formPrice').value) || 0;
    const oldPrice = parseFloat(document.getElementById('formOldPrice').value) || 0;
    const stock = parseInt(document.getElementById('formStock').value, 10) || 0;
    const image = document.getElementById('formImage').value.trim() || 'assets/images/anillo-solitario.jpg';
    const desc = document.getElementById('formDesc').value.trim();
    const badge = document.getElementById('formBadge').value.trim();

    const categoryLabels = {
      'anillos': 'Anillos de Compromiso',
      'collares': 'Collares & Dijes',
      'pulseras': 'Pulseras Finas',
      'aretes': 'Aretes & Arracadas',
      'parejas': 'Joyería para Parejas',
      'acero': 'Acero Inoxidable 316L'
    };

    if (editId) {
      const index = products.findIndex(p => p.id === editId);
      if (index > -1) {
        products[index] = {
          ...products[index],
          title,
          sku,
          category,
          categoryLabel: categoryLabels[category] || 'Alta Joyería',
          metal,
          price,
          oldPrice,
          stock,
          image,
          desc,
          badge,
          badgeClass: badge.includes('%') ? 'badge-sale' : 'badge-silver'
        };
        showToast(`✨ Joya "${title}" actualizada`);
      }
    } else {
      const newId = `prod-${Date.now().toString(36)}`;
      products.unshift({
        id: newId,
        sku,
        title,
        category,
        categoryLabel: categoryLabels[category] || 'Alta Joyería',
        metal,
        price,
        oldPrice,
        stock,
        image,
        desc,
        badge: badge || 'Nuevo Lanzamiento',
        badgeClass: 'badge-silver'
      });
      showToast(`💎 ¡Nueva joya "${title}" registrada con éxito!`);
    }

    saveProducts();
    productModal?.classList.remove('active');
  });

  window.exportInventoryJSON = function() {
    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(products, null, 2));
    const downloadAnchor = document.createElement('a');
    downloadAnchor.setAttribute("href", dataStr);
    downloadAnchor.setAttribute("download", `inventario_joyeria_angy_${new Date().toISOString().slice(0,10)}.json`);
    document.body.appendChild(downloadAnchor);
    downloadAnchor.click();
    downloadAnchor.remove();
    showToast('📁 Archivo de inventario exportado');
  };

  window.resetDefaultInventory = function() {
    if (confirm('¿Deseas restablecer el inventario inicial con los 5 modelos de muestra?')) {
      products = DEFAULT_PRODUCTS;
      saveProducts();
      showToast('🔄 Inventario restablecido');
    }
  };

  // Buscadores y Filtros
  document.getElementById('inventorySearchInput')?.addEventListener('input', renderInventoryTable);
  document.getElementById('inventoryCategoryFilter')?.addEventListener('change', renderInventoryTable);
  document.getElementById('inventoryStockFilter')?.addEventListener('change', renderInventoryTable);

  function showToast(message) {
    if (!toastContainer) return;
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `<i class="fa-solid fa-circle-check" style="color:var(--color-gold-bronze);"></i> <span>${message}</span>`;
    toastContainer.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
      toast.style.transition = '0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 3200);
  }
  window.showToast = showToast;

  // Iniciar verificación
  checkAuthState();
});
