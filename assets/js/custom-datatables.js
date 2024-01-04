$(document).ready(function () {
    var tableProducts = $('#products').DataTable({
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            search: 'Pesquisar:',
            info: 'Mostrando página _PAGE_ de _PAGES_',
            infoEmpty: 'Nenhum registro disponível',
            infoFiltered: '(filtrado de _MAX_ registros no total)',
            lengthMenu: 'Exibir _MENU_ registros por página',
            zeroRecords: 'Nenhum resultado encontrado - desculpe',
            paginate: {
                next: 'Próximo',
                previous: 'Anterior'
            }
        },
        ordering: false,
    });

    tableProducts.buttons().container().appendTo('#export-buttons');

});