<main class="form-signin w-100 m-auto mt-5 text-center">
    <form method="POST">
        <img class="mb-4" src="{{IMG}}/logo-jsl.png" alt="Painel do Usuário - Cadastro" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">Cadastro de Novo Usuário</h1>

        {{status}}

        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput1" name="nome" placeholder="Seu nome" maxlength="60" required>
            <label for="floatingInput1">Seu nome</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput2" name="email" placeholder="email@exemplo.com.br" maxlength="60" required>
            <label for="floatingInput2">Seu e-mail</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword1" name="senha1" placeholder="Senha" maxlength="20" required>
            <label for="floatingPassword1">Sua senha</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword2" name="senha2" placeholder="Confirmação de senha" maxlength="20" required>
            <label for="floatingPassword2">Confirmação de senha</label>
        </div>

        <div class="mb-3"></div>

        <button class="w-100 btn btn-sm btn-primary" type="submit">Cadastrar</button>

        <div class=" mt-3 mb-3">
            <a href="{{APP}}/usuario/login">Já tem usuário? Fazer login.</a>
        </div>

        <div class=" mt-3 mb-3">
            <a href="{{APP}}">Voltar</a>
        </div>
    </form>
</main>
