# 📚 Biblioteca Digital - Sistema de Gerenciamento de Livros

Sistema web completo desenvolvido em Laravel para gerenciamento de biblioteca digital, com funcionalidades de CRUD, autenticação, upload de arquivos e gerenciamento de sessões.

## 🎯 Sobre o Projeto

Este projeto foi desenvolvido como trabalho final da disciplina, implementando um sistema completo de gerenciamento de biblioteca com as seguintes características:

- **CRUD Completo** de Livros e Categorias
- **Sistema de Autenticação** com login e registro
- **Upload de Arquivos** (capas de livros em PNG/JPG)
- **Gerenciamento de Sessão** para controle de usuários
- **Uso de Cookies** para lembrar preferência de visualização (grid/lista)
- **Banco de Dados Relacional** MySQL
- **Interface Responsiva** com Bootstrap 5
- **Padrão MVC** completo

## ✨ Funcionalidades

### 📖 Gerenciamento de Livros
- Listar todos os livros com paginação
- Criar novo livro com upload de capa (PNG/JPG)
- Editar informações do livro
- Excluir livro (com exclusão da imagem)
- Visualizar detalhes completos
- Filtrar por categoria
- Buscar por título ou autor
- Alternar entre visualização em grade ou lista (preferência salva em cookie)

### 🏷️ Gerenciamento de Categorias
- Listar todas as categorias
- Criar nova categoria
- Editar categoria
- Excluir categoria (com validação de livros associados)
- Visualizar livros de uma categoria

### 🔐 Autenticação
- Login com validação
- Registro de novos usuários
- Logout com invalidação de sessão
- Proteção de rotas com middleware

## 🛠️ Tecnologias Utilizadas

- **Framework:** Laravel 10.x
- **Linguagem:** PHP 8.1
- **Banco de Dados:** MySQL 8.0
- **Frontend:** Bootstrap 5.3, Bootstrap Icons
- **Padrão:** MVC (Model-View-Controller)

## 📋 Requisitos do Sistema

- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Extensões PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, GD

## 🚀 Instalação

### 1. Clone o repositório
```bash
git clone https://github.com/SEU_USUARIO/biblioteca-digital.git
cd biblioteca-digital
```

### 2. Instale as dependências
```bash
composer install
```

### 3. Configure o ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure o banco de dados no arquivo `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca_digital
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 5. Crie o banco de dados
```sql
CREATE DATABASE biblioteca_digital CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Execute as migrations e seeders
```bash
php artisan migrate
php artisan db:seed
```

### 7. Crie o link simbólico para storage
```bash
php artisan storage:link
```

### 8. Inicie o servidor
```bash
php artisan serve
```

Acesse: `http://localhost:8000`

## 👤 Credenciais de Teste

### Administrador
- **E-mail:** admin@biblioteca.com
- **Senha:** admin123

### Usuário
- **E-mail:** user@biblioteca.com
- **Senha:** user123

## 📁 Estrutura do Projeto

```
biblioteca-digital/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php       # Autenticação
│   │   │   ├── BookController.php       # CRUD de Livros
│   │   │   └── CategoryController.php   # CRUD de Categorias
│   │   └── Middleware/
│   └── Models/
│       ├── User.php                     # Model de Usuário
│       ├── Book.php                     # Model de Livro
│       └── Category.php                 # Model de Categoria
├── database/
│   ├── migrations/                      # Migrations do banco
│   └── seeders/                         # Seeders de dados iniciais
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Layout principal
│       ├── auth/                        # Views de autenticação
│       ├── books/                       # Views de livros
│       └── categories/                  # Views de categorias
├── routes/
│   └── web.php                         # Rotas da aplicação
└── storage/
    └── app/
        └── public/
            └── covers/                  # Imagens de capas
```

## 🎨 Recursos Implementados

### ✅ Requisitos Obrigatórios

- [x] **CRUD Completo** - Create, Read, Update, Delete para Livros e Categorias
- [x] **Banco de Dados Relacional** - MySQL com relacionamentos
- [x] **Gerenciamento de Sessão** - Controle de usuários logados
- [x] **Upload de Arquivos** - Apenas PNG/JPG, armazenamento em storage/app/public
- [x] **Uso de Cookies** - Preferência de visualização (grid/lista)
- [x] **Organização MVC** - Estrutura completa Model-View-Controller
- [x] **Validação de Dados** - Validações em todos os formulários
- [x] **Mensagens de Feedback** - Sucesso e erro em todas as operações

### 🌟 Funcionalidades Extras

- Interface responsiva e moderna
- Filtros e busca avançada
- Paginação de resultados
- Relacionamentos entre tabelas
- Validação de exclusão (categorias com livros)
- Preview de imagens
- Ícones Bootstrap Icons
- Layout profissional com gradiente

## 📝 Rotas Principais

```
GET  /                          # Redireciona para login
GET  /login                     # Formulário de login
POST /login                     # Processar login
GET  /register                  # Formulário de registro
POST /register                  # Processar registro
POST /logout                    # Logout

# Livros (protegido por autenticação)
GET    /books                   # Listar livros
GET    /books/create            # Formulário criar livro
POST   /books                   # Salvar livro
GET    /books/{id}              # Visualizar livro
GET    /books/{id}/edit         # Formulário editar livro
PUT    /books/{id}              # Atualizar livro
DELETE /books/{id}              # Excluir livro

# Categorias (protegido por autenticação)
GET    /categories              # Listar categorias
GET    /categories/create       # Formulário criar categoria
POST   /categories              # Salvar categoria
GET    /categories/{id}         # Visualizar categoria
GET    /categories/{id}/edit    # Formulário editar categoria
PUT    /categories/{id}         # Atualizar categoria
DELETE /categories/{id}         # Excluir categoria
```

## 🗄️ Estrutura do Banco de Dados

### Tabela: users
- id (PK)
- name
- email (unique)
- role (admin/user)
- password
- timestamps

### Tabela: categories
- id (PK)
- name
- description
- timestamps

### Tabela: books
- id (PK)
- title
- author
- isbn (unique)
- description
- cover_image
- category_id (FK)
- timestamps

## 🔒 Segurança

- Senhas criptografadas com Hash
- Proteção CSRF em todos os formulários
- Validação de tipos de arquivo no upload
- Middleware de autenticação
- Sanitização de inputs
- Regeneração de sessão no login

## 📸 Screenshots

A aplicação possui:
- Tela de login moderna com gradiente
- Dashboard com listagem de livros em grade/lista
- Formulários intuitivos com validação
- Mensagens de sucesso/erro
- Interface responsiva

## 🤝 Contribuindo

Este é um projeto acadêmico, mas sugestões são bem-vindas!

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais.

## 👨‍💻 Autor

Desenvolvido como trabalho final da disciplina de Desenvolvimento Web.

---

**Nota:** Este sistema atende a todos os requisitos obrigatórios do trabalho final:
1. ✅ CRUD completo implementado
2. ✅ Banco de dados MySQL (relacional)
3. ✅ Gerenciamento de sessão
4. ✅ Upload de arquivos PNG/JPG
5. ✅ Uso de cookies
6. ✅ Organização MVC com boas práticas
