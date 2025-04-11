<?php

header("Content-Type: application/json");


//arquivo onde os produtos serão armazenados
echo json_encode($amb);
$ambFile='api\product.json';

//função para ler os produtos
function readProduct(){
    global $ambFile;
    if(file_exists($ambFile)){
        $json=file_get_contents($ambFile);
        return json_decode($json, true);
    } 
    return array(); 
}

//função para salvar produtos
function saveProduct($product){
    global $ambFile;
    file_put_contents($ambFile, json_encode($product, JSON_PRETTY_PRINT));
}
//processar a requisição
//apresentar as variaveis que vieram no pedido (GET ou POST)
$amb['status']='SUCESS';
$amb['method']=$_SERVER['REQUEST_METHOD'];

if($amb['method']=='GET'){
    $amb['amb']=$_GET;
    $product=readProduct();
    if(!empty($product)){
        http_response_code(200);
        echo json_encode(array(
            "sucess"=>true,
            "amb"=>$product
        ));
    }else{
        http_response_code(404);
        echo json_encode(array(
            "sucess"=>false,
            "message"=>"Nenhum produto cadastrado."
        ));
    }}elseif($amb['method']=='POST'){
        //cadastrar novo produto
        $amb=json_decode(file_get_contents("php://input"),true);
        $amb['amb']==$_POST;
        //validar dados
        if( !isset($amb['name'])|| !isset($amb['price'])|| !isset($amb['amount'])){
            http_response_code(400);
            echo json_encode(array(
                "sucess"=>false,
                "message"=>"Dados incompletos. Nome, preço e quantidade são obrigatórios."));
        }
        //criar novo produto
        if($newProduct){
            $newProduct=array(
                "id"=>uniqid(),
                "name"=>htmlspecialchars(strip_tags($data['nome'])),"descricao" => isset($data['descricao']) ? htmlspecialchars(strip_tags($data['descricao'])) : null,
                "preco" => floatval($data['preco']),
                "quantidade" => intval($data['quantidade']),
                "data_criacao" => date('Y-m-d H:i:s')
            );
        }
        //adicionar ao arquivo
        if(saveProduct($product)){
            $products = readProducts();
            $products[] = $newProduct;
            saveProduct($product);
        
            http_response_code(201);
            echo json_encode(array(
                "success" => true,
                "message" => "Produto criado com sucesso.",
                "data" => $newProduct
        ));
        }
        default:
        http_response_code(405);
        echo json_encode(array(
            "success" => false,
            "message" => "Método não permitido."
        ));
    
    
    
    }
?>