<h1 class="display-6 mb-3">{{header}}</h1>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

<a href="{{APP}}/usuario/usuarios">
    <button type="button" class="btn btn-primary btn-sm">
        <em class="fas fa-undo fa-fw"></em> Voltar
    </button>
</a>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

{{status}}

<form method="POST">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nome" name="nome" value="{{nome}}" placeholder="Nome" required>
        <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" value="{{email}}" placeholder="E-mail" required>
        <label for="email">E-mail</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="senha" name="senha" value="{{senha}}" placeholder="Senha <small style='font-size:0.75rem'>(deixe o campo em branco para manter a senha atual)</small>" {{required}}>
        <label for="senha">Senha <small style="font-size:0.75rem">(deixe o campo em branco para manter a senha atual)</small></label>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-sm btn-success"><em class="fas fa-fw fa-save"></em> Gravar</button>
    </div>
</form>
