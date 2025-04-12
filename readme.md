📦 API Simples de Gerenciamento de Produtos (PHP + JSON)
Esta é uma API RESTful simples para gerenciamento de produtos, desenvolvida em PHP com armazenamento em arquivo JSON. Ideal para pequenos projetos e estudos.

📌 Funcionalidades
Listar todos os produtos (GET)

Cadastrar novo produto (POST)

Validação de dados

Armazenamento persistente em JSON

Respostas padronizadas em JSON

🚀 Como Usar
Requisitos
Servidor PHP (Apache, Nginx, etc.)

Permissão de escrita no diretório
Endpoints
GET /api.php - Listar produtos
Retorna todos os produtos cadastrados.

POST /api.php - Criar produto
Cadastra um novo produto.

Parâmetros obrigatórios (body JSON):

name: Nome do produto (string)

price: Preço (number)

amount: Quantidade em estoque (integer)

Parâmetro opcional:

descricao: Descrição detalhada (string)



