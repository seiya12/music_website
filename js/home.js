const down = document.querySelector('.down');
const category = document.querySelector('.category');
const login = document.querySelector('#login');
const login_btn = document.querySelector('.login_btn');
const cansel = document.querySelector('.cansel');
const signup = document.querySelector('#signup');
const sign_link = document.querySelector('.sign_link');
const cansel_btn = document.querySelector('.cansel_btn');

category.style.display = 'none';
login.style.display = 'none';
login.style.zIndex = -500;
signup.style.display = 'none';
signup.style.zIndex = -500;

down.addEventListener('click',() => {
  category.style.display = 'block';
});
category.addEventListener('mouseleave', () =>{
  category.style.display = 'none';
});


login_btn.addEventListener('click',() => {
  login.style.display = 'block';
  login.style.zIndex = 499;
});
cansel.addEventListener('click',() => {
  login.style.display = 'none';
  login.style.zIndex = -500;
});
sign_link.addEventListener('click',() => {
  signup.style.display = 'block';
  signup.style.zIndex = 499;
});
cansel_btn.addEventListener('click',() => {
  signup.style.display = 'none';
  signup.style.zIndex = -500;
});

