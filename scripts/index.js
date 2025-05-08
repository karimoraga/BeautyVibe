const dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dd=> {
  const sel = dd.querySelector('.select');
  const menu = dd.querySelector('.menu');
  sel.addEventListener('click',e=> {
    e.stopPropagation();
    menu.classList.toggle('menu-open');
  });
});
document.addEventListener('click',()=> {
  document.querySelectorAll('.menu').forEach(m=> m.classList.remove('menu-open'));
});