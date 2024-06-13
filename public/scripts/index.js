
const container = document.getElementById('container');
const RegistrarBtn = document.getElementById('register');
const LoginBtn = document.getElementById('login');
const DarkMode = document.getElementById('dm-color');
const body = document.querySelector('body');
const colors = ['green', 'dark-green']

RegistrarBtn.addEventListener('click', ()=>
{
    container.classList.add('active');
}
);

LoginBtn.addEventListener('click', ()=>
{
    container.classList.remove('active');
}
);