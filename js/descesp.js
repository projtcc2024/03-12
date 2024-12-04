document.addEventListener('DOMContentLoaded', () => {
    // Informações dos cards
    const cardInfo = {
        1: {
            title: "Engenharia Mecânica",
            description: "Formado pela faculdade de (nome da faculdade) por x anos (outras informações)."
        },
        2: {
            title: "Carpintaria",
            description: "Me tornei um carpinteiro por tal e tal motivo... (já fiz tal e tal projeto)."
        },
        3: {
            title: "Designer",
            description: "Me tornei designer por tal e tal motivo, e me inspirei em tal e tal coisa para construir o design dos produtos."
        }
    };

    // Elementos do modal
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const closeModal = document.querySelector('.close-modal');

    // Adiciona evento para os botões "Ler Mais"
    document.querySelectorAll('.ler-mais').forEach(button => {
        button.addEventListener('click', () => {
            const cardId = button.getAttribute('data-id');
            const info = cardInfo[cardId];

            if (info) {
                modalTitle.textContent = info.title;
                modalDescription.textContent = info.description;
                modal.classList.remove('hidden');
                modal.style.display = "flex";
            }
        });
    });

    // Fecha o modal ao clicar no botão de fechar
    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.style.display = "none";
    });

    // Fecha o modal ao clicar fora dele
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
            modal.style.display = "none";
        }
    });
});
