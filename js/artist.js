const left = document.querySelector('.left');
const right = document.querySelector('.right');
const name = document.querySelector('.name');
const profile = document.querySelector('.profile');


right.style.display = 'none';
profile.style.display = 'none';

left.addEventListener('click', () => {
  left.style.display = 'none';
  right.style.display = 'block';
  name.animate(
  {
    left: [
      '400px',
      '-100px'
    ]
  },
  {
    duration: 400,
    fill: 'forwards',
    easing: 'ease'
  });
  
  profile.animate(
  {
    right: [
      '-400px',
      '100px'
    ]
  },
  {
    duration: 400,
    fill: 'forwards',
    easing: 'ease'
  });
  setTimeout(block,200);
});

right.addEventListener('click', () => {
  left.style.display = 'block';
  right.style.display = 'none';
  name.animate(
  {
    left: [
      '-100px',
      '400px'
    ]
  },
  {
    duration: 400,
    fill: 'forwards',
    easing: 'ease'
  });
  
  profile.animate(
  {
    right: [
      '100px',
      '-400px'
    ]
  },
  {
    duration: 400,
    fill: 'forwards',
    easing: 'ease'
  });
  setTimeout(none,65);
});

function none(){
  profile.style.display = 'none';
}

function block(){
  profile.style.display = 'block';
}