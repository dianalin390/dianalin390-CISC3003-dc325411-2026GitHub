// 获取页面元素
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

// 点击SIGN UP按钮，切换到注册表单
signUpButton.addEventListener('click', () => {
    container.classList.add('right-panel-active');
});

// 点击SIGN IN按钮，切换到登录表单
signInButton.addEventListener('click', () => {
    container.classList.remove('right-panel-active');
});