import 'bootstrap/dist/js/bootstrap.bundle.min.js';
$( document ).ready(function() {
    $( ".btn-outline-warning" ).click(function() {
        $('h1').css('color','blue');
    });

    $( ".btn-outline-primary" ).click(function() {
        $('li').html(localidad.habitantes);
    });
});