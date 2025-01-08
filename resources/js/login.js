document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const errorContainer = document.getElementById('error-container');
    const errorList = document.getElementById('error-list');

    // Get the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent the default form submission

        // Clear previous errors
        errorContainer.classList.add('d-none');
        errorList.innerHTML = '';

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const remember = document.getElementById('remember').checked;

        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json', // Signals the controller to return JSON
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token
                },
                body: JSON.stringify({
                    email,
                    password,
                    remember,
                }),
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Error al iniciar sesión.');
            }

            const data = await response.json();

            // Store the token in localStorage
            localStorage.setItem('userToken', data.token);

            // Redirect to dashboard
            window.location.href = '/dashboard';
        } catch (error) {
            console.error('Error al iniciar sesión:', error);

            // Show errors to the user
            errorContainer.classList.remove('d-none');
            errorList.innerHTML = `<li>${error.message}</li>`;
        }
    });
});
