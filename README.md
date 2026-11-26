# BIBLIOTECA AURORA
## Sistema de Gerenciamento de Biblioteca

### 1. APRESENTAÇÃO DO PROJETO

O projeto Biblioteca Aurora consiste no desenvolvimento de um sistema web destinado ao gerenciamento de uma biblioteca. A aplicação foi desenvolvida com o propósito de facilitar a organização e o controle das informações relacionadas ao acervo de livros.

O sistema permite realizar operações de cadastro, consulta, atualização e exclusão de livros, além de disponibilizar funcionalidades relacionadas ao gerenciamento de reservas e ao controle de acesso dos usuários.

### 2. INTEGRANTES DO GRUPO

- Maria Eduarda Souza
- Luiza Gomes
- Vitoria Moreira
- Yasmin Carvalho

### 3. TECNOLOGIAS UTILIZADAS

Para o desenvolvimento do projeto, foram utilizadas as seguintes tecnologias:

- **PHP:** utilizado para desenvolver a lógica e as funcionalidades do sistema.
- **MySQL:** responsável pelo armazenamento das informações.
- **HTML:** utilizado na estruturação das páginas.
- **CSS:** responsável pela formatação e apresentação visual do sistema.
- **XAMPP:** utilizado como ambiente de desenvolvimento local.
- **phpMyAdmin:** utilizado para o gerenciamento do banco de dados.

### 4. ESTRUTURA DE PASTAS

O projeto foi organizado em diretórios e arquivos, separando as funcionalidades para facilitar a manutenção e a compreensão do código.

```text
Projetofinal_bibliotecaphp/
│
├── css/
│   └── estilo.css
│
├── livros/
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   ├── listar.php
│   └── verifica_login.php
│
├── reservas/
│   ├── criar.php
│   ├── excluir.php
│   └── listar.php
│
├── bancobpf.sql
├── cabecalho.php
├── conexao.php
├── index.php
├── login.php
├── logout.php
├── README.md
└── rodape.php
```

### 5. PROCEDIMENTOS PARA EXECUÇÃO

Para executar o sistema localmente, é necessário possuir o XAMPP instalado no computador e seguir os procedimentos abaixo:

1. Copiar a pasta do projeto para o diretório `htdocs` do XAMPP.
2. Abrir o painel de controle do XAMPP e iniciar os serviços Apache e MySQL.
3. Acessar o phpMyAdmin pelo endereço `http://localhost/phpmyadmin`.
4. Importar o arquivo `bancobpf.sql` para criar e configurar o banco de dados.
5. Verificar as configurações de conexão no arquivo `conexao.php`.
6. Abrir o navegador e acessar o endereço:

`http://localhost/Projetofinal_bibliotecaphp/`

Após esses procedimentos, o sistema estará disponível para utilização no ambiente local.

### 6. FUNCIONALIDADES DO SISTEMA

O sistema Biblioteca Aurora apresenta as seguintes funcionalidades:

- Acesso ao sistema por meio de login.
- Controle de acesso utilizando sessões.
- Proteção das páginas internas.
- Cadastro de livros.
- Listagem e consulta dos livros cadastrados.
- Edição das informações dos livros.
- Exclusão de livros mediante confirmação.
- Cadastro de reservas.
- Listagem de reservas.
- Exclusão de reservas.
- Encerramento da sessão por meio da opção de logout.

### 7. CONSIDERAÇÕES FINAIS

O desenvolvimento da Biblioteca Aurora possibilitou a aplicação prática dos conhecimentos adquiridos durante as aulas, especialmente nas áreas de programação PHP, integração com banco de dados MySQL, autenticação de usuários e operações CRUD.

A realização do projeto também contribuiu para o aprimoramento dos conhecimentos sobre organização de arquivos, estruturação de páginas e desenvolvimento de sistemas web, permitindo colocar em prática os conteúdos trabalhados ao longo da disciplina.