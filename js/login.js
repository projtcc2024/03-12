document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector('form[action="../php/salvaruser.php"]'); // Formulário de cadastro
    const loginForm = document.querySelector('form[action="../php/login.php"]'); // Formulário de login
    const toggleLinks = document.querySelectorAll('#toggle-link a'); // Links de alternância

    // Inicialmente, esconda o formulário de login
    loginForm.style.display = 'none';

    function toggleForm() {
        if (registerForm.style.display === '' || registerForm.style.display === 'block') {
            // Mostrar formulário de login
            registerForm.style.display = 'none';
            loginForm.style.display = 'block';
            document.querySelector('.heading').innerHTML = '<span>Logar</span>';
        } else {
            // Mostrar formulário de cadastro
            registerForm.style.display = 'block';
            loginForm.style.display = 'none';
            document.querySelector('.heading').innerHTML = 'Cadastre-<span>Se</span>';
        }
    }

    // Adiciona evento de clique nos links de alternância
    toggleLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evita o comportamento padrão do link
            toggleForm(); // Chama a função de alternância
        });
    });
});
