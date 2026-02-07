# Private Chef - Desafio Técnico Laravel

Este projeto é um desafio técnico desenvolvido com **Laravel 12**, focado em demonstrar boas práticas de estruturação, performance de banco de dados e uma interface de usuário refinada. O sistema permite listar, visualizar, criar, comentar e avaliar receitas culinárias.

---

## 🚀 Decisões Técnicas & Arquitetura

### 1. Performance e Solução do Problema N+1
Para evitar múltiplas consultas ao banco de dados ao listar as métricas de avaliação, utilizei:
* **`withAvg()` e `withCount()`**: Implementados no `index` para calcular a média e o total de avaliações em uma única query SQL.
* **`loadAvg()` e `loadCount()`**: Utilizados no `show` para carregar as mesmas métricas via *Lazy Eager Loading*.

### 2. UI/UX Moderna (Padrão Emerald)
Afastei-me do visual padrão "cru" para entregar uma experiência mais próxima de um produto real:
* **Design:** Paleta de cores baseada em `Emerald-600`, bordas arredondadas (`rounded-[3rem]`) e efeitos de *Glassmorphism*.
* **Interatividade:** Uso de **Alpine.js** para criação dinâmica de ingredientes e **Tailwind CSS** para transições suaves.

### 3. Segurança e Regras de Negócio
* **Autorização:** Implementação rigorosa de **Policies**. Apenas o autor da receita possui permissão para editar ou excluir seus registros.
* **Avaliações Únicas:** Utilizei a lógica de `updateOrCreate()` no backend para garantir que cada usuário possa avaliar uma receita apenas uma vez, atualizando sua nota caso tente avaliar novamente.
* **Validação:** Centralizada em **Form Requests**, mantendo os Controllers "finos" e focados apenas no fluxo de controle.

---

## 🛠️ Stack Tecnológica

* **Backend:** PHP 8.2+ & Laravel 12
* **Frontend:** Blade, Tailwind CSS & Alpine.js
* **Autenticação:** Laravel Breeze
* **Banco de Dados:** MySQL
* **Container:** Laravel Sail (Docker)

---

## 📦 Instalação e Execução

Siga os passos abaixo para subir o ambiente:

1.  **Clonar o projeto:**
    ```
    git clone [https://github.com/matheussantos-mob/private-chef.git](https://github.com/matheussantos-mob/private-chef.git)
    cd private-chef
    ```

2.  **Subir os containers:**
    ```
    ./vendor/bin/sail up -d
    ```

3.  **Setup Automático:**
    Execute o comando abaixo para configurar todo o ambiente automaticamente (instalação de dependências PHP/JS, configuração do .env, geração de chaves, link de storage, migrations com seeds e build de assets):
    ```
    ./vendor/bin/sail bin composer run setup
    ```

4.  **Acessar a aplicação:**
    Abra no navegador: http://localhost


---

## 👤 Usuários para Teste

A aplicação já inicia com 4 usuários pré-configurados para facilitar a avaliação. A senha padrão para todos é `password`.

| Nome | E-mail |
| :--- | :--- |  
| **Admin** | admin@teste.com |
| **João Silva** | joao@teste.com |
| **Maria Oliveira** | maria@teste.com |
| **Pedro Santos** | pedro@teste.com |

---

## 📂 Pontos de Interesse no Código

* **Lógica de Interação:** `app/Http/Controllers/RecipeController.php` (Métodos `storeComment` e `storeRating`).
* **Segurança:** `app/Policies/RecipePolicy.php`.
* **Dados Iniciais:** `database/seeders/DatabaseSeeder.php` (Configuração das receitas brasileiras).
* **Frontend Dinâmico:** `resources/views/recipes/create.blade.php` (Gerenciamento de ingredientes com Alpine).
