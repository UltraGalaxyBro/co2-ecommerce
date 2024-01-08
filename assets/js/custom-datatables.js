$(document).ready(function () {
    var tableProducts = $('#products').DataTable({
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            search: 'Pesquisar:',
            info: 'Mostrando página _PAGE_ de _PAGES_',
            infoEmpty: 'Nenhum registro disponível',
            infoFiltered: '(filtrado de _MAX_ registros no total)',
            lengthMenu: 'Exibir _MENU_ registros por página',
            zeroRecords: 'Nenhum resultado encontrado'
        },
        ordering: false,
        ajax: {
            url: 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=all',
            dataSrc: 'data'
        },
        columns: [
            {
                data: 'img0',
                render: function (data, type, row) {
                    var imageUrl = '../assets/img/products/' + data;
                    return '<td><img class="rounded" src="' + imageUrl + '" width="40px" alt="Imagem do produto"></td>';
                }
            },
            {
                data: 'name',
                render: function (data, type, row) {
                    return '<td><small>' + data + '</small></td>';
                }
            },
            {
                render: function (data, type, row) {
                    var references = ''
                    if (row.original_code == 'INDEFINIDO' || row.original_code == null) {
                        references = row.brand_code + ' (' + row.brand + ')'
                    } else if (row.brand_code == 'INDEFINIDO' || row.brand_code == null) {
                        references = row.original_code + ' (' + row.automaker + ')'
                    } else {
                        references = row.original_code + ' (' + row.automaker + ') &bull; ' + row.brand_code + ' (' + row.brand + ')'
                    }
                    return '<td><small>' + references + '</small></td>';
                }
            },
            {
                data: 'inventory',
                render: function (data, type, row) {
                    return '<td><small>' + data + '</small></td>';
                }
            },
            {
                data: 'localization',
                render: function (data, type, row) {
                    return '<td><small>' + data + '</small></td>';
                }
            },
            {
                data: 'quantity',
                render: function (data, type, row) {
                    return '<td><small># ' + data + '</small></td>';
                }
            },
            {
                data: 'price',
                render: function (data, type, row) {
                    return '<td><small>R$ ' + data + '</small></td>';
                }
            },
            {
                data: 'id',
                render: function (data, type, row) {
                    return '<td>' +
                        '<div class="btn-group" role="group" aria-label="Basic mixed styles example">' +
                        '<button type="button" title="Editar produto" id="editButton" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-product-id="' + data + '">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">' +
                        '<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />' +
                        '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />' +
                        '</svg>' +
                        '</button>' +
                        '<button type="button" title="Excluir produto" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-product-id="' + data + '">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">' +
                        '<path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z" />' +
                        '</svg>' +
                        '</button>' +
                        '</div>' +
                        '</td>';
                }
            }
        ]
    });

    setTimeout(function () {
        tableProducts.buttons().container().appendTo('#export-buttons');
    }, 100);
});

$(document).ready(function () {

    $(document).on('click', '#editButton', function () {

        var dynamicId = $(this).data('product-id');
        var apiUrl = 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=get&id=' + dynamicId;

        $.ajax({
            url: apiUrl,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                var data = response.data;

                // DATA CRIAÇÃO DO PRODUTO
                $('#editFirstRecord').text("Criado em: " + moment(data.first_record).format('DD/MM/YYYY HH:mm:ss'));

                // DATA ÚLTIMA EDIÇÃO DO PRODUTO
                $('#editLastRecord').text("Última edição em: " + moment(data.last_record).format('DD/MM/YYYY HH:mm:ss'));
                //NOME DO PRODUTO
                $('#nameEdit').val(data.name);
                //CATEGORIA DO PRODUTO
                $('#categoryEdit').val(data.category);
                //MONTADORA DO PRODUTO
                $('#automakerEdit').empty();
                $('#automakerEdit').append("<option value='" + data.automaker + "' selected>" + data.automaker + "</option>");
                var optionsAutomaker = ["MERCEDES", "VOLKSWAGEN", "VOLVO", "SCANIA", "FORD", "IVECO", "Outras", "Geral"];
                for (var i = 0; i < optionsAutomaker.length; i++) {
                    if (data.automaker != optionsAutomaker[i]) {
                        $('#automakerEdit').append("<option value='" + optionsAutomaker[i] + "'>" + optionsAutomaker[i] + "</option>");
                    }
                }
                $('#automakerEdit').val(data.automaker);
                // INTERNO DO PRODUTO
                $('#insideCodeEdit').val(data.inside_code);
                // ORIGINAL DO PRODUTO
                $('#originalCodeEdit').val(data.original_code);
                // MARCA DO PRODUTO
                $('#brandEdit').val(data.brand);
                // FABRICANTE DO PRODUTO
                $('#brandCodeEdit').val(data.brand_code);
                // CONDIÇÃO DO PRODUTO
                $('#stateEdit').empty();
                $('#stateEdit').append("<option value='" + data.state + "' selected>" + data.state + "</option>");
                var optionsState = ["Novo", "Seminovo"];
                for (var i = 0; i < optionsState.length; i++) {
                    if (data.state != optionsState[i]) {
                        $('#stateEdit').append("<option value='" + optionsState[i] + "'>" + optionsState[i] + "</option>");
                    }
                }
                $('#stateEdit').val(data.state);
                // TIPO DE ESTOQUE DO PRODUTO
                $('#inventoryEdit').empty();
                $('#inventoryEdit').append("<option value='" + data.inventory + "' selected>" + data.inventory + "</option>");
                var optionsInventory = ["LOCAL", "VIRTUAL"];
                for (var i = 0; i < optionsInventory.length; i++) {
                    if (data.inventory != optionsInventory[i]) {
                        $('#inventoryEdit').append("<option value='" + optionsInventory[i] + "'>" + optionsInventory[i] + "</option>");
                    }
                }
                $('#inventoryEdit').val(data.inventory);
                // LOCALIZAÇÃO DO PRODUTO
                $('#localizationEdit').val(data.localization);
                // ESTOQUE DO PRODUTO
                $('#quantityEdit').val(data.quantity);
                // ESTOQUE MÍNIMO DO PRODUTO
                $('#quantityMinEdit').val(data.quantity_min);
                // CUSTO DO PRODUTO
                $('#costEdit').val(data.cost);
                // PREÇO DO PRODUTO
                $('#priceEdit').val(data.price);
                // PROMOÇÃO DO PRODUTO
                if (data.promotional === 1) {
                    $('#promotionalEdit').prop('checked', true);
                }
                // DATA DE PROMOÇÃO PRODUTO
                $('#promotionalDateEdit').val(data.promotional_date);
                // PREÇO DE PROMOÇÃO DO PRODUTO
                $('#promotionalPriceEdit').val(data.promotional_price);
                // VISIBILIDADE DO PRODUTO
                if (data.visible === 1) {
                    $('#visibleEdit').prop('checked', true);
                }
                // APLICAÇÃO PRODUTO
                $('#aplicationEdit').text(data.aplication);
                // DESCRIÇÃO DO PRODUTO
                $('#descriptionEdit').text(data.description);

                // PRIMEIRA IMAGEM
                if (data.img0 !== '' && data.img0 !== null) {
                    var src = "../assets/img/products/" + data.img0;
                    $('#targetImgEdit').attr('src', src);
                    $('#imgEditTxt').val(data.img0);

                } else {
                    var src = "../assets/img/products/default-image.png";
                    $('#targetImgEdit').attr('src', src);
                }

                // SEGUNDA IMAGEM
                if (data.img1 !== '' && data.img1 !== null) {
                    var src = "../assets/img/products/extra/" + data.img1;
                    $('#targetImgEdit1').attr('src', src);
                    $('#imgEditTxt1').val(data.img1);

                } else {
                    var src = "../assets/img/products/default-image.png";
                    $('#targetImgEdit1').attr('src', src);
                }

                // TERCEIRA IMAGEM
                if (data.img2 !== '' && data.img2 !== null) {
                    var src = "../assets/img/products/extra/" + data.img2;
                    $('#targetImgEdit2').attr('src', src);
                    $('#imgEditTxt2').val(data.img2);

                } else {
                    var src = "../assets/img/products/default-image.png";
                    $('#targetImgEdit2').attr('src', src);
                }

                // ID DO PRODUTO
                $('#idEdit').val(data.id);

            },
            error: function (xhr, status, error) {
                console.error('Erro ao obter dados da API. Status: ' + status + ', Erro: ' + error);
            }
        });
    });
});
