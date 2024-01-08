ajax: {
    url: 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=all',
    dataSrc: 'data'
},
columns: [
    {
        // Coluna de Imagem
        data: 'img0',
        render: function (data, type, row) {
            var imageUrl = '../assets/img/products/' + data;
            return '<td class="tableAlignProducts"><img class="rounded" src="' + imageUrl + '" width="40px" alt="Imagem do produto"></td>';
        }
    },
    {
        // Outras colunas com dados da API
        data: 'name',
        render: function (data, type, row) {
            return '<td class="tableAlignProducts"><small>' + data + '</small></td>';
        }
    },
    {
        render: function (data, type, row) {
            return '<td class="tableAlignProducts"><small>' + row.original_code + ' ' + row.automaker + ' ' + row.brand_code + ' ' + row.brand + '</small></td>';
        }
    },
    {
        data: 'inventory',
        render: function (data, type, row) {
            return '<td class="tableAlignProducts"><small>' + data + '</small></td>';
        }
    },
    {
        data: 'localization',
        render: function (data, type, row) {
            return '<td class="tableAlignProducts"><small>' + data + '</small></td>';
        }
    },
    {
        data: 'quantity',
        render: function (data, type, row) {
            return '<td class="tableAlignProducts"><small># ' + data + '</small></td>';
        }
    },
    {
        data: 'price',
        render: function (data, type, row) {
            return '<td class="tableAlignProducts"><small>R$ ' + data + '</small></td>';
        }
    },

],