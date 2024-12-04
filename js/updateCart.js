// Função para atualizar o contador de itens no carrinho
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const itemCount = cart.reduce((acc, item) => acc + item.quantity, 0);
    const itemCountElement = document.getElementById('item-count');
    if (itemCountElement) {
        itemCountElement.textContent = itemCount; // Atualiza o contador no HTML
    }
}

// Chama a função de atualizar ao carregar a página
window.onload = updateCartCount;
