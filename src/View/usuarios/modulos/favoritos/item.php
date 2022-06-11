<div class="col-md-6 col-lg-3 col-sm-12">
    <div class="card mb-3" style="width: 16rem;">
        <img src="{{imagem}}" class="card-img-top" style="height:277px" alt="{{titulo}}">
        <div class="card-body">
            <h5 class="card-title">{{titulo}}</h5>
            <p class="card-text">
                {{descricao}}
            </p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><small>Classificação:</small> {{classificacao}}</li>
        </ul>
        <div class="card-body">
            <a href="{{APP}}/usuario/favoritos/{{id}}/apagar" class="card-link">
                <em class="fas fa-fw fa-heart"></em>
            </a>
        </div>
    </div>
</div>
