(function() {
    "use strict";
    var regalo = document.getElementById('gift');
    document.addEventListener('DOMContentLoaded', function() {

        if (document.getElementById('map')) {
            var map = L.map('map').setView([8.989404, -79.499989], 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([8.989404, -79.499989]).addTo(map)
                .bindPopup('PMAWebCamp 2020.<br> Boletos ya disponibles.')
                .openPopup();
        }

        //DATOS DE USUARIO
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        //CAMPOS PASES
        var day_pass = document.getElementById('day_pass');
        var day2_pass = document.getElementById('day2_pass');
        var full_pass = document.getElementById('full_pass');

        //BOTONES Y DIVS
        var calculate = document.getElementById('calculate');
        var errorDiv = document.getElementById('error');
        var btnRegistry = document.getElementById('btnRegistry');
        var listaProducto = document.getElementById('products-list');
        var suma = document.getElementById('total-sum');

        //EXTRAS
        var camisas = document.getElementById('shirt_event');
        var etiquetas = document.getElementById('labels');

        btnRegistry.disabled = true;

        if (document.getElementById('calucate') || document.getElementById('day_pass') || document.getElementById('day2_pass') || document.getElementById('full_pass') || document.getElementById('nombre') || document.getElementById('apellido') || document.getElementById('email') || document.getElementById('btnRegistry')) {




            calculate.addEventListener('click', calcularMontos);
            day_pass.addEventListener('blur', mostrarDias);
            day2_pass.addEventListener('blur', mostrarDias);
            full_pass.addEventListener('blur', mostrarDias);

            nombre.addEventListener('blur', validarCampos);
            apellido.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarMail);

            let formulario_editar = document.getElementsByClassName('editar-registrado');
            if (formulario_editar.length > 0) {
                if (day_pass.value || day2_pass.value || full_pass.value) {
                    mostrarDias();
                }
            }

            function validarCampos() {
                if (this.value === '') {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Este campo es obligatorio *";
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red'
                } else {
                    errorDiv.style.display = 'none';
                    this.style.border = '2px solid #cccccc';
                }
            }

            function validarMail() {
                if (this.value.indexOf("@") > -1) {
                    errorDiv.style.display = 'none';
                    this.style.border = '2px solid #cccccc';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Debe tener al menos un @*";
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red'
                }
            }

            function calcularMontos(event) {
                event.preventDefault();
                if (regalo.value === '') {
                    alert("Debes Elegir un regalo");
                    regalo.focus();
                } else {
                    var boletosDia = parseInt(day_pass.value, 10) || 0,
                        boletos2Dias = parseInt(day2_pass.value, 10) || 0,
                        boletoCompleto = parseInt(full_pass.value, 10) || 0,
                        cantidadCamisas = parseInt(camisas.value, 10) || 0,
                        cantidadEtiquetas = parseInt(etiquetas.value, 10) || 0;



                    var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletoCompleto * 50) + ((cantidadCamisas * 10) * .93) + (cantidadEtiquetas * 2);

                    var ListadoProductos = [];

                    if (boletosDia >= 1) {
                        ListadoProductos.push(boletosDia + ' Pases por día');
                    }
                    if (boletos2Dias >= 1) {
                        ListadoProductos.push(boletos2Dias + ' Pases por 2 días');
                    }
                    if (boletoCompleto >= 1) {
                        ListadoProductos.push(boletoCompleto + ' Pases Completos');

                    }
                    if (cantidadCamisas >= 1) {
                        ListadoProductos.push(cantidadCamisas + ' Camisas');

                    }
                    if (cantidadEtiquetas >= 1) {
                        ListadoProductos.push(cantidadEtiquetas + ' Etiquetas');

                    }
                    listaProducto.style.display = "block";
                    listaProducto.innerHTML = '';
                    for (var i = 0; i < ListadoProductos.length; i++) {
                        listaProducto.innerHTML += ListadoProductos[i] + '<br/>';
                    }

                    suma.innerHTML = "$ " + totalPagar.toFixed(2);

                    btnRegistry.disabled = false;
                    document.getElementById('total_order').value = totalPagar;
                    console.log(ListadoProductos);
                }
            }

            function mostrarDias() {
                var boletosDia = parseInt(day_pass.value, 10) || 0,
                    boletos2Dias = parseInt(day2_pass.value, 10) || 0,
                    boletoCompleto = parseInt(full_pass.value, 10) || 0;

                var diasElegidos = [];

                if (boletosDia > 0) {
                    diasElegidos.push('viernes');
                }
                if (boletos2Dias > 0) {
                    diasElegidos.push('viernes', 'sabado');
                }
                if (boletoCompleto > 0) {
                    diasElegidos.push('viernes', 'sabado', 'domingo');
                }

                for (var i = 0; i < diasElegidos.length; i++) {
                    document.getElementById(diasElegidos[i]).style.display = 'block';
                }

            }
        }

    }); // DOM CONTENT LOADED
})();

$(function() {

    //LETTERING
    $('.site-name').lettering();

    //AGREGAR CLASE A MENU

    $('body.conferencias .main-navigation a:contains("Conferencia")').addClass('activo');
    $('body.calendario .main-navigation a:contains("Calendario")').addClass('activo');
    $('body.invitados .main-navigation a:contains("Invitado")').addClass('activo');


    //MENU FIJO

    var windowHeight = $(window).height();
    var barraAltura = $('.bar').innerHeight();

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll > windowHeight) {
            $('.bar').addClass('fixed');
            $('body').css({ 'margin-top': barraAltura + 'px' })
        } else {
            $('.bar').removeClass('fixed');
            $('body').css({ 'margin-top': '0px' })
        }
    });

    //MENU RESPONSIVE

    $('.mobile-menu').on('click', function() {
        $('.main-navigation').slideToggle();
    })

    //PROGRAMA DE CONFERENCIAS
    $('.program-event .info-curso:first').show();
    $('.menu-program a:first').addClass('activo');

    $('.menu-program a').on('click', function() {
        $('.menu-program a').removeClass('activo');
        $(this).addClass('activo');
        $('.hide').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        return false;
    });

    //ANIMACIONES PARA LOS NUMEROS

    $('.event-summary li:nth-child(1) p').animateNumber({ number: 6 }, 1800);
    $('.event-summary li:nth-child(2) p').animateNumber({ number: 15 }, 1800);
    $('.event-summary li:nth-child(3) p').animateNumber({ number: 3 }, 1800);
    $('.event-summary li:nth-child(4) p').animateNumber({ number: 9 }, 1800);

    //CUENTA REGRESIVA

    $('.countdown').countdown('2020/12/10 09:00:00', function(event) {
        $('#days').html(event.strftime('%D'));
        $('#hours').html(event.strftime('%H'));
        $('#minutes').html(event.strftime('%M'));
        $('#seconds').html(event.strftime('%S'));
    });

    //COLORBOX

    if ($('.info-invited').length) {
        $('.info-invited').colorbox({ inline: true, width: "50%" });
        $('.button_newsletter').colorbox({ inline: true, width: "50%" });
    }

});