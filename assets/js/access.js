//--------------------------------------------------FORMULÁRIOS-----------------------------------------------------

//CRIAR CONTA
$(document).ready(function () {
    $("#signupForm").submit(function (event) {
        event.preventDefault();
        var dados = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "controllers/access/signupController.php",
            data: dados,
            success: function (response) {
                if (response == 'Success!') {
                    $('#messageCreate').text("Conta criada com sucesso!").removeClass("text-danger").addClass("text-success");
                    $('#closeSignup').click();
                    var email = $('#signupForm input[name="emailCreate"]').val();
                    $('#formLogin input[name="emailLogin"]').val(email);
                } else {
                    $('#messageCreate').text(response).removeClass("text-success").addClass("text-danger");
                }
            },
            error: function (xhr, status, error) {
                alert("Erro ao enviar o formulário para criar conta: " + error);

            }
        });
    });
});

$(document).ready(function () {
    $("#formLogin").submit(function (event) {
        event.preventDefault();
        var dados = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "controllers/access/loginController.php",
            data: dados,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Redirecione para a página adequada
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                    
                } else {
                    $('#messageCreate').text(response.message).removeClass("text-success").addClass("text-danger");
                }
            },
            error: function (xhr, status, error) {
                alert("Erro ao enviar o formulário para criar conta: " + error);

            }
        });
    });
});