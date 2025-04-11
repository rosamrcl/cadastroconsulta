Como usar a API
Cadastrar produto (POST)
URL: http://seusite.com/api/index.php
Método: POST
Headers:
  Content-Type: application/json
Body:
{
    "nome": "Smartphone",
    "descricao": "Modelo XYZ 128GB",
    "preco": 1999.90,
    "quantidade": 15
}
Consultar produtos (GET)
URL: http://seusite.com/api/index.php
Método: GET



Funcionalidades
Cadastro de produtos:

Gera um ID único automaticamente

Armazena nome, descrição (opcional), preço e quantidade

Registra data/hora de criação

Consulta de produtos:

Retorna todos os produtos cadastrados

Formato JSON organizado

Validações básicas:

Verifica campos obrigatórios (nome, preço, quantidade)

Proteção básica contra XSS (htmlspecialchars + strip_tags)

Conversão de tipos (preço para float, quantidade para int)

Vantagens desta abordagem
Não requer instalação/configuração de banco de dados

Fácil de implementar e testar

Ideal para protótipos ou pequenas aplicações

Dados persistentes entre execuções (armazenados em JSON)