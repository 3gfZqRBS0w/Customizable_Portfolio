const loader = document.querySelector('.loader');

function hide() {
    loader.classList.add('sup');
}

window.addEventListener('load', () => {

    loader.classList.add('fondu-out');
    setTimeout(hide, 400); 
})

function detectChange(selectOS) {
    console.log(selectOS.value)
}



