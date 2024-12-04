// Mostrar o pop-up quando a página carregar
window.onload = () => {
    document.getElementById('popup').style.display = 'flex';
}

// Fechar o pop-up ao clicar no "x"
document.getElementById('close-popup').onclick = () => {
    document.getElementById('popup').style.display = 'none';
}

// Fechar o pop-up ao clicar fora dele
window.onclick = (event) => {
    if (event.target == document.getElementById('popup')) {
        document.getElementById('popup').style.display = 'none';
    }
}



let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}




/*animações de entrada prontas pelo scrollreveal.com*/

ScrollReveal({
    /* reset: true,*/
    distance: '80px',
    duration: 2000,
    delay: 200
});

ScrollReveal().reveal('.home-content, .heading', 
    {
        origin: 'top'
    });
ScrollReveal().reveal('.popup, #formcad', 
    {
        origin: 'top',
        delay: 800
    });

ScrollReveal().reveal('.home-img, .services-container, .portfolio-box, ',
    {
        origin: 'bottom'
    });

ScrollReveal().reveal('.home-content h1, .about-img, .logo ',
    {
        origin: 'left'
    });

ScrollReveal().reveal('.home-content p, .about-content ',
    {
        origin: 'right'
    });

/*animação de escrita typde.com

const typed = new Typed('.multiple-text', {
    strings: ['Desenvolvedor Frontend', 'Programador Etec', 'Freelancer'],
    typeSpeed:100,
    backSpeed:100,
    backdelay:1000,
    loop: true
});
*/