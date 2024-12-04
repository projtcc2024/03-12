if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", ready);
} else {
    ready();
}

function ready() {
    loadCart(); // Carrega o carrinho da memória
    updateCart(); // Atualiza a exibição dos itens do carrinho
}

let cart = [];

// Carrega o carrinho e atualiza a exibição ao carregar a página
window.onload = function () {
    loadCart();
    updateCart();
};

// Carrega o carrinho do localStorage
function loadCart() {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart); // Converte a string em um array
    } else {
        cart = []; // Inicializa o carrinho como vazio
    }
    updateCart();
}

// Atualiza a exibição dos itens no carrinho
function updateCart() {
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = ''; // Limpa o conteúdo atual

    if (cart.length === 0) {
        cartContainer.innerHTML = '<p>O carrinho está vazio.</p>'; // Mensagem se o carrinho estiver vazio
    } else {
        cart.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'cart-item row mb-4 d-flex justify-content-between align-items-center';
            itemElement.innerHTML = `
                <div class="col-md-3">
                    <h6>${item.name}</h6> <!-- Nome do produto -->
                </div>
                <div class="col-md-3 d-flex">
                    <button class="btn btn-link px-2" onclick="updateQuantity(${item.id}, -1)">
                        <i class="fas fa-minus"></i> <!-- Botão para diminuir quantidade -->
                    </button>
                    <input type="number" min="1" class="form-control form-control-sm quantity-input" value="${item.quantity}" onchange="updateQuantity(${item.id}, this.value - ${item.quantity})" />
                    <button class="btn btn-link px-2" onclick="updateQuantity(${item.id}, 1)">
                        <i class="fas fa-plus"></i> <!-- Botão para aumentar quantidade -->
                    </button>
                </div>
                <div class="col-md-2">
                    <h6 class="item-price">R$ ${item.price.toFixed(2)}</h6> <!-- Preço do produto -->
                </div>
                <div class="col-md-1 text-end">
                    <button onclick="removeFromCart(${item.id})" class="remove-item btn btn-link">
                        <i class="fas fa-times"></i> <!-- Botão para remover o item -->
                    </button>
                </div>
            `;
            cartContainer.appendChild(itemElement);
        });
    }

    updateTotal(); // Chama updateTotal para recalcular os totais
    saveCart(); // Salva o carrinho atualizado no localStorage
}

// Atualiza o total de itens e o preço no carrinho
function updateTotal() {
    let total = 0;
    let totalItems = 0;
    
    const shippingCost = parseFloat(document.getElementById('shipping-options') ? document.getElementById('shipping-options').value : 0);
    
    cart.forEach(item => {
        total += item.price * item.quantity; // Soma o preço total dos itens
        totalItems += item.quantity; // Soma a quantidade total dos itens
    });

    total += shippingCost; // Adiciona o custo do frete ao total

    // Atualiza o DOM com os valores totais
    document.getElementById('total-price').textContent = `R$ ${total.toFixed(2)}`; // Atualiza o total de preço
    document.getElementById('final-price').textContent = `R$ ${total.toFixed(2)}`; // Atualiza o preço final
    document.getElementById('total-items').textContent = totalItems; // Atualiza o total de itens
}


// Remove um item do carrinho
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId); // Remove o item do carrinho pelo ID
    updateCart(); // Atualiza a exibição do carrinho
}

// Atualiza a quantidade de um item no carrinho
function updateQuantity(productId, change) {
    const item = cart.find(i => i.id === productId); // Encontra o item pelo ID
    if (item) {
        item.quantity = Math.max(1, item.quantity + change); // Garante que a quantidade seja no mínimo 1
    }
    updateCart(); // Atualiza a exibição do carrinho
}

// Salva o carrinho no localStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart)); // Armazena o carrinho no localStorage
}
