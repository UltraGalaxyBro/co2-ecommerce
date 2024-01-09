
//--------------------------------SCRIPTS RESPONSÁVEIS PELA MANIPULAÇÃO DA EXIBIÇÃO DOS CAMPOS AO CRIAR UM PRODUTO - INÍCIO
$(document).ready(function () {
    // Exibe a div quando a opção LOCAL é selecionada
    $('#inventoryCreate').change(function () {
        if ($(this).val() === 'LOCAL') {
            $('#atLocalOption1').show();
            $('#atLocalOption2').show();
            $('#atLocalOption3').show();

        } else {
            $('#atLocalOption1').hide();
            $('#atLocalOption2').hide();
            $('#atLocalOption3').hide();
        }
    });

    // Garante que a div seja exibida corretamente na carga inicial da página
    if ($('#inventoryCreate').val() === 'LOCAL') {
        $('#atLocalOption1').show();
        $('#atLocalOption2').show();
        $('#atLocalOption3').show();
    }
});

$(document).ready(function () {
    // Exibe a div quando o checkbox de promoção estiver marcado
    $('#promotionalCreate').change(function () {
        if ($(this).is(':checked')) {
            $('#promotionalOptionCreate1').show();
            $('#promotionalOptionCreate2').show();
        } else {
            $('#promotionalOptionCreate1').hide();
            $('#promotionalOptionCreate2').hide();
        }
    });

    // Garante que a div seja exibida corretamente na carga inicial da página
    if ($('#promotionalCreate').is(':checked')) {
        $('#promotionalOptionCreate1').show();
        $('#promotionalOptionCreate2').show();

    }
});

$(document).ready(function () {
    // Exibe a div quando o checkbox de visibilidade estiver marcado
    $('#visibleCreate').change(function () {
        if ($(this).is(':checked')) {
            $('#visibleOptionCreate1').show();
            $('#visibleOptionCreate2').show();
        } else {
            $('#visibleOptionCreate1').hide();
            $('#visibleOptionCreate2').hide();
        }
    });

    // Garante que a div seja exibida corretamente na carga inicial da página
    if ($('#visibleCreate').is(':checked')) {
        $('#visibleOptionCreate1').show();
        $('#visibleOptionCreate2').show();

    }
});
//--------------------------------SCRIPTS RESPONSÁVEIS PELA MANIPULAÇÃO DA EXIBIÇÃO DOS CAMPOS AO CRIAR UM PRODUTO - FIM

//--------------------------------SCRIPTS RESPONSÁVEIS PELA MANIPULAÇÃO DA EXIBIÇÃO DOS CAMPOS AO EDITAR UM PRODUTO - INÍCIO
$(document).ready(function () {

    $('#inventoryEdit').change(function () {
        if ($(this).val() === 'LOCAL') {
            $('#atLocalOption4').show();
            $('#atLocalOption5').show();
            $('#atLocalOption6').show();

        } else {
            $('#atLocalOption4').hide();
            $('#atLocalOption5').hide();
            $('#atLocalOption6').hide();
        }
    });

    $('#editModal').on('shown.bs.modal', function () {
        if ($('#inventoryEdit').val() === 'LOCAL') {
            $('#atLocalOption4').show();
            $('#atLocalOption5').show();
            $('#atLocalOption6').show();
        }
    });
});

$(document).ready(function () {

    $('#promotionalEdit').change(function () {
        if ($(this).is(':checked')) {
            $('#promotionalOptionEdit4').show();
            $('#promotionalOptionEdit5').show();
        } else {
            $('#promotionalOptionEdit4').hide();
            $('#promotionalOptionEdit5').hide();
        }
    });
    $('#editModal').on('shown.bs.modal', function () {
        if ($('#promotionalEdit').is(':checked')) {
            $('#promotionalOptionEdit4').show();
            $('#promotionalOptionEdit5').show();

        }
    });

});

$(document).ready(function () {

    $('#visibleEdit').change(function () {
        if ($(this).is(':checked')) {
            $('#visibleOptionEdit1').show();
            $('#visibleOptionEdit2').show();
        } else {
            $('#visibleOptionEdit1').hide();
            $('#visibleOptionEdit2').hide();
        }
    });
    $('#editModal').on('shown.bs.modal', function () {
        if ($('#visibleEdit').is(':checked')) {
            $('#visibleOptionEdit1').show();
            $('#visibleOptionEdit2').show();

        }
    });


});
//--------------------------------SCRIPTS RESPONSÁVEIS PELA MANIPULAÇÃO DA EXIBIÇÃO DOS CAMPOS AO EDITAR UM PRODUTO - FIM

//--------------------------------SCRIPTS RESPONSÁVEIS PELA EXIBIÇÃO DAS IMAGENS NO FORMULÁRIO PARA CRIAR UM PRODUTO - INÍCIO
function clearImage(inputId, imgId) {
    const input = $('#' + inputId);
    const img = $('#' + imgId);

    // Verifica se a imagem sendo apagada é a primeira
    if (inputId === 'imgCreate') {
        // Se sim, limpa as imagens dos campos seguintes
        $('#imgCreate1, #imgCreate2').each(function () {
            const id = $(this).attr('id');
            const targetId = 'target' + id.charAt(0).toUpperCase() + id.slice(1);
            $(this).val('');
            $('#' + targetId).attr('src', '../assets/img/products/default-image.png');
        });
    }

    // Limpa a imagem atual
    input.val('');
    img.attr('src', '../assets/img/products/default-image.png');

    showHideImageDivs();
}


function showHideImageDivs() {
    // Mostra ou esconde as divs adicionais com base na presença de imagens nos campos correspondentes
    $('#imgCreate1').closest('.form-group').toggle($('#targetImgCreate').attr('src') !== '../assets/img/products/default-image.png');
    $('#imgCreate2').closest('.form-group').toggle($('#targetImgCreate1').attr('src') !== '../assets/img/products/default-image.png');
}

$(document).ready(function () {

    function previewImage(inputId, imgId) {
        const input = $('#' + inputId);
        const img = $('#' + imgId);

        if (input[0].files && input[0].files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                img.attr('src', e.target.result);
                showHideImageDivs(); // Chama a função para ajustar a exibição das divs
            };

            reader.readAsDataURL(input[0].files[0]);
        }
    }

    $('#imgCreate, #imgCreate1, #imgCreate2').change(function () {
        const inputId = $(this).attr('id');
        const imgId = 'target' + inputId.charAt(0).toUpperCase() + inputId.slice(1);

        console.log('Input ID:', inputId);
        console.log('Image ID:', imgId);

        previewImage(inputId, imgId);
    });
});
//--------------------------------SCRIPTS RESPONSÁVEIS PELA EXIBIÇÃO DAS IMAGENS NO FORMULÁRIO PARA CRIAR UM PRODUTO - FIM

//--------------------------------SCRIPTS RESPONSÁVEIS PELA EXIBIÇÃO DAS IMAGENS NO FORMULÁRIO PARA EDITAR UM PRODUTO - INÍCIO

function clearImage2(inputId, imgId, deleteLogId) {
    const input = $('#' + inputId);
    const img = $('#' + imgId);
    const deleteLog = $('#' + deleteLogId);

    // Verifica se a imagem sendo apagada é a primeira
    if (inputId === 'imgEdit') {
        // Se sim, limpa as imagens dos campos seguintes
        $('#imgEdit1, #imgEdit2').each(function () {
            const id = $(this).attr('id');
            const targetId = 'target' + id.charAt(0).toUpperCase() + id.slice(1);
            $(this).val('');
            $('#' + targetId).attr('src', '../assets/img/products/default-image.png');
        });
    }

    // Limpa a imagem atual
    deleteLog.val(1);
    input.val('');
    img.attr('src', '../assets/img/products/default-image.png');

    showHideImageDivs2();
}


function showHideImageDivs2() {
    // Mostra ou esconde as divs adicionais com base na presença de imagens nos campos correspondentes
    $('#imgEdit1').closest('.form-group').toggle($('#targetImgEdit').attr('src') !== '../assets/img/products/default-image.png');
    $('#imgEdit2').closest('.form-group').toggle($('#targetImgEdit1').attr('src') !== '../assets/img/products/default-image.png');
}

$(document).ready(function () {

    function previewImage2(inputId, imgId) {
        const input = $('#' + inputId);
        const img = $('#' + imgId);

        if (input[0].files && input[0].files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                img.attr('src', e.target.result);
                showHideImageDivs2(); // Chama a função para ajustar a exibição das divs
            };

            reader.readAsDataURL(input[0].files[0]);
        }
    }

    $('#editModal').on('shown.bs.modal', function () {
        showHideImageDivs2()
    });

    $('#imgEdit, #imgEdit1, #imgEdit2').change(function () {
        const inputId = $(this).attr('id');
        const imgId = 'target' + inputId.charAt(0).toUpperCase() + inputId.slice(1);

        previewImage2(inputId, imgId);
    });
});

//--------------------------------SCRIPTS RESPONSÁVEIS PELA EXIBIÇÃO DAS IMAGENS NO FORMULÁRIO PARA EDITAR UM PRODUTO - FIM

//--------------------------------SCRIPTS DO AUTOCOMPLETE DE CATEGORIAS E MARCAS - INÍCIO

$(document).ready(function () {

    $('#categoryCreate').keyup(function () {

        var inputText = $(this).val();

        $.ajax({
            url: 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=categories',
            type: 'get',
            dataType: 'json',
            success: function (response) {

                var filteredCategories = response.data.filter(function (category) {
                    return category.name.toLowerCase().includes(inputText.toLowerCase());
                });

                $('#categorySuggestions').html('');

                filteredCategories.forEach(function (category) {
                    var suggestionItem = $('<li>' + category.name + ' &#128070;</li>');

                    suggestionItem.click(function () {
                        $('#categoryCreate').val(category.name);
                        $('#categorySuggestions').html('');
                    });

                    $('#categorySuggestions').append(suggestionItem);
                });
            },
            error: function () {
                console.log('Erro ao obter categorias do backend.');
            }
        });
    });

    $('#categoryEdit').keyup(function () {

        var inputText = $(this).val();

        $.ajax({
            url: 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=categories',
            type: 'get',
            dataType: 'json',
            success: function (response) {

                var filteredCategories = response.data.filter(function (category) {
                    return category.name.toLowerCase().includes(inputText.toLowerCase());
                });

                $('#categorySuggestionsUpd').html('');

                filteredCategories.forEach(function (category) {
                    var suggestionItem = $('<li>' + category.name + ' &#128070;</li>');

                    suggestionItem.click(function () {
                        $('#categoryEdit').val(category.name);
                        $('#categorySuggestionsUpd').html('');
                    });

                    $('#categorySuggestionsUpd').append(suggestionItem);
                });
            },
            error: function () {
                console.log('Erro ao obter categorias do backend.');
            }
        });
    });


    $('#brandCreate').keyup(function () {

        var inputText = $(this).val();

        $.ajax({
            url: 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=brands',
            type: 'get',
            dataType: 'json',
            success: function (response) {

                var filteredBrands = response.data.filter(function (brand) {
                    return brand.name.toLowerCase().includes(inputText.toLowerCase());
                });

                $('#brandSuggestions').html('');

                filteredBrands.forEach(function (brand) {
                    var suggestionItem = $('<li>' + brand.name + ' &#128070;</li>');

                    suggestionItem.click(function () {
                        $('#brandCreate').val(brand.name);
                        $('#brandSuggestions').html('');
                    });

                    $('#brandSuggestions').append(suggestionItem);
                });
            },
            error: function () {
                console.log('Erro ao obter marcas do backend.');
            }
        });
    });

    $('#brandEdit').keyup(function () {

        var inputText = $(this).val();

        $.ajax({
            url: 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=brands',
            type: 'get',
            dataType: 'json',
            success: function (response) {

                var filteredBrands = response.data.filter(function (brand) {
                    return brand.name.toLowerCase().includes(inputText.toLowerCase());
                });

                $('#brandSuggestionsUpd').html('');

                filteredBrands.forEach(function (brand) {
                    var suggestionItem = $('<li>' + brand.name + ' &#128070;</li>');

                    suggestionItem.click(function () {
                        $('#brandEdit').val(brand.name);
                        $('#brandSuggestionsUpd').html('');
                    });

                    $('#brandSuggestionsUpd').append(suggestionItem);
                });
            },
            error: function () {
                console.log('Erro ao obter marcas do backend.');
            }
        });
    });
});

//--------------------------------SCRIPTS DO AUTOCOMPLETE DE CATEGORIAS - FIM

$(document).on('click', '#manipulateCategories', function () {

    var apiUrl = 'http://localhost/co2-ecommerce/system/controllers/products/apirest/apiProducts.php?api_key=AI7x234567890qwertYuiopASDFGHJKLZXCVBNM&route=categories';

    $.ajax({
        url: apiUrl,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response && response.data && response.data.length > 0) {
                var data = response.data;
                $('#generatedCategories').empty();

                for (var i = 0; i < data.length; i++) {
                    var row = '<tr>';
                    row += '<td class="fw-bold">' + data[i].name + '</td>';
                    row += '<td><button class="deleteCategory btn btn-outline-danger" data-id="' + data[i].id + '">X</button></td>';
                    row += '</tr>';
                    $('#generatedCategories').append(row);
                }
            } else {
                console.error('A resposta da API não contém dados válidos.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Erro ao obter dados da API. Status: ' + status + ', Erro: ' + error);
        }
    });
});


$(document).on('click', '.deleteCategory', function () {
    var categoryId = $(this).data('id');
    
    $.ajax({
        url: 'controllers/products/deletingCategory.php',
        method: 'POST',
        data: { id: categoryId },
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function (response) {
            if (response == 'Success!') {
                window.location = 'products.php';
            } else {
                $('#manipulateCategoryMsg').text(response).removeClass("text-success").addClass("text-danger");
            }
        },
        error: function (xhr, status, error) {
            console.error('Erro ao excluir categoria. Status: ' + status + ', Erro: ' + error);
        }
    });
});

//CRIAR CATEGORIA
$(document).ready(function () {
    $("#makingCategoryForm").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            type: "POST",
            url: "controllers/products/creatingCategory.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
            .done(function (response) {
                if (response == 'Success!') {
                    window.location = 'products.php';
                } else {
                    $('#manipulateCategoryMsg').text(response).removeClass("text-success").addClass("text-danger");
                }
            })
            .fail(function (xhr, status, error) {
                alert("Erro ao enviar o formulário para criar produto: " + error);
            });
    });
});
//--------------------------------SCRIPTS RESPONSÁVEIS PELO ENVIO DOS FORMULÁRIOS DE PRODUTOS - INÍCIO
//CRIAR PRODUTO
$(document).ready(function () {
    $("#createProduct").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $('#createProductBtn').prop('disabled', true);
        $('#loadingCreateProduct').show();

        $.ajax({
            type: "POST",
            url: "controllers/products/creatingProduct.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
            .done(function (response) {
                $('#createProductBtn').prop('disabled', false);
                $('#loadingCreateProduct').hide();
                if (response == 'Success!') {
                    window.location = 'products.php';
                } else {
                    $('#messageCreateProduct').text(response).removeClass("text-success").addClass("text-danger");
                }
            })
            .fail(function (xhr, status, error) {
                alert("Erro ao enviar o formulário para criar produto: " + error);
            });
    });
});

//EDITAR PRODUTO
$(document).ready(function () {
    $("#editProduct").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $('#EditProductBtn').prop('disabled', true);
        $('#loadingEditProduct').show();

        $.ajax({
            type: "POST",
            url: "controllers/products/updatingProduct.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
            .done(function (response) {
                $('#EditProductBtn').prop('disabled', false);
                $('#loadingEditProduct').hide();
                if (response == 'Success!') {
                    window.location = 'products.php';
                } else {
                    $('#messageEditProduct').text(response).removeClass("text-success").addClass("text-danger");
                }
            })
            .fail(function (xhr, status, error) {
                alert("Erro ao enviar o formulário para editar produto: " + error);
            });
    });
});

//EXCLUIR PRODUTO
$(document).ready(function () {
    $("#deleteProduct").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $('#DeleteProductBtn').prop('disabled', true);
        $('#loadingDeleteProduct').show();

        $.ajax({
            type: "POST",
            url: "controllers/products/deletingProduct.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
            .done(function (response) {
                $('#DeleteProductBtn').prop('disabled', false);
                $('#loadingDeleteProduct').hide();
                if (response == 'Success!') {
                    window.location = 'products.php';
                } else {
                    $('#messageDeleteProduct').text(response).removeClass("text-success").addClass("text-danger");
                }
            })
            .fail(function (xhr, status, error) {
                alert("Erro ao enviar o formulário para editar produto: " + error);
            });
    });
});

//--------------------------------SCRIPTS RESPONSÁVEIS PELOS FORMULÁRIOS - FIM

