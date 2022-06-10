<h1>{{header}}</h1>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

<a href="{{APP}}/usuario/depoimentos">
    <button type="button" class="btn btn-primary btn-sm">
        <em class="fas fa-undo fa-fw"></em> Voltar
    </button>
</a>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

<form method="post">
    <div class="form-group">
        Você deseja realmente apagar o depoimento de <strong>{{titulo}}</strong> com o texto <strong>"{{texto}}"</strong>?
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-danger btn-sm"><em class="fas fa-fw fa-trash-alt"></em> Apagar</button>
    </div>
</form>
