document.querySelectorAll('.citem')
  .forEach(e => e.addEventListener('click', _ => change(e.dataset.id)))


function change(n) {
  let panels = document.querySelectorAll('.wrapper')
  panels.forEach(p => p.classList.remove('active'))
  panels[n - 1].classList.add('active')
}