import $ from 'jquery';
import 'datatables.net-bs5';

export function inicializarDataTable(selector = '.datatable') {
    $(document).ready(function () {
        $(selector).DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
}
