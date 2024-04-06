document.addEventListener('DOMContentLoaded', function () {
    const userMenuTrigger = document.getElementById('user-menu-trigger');
    const modal = document.getElementById('modal');
    const closeBtn = document.getElementById('close-btn');

    userMenuTrigger.addEventListener('click', function () {
        modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

function cerrarSesion() {
    window.location.href = '../cerrar_sesion.php';
}