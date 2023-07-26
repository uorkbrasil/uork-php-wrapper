
window.addEventListener('DOMContentLoaded', function() {
    const welcomeText = document.getElementById('welcome-text');
    welcomeText.style.opacity = '1';
    welcomeText.style.transform = 'translateY(0)';

    setTimeout(function() {
        window.location.href = './consultas';
    }, 5000); 
});
