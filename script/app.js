const loader = document.querySelector('.loader');

function hide() {
    loader.classList.add('sup');
}

window.addEventListener('load', () => {

    loader.classList.add('fondu-out');
    setTimeout(hide, 400); 
})


$(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
  }).resize();