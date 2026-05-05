document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const numberInput = document.getElementById('telpon');
    const birthInput = document.getElementById('birthdate');
    const fileInput = document.getElementById('file');
    const messageInput = document.getElementById('message');

    // nampilin pesan error di bawah input
    const showError = (input, message) => {
        const formGroup = input.parentElement;
        let errorDisplay = formGroup.querySelector('.error-message');
        
        // function klo elemen error belum ada, tampilin di bawah kolom
        if (!errorDisplay) {
            errorDisplay = document.createElement('small');
            errorDisplay.className = 'error-message';
            formGroup.appendChild(errorDisplay);
        }
        
        errorDisplay.textContent = message;
        errorDisplay.style.color = 'red';
        input.style.borderColor = 'red';
    };

    // function untuk hapus pesan error
    const clearError = (input) => {
        const formGroup = input.parentElement;
        const errorDisplay = formGroup.querySelector('.error-message');
        if (errorDisplay) {
            errorDisplay.textContent = '';
        }
        input.style.borderColor = '';
    };

    // validasi real-time saat pengguna mengetik
    nameInput.addEventListener('input', () => {
        if (nameInput.value.length < 3) {
            showError(nameInput, 'Name must containat least 3 character.');
        } else {
            clearError(nameInput);
        }
    });

    emailInput.addEventListener('input', () => {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            showError(emailInput, 'Email format is invalid.');
        } else {
            clearError(emailInput);
        }
    });

    numberInput.addEventListener('input', () => {
        const numberPattern = /^[0-9]+$/;
        if (numberInput.value.length < 10 || numberInput.value.length > 12 && !numberInput.match(numberPattern))  {
            showError(numberInput, 'Phone number is invalid');
        } else {
            clearError(numberInput);
        }
    });

    birthInput.addEventListener('input', () => {
        const dateInfo = birthInput.value;

        if (dateInfo === '') {
            showError(birthInput, 'Fill your birthday');
        } else {
            clearError(birthInput);
        }
    });

    // validasi saat form disubmit
    form.addEventListener('submit', (e) => {
        let isFormValid = true;

        if (nameInput.value.trim() === '') {
            showError(nameInput, 'Name must be filled.');
            isFormValid = false;
        }

        
        if (messageInput.value.trim().length < 3) {
             showError(messageInput, 'Message must contain at least 3 character.');
             isFormValid = false;
        }

        // cek File 
        if (fileInput.files.length > 0) {
            const fileSize = fileInput.files[0].size / 1024 / 1024; // konvert ke MB
            if (fileSize > 2) {
                showError(fileInput, 'File maximum size is 2MB.');
                isFormValid = false;
            }
        }

        if (!isFormValid) {
            e.preventDefault();
            alert('Please check your form again, something must be missing.');
        } else {
            const name = nameInput.value;
            alert('Thank you, ' + name + ' we are sending your message...');
        }
    });

    // reset form handling
    form.addEventListener('reset', () => {
        const errors = document.querySelectorAll('.error-message');
        errors.forEach(err => err.textContent = '');
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => input.style.borderColor = '');
    });
});