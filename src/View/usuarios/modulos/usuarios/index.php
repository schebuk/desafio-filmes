<h1>{{header}}</h1>

{{botaoAdd}}

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

{{status}}

<table class="table table-light table-striped">
    <thead class="thead-light">
        <tr>
            <th class="text-center" style="width:5%"># ID</th>
            <th class="text-left" style="width:25%">Nome</th>
            <th class="text-left" style="width:30%">E-mail</th>
            <th class="text-center" style="width:20%">Data de Criação</th>
            <th class="text-center" style="width:10%">Ações</th>
        </tr>
    </thead>
    <tbody>
        {{itens}}
    </tbody>
</table>

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

{{paginacao}}
