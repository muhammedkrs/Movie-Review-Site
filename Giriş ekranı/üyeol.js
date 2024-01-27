// Renk geçişleri için kullanılacak renklerin listesi
const colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#00FFFF', '#FF00FF'];

// Emoji karakterleri listesi
const emojis = ['🎬', '🍿', '🎥'];

// Arka plana rastgele renk ve emoji eklemek için fonksiyon
function addBackgroundElements() {
    const background = document.querySelector('.background');
    const width = window.innerWidth;
    const height = window.innerHeight;

    // Emoji karakterlerini rastgele konumlandırma ve stil verme
    for (let i = 0; i < 15; i++) {

        const emoji = emojis[Math.floor(Math.random() * emojis.length)];
        const span = document.createElement('span');
        span.textContent = emoji;
        span.classList.add('emoji');
        span.style.left = `${Math.random() * width}px`;
        span.style.top = `${Math.random() * height}px`;
        span.style.color = colors[Math.floor(Math.random() * colors.length)];
        background.appendChild(span);
        for (let i = 0; i < 5; i++) {
            const emoji = emojis[Math.floor(Math.random() * emojis.length)];
            const span = document.createElement('span');
            span.textContent = emoji;
            span.classList.add('emoji');
            span.style.left = `${Math.random() * width}px`;
            span.style.top = `${Math.random() * height}px`;
            span.style.color = colors[Math.floor(Math.random() * colors.length)];
            background.appendChild(span);
        }

    }
}

// Arka plana animasyonlu renk geçişleri eklemek için fonksiyon
function animateBackground() {
    const background = document.querySelector('.background');

    // Rastgele renk seçme ve arka plana uygulama
    function changeBackgroundColor() {
        const color = colors[Math.floor(Math.random() * colors.length)];
        background.style.backgroundColor = color;
    }

    // Arka planın renklerini dalgalanarak değiştirme işlemini tekrarlayan fonksiyon
    function waveBackgroundColors() {
        changeBackgroundColor();
        setTimeout(changeBackgroundColor, 1000);
    }

    // Arka planın renklerini dalgalanarak değiştirme işlemini başlatma
    waveBackgroundColors();
    setInterval(waveBackgroundColors, 2000);
}

// Sayfa yüklendiğinde arka plana elementler ekleyip animasyonları başlatma
window.addEventListener('load', () => {
    addBackgroundElements();
    animateBackground();
});
