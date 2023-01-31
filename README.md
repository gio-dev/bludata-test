
## Teste da Bludata by Giovan Dias

Teste desenvolvido pelo dev Giovan Dias utilizando os recursos abaixo:

- Laravel (v8);
- MySQL;
- VueJs (v3);

Alguns conceitos utilizados:

- Solid;
- Clean Code;
- VueRoutes;

### Tempo de Execução

Para realizar o desenvolvimento do teste, foi usado as horas destacadas abaixo:

- Setup (boilerplate Laravel + VueJs): 2h;
- Desenvolvimento Laravel: 4h;
- Desenvolvimento VueJs: 14h (não é meu forte, estou treinando mas não uso no dia a dia)

## Setup do Projeto

A seguir temos o passo a passo para executar o projeto, desde a sua instalação após o download via Git até a execução.


- Primeiramente após o download via Git, é criar seu banco de dados na sua máquina local e configurá-lo no arquivo .env;
- Apos isso, execute o comando: <pre>composer install</pre>
- Após instalar o composer execute o comando a seguir para popular as tabelas na base de dados <pre>php artisan migrate</pre>
- Ocorrendo tudo corretamente, execute o comando a seguir para popular a tabela de estados que será usada no projeto <pre>php artisan db:seed</pre>
- Feito isso, basta iniciar o servidor com o comando abaixo e acessar o link gerado <pre>php artisan serve</pre>

## Observações

1 - Além das rotas visuais do projeto, há algumas rotas usadas no desenvolvimento que podem ser visualizadas:

- /companies -> Para listagem de todas as empresas
- /company/:id/providers -> Listar os fornecedores por empresa, acessada pela rota acima;

2 - No laravel, uso um conceito de reutilização de código bem abrangente, além disso, gosto de usar o máximo de recursos que ele dispõe com finalidade de facilitar o desenvolvimento como observers, scopes, resources, requests, além disso tenho alguns próprios que me auxiliam como Enum, Filters, Services e Repositories.
