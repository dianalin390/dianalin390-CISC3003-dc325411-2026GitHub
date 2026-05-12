const form = document.getElementById('contactForm');

form.addEventListener('submit', function(e) {
    let valid = true;

    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const subject = form.subject.value.trim();
    const message = form.message.value.trim();

    if (!name) {
        alert('Please enter your name');
        valid = false;
    }

    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
        alert('Please enter a valid email');
        valid = false;
    }

    if (!subject) {
        alert('Please enter a subject');
        valid = false;
    }

    if (!message) {
        alert('Please enter your message');
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
    }
});