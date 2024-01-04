//--------------------------------SCRIPTS RESPONSÁVEIS PELA MANIPULAÇÃO DA EXIBIÇÃO DOS CAMPOS AO CRIAR UM PRODUTO - INÍCIO
$(document).ready(function () {
    // Exibe a div quando a opção LOCAL é selecionada
    $('#inventoryCreate').change(function () {
        if ($(this).val() === 'LOCAL') {
            $('#optionsLocalInventory').show();
        } else {
            $('#optionsLocalInventory').hide();
        }
    });

    // Garante que a div seja exibida corretamente na carga inicial da página
    if ($('#inventoryCreate').val() === 'LOCAL') {
        $('#optionsLocalInventory').show();
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

//--------------------------------SCRIPTS RESPONSÁVEIS PELA EXIBIÇÃO DAS IMAGENS NO FORMULÁRIO PARA CRIAR UM PRODUTO - INÍCIO
function clearImage(inputId, imgId) {
    const input = $('#' + inputId);
    const img = $('#' + imgId);

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

        previewImage(inputId, imgId);
    });
});
//--------------------------------SCRIPTS RESPONSÁVEIS PELA EXIBIÇÃO DAS IMAGENS NO FORMULÁRIO PARA CRIAR UM PRODUTO - FIM

//--------------------------------SCRIPTS RESPONSÁVEIS PELOS FORMULÁRIOS - INÍCIO
//CRIAR CONTA
$(document).ready(function () {
    $("#createProduct").submit(function (event) {
        event.preventDefault();
        var info = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "controllers/products/creatingProduct.php",
            data: info,
            success: function (response) {
                if (response == 'Success!') {
                    $('#messageCreateProduct').text(response).removeClass("text-danger").addClass("text-success");
                } else {
                    $('#messageCreateProduct').text(response).removeClass("text-success").addClass("text-danger");
                }
            },
            error: function (xhr, status, error) {
                alert("Erro ao enviar o formulário para criar produto: " + error);

            }
        });
    });
});

//--------------------------------SCRIPTS RESPONSÁVEIS PELOS FORMULÁRIOS - FIM

