# DESAFIO VAMOS

## Para acessar o projeto em um servidor remoto

- Acesse https://agenciab33.com.br/desafio
- Ao clicar no menu `Acesso do Usuário` é possível fazer um cadastro de usuário para acesso ao painel de controle.

## Para iniciar o projeto

- Clone o projeto do repositório remoto https://github.com/baccijsl/desafio
- Execute o composer install
- Execute o composer dump-autoload
- Crie um banco de dados com o nome que desejar e importe o arquivo `db_desafio.sql`
- Altere o arquivo `config\configDatabase.php` com suas credenciais de acesso ao banco de dados
- Altere o arquivo `config\configDefinicoes.php` onde é definido a constante `APP` para o diretório local do seu projeto
- Localmente, acesse http://localhost/SEU_DIRETORIO_LOCAL
- Have fun and rock on :metal:!

## Objetivos

O objetivo deste teste é conhecer as habilidades do analista programador em:

- Programação Front-end/Back-end
- Organização e estruturação de um projeto
- Análise/Entendimento de requisitos
- Qualidade do código
- Conhecimento em banco de dados
- Conhecimento de APIs
- Lógica

## Importante

Nenhum código desenvolvido neste teste será utilizado de forma comercial. O objetivo aqui é apenas avaliar o conhecimento do candidato.

## O desafio!

Que tal desenvolvermos um sistema de filmes favoritos para que as pessoas consigam fazer uma lista dos filmes que elas mais gostam?

### Então você vai precisar:

- Criar a estrutura de projeto utilizando as melhores técnicas que facilitem a manutenção futura do projeto
- Criar a estrutura de banco de dados
- Popular a tabela de filmes (recomendados consumir a API do The Movie DB)
- Criar sistema de autenticação para que o usuário se cadastre e consiga efetuar login
- Criar os endpoints para:
  - Cadastrar um usuário
  - Efetuar login para poder consumir o restante da API
  - Listar os filmes cadastrados no banco
  - Listar os filmes que o usuário salvou como favorito
  - Salvar um filme como favorito
  - Remover um filme da lista de favoritos do usuário
- Criar o front de todas as telas integrando com as APIs criadas

Não esqueça das validações!

### O que devo utilizar?

- Qualquer biblioteca/framework
- Alguma arquitetura que facilite a manutenção futura do código

### Plus

- Testes automatizados

### Como participar?

- Fazer um fork deste repositório e enviar um pull request ao finalizar. Não esqueça de colocar as instruções para rodar o projeto.

# Boa sorte!
