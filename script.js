
const container = document.getElementById('container');
const RegistrarBtn = document.getElementById('register');
const LoginBtn = document.getElementById('login');

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