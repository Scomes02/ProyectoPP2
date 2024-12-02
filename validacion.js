document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registroForm');
    const checkboxes = document.querySelectorAll('input[name="tipo"]');

    form.addEventListener('submit', function(event) {
        let checkboxChecked = false;
        let allFieldsFilled = true;

        // Validar que solo un checkbox esté marcado
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                if (checkboxChecked) {
                    event.preventDefault();
                    alert('Solo puede seleccionar un tipo de usuario.');
                    return;
                }
                checkboxChecked = true;
            }
        });

        // Validar que todos los campos estén llenos
        const requiredFields = document.querySelectorAll('input[required]');
        requiredFields.forEach(field => {
            if (!field.value) {
                allFieldsFilled = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!allFieldsFilled) {
            event.preventDefault();
            alert('Por favor, complete todos los campos.');
        }

        // Si todo está bien, enviar los datos
        if (checkboxChecked && allFieldsFilled) {
            // Aquí puedes agregar el código para enviar los datos a la base de datos
            console.log('Datos enviados:', new FormData(form));
        }
    });
});