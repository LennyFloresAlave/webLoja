<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Para fins de teste, vamos apenas retornar os dados que recebemos
    if (isset($data['nome']) && isset($data['descricao']) && isset($data['quantidade'])  && isset($data['marca']) && isset($data['preco']) && isset($data['validade'])) {
        // Aqui você pode adicionar o código para salvar o produto no banco de dados
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Produto criado com sucesso!',
            'data' => $data // Retornando os dados recebidos para confirmar
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dados insuficientes']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não suportado']);
}
// produto.php

if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    // Pegando os dados da requisição
    $data = json_decode(file_get_contents("php://input"), true); // Lê e decodifica o JSON enviado

    $id = $data['id'] ?? null; // Obtém o ID
    unset($data['id']); // Remove o ID dos dados para evitar conflito

    if ($id) {
        // Atualiza o produto no banco de dados
        // Aqui deve estar a lógica de atualização do banco de dados
        // Exemplo com PDO
        $stmt = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, marca = :marca, preco = :preco, quantidade = :quantidade WHERE id = :id");
        $stmt->execute(array_merge($data, ['id' => $id]));

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Produto atualizado com sucesso!']);
        } else {
            echo json_encode(['message' => 'Produto não encontrado ou nenhuma alteração feita.']);
        }
    } else {
        echo json_encode(['message' => 'ID do produto não fornecido.']);
    }
}

// Exemplo de como lidar com DELETE em PHP

// produto.php

// Conexão com o banco de dados (exemplo)


// Exemplo de estrutura básica para manipular requisições DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Obtém o ID do produto da query string
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'] ?? null;

    if ($id) {
        // Execute sua lógica para deletar o produto aqui
        // Exemplo: $result = $database->deleteProduct($id);
        
        // Se a deleção for bem-sucedida
        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Produto deletado com sucesso!']);
        } else {
            http_response_code(404); // Produto não encontrado
            echo json_encode(['error' => 'Produto não encontrado.']);
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'ID do produto não fornecido.']);
    }
} else {
    // Lida com outros métodos HTTP se necessário
    http_response_code(405); // Método não permitido
    echo json_encode(['error' => 'Método não permitido.']);
}


?>







