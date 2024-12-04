document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id'); // Pega o valor do parâmetro 'id'

    // Mock de produtos
    const products = {
        "1": { name: "Produto1", description: "Descrição do Produto 1", price: "R$ 5,50", img: "../images/at1.png" },
        "2": { name: "Produto2", description: "Descrição do Produto 2", price: "R$ 4,30", img: "../images/at2.png" },
        "3": { name: "Produto3", description: "Descrição do Produto 3", price: "R$ 4,30", img: "../images/at3.png" },
        "4": { name: "Produto4", description: "Descrição do Produto 4", price: "R$ 4,30", img: "../images/at4.png" },
        "5": { name: "Produto5", description: "Descrição do Produto 5", price: "R$ 4,30", img: "../images/at5.png" },
        "6": { name: "Produto6", description: "Descrição do Produto 6", price: "R$ 4,30", img: "../images/at6.png" },
        "7": { name: "Produto7", description: "Descrição do Produto 7", price: "R$ 4,30", img: "../images/at2.png" },
        "8": { name: "Produto8", description: "Descrição do Produto 8", price: "R$ 4,30", img: "../images/at7.png" },
        "9": { name: "Produto9", description: "Descrição do Produto 9", price: "R$ 4,30", img: "../images/at8.png" },
        "10": { name: "Produto10", description: "Descrição do Produto 10", price: "R$ 4,30", img: "../images/at9.png" },
        "11": { name: "Produto11", description: "Descrição do Produto 11", price: "R$ 4,30", img: "../images/at10.png" },
        "12": { name: "Produto12", description: "Descrição do Produto 12", price: "R$ 4,30", img: "../images/at11.png" },
        "13": { name: "Produto13", description: "Descrição do Produto 13", price: "R$ 4,30", img: "../images/at12.png" },
        // Adicione os outros produtos aqui
    };

    // Verifica se o produto existe
    const product = products[productId];
    if (product) {
        document.getElementById('product-info').innerHTML = `
            <img src="${product.img}" alt="${product.name}">
            <h2>${product.name}</h2>
            <p>${product.description}</p>
            <span>${product.price}</span>
        `;
    } else {
        document.getElementById('product-info').innerHTML = `<p>Produto não encontrado.</p>`;
    }
});
