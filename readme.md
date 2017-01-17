# UFOP Boilerplate - Laravel 5.3

Esse projeto se destina aqueles que desejam criar algum sistema dedicado a comunidade da [Universidade Federal de Ouro
Preto (UFOP)](http://ufop.br/) usando o mesmo sistema de autenticação do portal [Minha UFOP](http://www.minha.ufop.br/),
tornando a experiência do usuário mais agradável.

Esse *boilerplate* foi desenvolvido usando o *framework* [Laravel](https://laravel.com/), que é um dos *frameworks* PHP
mais usados no mercado na época de criação desse *boilerplate*. Além disso, para o painel de controle, foi utilizado uma
versão personalizada da *dashboard* do [AdminLTE 2](https://almsaeedstudio.com/themes/AdminLTE/index2.html).

Em conjunto ao sistema, para a sessão de autenticação usando os dados do [Minha UFOP](http://www.minha.ufop.br/),
foi usada a API [LD(AP)I](https://github.com/jpmoura/ldapi#ldapi---ptbr) como API de autenticação, que atualmente está
hospedada nos servidores do *campus* do [Instituto de Ciências Exatas e Aplicadas (ICEA)](http://www.icea.ufop.br/site/),
localizado na cidade de João Monlevade, Minas Gerais.

## Pré-requisitos

Antes de executar os comandos de instalação, é necessário que você tenha instalado no dispositivo onde o sistema irá ser
hospedado o [Node.js](https://nodejs.org/en/) entre as versões 0.12 e 6.9.4 e o [gulp.js](http://gulpjs.com/) instalado
globalmente. Você pode ver mais detalhes sobre a instalação do [Node.js](https://nodejs.org/en/) visitando o site da
aplicação para ter mais detalhes sobre os procedimentos em cada plataforma.

No caso do [gulp.js](http://gulpjs.com/), você deve instalar previamente o [Node.js](https://nodejs.org/en/) e então
executar o comando `npm install --global gulp-cli`. Caso você esteje usando um sistema UNIX como MacOS ou uma
distribuição Linux, talvez seja necessário executar o comando com permissão de administrador e para isso você pode usar
o comando `sudo` ou `su`, variando de acordo com o seu sistema operacional.

Como pré-requisitos do próprio Laravel, temos:

* Versão do PHP igual ou superior a 5.6.4;
* Extensão OpenSSL do PHP ativada;
* Extensão PDO do banco de dados utilizado ativada;
* Extensão Mbstring do PHP ativada;
* Extensão Tokenizer do PHP ativada;
* Extensão XML do PHP ativada;

## Instalação

Para a instalação são necessários os seguintes comandos:

```bash
$ composer install
$ npm install
$ gulp --prod
$ php artisan migrate
```

O comando `composer install` é usado para realizar a instalação de todos os pacotes os quais o sistema é dependente para
que o mesmo funcione.

O comando `npm install` é usado para instalar as bibliotecas necessárias para manipulação de
*assets*  ou recursos do sistema como arquivos CSS, JavaScript, etc. Caso você esteja usando um sistema Windows para 
hospedar a aplicação, talvez seja necessário executar o comando `npm install --no-bin-links` ao invés do `npm install`
devido algumas restrições do sistema operacional.

O comando `gulp --prod` irá realizar todos os comandos definidos no arquivo [gulpfile.js](./gulpfile.js),
onde estão definidos todos os procedimentos referentes aos arquivos de recursos do sistema. No caso desse *boilerplate*
todos os arquivos CSS e JavaScript serão mesclados e minificados em um único arquivo, pois isso é uma boa prática para o
desenvolvimento de sistemas WEB.

E por último, o comando `php artisan migrate` faz a migração da tabela que irá conter os usuários para o banco de dados.

## Configuração

Dentro da pasta [config](./config) existe o arquivo [ldapi.php](./config/ldapi.php) que mostra que no arquivo de
ambiente, o chamado arquivo `.env` devem existir as entradas `LDAPI_USER` que deve conter o sistema usuário da API e o
campo `LDAPI_PASSWORD`. No arquivo [.env.example](./.env.example) é possível ver um exemplo preenchido. Para obter o seu
usuário e senha da LDAPI é necessário entrar em contato com o suporte de informática do
[ICEA](mailto:suporteinformatica@decea.ufop.br).

Após preenchido o usuário e senha do LDAPI no arquivo `.env` pode ser necessário executar o comando
`php artisan config:cache` na raiz do diretório do sistema. Esse comando limpa a configuração anterior que foi salva em
cache e força um novo carregamento do arquivo de configuração.

## Funcionamento da Autenticação

A LDAPI é uma API RESTful e por isso reponde a requisições HTTP. Para realizar tais requisições para a API foi utilizado
o pacote GuzzleHttp, que é um dos pacotes HTTP mais conhecidos para PHP.

O controlador [LoginController](./app/Http/Controllers/Auth/LoginController.php) contém toda a lógica da autenticação.
Para esse *boilerplate*, foi tomada como restrição que somente professores e técnicos administrativos seriam capazes de
utilizar o sistema.

A autenticação nesse caso depende de dois métodos do [LoginController](./app/Http/Controllers/Auth/LoginController.php),
que são o `isPermitted` que verifica se o usuário pertence a algum grupo da lista de permitidos e o método `postLogin`
que recebe os dados do formulário da página de login. Usando as credenciais fornecidas, é feita uma requisição para a
LDAPI e dependendo da resposta o usuário é autenticado ou não. Caso seja o primeiro acesso do usuário, ele é cadastrado
imediatamente e automaticamente no banco de dados, usando os atributos provenientes da resposta da LDAPI caso ele esteja
autorizado e autenticado.

Todo o código de autenticação está comentado no corpo dos métodos no
[LoginController](./app/Http/Controllers/Auth/LoginController.php). Existem também o tratamento de eventos, que
basicamente somente criam uma entrada no arquivo de *log* informando o administrador sobre erros de login, logins que
foram realizados com sucesso e também logouts feitos, bem como o registro da criação de novos usuários.