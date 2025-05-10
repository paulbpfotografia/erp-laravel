document.addEventListener("DOMContentLoaded", () => {
  const sidebar   = document.getElementById("sidebar");
  const toggleBtn = document.getElementById("sidebarToggle"); // capturamos el botón por su ID

  // 1) Toggle persistente al click
  toggleBtn.addEventListener("click", e => {
    e.preventDefault();
    sidebar.classList.toggle("expanded");               // cambia el ancho del sidebar
    document.body.classList.toggle("sidebar-expanded"); // desplaza main-content y footer
  });

  // 2) Acordeón de sub-menús: al abrir uno, cierra los demás
  sidebar.querySelectorAll('a[data-bs-toggle="collapse"]').forEach(btn => {
    btn.addEventListener("show.bs.collapse", () => {
      const targetId = btn.getAttribute("href").slice(1);
      sidebar.querySelectorAll(".collapse.show").forEach(openEl => {
        if (openEl.id !== targetId) {
          const inst = bootstrap.Collapse.getInstance(openEl)
                     || new bootstrap.Collapse(openEl, { toggle: false });
          inst.hide();
        }
      });
    });
  });
});
