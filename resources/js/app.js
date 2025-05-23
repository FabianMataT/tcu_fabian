import './bootstrap';
import './assets/string_to_slug';ç

document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                entry.target.classList.remove('opacity-0', 'translate-y-4');
                obs.unobserve(entry.target); // solo una vez
            }
        });
    }, {
        threshold: 0.1,
    });

    document.querySelectorAll('.observe-fade').forEach(el => {
        observer.observe(el);
    });
});