# Biblioteca

Sistema web para gerenciamento de livros desenvolvido com Laravel.

---

## Tecnologias Utilizadas

### Backend
- PHP 8.4.20
- Laravel 13.8.0

### Frontend
- Tailwind CSS 4.0
- JavaScript
- HTML5
- CSS3
- Blade

### Banco de Dados
- MySQL 8.0.35

### Ambiente de Desenvolvimento
- Laravel Herd
- HeidiSQL
- Vite

### Runtime e Gerenciamento
- Node.js 24.1.0
- NPM 11.3.0
- Composer

---

## Funcionalidades

- Cadastro de livros
- Edição de livros
- Exclusão de livros
- Sistema de autenticação
- Página pública de visualização de livros
- Interface responsiva
- Criptografia de IDs nas rotas

---

## Ambiente Local

O projeto foi executado localmente utilizando:

```text
http://biblioteca.test/
```

com gerenciamento do ambiente através do Laravel Herd.

O frontend foi executado em modo desenvolvimento utilizando:

```bash
npm run dev
```

---

## Instalação

Clone o projeto:

```bash
git clone https://github.com/lmoliiveira/biblioteca.git
```

Entre na pasta:

```bash
cd biblioteca
```

Instale as dependências PHP:

```bash
composer install
```

Instale as dependências frontend:

```bash
npm install
```

Configure o ambiente:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Execute as migrations:

```bash
php artisan migrate
```

Inicie o Vite:

```bash
npm run dev
```

---

## Autor

Lucas Oliveira

GitHub:
https://github.com/lmoliiveira
