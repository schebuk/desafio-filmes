<h1 class="display-6 mb-3">{{header}}</h1>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

<a href="{{APP}}/usuario/depoimentos">
    <button type="button" class="btn btn-primary btn-sm">
        <em class="fas fa-undo fa-fw"></em> Voltar
    </button>
</a>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

{{status}}

<form method="POST">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="titulo" name="titulo" value="{{titulo}}" placeholder="Título" required>
        <label for="titulo">Título</label>
    </div>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Digite seu depoimento..." style="height: 200px" name="texto" id="texto" required>{{texto}}</textarea>
        <label for="texto">Digite seu depoimento...</label>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-sm btn-success"><em class="fas fa-fw fa-save"></em> Gravar</button>
    </div>
</form>
