/**
 * JOYERÍA ANGY - MOTOR PRINCIPAL DE TIENDA E INVENTARIO (APP.JS)
 * Control de Inventario en Tiempo Real, Carrito, Medidor de Tallas, WhatsApp y CRUD de Productos
 */

document.addEventListener('DOMContentLoaded', () => {
  const JOYERIA_WHATSAPP = '5215512345678';

  // 1. Catálogo Inicial de Inventario de Joyería Angy
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
      desc: 'Forjado a mano por expertos orfebres en auténtica Plata Esterlina Ley .925 con un deslumbrante centro de corte brillante redondo y micropavé en los laterales. Diseñado para una comodidad superior y un brillo inigualable.'
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
      desc: 'Collar de cadena veneciana en plata esterlina .925 con un dije de corazón en cristal azul zafiro facetado, rodeado de delicada filigrana de plata pulida con acabado rodio anti-deslustre.'
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
      stock: 3, // Stock Bajo
      image: 'assets/images/pulsera-eslabones.jpg',
      badge: 'Edición Limitada',
      badgeClass: 'badge-hot',
      desc: 'Fusión de lujo entre un clásico brazalete tennis con circonias engastadas a 4 uñas y eslabones dobles de plata italiana con broche de seguridad tipo langosta.'
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
      desc: 'Arracadas huggies de diseño curvo con triple hilera de circonias micropavé. Cierre de presión seguro y cómodo para uso diario en plata hipoalergénica.'
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
      desc: 'Par de anillos de promesa para pareja. Una argolla lisa de plata satinada y una churumbela completa de circonias brillantes. Incluye grabado de texto gratuito en el interior.'
    }
  ];

  // Cargar productos del LocalStorage o inicializar
  let products = JSON.parse(localStorage.getItem('joyeria_angy_products_inventory'));
  if (!products || !Array.isArray(products) || products.length === 0) {
    products = DEFAULT_PRODUCTS;
    localStorage.setItem('joyeria_angy_products_inventory', JSON.stringify(products));
  }

  // Carrito y Favoritos
  let cart = JSON.parse(localStorage.getItem('joyeria_angy_cart')) || [
    {
      id: 'prod-1',
      title: 'Anillo Solitario Diamante Simulado Plata .925',
      price: 1290,
      size: '7',
      image: 'assets/images/anillo-solitario.jpg',
      qty: 1
    }
  ];

  let wishlist = JSON.parse(localStorage.getItem('joyeria_angy_wishlist')) || [];
  let currentProductDetail = products[0] || DEFAULT_PRODUCTS[0];

  // Elementos DOM
  const cartDrawerOverlay = document.getElementById('cartDrawerOverlay');
  const cartToggleButtons = document.querySelectorAll('.cart-toggle-btn');
  const closeDrawerBtn = document.getElementById('closeDrawerBtn');
  const cartItemsList = document.getElementById('cartItemsList');
  const cartSubtotalEl = document.getElementById('cartSubtotal');
  const cartCountBadges = document.querySelectorAll('.cart-count-badge');
  const whatsappCartBtn = document.getElementById('whatsappCartBtn');
  const toastContainer = document.getElementById('toastContainer');
  const header = document.querySelector('.site-header');

  // Ring Sizer Elements
  const ringSizerModal = document.getElementById('ringSizerModal');
  const openRingSizerBtns = document.querySelectorAll('.open-ring-sizer-btn');
  const closeRingSizerBtn = document.getElementById('closeRingSizerBtn');
  const sizerSlider = document.getElementById('sizerSlider');
  const sizerCircle = document.getElementById('sizerCircle');
  const sizerSizeValue = document.getElementById('sizerSizeValue');
  const sizerMmValue = document.getElementById('sizerMmValue');

  // Product Admin Modal Elements
  const productModal = document.getElementById('productAdminModal');
  const closeProductModalBtn = document.getElementById('closeProductModalBtn');
  const productForm = document.getElementById('productAdminForm');

  // 2. Funciones de Formato
  function formatCurrency(amount) {
    return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(amount);
  }
  window.formatCurrency = formatCurrency;

  function saveProducts() {
    localStorage.setItem('joyeria_angy_products_inventory', JSON.stringify(products));
    renderAllGrids();
    renderInventoryTable();
    updateInventoryKPIs();
  }

  // 3. Renderizado de Catálogo en Tienda y Home
  function renderAllGrids() {
    renderGrid('homeProductsGrid', 'all');
    renderGrid('shopProductsGrid', 'all');
  }

  function renderGrid(containerId, filterCat = 'all', searchQuery = '') {
    const container = document.getElementById(containerId);
    if (!container) return;

    let filtered = products;
    if (filterCat !== 'all') {
      filtered = filtered.filter(p => p.category === filterCat);
    }
    if (searchQuery.trim() !== '') {
      const q = searchQuery.toLowerCase();
      filtered = filtered.filter(p => p.title.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q) || p.categoryLabel.toLowerCase().includes(q));
    }

    if (filtered.length === 0) {
      container.innerHTML = `
        <div style="grid-column: 1 / -1; text-align:center; padding: 3rem 1rem; color: var(--color-silver-mid);">
          <i class="fa-solid fa-gem" style="font-size: 2.5rem; margin-bottom: 1rem; color: #38bdf8; opacity:0.6;"></i>
          <h3>No se encontraron piezas</h3>
          <p>Intenta con otra categoría o término de búsqueda.</p>
        </div>
      `;
      return;
    }

    container.innerHTML = filtered.map(p => {
      const isOutOfStock = p.stock <= 0;
      const isLowStock = p.stock > 0 && p.stock <= 3;
      const badgeHtml = isOutOfStock 
        ? `<span class="badge badge-outofstock">Agotado</span>`
        : `<span class="badge ${p.badgeClass || 'badge-silver'}">${p.badge || 'Plata .925'}</span>`;
      
      const stockHint = isLowStock ? `<span style="font-size:0.75rem; color:#facc15; font-weight:600;"><i class="fa-solid fa-fire"></i> ¡Últimas ${p.stock} piezas!</span>` : '';

      return `
        <div class="product-card" data-category="${p.category}" onclick="openProductDetail('${p.id}')">
          <div class="product-image-wrap">
            <span class="product-badges">
              ${badgeHtml}
              <span class="badge badge-silver">${p.metal.includes('.925') ? 'Plata .925' : 'Acero 316L'}</span>
            </span>
            <div class="product-actions-hover" onclick="event.stopPropagation()">
              <button class="action-icon-btn wishlist-btn" data-id="${p.id}" onclick="toggleWishlist('${p.id}', '${p.title.replace(/'/g, "\\'")}')" title="Añadir a favoritos">
                <i class="fa-regular fa-heart" style="color: ${wishlist.includes(p.id) ? '#ef4444' : '#ffffff'};"></i>
              </button>
              ${p.category === 'anillos' || p.category === 'parejas' ? `<button class="action-icon-btn open-ring-sizer-btn" title="Medidor de Tallas"><i class="fa-solid fa-ruler"></i></button>` : ''}
            </div>
            <img src="${p.image}" alt="${p.title}" onerror="this.src='assets/images/anillo-solitario.jpg'">
          </div>
          <div class="product-info">
            <div style="display:flex; justify-content:space-between; align-items:center;">
              <span class="product-meta-tag">${p.categoryLabel}</span>
              ${stockHint}
            </div>
            <h4 class="product-title">${p.title}</h4>
            <div class="product-rating">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
              <span class="rating-count">(${p.sku})</span>
            </div>
            <div class="product-price-row">
              <span class="current-price">${formatCurrency(p.price)}</span>
              ${p.oldPrice ? `<span class="regular-price">${formatCurrency(p.oldPrice)}</span>` : ''}
            </div>
            <div class="product-btn-group" onclick="event.stopPropagation()">
              <button class="btn btn-primary btn-sm add-to-cart-quick" data-id="${p.id}" data-price="${p.price}" ${isOutOfStock ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : ''}>
                <i class="fa-solid fa-bag-shopping"></i> ${isOutOfStock ? 'Agotado' : 'Agregar'}
              </button>
              <a href="#" class="btn btn-whatsapp btn-sm btn-whatsapp-product" data-title="${p.title.replace(/"/g, '&quot;')}" data-price="${p.price}" ${isOutOfStock ? 'style="opacity:0.5; pointer-events:none;"' : ''}>
                <i class="fa-brands fa-whatsapp"></i>
              </a>
            </div>
          </div>
        </div>
      `;
    }).join('');

    attachProductQuickListeners();
  }

  function attachProductQuickListeners() {
    document.querySelectorAll('.add-to-cart-quick').forEach(btn => {
      btn.onclick = (e) => {
        e.preventDefault();
        const id = btn.dataset.id;
        const prod = products.find(p => p.id === id);
        if (!prod || prod.stock <= 0) {
          showToast('⚠️ Producto temporalmente agotado');
          return;
        }
        window.addToCart({
          id: prod.id,
          title: prod.title,
          price: prod.price,
          size: '7',
          image: prod.image,
          qty: 1
        });
      };
    });

    document.querySelectorAll('.btn-whatsapp-product').forEach(btn => {
      btn.onclick = (e) => {
        const title = btn.dataset.title || 'Joya Joyería Angy';
        const price = btn.dataset.price || '0';
        const msg = `💍 *¡Hola Joyería Angy!* Me gustaría ordenar la pieza: *${title}* (${formatCurrency(price)}) en Plata Ley .925. ¿Tienen disponibilidad para envío inmediato?`;
        btn.href = `https://wa.me/${JOYERIA_WHATSAPP}?text=${encodeURIComponent(msg)}`;
      };
    });
  }

  // 4. Módulo de Administración e Inventario (KPIs y Tabla)
  function updateInventoryKPIs() {
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
      kpiAlertsEl.innerHTML = `${lowStockCount} <span style="font-size:0.9rem; color:#ef4444; font-weight:normal;">(${outOfStockCount} agotados)</span>`;
    }
  }

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
            <i class="fa-solid fa-box-open" style="font-size: 2rem; margin-bottom: 0.5rem; color:#38bdf8; display:block;"></i>
            No se encontraron joyas con los filtros seleccionados.
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
        statusBadge = `<span class="stock-badge stock-in"><i class="fa-solid fa-circle-check"></i> Disponible (${p.stock})</span>`;
      }

      return `
        <tr data-id="${p.id}">
          <td style="width: 70px;">
            <img src="${p.image}" alt="${p.title}" style="width:50px; height:50px; border-radius:6px; object-fit:cover; border:1px solid var(--border-glass);" onerror="this.src='assets/images/anillo-solitario.jpg'">
          </td>
          <td>
            <div style="font-weight:600; color:#ffffff; font-size:0.95rem;">${p.title}</div>
            <div style="font-size:0.78rem; color:var(--color-silver-glow); font-family:monospace;"><i class="fa-solid fa-barcode"></i> ${p.sku}</div>
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
              <button class="icon-action-btn" style="width:34px; height:34px; font-size:0.82rem; color:#38bdf8;" onclick="openProductDetail('${p.id}')" title="Ver en Tienda">
                <i class="fa-solid fa-eye"></i>
              </button>
              <button class="icon-action-btn" style="width:34px; height:34px; font-size:0.82rem; color:#ef4444;" onclick="deleteProduct('${p.id}')" title="Eliminar de Catálogo">
                <i class="fa-solid fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  }

  // 5. CRUD de Joyas e Inventario
  window.adjustStock = function(id, delta) {
    const prod = products.find(p => p.id === id);
    if (!prod) return;
    const newStock = Math.max(0, (parseInt(prod.stock, 10) || 0) + delta);
    prod.stock = newStock;
    saveProducts();
    showToast(`📦 Stock de ${prod.sku} actualizado a ${newStock} pzas`);
  };

  window.deleteProduct = function(id) {
    const prod = products.find(p => p.id === id);
    if (!prod) return;
    if (confirm(`¿Estás seguro de eliminar "${prod.title}" (${prod.sku}) del catálogo e inventario?`)) {
      products = products.filter(p => p.id !== id);
      saveProducts();
      showToast(`🗑️ Joya eliminada del inventario`);
    }
  };

  window.openAddProductModal = function() {
    document.getElementById('productModalTitle').textContent = '➕ Agregar Nueva Joya al Inventario';
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

  closeProductModalBtn?.addEventListener('click', () => {
    productModal?.classList.remove('active');
  });

  productModal?.addEventListener('click', (e) => {
    if (e.target === productModal) {
      productModal.classList.remove('active');
    }
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
      // Modificar existente
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
          badgeClass: badge.includes('%') ? 'badge-sale' : (badge.includes('Más') || badge.includes('HOT') ? 'badge-hot' : 'badge-silver')
        };
        showToast(`✨ Joya "${title}" actualizada`);
      }
    } else {
      // Crear nueva pieza
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
      showToast(`💎 ¡Nueva joya "${title}" agregada al inventario!`);
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
    showToast('📁 Archivo de inventario descargado');
  };

  window.resetDefaultInventory = function() {
    if (confirm('¿Deseas restablecer el inventario inicial de muestra? Se restaurarán los 5 modelos principales.')) {
      products = DEFAULT_PRODUCTS;
      saveProducts();
      showToast('🔄 Inventario restablecido con éxito');
    }
  };

  // 6. Vista de Detalle de Producto
  window.openProductDetail = function(productId) {
    const prod = products.find(p => p.id === productId) || products[0];
    currentProductDetail = prod;

    const imgEl = document.getElementById('detailMainImage');
    const titleEl = document.getElementById('detailTitle');
    const metaEl = document.getElementById('detailMetaTag');
    const priceEl = document.getElementById('detailPrice');
    const oldPriceEl = document.getElementById('detailOldPrice');
    const descEl = document.getElementById('detailDesc');
    const waBtn = document.getElementById('detailWhatsAppBtn');
    const addBtn = document.getElementById('detailAddToCartBtn');

    if (imgEl) imgEl.src = prod.image;
    if (titleEl) titleEl.textContent = prod.title;
    if (metaEl) metaEl.textContent = `${prod.categoryLabel} • ${prod.metal}`;
    if (priceEl) priceEl.textContent = formatCurrency(prod.price);
    if (oldPriceEl) oldPriceEl.textContent = prod.oldPrice ? formatCurrency(prod.oldPrice) : '';
    if (descEl) descEl.textContent = prod.desc;

    const isOutOfStock = prod.stock <= 0;
    if (addBtn) {
      if (isOutOfStock) {
        addBtn.disabled = true;
        addBtn.innerHTML = `<i class="fa-solid fa-ban"></i> Producto Agotado`;
        addBtn.style.opacity = '0.5';
        addBtn.style.cursor = 'not-allowed';
      } else {
        addBtn.disabled = false;
        addBtn.innerHTML = `<i class="fa-solid fa-bag-shopping"></i> Añadir a mi Carrito (${prod.stock} disponibles)`;
        addBtn.style.opacity = '1';
        addBtn.style.cursor = 'pointer';
      }
    }

    if (waBtn) {
      if (isOutOfStock) {
        waBtn.style.opacity = '0.5';
        waBtn.style.pointerEvents = 'none';
      } else {
        waBtn.style.opacity = '1';
        waBtn.style.pointerEvents = 'auto';
        const waMsg = `💍 *¡Hola Joyería Angy!* Me gustaría ordenar la pieza: *${prod.title}* (${formatCurrency(prod.price)}) en ${prod.metal}. SKU: ${prod.sku}. ¿Tienen disponibilidad?`;
        waBtn.href = `https://wa.me/${JOYERIA_WHATSAPP}?text=${encodeURIComponent(waMsg)}`;
      }
    }

    window.switchView('producto');
  };

  // 7. Navegación entre Vistas (SPA Switching)
  window.switchView = function(viewName, filterCategory) {
    document.querySelectorAll('.page-view').forEach(view => view.classList.remove('active-view'));
    document.querySelectorAll('.view-pill-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));

    const targetView = document.getElementById(`view-${viewName}`);
    if (targetView) targetView.classList.add('active-view');

    const pillBtn = document.querySelector(`.view-pill-btn[onclick*="${viewName}"]`);
    if (pillBtn) pillBtn.classList.add('active');

    const navLink = document.getElementById(`nav-${viewName}`);
    if (navLink) navLink.classList.add('active');

    window.scrollTo({ top: 0, behavior: 'smooth' });

    if (viewName === 'admin') {
      renderInventoryTable();
      updateInventoryKPIs();
    } else if (viewName === 'catalogo') {
      const activeCat = filterCategory || 'all';
      renderGrid('shopProductsGrid', activeCat);
      document.querySelectorAll('#view-catalogo .tab-btn').forEach(b => {
        b.classList.toggle('active', b.dataset.category === activeCat);
      });
    } else if (viewName === 'inicio') {
      renderGrid('homeProductsGrid', 'all');
    }
  };

  // 8. Filtros de Categoría
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const parentView = btn.closest('.page-view');
      const targetGrid = parentView?.id === 'view-inicio' ? 'homeProductsGrid' : 'shopProductsGrid';
      parentView?.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderGrid(targetGrid, btn.dataset.category || 'all');
    });
  });

  // 9. Buscador Global y Buscador de Inventario
  document.getElementById('globalSearchInput')?.addEventListener('input', (e) => {
    const q = e.target.value;
    window.switchView('catalogo');
    renderGrid('shopProductsGrid', 'all', q);
  });

  document.getElementById('inventorySearchInput')?.addEventListener('input', () => {
    renderInventoryTable();
  });
  document.getElementById('inventoryCategoryFilter')?.addEventListener('change', () => {
    renderInventoryTable();
  });
  document.getElementById('inventoryStockFilter')?.addEventListener('change', () => {
    renderInventoryTable();
  });

  // 10. Carrito de Compras
  function saveCart() {
    localStorage.setItem('joyeria_angy_cart', JSON.stringify(cart));
    updateCartUI();
  }

  function updateCartUI() {
    const totalCount = cart.reduce((acc, item) => acc + item.qty, 0);
    const subtotal = cart.reduce((acc, item) => acc + (item.price * item.qty), 0);

    cartCountBadges.forEach(badge => badge.textContent = totalCount);
    if (cartSubtotalEl) cartSubtotalEl.textContent = formatCurrency(subtotal);

    if (cartItemsList) {
      if (cart.length === 0) {
        cartItemsList.innerHTML = `
          <div style="text-align:center; padding: 3rem 1rem; color: var(--color-silver-mid);">
            <i class="fa-solid fa-gem" style="font-size: 2.5rem; margin-bottom: 1rem; color:#38bdf8; opacity: 0.5;"></i>
            <p>Tu carrito está vacío</p>
            <button class="btn btn-outline-silver btn-sm" style="margin-top: 1rem;" onclick="document.getElementById('closeDrawerBtn').click(); switchView('catalogo');">Explorar Colección</button>
          </div>
        `;
      } else {
        cartItemsList.innerHTML = cart.map(item => `
          <div class="cart-item" data-id="${item.id}">
            <img src="${item.image}" alt="${item.title}" onerror="this.src='assets/images/anillo-solitario.jpg'">
            <div class="cart-item-info">
              <h5>${item.title}</h5>
              <div class="cart-item-meta">Talla: ${item.size || 'Estándar'} | Plata Ley .925</div>
              <div class="cart-item-price">${formatCurrency(item.price)}</div>
            </div>
            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:0.4rem;">
              <div class="qty-control">
                <button class="qty-btn decrease-qty" data-id="${item.id}">-</button>
                <span class="qty-num">${item.qty}</span>
                <button class="qty-btn increase-qty" data-id="${item.id}">+</button>
              </div>
              <button class="remove-cart-item" data-id="${item.id}" style="background:transparent; border:none; color: #ef4444; font-size:0.75rem; cursor:pointer;">Eliminar</button>
            </div>
          </div>
        `).join('');
      }
    }

    const freeShippingTarget = 1499;
    const progressFill = document.querySelector('.progress-fill');
    const shippingText = document.getElementById('shippingProgressText');
    if (progressFill && shippingText) {
      const percentage = Math.min((subtotal / freeShippingTarget) * 100, 100);
      progressFill.style.width = `${percentage}%`;
      if (subtotal >= freeShippingTarget) {
        shippingText.innerHTML = '✨ ¡Felicidades! Tienes <strong>Envío Gratis Express</strong>';
      } else {
        const remaining = freeShippingTarget - subtotal;
        shippingText.innerHTML = `Agrega <strong>${formatCurrency(remaining)}</strong> más para <strong>Envío Gratis</strong>`;
      }
    }

    if (whatsappCartBtn) {
      if (cart.length > 0) {
        let msg = `💍 *¡Hola Joyería Angy! Deseo comprar el siguiente pedido de joyería:*%0A%0A`;
        cart.forEach((item, idx) => {
          msg += `${idx + 1}. *${item.title}* (Talla: ${item.size || 'Estándar'}) x ${item.qty} = ${formatCurrency(item.price * item.qty)}%0A`;
        });
        msg += `%0A💰 *Total a Pagar:* ${formatCurrency(subtotal)}%0A📍 *Material:* Plata Ley .925 con Certificado y Estuche de Regalo%0A%0A¿Me podrían indicar los datos para realizar mi pago y coordinar el envío por favor?`;
        whatsappCartBtn.href = `https://wa.me/${JOYERIA_WHATSAPP}?text=${msg}`;
      } else {
        whatsappCartBtn.href = `https://wa.me/${JOYERIA_WHATSAPP}?text=Hola%20Joyer%C3%ADa%20Angy,%20quisiera%20recibir%20el%20cat%C3%A1logo%20actualizado`;
      }
    }
  }

  window.addToCart = function(product) {
    const existing = cart.find(i => i.id === product.id && i.size === product.size);
    if (existing) {
      existing.qty += (product.qty || 1);
    } else {
      cart.push({
        id: product.id,
        title: product.title,
        price: product.price,
        size: product.size || '7',
        image: product.image,
        qty: product.qty || 1
      });
    }
    saveCart();
    showToast(`✨ ¡${product.title} añadido al carrito!`);
    cartDrawerOverlay?.classList.add('active');
  };

  cartToggleButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      cartDrawerOverlay?.classList.add('active');
    });
  });

  closeDrawerBtn?.addEventListener('click', () => cartDrawerOverlay?.classList.remove('active'));
  cartDrawerOverlay?.addEventListener('click', (e) => {
    if (e.target === cartDrawerOverlay) cartDrawerOverlay.classList.remove('active');
  });

  cartItemsList?.addEventListener('click', (e) => {
    const target = e.target;
    const id = target.dataset.id;
    if (!id) return;

    if (target.classList.contains('increase-qty')) {
      const item = cart.find(i => i.id === id);
      if (item) item.qty++;
      saveCart();
    } else if (target.classList.contains('decrease-qty')) {
      const item = cart.find(i => i.id === id);
      if (item && item.qty > 1) {
        item.qty--;
      } else {
        cart = cart.filter(i => i.id !== id);
      }
      saveCart();
    } else if (target.classList.contains('remove-cart-item')) {
      cart = cart.filter(i => i.id !== id);
      saveCart();
      showToast('Producto eliminado del carrito');
    }
  });

  // 11. Medidor de Anillos (Ring Sizer)
  const ringSizesMap = [
    { size: '4', mm: 14.9, px: 75 },
    { size: '4.5', mm: 15.3, px: 79 },
    { size: '5', mm: 15.7, px: 83 },
    { size: '5.5', mm: 16.1, px: 87 },
    { size: '6', mm: 16.5, px: 91 },
    { size: '6.5', mm: 16.9, px: 95 },
    { size: '7', mm: 17.3, px: 99 },
    { size: '7.5', mm: 17.7, px: 103 },
    { size: '8', mm: 18.1, px: 107 },
    { size: '8.5', mm: 18.5, px: 111 },
    { size: '9', mm: 18.9, px: 115 },
    { size: '9.5', mm: 19.4, px: 119 },
    { size: '10', mm: 19.8, px: 123 },
    { size: '10.5', mm: 20.2, px: 127 },
    { size: '11', mm: 20.6, px: 131 },
    { size: '12', mm: 21.4, px: 139 }
  ];

  function updateRingSizer(val) {
    const index = Math.min(Math.max(parseInt(val, 10), 0), ringSizesMap.length - 1);
    const data = ringSizesMap[index];
    if (sizerCircle) {
      sizerCircle.style.width = `${data.px}px`;
      sizerCircle.style.height = `${data.px}px`;
    }
    if (sizerSizeValue) sizerSizeValue.textContent = `Talla ${data.size}`;
    if (sizerMmValue) sizerMmValue.textContent = `${data.mm} mm de diámetro`;
  }

  sizerSlider?.addEventListener('input', (e) => updateRingSizer(e.target.value));

  openRingSizerBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      ringSizerModal?.classList.add('active');
      updateRingSizer(sizerSlider?.value || 6);
    });
  });

  closeRingSizerBtn?.addEventListener('click', () => ringSizerModal?.classList.remove('active'));
  ringSizerModal?.addEventListener('click', (e) => {
    if (e.target === ringSizerModal) ringSizerModal.classList.remove('active');
  });

  // Selector de Tallas en Ficha
  document.querySelectorAll('.size-pill').forEach(pill => {
    pill.addEventListener('click', () => {
      const parent = pill.closest('.size-selector-grid');
      if (!parent) return;
      parent.querySelectorAll('.size-pill').forEach(p => p.classList.remove('selected'));
      pill.classList.add('selected');
    });
  });

  // Wishlist
  window.toggleWishlist = function(id, title) {
    const idx = wishlist.indexOf(id);
    if (idx > -1) {
      wishlist.splice(idx, 1);
      showToast(`Removido de favoritos`);
    } else {
      wishlist.push(id);
      showToast(`💖 ¡${title} guardado en favoritos!`);
    }
    localStorage.setItem('joyeria_angy_wishlist', JSON.stringify(wishlist));
    renderAllGrids();
  };

  // Toast
  function showToast(message) {
    if (!toastContainer) return;
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `<i class="fa-solid fa-circle-check" style="color:#38bdf8;"></i> <span>${message}</span>`;
    toastContainer.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
      toast.style.transition = '0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 3200);
  }
  window.showToast = showToast;

  // Header Scroll
  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) header?.classList.add('scrolled');
    else header?.classList.remove('scrolled');
  });

  // Inicialización
  renderAllGrids();
  updateCartUI();
  updateInventoryKPIs();
});
