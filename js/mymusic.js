const down = document.querySelector('.down');
const category = document.querySelector('.category');
const logout = document.querySelector('.logout');
const logout_btn = document.querySelector('.logout_btn');
const logout_cancel = document.querySelector('.logout_cancel');

category.style.display = 'none';
category.style.zIndex = -500;
logout.style.display = 'none';
logout.style.zIndex = -500;

down.addEventListener('click',() => {
  category.style.display = 'block';
  category.style.zIndex = 499;
});
category.addEventListener('mouseleave', () =>{
  category.style.display = 'none';
  category.style.zIndex = -500;
});
logout_btn.addEventListener('click',() => {
  logout.style.display = 'block';
  logout.style.zIndex = 499;
});
logout_cancel.addEventListener('click',() => {
  logout.style.display = 'none';
  logout.style.zIndex = -500;
});
