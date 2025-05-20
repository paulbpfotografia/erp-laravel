document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("sidebarToggle"); // capturamos el botón por su ID
    // Dos arrays para diferenciar click vs hover
    let clickOpen = [];
    let hoverOpen = [];

    // Función auxiliar: devuelve IDs de submenús abiertos
    const getOpenIds = () =>
        Array.from(sidebar.querySelectorAll(".collapse.show")).map(
            (el) => el.id
        );

    // Función auxiliar: cierra los submenús dados
    const hideByIds = (ids) =>
        ids.forEach((id) => {
            const el = document.getElementById(id);
            const inst =
                bootstrap.Collapse.getInstance(el) ||
                new bootstrap.Collapse(el, { toggle: false });
            inst.hide();
        });

    // Función auxiliar: muestra los submenús dados
    const showByIds = (ids) =>
        ids.forEach((id) => {
            const el = document.getElementById(id);
            const inst = bootstrap.Collapse.getOrCreateInstance(el, {
                toggle: false,
            });
            inst.show();
        });

    // 1) Toggle persistente al click
    toggleBtn.addEventListener("click", (e) => {
        e.preventDefault();

        const isExpanded = sidebar.classList.contains("expanded");

        if (isExpanded) {
            // al colapsar -> guardo clickOpen y cierro
            clickOpen = getOpenIds();
            hideByIds(clickOpen);
        }

        sidebar.classList.toggle("expanded");
        document.body.classList.toggle("sidebar-expanded");

        if (!isExpanded) {
            // al expandir -> clickOpen
            showByIds(clickOpen);
            clickOpen = [];
        }
    });

    // 2) Acordeón de sub-menús: al abrir uno, cierra los demás
    sidebar.querySelectorAll('a[data-bs-toggle="collapse"]').forEach((btn) => {
        btn.addEventListener("show.bs.collapse", () => {
            const targetId = btn.getAttribute("href").slice(1);
            sidebar.querySelectorAll(".collapse.show").forEach((openEl) => {
                if (openEl.id !== targetId) {
                    const inst =
                        bootstrap.Collapse.getInstance(openEl) ||
                        new bootstrap.Collapse(openEl, { toggle: false });
                    inst.hide();
                }
            });
        });
    });
    // 3) Hover out: solo si NO está expanded por click(button)
    sidebar.addEventListener("mouseleave", () => {
        if (!sidebar.classList.contains("expanded")) {
            hoverOpen = getOpenIds();
            hideByIds(hoverOpen);
        }
    });

    // 4) Hover in: solo si NO está expanded por click(button-topbar)
    sidebar.addEventListener("mouseenter", () => {
        if (!sidebar.classList.contains("expanded") && hoverOpen.length) {
            showByIds(hoverOpen);
            hoverOpen = [];
        }
    });
});
