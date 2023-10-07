// Simulación de datos para la gráfica
const data = {
    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
    datasets: [{
      label: 'Cantidad de transacciones',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: 'rgba(54, 162, 235, 0.5)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  };
  
  const ctx = document.getElementById('chart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  function logout(event) {
  event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

  // Limpiar credenciales almacenadas en el navegador
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "logout.php", true);
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          // Eliminar la información del usuario conectado en la página actual
          var usuarioConectado = document.querySelector('.usuario-conectado');
          if (usuarioConectado) {
              usuarioConectado.remove();
          }

          // Redirigir a la página de inicio
          window.location.href = "index.php";
      }
  };
  xmlhttp.send();
}


// Codigo para validar contraseñas (agregar_user_caja)
function validar(event) {
  event.preventDefault();  // Detener el envío del formulario

  var intentos = 0;
  var pass = document.getElementById("clave").value;
  var pass1 = document.getElementById("confirma_clave").value;

  if (intentos <= 3) {
      if (pass !== pass1) {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Las contraseñas no coinciden!'
          });
      } else {
          Swal.fire({
              icon: 'success',
              title: 'Usuario Creado Correctamente',
              text: 'Presiona Aceptar para continuar...'
          }).then((result) => {
              if (result.isConfirmed) {
                  // Si todo es válido, enviar datos del formulario por AJAX
                  var formData = new FormData(document.getElementById("miFormulario"));
                  enviarDatos(formData);
                  //document.procesaFormCajero.submit();
              }
          });
      }
  } else {
      alert("Has alcanzado el máximo número de intentos.!!");
  }
}

// AJAX Formulario
function enviarDatos(formData) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "procesaFormCajero.php", true);
  xhr.onload = function () {
      if (xhr.status === 200) {
          // Manejar la respuesta 
          console.log("Respuesta del servidor:", xhr.responseText);
          // refrescar 
          window.location.reload();
      } else {
          alert("Hubo un error en la solicitud al servidor.");
      }
  };
  xhr.send(formData);
}

// Para actualizar los estados de los usuarios cajeros
function actualizarEstado(select, usuario) {
    const nuevoEstado = select.value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "actualizar_estado.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                //console.log("Estado actualizado exitosamente.");
                alert("Estado actualizado exitosamente.");
            } else {
                //console.error("Hubo un error al actualizar el estado.");
                alert("Hubo un error al actualizar el estado.");
            }
        }
    };

    xhr.send("usuario=" + usuario + "&estado=" + nuevoEstado);
}

// para la parte de agregacion de cuentas de terceros
function validar2(event) {
    event.preventDefault();  // Detener el envío del formulario

    // Si todo es válido, enviar datos del formulario por AJAX
    var formData = new FormData(document.getElementById("miFormulario2"));
    enviarDatos2(formData);
}

function enviarDatos2(formData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesaFormCuentaTerceros.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            if (xhr.responseText.includes('La cuenta no existe')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Cuenta no existente',
                    text: 'La cuenta ingresada no existe.'
                });
            } else if (xhr.responseText.includes('Registro insertado correctamente.')) {
                // La cuenta existe, mostrar alerta de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Cuenta de Terceros Creada Exitosamente!',
                    text: 'Presiona Aceptar para continuar...'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si todo es válido, recargar la página
                        window.location.reload();
                    }
                });
            } else {
                alert("Hubo un error en la solicitud al servidor.");
            }
        }
    };
    xhr.send(formData);
}


// para la parte del proceso de transacciones
function validar3(event) {
    event.preventDefault();  // Detener el envío del formulario

    // Si todo es válido, enviar datos del formulario por AJAX
    var formData = new FormData(document.getElementById("miFormulario3"));
    console.log("cant_maxima_dia:", formData.get('cant_maxima_dia'));  // Agrega esta línea para verificar el valor de cant_maxima_dia
    enviarDatos3(formData);
}

function enviarDatos3(formData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesaTransferencia.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            
            if (xhr.responseText.includes('El monto de transferencia excede el límite permitido para esta cuenta.')) {
                Swal.fire({
                    icon: 'error',
                    title: '¡Monto máximo a enviar excedido!',
                    text: 'El monto maximo de la transferencia excede el limite permitido para esta cuenta'  // Mostrar el mensaje de error proveniente del servidor
                });
            } else if (xhr.responseText.includes('Se ha alcanzado la cantidad máxima de transacciones para hoy.')) {
                Swal.fire({
                    icon: 'error',
                    title: '¡Límite de transacciones diarias alcanzado!',
                    text: 'Se ha alcanzado la cantidad máxima de transacciones para el dia hoy, vuelve a intentarlo mañana.'  // Mostrar el mensaje de límite de transacciones por día
                });
            }
             else {
                // La cuenta existe, mostrar alerta de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Excelente! La transferencia se ha enviado correctamente.',
                    text: 'Presiona Aceptar para continuar...'  // Mostrar el mensaje de éxito proveniente del servidor
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si todo es válido, recargar la página
                        window.location.reload();
                    }
                });
            }
        } else {
            alert("Hubo un error en la solicitud al servidor.");
        }
    };
    xhr.send(formData);
}

// para la parte de agregacion de cuentas monetarias
function validar4(event) {
    event.preventDefault();  // Detener el envío del formulario

    // Si todo es válido, enviar datos del formulario por AJAX
    var formData = new FormData(document.getElementById("miFormulario4"));
    enviarDatos4(formData);
}

function enviarDatos4(formData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesaCtaMonetaria.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // La cuenta existe, mostrar alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Cuenta Monetaria Creada Exitosamente!',
                        text: 'Presiona "Ok" para continuar...'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si todo es válido, recargar la página
                            window.location.reload();
                        }
                    });
                } else {
                    // La cuenta no existe, mostrar alerta de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Ops!',
                        text: response.message
                    });
                }
            } catch (error) {
                alert("Hubo un error en la solicitud al servidor.");
            }
        }
    };
    xhr.send(formData);
}

// para la parte de agregacion de cuentas monetarias
function validar5(event) {
    event.preventDefault();  // Detener el envío del formulario

    // Si todo es válido, enviar datos del formulario por AJAX
    var formData = new FormData(document.getElementById("miFormulario5"));
    enviarDatos5(formData);
}

function enviarDatos5(formData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesaDeposito.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // La cuenta existe, mostrar alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Deposito Realizado Exitosamente!',
                        text: response.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si todo es válido, recargar la página
                            window.location.reload();
                        }
                    });
                } else {
                    // La cuenta no existe, mostrar alerta de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Ops!',
                        text: response.message
                    });
                }
            } catch (error) {
                alert("Hubo un error en la solicitud al servidor.");
            }
        }
    };
    xhr.send(formData);
}

// para la parte de agregacion de cuentas monetarias
function validar6(event) {
    event.preventDefault();  // Detener el envío del formulario

    // Si todo es válido, enviar datos del formulario por AJAX
    var formData = new FormData(document.getElementById("miFormulario6"));
    enviarDatos6(formData);
}

function validar6(event) {
    event.preventDefault();  // Detener el envío del formulario

    // Si todo es válido, enviar datos del formulario por AJAX
    var formData = new FormData(document.getElementById("miFormulario6"));
    enviarDatos6(formData);
}

function enviarDatos6(formData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesaRetiro.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Retiro exitoso, mostrar alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Retiro Realizado Exitosamente!',
                        text: response.message,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Recargar la página si es necesario
                            window.location.reload();
                        }
                    });
                } else {
                    // Error en el retiro, mostrar alerta de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en el Retiro',
                        text: response.message,
                        confirmButtonText: 'Aceptar'
                    });
                }
            } catch (error) {
                // Error al analizar la respuesta del servidor
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error en la solicitud al servidor.',
                    confirmButtonText: 'Aceptar'
                });
            }
        } else if (xhr.status === 400) {
            // Retiro excede el saldo
            Swal.fire({
                icon: 'error',
                title: 'Error en el Retiro',
                text: 'No puedes retirar más de lo que tienes en la cuenta.',
                confirmButtonText: 'Aceptar'
            });
        }
    };
    xhr.send(formData);
}

// Codigo para validar contraseñas (agregar_user_caja)
// function validar7(event) {
//     event.preventDefault();  // Detener el envío del formulario
  
//     var intentos = 0;
//     var pass = document.getElementById("contrasena").value;
//     var pass1 = document.getElementById("confirmar_contrasena").value;
  
//     if (intentos <= 3) {
//         if (pass !== pass1) {
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Las contraseñas no coinciden!'
//             });
//         } 
//         else if (xhr.responseText === "existe") {
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Las cuenta ya existe!'
//             });
//         } 
//         else {
//             Swal.fire({
//                 icon: 'success',
//                 title: 'Usuario Creado Correctamente',
//                 text: 'Verifica tu cuenta de correo para activar tu cuenta. Presiona Aceptar para continuar...'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     // Si todo es válido, enviar datos del formulario por AJAX
//                     var formData = new FormData(document.getElementById("miFormulario7"));
//                     enviarDatos7(formData);
//                     //document.procesaFormCajero.submit();
//                 }
//             });
//         }
//     } else {
//         alert("Has alcanzado el máximo número de intentos.!!");
//     }
//   }



  
//   // AJAX Formulario
//   function enviarDatos7(formData) {
//     var xhr = new XMLHttpRequest();
//     xhr.open("POST", "procesaRegistro.php", true);
//     xhr.onload = function () {
//         if (xhr.status === 200) {
//             // Manejar la respuesta 
//             console.log("Respuesta del servidor:", xhr.responseText);
//             // refrescar 
//             window.location.reload();
//         } else {
//             alert("Hubo un error en la solicitud al servidor.");
//         }
//     };
//     xhr.send(formData);
//   }

var serverResponse;

// Codigo para validar contraseñas (agregar_user_caja)
function validar7(event) {
    event.preventDefault();  // Detener el envío del formulario

    var intentos = 0;
    var pass = document.getElementById("contrasena").value;
    var pass1 = document.getElementById("confirmar_contrasena").value;

    if (intentos <= 3) {
        if (pass !== pass1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Las contraseñas no coinciden!'
            });
        } else {
            if (serverResponse && serverResponse.includes("existe")) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La cuenta ya existe!'
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario Creado Correctamente',
                    text: 'Verifica tu cuenta de correo para activar tu cuenta. Presiona Aceptar para continuar...'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si todo es válido, enviar datos del formulario por AJAX
                        var formData = new FormData(document.getElementById("miFormulario7"));
                        enviarDatos7(formData);
                        //document.procesaFormCajero.submit();
                    }
                });
            }
        }
    } else {
        alert("Has alcanzado el máximo número de intentos.!!");
    }
}

// AJAX Formulario
function enviarDatos7(formData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesaRegistro.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                // Almacena el resultado del servidor
                serverResponse = xhr.responseText;

                // Manejar la respuesta
                console.log("Respuesta del servidor:", serverResponse);

                if (serverResponse && serverResponse.includes("existe")) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'La cuenta ya existe!'
                    });
                } else {
                    // refrescar
                    window.location.reload();
                }
            } else {
                alert("Hubo un error en la solicitud al servidor.");
            }
        }
    };

    xhr.send(formData);
}











  