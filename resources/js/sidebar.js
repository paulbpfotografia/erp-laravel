document.addEventListener("DOMContentLoaded", () => {
    const sidebar   = document.getElementById("sidebar");
    const toggleBtn = sidebar.querySelector(".toggle-btn");
  
    // 1) Toggle persistente: agrega/quita .expanded en el sidebar
    toggleBtn.addEventListener("click", () => {
      sidebar.classList.toggle("expanded");
      document.body.classList.toggle("sidebar-expanded");
    });
  
    // 2) Acordeón: al abrir un submenú, cierra los demás
    sidebar.querySelectorAll('a[data-bs-toggle="collapse"]').forEach(btn => {
      btn.addEventListener("show.bs.collapse", () => {
        const targetId = btn.getAttribute("href").slice(1);
        sidebar.querySelectorAll(".collapse.show").forEach(openEl => {
          if (openEl.id !== targetId) {
            new bootstrap.Collapse(openEl, { toggle: false }).hide();
          }
        });
      });
    });

    // Toggle por hover
  sidebar.addEventListener("mouseenter", () => {
    document.body.classList.add("sidebar-expanded");
  });
  sidebar.addEventListener("mouseleave", () => {
    // Solo quitamos hover, pero respetamos el estado click si existe
    if (!sidebar.classList.contains("expanded")) {
      document.body.classList.remove("sidebar-expanded");
    }
  });
  
  });
  