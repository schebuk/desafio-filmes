<h1 class="display-6 mb-3">{{header}}</h1>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

<a href="{{APP}}/usuario/favoritos">
    <button type="button" class="btn btn-primary btn-sm">
        <em class="fas fa-undo fa-fw"></em> Voltar
    </button>
</a>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

<form method="post">
    <div class="form-group">
        Você deseja realmente apagar o filme dos seus favoritos?
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-danger btn-sm"><em class="fas fa-fw fa-trash-alt"></em> Apagar</button>
    </div>
</form>
