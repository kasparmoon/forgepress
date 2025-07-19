document.addEventListener('DOMContentLoaded', function () {
    const searchToggle = document.querySelector('.search-toggle');
    const searchModalContainer = document.querySelector('.search-modal-container');

    if (searchToggle && searchModalContainer) {
        searchToggle.addEventListener('click', function () {
            document.body.classList.toggle('search-modal-open');
            this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
        });

        searchModalContainer.addEventListener('click', function (e) {
            if (e.target === this) {
                document.body.classList.remove('search-modal-open');
                searchToggle.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && document.body.classList.contains('search-modal-open')) {
                document.body.classList.remove('search-modal-open');
                searchToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
});