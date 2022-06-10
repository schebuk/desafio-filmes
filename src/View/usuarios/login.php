<main class="form-signin w-100 m-auto mt-5 text-center">
    <form method="POST">
        <img class="mb-4" src="{{IMG}}/logo-jsl.png" alt="Painel do Usuário - Login" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">Painel do Usuário</h1>

        {{status}}

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="email@exemplo.com.br" required>
            <label for="floatingInput">Seu e-mail</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="senha" placeholder="Senha" required>
            <label for="floatingPassword">Sua senha</label>
        </div>

        <div class="mb-3"></div>

        <button class="w-100 btn btn-sm btn-primary" type="submit">Entrar</button>

        <div class=" mt-3 mb-3">
            <a href="{{APP}}/usuario/cadastro">Cadastre-se</a>
        </div>

        <div class=" mt-3 mb-3">
            <a href="{{APP}}">Voltar</a>
        </div>
    </form>
</main>
