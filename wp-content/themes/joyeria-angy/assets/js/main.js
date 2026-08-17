/**
 * JOYERÍA ANGY - JAVASCRIPT PRINCIPAL (MAIN.JS)
 * Funcionalidades interactivas, Carrito, Medidor de Tallas, WhatsApp Directo y Modales
 */

document.addEventListener('DOMContentLoaded', () => {
  const JOYERIA_WHATSAPP = (typeof joyeriaAngyData !== 'undefined' && joyeriaAngyData.whatsapp) ? joyeriaAngyData.whatsapp : '5215512345678';

  // 1. Estado Global del Carrito y Favoritos
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

  // 2. Elementos DOM Comunes
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

  // 3. Header Scroll Effect
  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      header?.classList.add('scrolled');
    } else {
      header?.classList.remove('scrolled');
    }
  });

  // 4. Carrito Drawer Functions
  function saveCart() {
    localStorage.setItem('joyeria_angy_cart', JSON.stringify(cart));
    updateCartUI();
  }

  function formatCurrency(amount) {
    return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(amount);
  }

  function updateCartUI() {
    const totalCount = cart.reduce((acc, item) => acc + item.qty, 0);
    const subtotal = cart.reduce((acc, item) => acc + (item.price * item.qty), 0);

    cartCountBadges.forEach(badge => {
      badge.textContent = totalCount;
    });

    if (cartSubtotalEl) {
      cartSubtotalEl.textContent = formatCurrency(subtotal);
    }

    if (cartItemsList) {
      if (cart.length === 0) {
        cartItemsList.innerHTML = `
          <div style="text-align:center; padding: 3rem 1rem; color: var(--color-silver-mid);">
            <i class="fa-solid fa-gem" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.5;"></i>
            <p>Tu carrito está vacío</p>
            <button class="btn btn-outline-silver btn-sm" style="margin-top: 1rem;" onclick="document.getElementById('closeDrawerBtn').click()">Explorar Colección</button>
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

    // Actualizar barra de envío gratis (meta: $1,499 MXN)
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

    // Configurar enlace de WhatsApp para todo el pedido
    if (whatsappCartBtn) {
      if (cart.length > 0) {
        let msg = `💍 *¡Hola Joyería Angy! Deseo comprar el siguiente pedido de joyería:*%0A%0A`;
        cart.forEach((item, idx) => {
          msg += `${idx + 1}. *${item.title}* (Talla: ${item.size || 'Estándar'}) x ${item.qty} = ${formatCurrency(item.price * item.qty)}%0A`;
        });
        msg += `%0A💰 *Total a Pagar:* ${formatCurrency(subtotal)}%0A📍 *Material:* Plata Ley .925 Garantizada con Estuche de Regalo%0A%0A¿Me podrían indicar los datos para realizar mi pago y coordinar el envío por favor?`;
        whatsappCartBtn.href = `https://wa.me/${JOYERIA_WHATSAPP}?text=${msg}`;
      } else {
        whatsappCartBtn.href = `https://wa.me/${JOYERIA_WHATSAPP}?text=Hola%20Joyería%20Angy,%20quisiera%20recibir%20información%20y%20catálogo%20de%20plata%20.925`;
      }
    }
  }

  // Eventos del Carrito
  cartToggleButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      cartDrawerOverlay?.classList.add('active');
    });
  });

  closeDrawerBtn?.addEventListener('click', () => {
    cartDrawerOverlay?.classList.remove('active');
  });

  cartDrawerOverlay?.addEventListener('click', (e) => {
    if (e.target === cartDrawerOverlay) {
      cartDrawerOverlay.classList.remove('active');
    }
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

  // 5. Función Global para Añadir al Carrito
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

  // 6. Medidor Virtual de Tallas de Anillos (Ring Sizer)
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

  function updateRingSizer(sliderValue) {
    const index = Math.min(Math.max(parseInt(sliderValue, 10), 0), ringSizesMap.length - 1);
    const data = ringSizesMap[index];
    if (sizerCircle) {
      sizerCircle.style.width = `${data.px}px`;
      sizerCircle.style.height = `${data.px}px`;
    }
    if (sizerSizeValue) sizerSizeValue.textContent = `Talla ${data.size}`;
    if (sizerMmValue) sizerMmValue.textContent = `${data.mm} mm de diámetro`;
  }

  sizerSlider?.addEventListener('input', (e) => {
    updateRingSizer(e.target.value);
  });

  openRingSizerBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      ringSizerModal?.classList.add('active');
      updateRingSizer(sizerSlider?.value || 6);
    });
  });

  closeRingSizerBtn?.addEventListener('click', () => {
    ringSizerModal?.classList.remove('active');
  });

  ringSizerModal?.addEventListener('click', (e) => {
    if (e.target === ringSizerModal) {
      ringSizerModal.classList.remove('active');
    }
  });

  // 7. Selector de Tallas en Fichas de Producto
  document.querySelectorAll('.size-pill').forEach(pill => {
    pill.addEventListener('click', () => {
      const parent = pill.closest('.size-selector-grid');
      if (!parent) return;
      parent.querySelectorAll('.size-pill').forEach(p => p.classList.remove('selected'));
      pill.classList.add('selected');
    });
  });

  // 8. Notificaciones Toast
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

  // 9. Wishlist Toggle
  window.toggleWishlist = function(id, title) {
    const idx = wishlist.indexOf(id);
    if (idx > -1) {
      wishlist.splice(idx, 1);
      showToast(`Removido de favoritos`);
    } else {
      wishlist.push(id);
      showToast(`💖 ¡${title} guardado en tus favoritos!`);
    }
    localStorage.setItem('joyeria_angy_wishlist', JSON.stringify(wishlist));
    document.querySelectorAll(`.wishlist-btn[data-id="${id}"]`).forEach(b => {
      b.style.color = wishlist.includes(id) ? '#ef4444' : '#ffffff';
    });
  };

  // Inicializar UI
  updateCartUI();
});
