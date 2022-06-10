<h1>Depoimentos</h1>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

<a href="{{APP}}/usuario/depoimentos/novo">
    <button type="button" class="btn btn-success btn-sm">
        <em class="fas fa-plus-square fa-fw"></em> Cadastrar Depoimento
    </button>
</a>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

{{status}}

<table class="table table-light table-striped">
    <thead class="thead-light">
        <tr>
            <th class="text-center" style="width:5%"># ID</th>
            <th class="text-left" style="width:25%">Nome</th>
            <th class="text-left" style="width:40%">Texto</th>
            <th class="text-center" style="width:10%">Data</th>
            <th class="text-center" style="width:10%">Ações</th>
        </tr>
    </thead>
    <tbody>
        {{itens}}
    </tbody>
</table>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

{{paginacao}}
