<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <title>CO2 Peças - Acesso</title>
    <link rel="stylesheet" href="ext/bootstrap/bootstrap.min.css">
</head>

<body>

    <!-- FORMULÁRIO DE LOGIN - início -->
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <a title="Voltar à página principal" href="index.php">
                    <img src="assets/img/logo.svg" width="150" height="150" alt="Logo para retorno À página principal">
                </a>
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3"><em>Área de acesso</em></h1>
                <p class="col-lg-10 fs-4">Fazer login ou criar uma conta<br>é <strong>rápido</strong> e
                    <strong>fácil</strong>.<br>Vá em frente! <svg xmlns="http://www.w3.org/2000/svg" width="30"
                        height="30" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5" />
                    </svg>
                </p>

            </div>

            <div class="col-md-10 mx-auto col-lg-5">
                <form id="formLogin" class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="emailLogin" name="emailLogin"
                            placeholder="nome@exemplo.com" required>
                        <label for="emailLogin">E-mail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="passwordLogin" name="passwordLogin"
                            placeholder="Senha escolhida" required>
                        <label for="passwordLogin">Senha</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
                    <div id="messageLogin" class="text-center"></div>
                    <hr class="my-4">
                    <p>Esqueceu a senha? <a href="#" data-bs-toggle="modal" data-bs-target="#modalRecovery"
                            title="Recuperar senha" class="text-decoration-none badge text-bg-info fs-6">Recuperar <svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-hand-index-thumb" viewBox="0 0 16 16">
                                <path
                                    d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 0 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 1 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.118a.5.5 0 0 1-.447-.276l-1.232-2.465-2.512-4.185a.517.517 0 0 1 .809-.631l2.41 2.41A.5.5 0 0 0 6 9.5V1.75A.75.75 0 0 1 6.75 1M8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v6.543L3.443 6.736A1.517 1.517 0 0 0 1.07 8.588l2.491 4.153 1.215 2.43A1.5 1.5 0 0 0 6.118 16h6.302a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046zm2.094 2.025" />
                            </svg></a></p>
                    <p>Não possui conta? <a href="#" data-bs-toggle="modal" data-bs-target="#modalSignup"
                            title="Criar conta" class="text-decoration-none badge text-bg-warning fs-6">Criar <svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-hand-index-thumb" viewBox="0 0 16 16">
                                <path
                                    d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 0 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 1 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.118a.5.5 0 0 1-.447-.276l-1.232-2.465-2.512-4.185a.517.517 0 0 1 .809-.631l2.41 2.41A.5.5 0 0 0 6 9.5V1.75A.75.75 0 0 1 6.75 1M8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v6.543L3.443 6.736A1.517 1.517 0 0 0 1.07 8.588l2.491 4.153 1.215 2.43A1.5 1.5 0 0 0 6.118 16h6.302a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046zm2.094 2.025" />
                            </svg></a></p>
                </form>
            </div>

        </div>
    </div>
    <!-- FORMULÁRIO DE LOGIN - fim -->

    <!-- FORMULÁRIOS RECUPERAR SENHA - início -->
    <div class="modal fade" id="modalRecovery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Recuperar senha</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-5 pt-0">
                    <div id="emailReset">
                        <form id="formEmail" class="">
                            <label class="mb-2 fw-bold" for="emailRecovery">Seu e-mail cadastrado</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" id="emailRecovery" name="emailRecovery"
                                    placeholder="nome@exemplo.com" aria-label="nome@exemplo.com"
                                    aria-describedby="generate-token" required>
                                <button class="btn btn-primary" type="submit"
                                    id="generate-token"><small>Gerar</small></button>
                            </div>
                        </form>
                    </div>
                    <div id="tokenReset">
                        <form id="formToken">
                            <label class="mb-2 fw-bold" for="secureToken">Token de segurança enviado ao e-mail</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="secureToken" name="secureToken"
                                    placeholder="nome@exemplo.com" aria-label="nome@exemplo.com"
                                    aria-describedby="validate-token" required>
                                <button class="btn btn-primary" type="submit"
                                    id="validate-token"><small>Validar</small></button>
                            </div>
                        </form>
                    </div>
                    <div id="passwordReset">
                        <form id="formReset">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3" id="newPassword" name="newPassword"
                                    placeholder="name@example.com" required>
                                <label for="newPassword">Nova senha</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3" id="newPassword2" name="newPassword2"
                                    placeholder="name@example.com" required>
                                <label for="newPassword2">Confirmar nova senha</label>
                            </div>
                            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Redefinir
                                senha</button>
                        </form>
                    </div>
                    <div id="messageRecovery" class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- FORMULÁRIOS RECUPERAR SENHA - fim -->

    <!-- FORMULÁRIO CRIAR CONTA - início -->
    <div class="modal fade" id="modalSignup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Criar conta</h1>
                    <button id="closeSignup" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form id="signupForm" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="nameCreate" name="nameCreate"
                                placeholder="" required>
                            <label for="nameCreate">Nome completo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="emailCreate" name="emailCreate"
                                placeholder="nome@exemplo.com" required>
                            <label for="emailCreate">E-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="passwordCreate"
                                name="passwordCreate" placeholder="Password" required>
                            <label for="passwordCreate">Senha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="passwordCreate2"
                                name="passwordCreate2" placeholder="Password" required>
                            <label for="passwordCreate2">Confirmar senha</label>
                        </div>
                        <div class="form-check text-start my-3">
                            <input class="form-check-input" type="checkbox" id="userAgreed" name="userAgreed" required>
                            <label class="form-check-label" for="userAgreed">
                                <small>Concordo que li e aceito os <a title="Termos de uso da CO2 Peças"
                                        href="terms.html" target="_blank">Termos de uso</a> e <a
                                        title="Políticas da CO2 Peças" href="policies.php"
                                        target="_blank">Políticas</a> do site.</small>
                            </label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Criar</button>
                    </form>
                    <div id="messageCreate" class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- FORMULÁRIO CRIAR CONTA - fim -->
    <script src="ext/jquery/jquery-3.7.1.js"></script>
    <script src="assets/js/access.js" async></script>
    <script src="ext/bootstrap/bootstrap.bundle.min.js"></script>


</body>

</html>