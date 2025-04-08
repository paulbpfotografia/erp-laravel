import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';

import './toast.js';
import './eliminar.js';
import './sidebar.js';

// NUEVO: Importar función para usarla globalmente en Blade

import { inicializarDataTable } from './datatables';
window.inicializarDataTable = inicializarDataTable;
