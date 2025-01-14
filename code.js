const patterns = {
    nombre: /^[A-Z][a-zA-ZáéíóúÁÉÍÓÚÑñ]+$/i, 
    apellidos: /^[A-Z][a-záéíóúÁÉÍÓÚÑñ]+$/i,
    dni: /^[A-Z0-9]{1,8}[A-Z]$/i,
    fechaNacimiento: /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/,
    codigoPostal: /^\d{5}$/,
    email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
    telFijo: /^\d{9}$/,
    telMovil: /^(\+34|34)?\d{9}$/,
    iban: /^[A-Z]{2}\d{2}[A-Z0-9]{4,24}$/,
    tarjetaCredito: /^(?:\d{4}[- ]?){3}\d{4}$/,
    password: /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{12,}$/,
    confirmarPassword: /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{12,}$/
};


document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.form');
  

   
    // Función para recuperar los datos guardados
/*    function recuperarDatos() {
        const datos = JSON.parse(localStorage.getItem('formularioDatos'));
        if (datos) {
            form.querySelectorAll('input').forEach(input => {
                input.value = datos[input.placeholder] || '';
            });
            alert('Datos recuperados correctamente');
        } else {
            alert('No hay datos guardados');
        }
    }*/

    // Eventos para los botones
    document.getElementById('cargarJson').addEventListener('click', obtenerDatosJson);
    document.getElementById('pubPhp').addEventListener('click', publicarPhp);
    document.getElementById('cargarPhp').addEventListener('click', obtenerDatosPhp);

    // Validación de campos en tiempo real
    form.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('invalid');
                this.classList.add('valid');
            } else {
                this.classList.remove('valid');
                this.classList.add('invalid');
            }
        });
    });
});

function validate(field, regex){

    if(regex.test(field.value)){
        field.className = 'valid';
    } else {
        field.className = 'invalid';
    }

}


function obtenerDatosJson(){
    fetch ('usuario.json')              // Se usa fetch para realizar solicitudes HTTP ya que es más simple que usar XML
        .then(res => res.json())
        .then(data => {
            const fields = {
                nombre: document.getElementById('nombre').value = data.nombre,
                apellidos: document.getElementById('apellido').value = data.apellidos,
                dni: document.getElementById('dni').value = data.dni,
                fechaNacimiento: document.getElementById('nacimiento').value = data.fecha,
                codigoPostal: document.getElementById('cp').value = data.cp,
                email: document.getElementById('email').value = data.correo,
                telFijo: document.getElementById('fijo').value = data.fijo,
                telMovil: document.getElementById('movil').value = data.movil,
                iban: document.getElementById('iban').value = data.iban,
                tarjetaCredito: document.getElementById('tarjeta').value = data.tarjeta,
                password: document.getElementById('passwd').value = data.contrasena,
                confirmarPassword: document.getElementById('confirmar').value = data.contrasena,
            };

            // Asignar valores dinámicamente y validar
            for (const key in fields) {
                if (fields.hasOwnProperty(key) && patterns.hasOwnProperty(key)) {
                    fields[key].value = data[key] || ''; // Asignar valor desde JSON o vacío si no existe
                    validate(fields[key], patterns[key]); // Validar campo con su expresión regular
                }
            }
        })
        .catch(error => {
            console.error('error: ', error);
        })
}

// Función para publicar los datos (POST)
function publicarPhp() {
    const formData = new FormData(document.querySelector('.form'));

    // Convertir FormData en un objeto JSON
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    fetch('http://localhost:8080/Proyecto-8-DEW/publicar_php.php', {
        method: 'POST',
        body: formData // Enviar los datos como JSON
    })
        .then(res => res.json())
        .then(data => {
            console.log('Respuesta servidor: ', data);
            if (data.message === "Datos guardados correctamente") {
                // Limpiar los campos del formulario antes de ocultarlo
                const formElement = document.querySelector('.form');
                formElement.querySelectorAll('input').forEach(input => input.value = '');

                // Ocultar el formulario
                formElement.style.display = 'none'; // Ocultar formulario

                setTimeout(() => {
                    // Mostrar el formulario de nuevo y cargar los datos
                    formElement.style.display = 'block';

                    // Cargar los datos desde el servidor
                    fetch('http://localhost:8080/Proyecto-8-DEW/get_php.php', {
                        method: 'GET',
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.message === "Datos recuperados correctamente") {
                                // Poblar el formulario con los datos recibidos
                                const userData = data.data;
                                document.getElementById('nombre').value = userData.nombre || '';
                                document.getElementById('apellido').value = userData.apellido || '';
                                document.getElementById('dni').value = userData.dni || '';
                                document.getElementById('nacimiento').value = userData.fechaNacimiento || '';
                                document.getElementById('cp').value = userData.codigoPostal || '';
                                document.getElementById('email').value = userData.email || '';
                                document.getElementById('fijo').value = userData.telefonoFijo || ''; 
                                document.getElementById('movil').value = userData.telefonoMovil || ''; 
                                document.getElementById('iban').value = userData.iban || '';
                                document.getElementById('tarjeta').value = userData.tarjetaCredito || '';
                                document.getElementById('passwd').value = userData.password || '';
                                document.getElementById('confirmar').value = userData.password || '';
                            } else {
                                console.error('No se encontraron datos guardados');
                            }
                        })
                        .catch(error => console.error('Error al cargar datos: ', error));
                }, 2000); // Esperar 2 segundos
            }
        })
        .catch(error => {
            console.error('Error: ', error);
        });
}

// Función para obtener los datos guardados (GET)
function obtenerDatosPhp() {
    fetch('http://localhost:8080/Proyecto-8-DEW/get_php.php', {
        method: 'GET',
    })
        .then(res => res.json())
        .then(data => {
            if (data.message === "Datos recuperados correctamente") {
                // Poblar el formulario con los datos recibidos
                const userData = data.data;
                document.getElementById('nombre').value = userData.nombre || '';
                document.getElementById('apellido').value = userData.apellido || '';
                document.getElementById('dni').value = userData.dni || '';
                document.getElementById('nacimiento').value = userData.fechaNacimiento || '';
                document.getElementById('cp').value = userData.codigoPostal || '';
                document.getElementById('email').value = userData.email || '';
                document.getElementById('fijo').value = userData.telFijo || '';
                document.getElementById('movil').value = userData.telMovil || '';
                document.getElementById('iban').value = userData.iban || '';
                document.getElementById('tarjeta').value = userData.tarjetaCredito || '';
                document.getElementById('passwd').value = userData.password || '';
                document.getElementById('confirmar').value = userData.password || '';
            } else {
                console.error('No se encontraron datos guardados');
            }
        })
        .catch(error => console.error('Error al cargar datos: ', error));
}

