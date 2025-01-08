document.querySelector('#logoutButton').addEventListener('click', () => {
    localStorage.removeItem('userToken'); // Remove the token
    alert('Sesión cerrada exitosamente.');
    window.location.reload(); // Optional: Reload the page
});