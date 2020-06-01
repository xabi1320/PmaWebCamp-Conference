(function() {
    "use strict";
    var regalo = document.getElementById('gift');
    document.addEventListener('DOMContentLoaded', function() {

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
                    console.log(diasElegidos);
                }
                if (boletos2Dias > 0) {
                    diasElegidos.push('viernes', 'sabado');
                    console.log(diasElegidos);
                }
                if (boletoCompleto > 0) {
                    diasElegidos.push('viernes', 'sabado', 'domingo');
                    console.log(diasElegidos);
                }

                for (var i = 0; i < diasElegidos.length; i++) {
                    document.getElementById(diasElegidos[i]).style.display = 'block';
                }

            }
        }

    }); // DOM CONTENT LOADED
})();