let cart = JSON.parse(localStorage.getItem('cart')) || []; // Inicializa o carrinho

// Função para adicionar um produto ao carrinho
function addToCart(productId, productName, productPrice) {
    const itemIndex = cart.findIndex(item => item.id === productId); // Procura o item no carrinho pelo ID

    if (itemIndex > -1) {
        // Se o item já existe no carrinho, incrementa a quantidade
        cart[itemIndex].quantity += 1;
    } else {
        // Se não existe, adiciona como um novo item
        cart.push({ 
            id: productId, 
            name: productName, 
            price: productPrice, 
            quantity: 1 
        });
    }

    saveCart(); // Salva o carrinho no localStorage
    updateCartBadge(); // Atualiza o badge de itens no carrinho
    alert('Produto adicionado ao carrinho!'); // Alerta de confirmação
}

// Função intermediária para verificar login antes de adicionar ao carrinho
function handleAddToCart(productId, productName, productPrice) {
    if (!isLoggedIn) {
        // Redireciona para a página de erro
        window.location.href = '../html/erroadaocarrinho.html';
        return;
    }
    addToCart(productId, productName, productPrice);
}

// Atualiza o número de itens exibidos no badge
function updateCartBadge() {
    const itemCount = cart.reduce((sum, item) => sum + item.quantity, 0); // Soma todas as quantidades no carrinho
    const badge = document.getElementById('item-count'); // Badge no carrinho
    if (badge) {
        badge.textContent = itemCount; // Atualiza o conteúdo do badge
    }
}

// Salva o carrinho no localStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart)); // Armazena o carrinho
    console.log(`Carrinho salvo: ${JSON.stringify(cart)}`); // Log para depuração
}

// Atualiza a contagem de itens ao carregar a página
window.onload = function () {
    updateCartBadge(); // Atualiza o badge assim que a página é carregada
};
