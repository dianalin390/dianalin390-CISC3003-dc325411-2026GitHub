// AJAX 檢查郵箱是否已被使用
document.getElementById('email').addEventListener('input', function() {
    const email = this.value;
    const check = document.getElementById('emailCheck');
    
    fetch(`check_email.php?email=${email}`)
    .then(res => res.text())
    .then(data => {
        if(data === 'exists') {
            check.style.color = 'red';
            check.textContent = 'Email already registered';
        } else {
            check.style.color = 'green';
            check.textContent = 'Email available';
        }
    });
});

// 表單驗證
const signupForm = document.getElementById('signupForm');
if(signupForm) {
    signupForm.addEventListener('submit', e => {
        const password = document.getElementById('password').value;
        if(password.length < 6) {
            alert('Password must be at least 6 characters');
            e.preventDefault();
        }
    });
}