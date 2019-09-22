const down = document.querySelector('.down');
const category = document.querySelector('.category');
const logout = document.querySelector('.logout');
const logout_btn = document.querySelector('.logout_btn');
const logout_cancel = document.querySelector('.logout_cancel');
const signup = document.querySelector('#signup');
const login = document.querySelector('#login');


login.style.display = 'none';
login.style.zIndex = -500;
signup.style.display = 'none';
signup.style.zIndex = -500;
category.style.display = 'none';
logout.style.display = 'none';
logout.style.zIndex = -500;

down.addEventListener('click',() => {
  category.style.display = 'block';
});
category.addEventListener('mouseleave', () =>{
  category.style.display = 'none';
});
logout_btn.addEventListener('click',() => {
  logout.style.display = 'block';
  logout.style.zIndex = 499;
});
logout_cancel.addEventListener('click',() => {
  logout.style.display = 'none';
  logout.style.zIndex = -500;
});
