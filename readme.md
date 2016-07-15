# Meu ICEA

O [Meu ICEA](http://200.239.152.5/meuicea/public)
é o portal de serviços que reúne todos os serviços de TI disponíveis aos corpos
docente, discente, técnico e administrativo do [Instituto de Ciências Exatas e Aplicadas (campus João Monlevade)](http://www.icea.ufop.br)
da [Universidade Federal de Ouro Preto](http://ufop.br).

A motivação para criação do portal foi centralizar em um só local todos os sistemas
ao qual um determinado usuário tem acesso especificamente para o *campus* de
João Monlevade, facilitando também a autenticação entre os diferentes sistemas
sem a necessidade de um *login* e senha específicos para cada um deles.

O sistema foi desenvolvido usando a versão 5.2 do *framework* [Laravel](https://laravel.com/)
para aplicações web, um dos mais usados no mercado durante o período de
desenvolvimento.

## Funcionamento
O sistema utiliza a mesma base LDAP na autenticação do sistema [Minha UFOP](http://www.minha.ufop.br),
filtrando o usuário pela localidade em que ele se encontra, permitindo somente
aqueles usuários que pertençam ao *campus* de João Monlevade, existindo a exceção
do Departamento de Computação (DECOM) que pertence à Ouro Preto porém existem
professores vinculados ao mesmo que ministram aulas no *campus*.

Autenticado o usuário, ele tem alguns dados armazenados na tabela de sessão
que é compartilhada entre os sistemas, porém estes dados estão criptografados
assim como toda a comunicação feita entre o portal e o *middleware* de autenticação
de cada sistema em específico.

Existe também a restrição de que a sessão do usuário existe por apenas trinta
minutos no banco, a partir disso ela é automaticamente expirada, requerindo do
usuário uma nova autenticação.

Com o objetivo de manter a conscistência entre os sistemas, foi usado como base o design [AdminLTE](https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html)
desenvolvido por [Abdullah Almsaeed](mailto:abdullah@almsaeedstudio.com),
alterando-se basicamente só a palheta de cores do tema.

## Instalação
Para instalação é necessário ter o gerenciado de dependências composer instalado,
e a partir dele usar o comando de instalação:

```bash
composer install
composer update
```

Para usuários de sistemas UNIX, será necessário conceder permissão de leitura,
gravação e execução da pasta em que se encontra o sistema para o grupo
*www-data* caso o usuário esteja utilizando as configurações padrões do servidor
[Apache](http://www.apache.org/) que pode ser dado pelo seguinte comando
com permissões de administrador:

```bash
chown -R www-data:USUARIO PASTA
```

Basta usar o comando *sudo* ou *su* dependendo da distribuição *Linux*
juntamente com este comando.

A estrutura do banco de dados usada pelo sistema pode ser criada a partir do
script SQL encontrado [aqui](./DUMP_meuicea.sql). Além disso é necessário configurar as variáveis
de ambiente do Laravel a partir do arquivo na raiz do projeto sem nome mas de
extensão ENV. Existe um arquivo de exemplo [aqui](./.env.example) que pode ser editado e depois
renomeado apropriadamente apenas para .env onde nele deve-se encontrar o
endereço, senha, usuário e nome da base do banco de dados. Também nesse arquivo é
necessário definir uma variável chamada APP_ENC_KEY que define uma chave de 32 bits
que será usada para encriptação e decriptação das variáveis de sessão que serão
compartilhadas entre os sistemas.

## TODO

* Otimização do carregamento dos elementos CSS e Javascript usando Gulp juntamente com SASS ou LESS.
