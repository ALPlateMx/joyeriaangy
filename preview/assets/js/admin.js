/**
 * JOYERÍA ANGY - SISTEMA DE AUTENTICACIÓN, ROLES & ERP INDEPENDIENTE (ADMIN.JS)
 * Control de Acceso Seguro, Creación de Usuarios, Asignación de Roles y Gestión de Inventario
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Usuarios y Roles Iniciales de Joyería Angy ERP
  const DEFAULT_USERS = [
    {
      id: 'usr-1',
      name: 'Angy Platero',
      email: 'admin@joyeriaangy.com',
      username: 'admin',
      pass: 'angy2026',
      role: 'superadmin',
      roleLabel: 'Super Administrador',
      status: 'active',
      createdAt: '2026-01-10'
    },
    {
      id: 'usr-2',
      name: 'Roberto Mendoza',
      email: 'almacen@joyeriaangy.com',
      username: 'almacen',
      pass: 'almacen2026',
      role: 'manager',
      roleLabel: 'Gerente de Almacén',
      status: 'active',
      createdAt: '2026-02-01'
    },
    {
      id: 'usr-3',
      name: 'Sofía Joyas',
      email: 'ventas@joyeriaangy.com',
      username: 'ventas',
      pass: 'ventas2026',
      role: 'sales',
      roleLabel: 'Asesor de Ventas',
      status: 'active',
      createdAt: '2026-02-15'
    },
    {
      id: 'usr-4',
      name: 'Lic. Claudia Morales',
      email: 'auditoria@joyeriaangy.com',
      username: 'auditoria',
      pass: 'auditor2026',
      role: 'auditor',
      roleLabel: 'Auditor Financiero',
      status: 'active',
      createdAt: '2026-03-01'
    }
  ];

  // Cargar usuarios del Storage o inicializar
  let users = JSON.parse(localStorage.getItem('joyeria_angy_admin_users'));
  if (!users || !Array.isArray(users) || users.length === 0) {
    users = DEFAULT_USERS;
    localStorage.setItem('joyeria_angy_admin_users', JSON.stringify(users));
  }

  // 2. Catálogo Base Inicial de Inventario
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

  let products = JSON.parse(localStorage.getItem('joyeria_angy_products_inventory'));
  if (!products || !Array.isArray(products) || products.length === 0) {
    products = DEFAULT_PRODUCTS;
    localStorage.setItem('joyeria_angy_products_inventory', JSON.stringify(products));
  }

  // Elementos DOM
  const loginScreen = document.getElementById('adminLoginScreen');
  const dashboardScreen = document.getElementById('adminDashboardScreen');
  const loginForm = document.getElementById('adminLoginForm');
  const userInput = document.getElementById('loginUsername');
  const passInput = document.getElementById('loginPassword');
  const rememberCheckbox = document.getElementById('rememberSession');
  const errorMsg = document.getElementById('loginErrorMsg');
  const logoutBtn = document.getElementById('adminLogoutBtn');

  // Modales
  const productModal = document.getElementById('productAdminModal');
  const closeProductModalBtn = document.getElementById('closeProductModalBtn');
  const productForm = document.getElementById('productAdminForm');

  const userModal = document.getElementById('userAdminModal');
  const closeUserModalBtn = document.getElementById('closeUserModalBtn');
  const userForm = document.getElementById('userAdminForm');
  const toastContainer = document.getElementById('toastContainer');

  function formatCurrency(amount) {
    return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(amount);
  }

  // 3. Verificación de Autenticación y Carga de Usuario Activo
  function getActiveUser() {
    return JSON.parse(localStorage.getItem('joyeria_angy_current_admin')) || 
           JSON.parse(sessionStorage.getItem('joyeria_angy_current_admin'));
  }

  function checkAuthState() {
    const activeUser = getActiveUser();

    if (activeUser && activeUser.email) {
      if (loginScreen) loginScreen.style.display = 'none';
      if (dashboardScreen) dashboardScreen.style.display = 'block';

      // Actualizar perfil en topbar
      const avatarEl = document.getElementById('headerAdminAvatar');
      const nameEl = document.getElementById('headerAdminName');
      const roleEl = document.getElementById('headerAdminRole');

      if (avatarEl) {
        const initials = activeUser.name.split(' ').map(n => n[0]).join('').slice(0, 2).toUpperCase();
        avatarEl.textContent = initials || 'JA';
      }
      if (nameEl) nameEl.textContent = activeUser.name || 'Administrador';
      if (roleEl) roleEl.textContent = activeUser.roleLabel || 'Super Administrador';

      updateKPIs();
      renderInventoryTable();
      renderUsersTable();
    } else {
      if (loginScreen) loginScreen.style.display = 'flex';
      if (dashboardScreen) dashboardScreen.style.display = 'none';
    }
  }

  // 4. Procesar Login
  loginForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const entered = userInput.value.trim().toLowerCase();
    const pass = passInput.value.trim();

    const foundUser = users.find(u => 
      (u.email.toLowerCase() === entered || u.username.toLowerCase() === entered) && u.pass === pass
    );

    if (foundUser) {
      if (foundUser.status === 'suspended') {
        if (errorMsg) {
          errorMsg.textContent = '⛔ Esta cuenta de usuario se encuentra suspendida por la administración.';
          errorMsg.style.display = 'block';
        }
        return;
      }

      if (errorMsg) errorMsg.style.display = 'none';
      
      const remember = rememberCheckbox?.checked;
      if (remember) {
        localStorage.setItem('joyeria_angy_current_admin', JSON.stringify(foundUser));
        localStorage.setItem('joyeria_angy_admin_auth', 'true');
      } else {
        sessionStorage.setItem('joyeria_angy_current_admin', JSON.stringify(foundUser));
        sessionStorage.setItem('joyeria_angy_admin_auth', 'true');
      }

      showToast(`🔑 ¡Bienvenido(a), ${foundUser.name}! (${foundUser.roleLabel})`);
      checkAuthState();
    } else {
      if (errorMsg) {
        errorMsg.textContent = '❌ Usuario o contraseña incorrectos. Verifica tus credenciales.';
        errorMsg.style.display = 'block';
      }
      passInput.value = '';
      passInput.focus();
    }
  });

  // 5. Logout
  window.adminLogout = function() {
    localStorage.removeItem('joyeria_angy_current_admin');
    sessionStorage.removeItem('joyeria_angy_current_admin');
    localStorage.removeItem('joyeria_angy_admin_auth');
    sessionStorage.removeItem('joyeria_angy_admin_auth');
    showToast('🔒 Sesión cerrada con seguridad.');
    checkAuthState();
  };

  logoutBtn?.addEventListener('click', window.adminLogout);

  // 6. Cambio de Pestañas del Panel Admin
  window.switchAdminTab = function(tabName) {
    document.querySelectorAll('.admin-subnav-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.admin-tab-content').forEach(tab => tab.style.display = 'none');

    const btn = document.getElementById(`tabBtn-${tabName}`);
    const content = document.getElementById(`tabContent-${tabName}`);

    if (btn) btn.classList.add('active');
    if (content) content.style.display = 'block';

    if (tabName === 'inventario') {
      renderInventoryTable();
      updateKPIs();
    } else if (tabName === 'usuarios') {
      renderUsersTable();
    }
  };

  // 7. Módulo de Gestión de Usuarios & Roles (CRUD)
  function renderUsersTable() {
    const tbody = document.getElementById('usersTableBody');
    if (!tbody) return;

    const q = (document.getElementById('usersSearchInput')?.value || '').toLowerCase().trim();
    const roleFilter = document.getElementById('usersRoleFilter')?.value || 'all';

    let list = users;
    if (roleFilter !== 'all') {
      list = list.filter(u => u.role === roleFilter);
    }
    if (q) {
      list = list.filter(u => u.name.toLowerCase().includes(q) || u.email.toLowerCase().includes(q) || u.username.toLowerCase().includes(q));
    }

    const roleBadgeClasses = {
      'superadmin': 'role-superadmin',
      'manager': 'role-manager',
      'sales': 'role-sales',
      'auditor': 'role-auditor'
    };

    const roleIcons = {
      'superadmin': 'fa-solid fa-crown',
      'manager': 'fa-solid fa-boxes-stacked',
      'sales': 'fa-solid fa-comments-dollar',
      'auditor': 'fa-solid fa-calculator'
    };

    if (list.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="6" style="text-align:center; padding: 2.5rem; color:var(--color-silver-mid);">
            <i class="fa-solid fa-users-slash" style="font-size: 2rem; margin-bottom: 0.5rem; color:var(--color-gold-bronze); display:block;"></i>
            No se encontraron usuarios registrados con los filtros seleccionados.
          </td>
        </tr>
      `;
      return;
    }

    const activeAdmin = getActiveUser();

    tbody.innerHTML = list.map(u => {
      const initials = u.name.split(' ').map(n => n[0]).join('').slice(0, 2).toUpperCase();
      const isCurrent = activeAdmin && (activeAdmin.id === u.id || activeAdmin.email === u.email);
      const isSuspended = u.status === 'suspended';

      return `
        <tr data-id="${u.id}">
          <td>
            <div style="display:flex; align-items:center; gap:0.75rem;">
              <div class="admin-avatar" style="width:34px; height:34px; font-size:0.78rem;">${initials}</div>
              <div>
                <div style="font-weight:600; color:#ffffff;">${u.name} ${isCurrent ? '<span style="font-size:0.7rem; color:var(--color-gold-bronze);">(Tú)</span>' : ''}</div>
                <div style="font-size:0.75rem; color:var(--color-silver-dark);">ID: ${u.id}</div>
              </div>
            </div>
          </td>
          <td>
            <div style="color:var(--text-main); font-size:0.9rem;">${u.email}</div>
            <div style="font-size:0.75rem; color:var(--color-silver-mid); font-family:monospace;">@${u.username}</div>
          </td>
          <td>
            <span class="role-badge ${roleBadgeClasses[u.role] || 'role-superadmin'}">
              <i class="${roleIcons[u.role] || 'fa-solid fa-shield-halved'}"></i> ${u.roleLabel}
            </span>
          </td>
          <td>
            <span class="${isSuspended ? 'status-badge-suspended' : 'status-badge-active'}">
              ${isSuspended ? '<i class="fa-solid fa-ban"></i> Suspendido' : '<i class="fa-solid fa-circle-check"></i> Activo'}
            </span>
          </td>
          <td style="font-size:0.82rem; color:var(--color-silver-dark);">${u.createdAt || '2026-01-01'}</td>
          <td>
            <div style="display:flex; gap:0.4rem;">
              <button class="icon-action-btn" style="width:32px; height:32px; font-size:0.78rem;" onclick="openEditUserModal('${u.id}')" title="Editar Usuario & Rol">
                <i class="fa-solid fa-pen"></i>
              </button>
              <button class="icon-action-btn" style="width:32px; height:32px; font-size:0.78rem; color:${isSuspended ? '#4ade80' : '#f59e0b'};" onclick="toggleUserStatus('${u.id}')" title="${isSuspended ? 'Reactivar Acceso' : 'Suspender Acceso'}" ${isCurrent ? 'disabled style="opacity:0.3; cursor:not-allowed;"' : ''}>
                <i class="fa-solid ${isSuspended ? 'fa-user-check' : 'fa-user-slash'}"></i>
              </button>
              <button class="icon-action-btn" style="width:32px; height:32px; font-size:0.78rem; color:#ef4444;" onclick="deleteUser('${u.id}')" title="Eliminar Usuario" ${isCurrent ? 'disabled style="opacity:0.3; cursor:not-allowed;"' : ''}>
                <i class="fa-solid fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  }

  function saveUsers() {
    localStorage.setItem('joyeria_angy_admin_users', JSON.stringify(users));
    renderUsersTable();
  }

  window.openAddUserModal = function() {
    document.getElementById('userModalTitle').textContent = '➕ Registrar Nuevo Usuario / Colaborador';
    userForm.reset();
    document.getElementById('editUserId').value = '';
    document.getElementById('formUserPass').required = true;
    userModal?.classList.add('active');
  };

  window.openEditUserModal = function(id) {
    const u = users.find(user => user.id === id);
    if (!u) return;

    document.getElementById('userModalTitle').textContent = `✏️ Editar Usuario: ${u.name}`;
    document.getElementById('editUserId').value = u.id;
    document.getElementById('formUserName').value = u.name;
    document.getElementById('formUserEmail').value = u.email;
    document.getElementById('formUserUsername').value = u.username;
    document.getElementById('formUserRole').value = u.role;
    document.getElementById('formUserStatus').value = u.status;
    document.getElementById('formUserPass').value = '';
    document.getElementById('formUserPass').placeholder = 'Dejar en blanco para mantener la contraseña actual';
    document.getElementById('formUserPass').required = false;

    userModal?.classList.add('active');
  };

  closeUserModalBtn?.addEventListener('click', () => userModal?.classList.remove('active'));
  userModal?.addEventListener('click', (e) => {
    if (e.target === userModal) userModal.classList.remove('active');
  });

  window.generateRandomPassword = function() {
    const chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%';
    let pass = '';
    for (let i = 0; i < 10; i++) {
      pass += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    const passInputEl = document.getElementById('formUserPass');
    if (passInputEl) {
      passInputEl.value = pass;
      passInputEl.type = 'text';
      showToast(`🔑 Clave generada: ${pass}`);
    }
  };

  userForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const editId = document.getElementById('editUserId').value;
    const name = document.getElementById('formUserName').value.trim();
    const email = document.getElementById('formUserEmail').value.trim().toLowerCase();
    const username = document.getElementById('formUserUsername').value.trim().toLowerCase();
    const pass = document.getElementById('formUserPass').value.trim();
    const role = document.getElementById('formUserRole').value;
    const status = document.getElementById('formUserStatus').value;

    const roleLabels = {
      'superadmin': 'Super Administrador',
      'manager': 'Gerente de Almacén',
      'sales': 'Asesor de Ventas',
      'auditor': 'Auditor Financiero'
    };

    if (editId) {
      const idx = users.findIndex(u => u.id === editId);
      if (idx > -1) {
        users[idx].name = name;
        users[idx].email = email;
        users[idx].username = username;
        users[idx].role = role;
        users[idx].roleLabel = roleLabels[role] || 'Colaborador';
        users[idx].status = status;
        if (pass) users[idx].pass = pass;
        showToast(`✨ Usuario "${name}" actualizado con éxito`);
      }
    } else {
      const duplicate = users.find(u => u.email.toLowerCase() === email || u.username.toLowerCase() === username);
      if (duplicate) {
        alert('⚠️ Ya existe un usuario registrado con ese correo o nombre de usuario.');
        return;
      }

      const newId = `usr-${Date.now().toString(36)}`;
      users.push({
        id: newId,
        name,
        email,
        username,
        pass: pass || 'angy2026',
        role,
        roleLabel: roleLabels[role] || 'Colaborador',
        status,
        createdAt: new Date().toISOString().slice(0, 10)
      });
      showToast(`👥 ¡Usuario "${name}" (${roleLabels[role]}) creado!`);
    }

    saveUsers();
    userModal?.classList.remove('active');
  });

  window.toggleUserStatus = function(id) {
    const u = users.find(user => user.id === id);
    if (!u) return;
    const newStatus = u.status === 'active' ? 'suspended' : 'active';
    u.status = newStatus;
    saveUsers();
    showToast(`Estado de ${u.name} cambiado a ${newStatus === 'active' ? 'Activo' : 'Suspendido'}`);
  };

  window.deleteUser = function(id) {
    const u = users.find(user => user.id === id);
    if (!u) return;
    if (confirm(`¿Estás seguro de eliminar el usuario "${u.name}" (${u.email})? Esta acción revocará todos sus accesos al ERP.`)) {
      users = users.filter(user => user.id !== id);
      saveUsers();
      showToast('🗑️ Usuario eliminado del sistema');
    }
  };

  document.getElementById('usersSearchInput')?.addEventListener('input', renderUsersTable);
  document.getElementById('usersRoleFilter')?.addEventListener('change', renderUsersTable);

  // 8. Control de Inventario y KPIs
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

  function renderInventoryTable() {
    const tableBody = document.getElementById('inventoryTableBody');
    if (!tableBody) return;

    const searchQ = (document.getElementById('inventorySearchInput')?.value || '').toLowerCase().trim();
    const filterCat = document.getElementById('inventoryCategoryFilter')?.value || 'all';
    const filterStock = document.getElementById('inventoryStockFilter')?.value || 'all';

    let list = products;
    if (filterCat !== 'all') list = list.filter(p => p.category === filterCat);
    if (filterStock === 'in') list = list.filter(p => p.stock > 3);
    else if (filterStock === 'low') list = list.filter(p => p.stock > 0 && p.stock <= 3);
    else if (filterStock === 'out') list = list.filter(p => p.stock <= 0);

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
