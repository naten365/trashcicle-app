document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
        const parent = item.parentElement;
        parent.classList.toggle('open');
        const answer = parent.querySelector('.faq-answer');
        const icon = item.querySelector('i');
        if (parent.classList.contains('open')) {
            answer.style.maxHeight = answer.scrollHeight + 'px';
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
        } else {
            answer.style.maxHeight = 0;
            icon.classList.remove('fa-minus');
            icon.classList.add('fa-plus');
        }
    });
});

document.getElementById('search-input').addEventListener('input', function() {
    const searchQuery = this.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question span').textContent.toLowerCase();
        if (question.includes(searchQuery)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});