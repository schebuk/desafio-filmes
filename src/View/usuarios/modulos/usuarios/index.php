<h1 class="display-6 mb-3">{{header}}</h1>

{{botaoAdd}}

<div class="d-flex flex-wrap justify-content-between align-items-center py-2 mt-3 border-top"></div>

{{status}}

<table class="table table-light table-striped">
    <thead class="thead-light">
        <tr>
            <th class="text-center"># ID</th>
            <th class="text-left">Nome</th>
            <th class="text-left">E-mail</th>
            <th class="text-center">Data de Criação</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        {{itens}}
    </tbody>
</table>

{{paginacao}}
