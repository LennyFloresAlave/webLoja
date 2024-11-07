<?php
require_once '../DAO/Conexao.php';
// Habilitar o relatório de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Arquivo: produto.php

if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    // Captura os dados enviados no corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];
    $campos = [];

    // Verifica quais campos foram enviados para incluir na query de atualização
    if (isset($data['nome'])) {
        $campos[] = "nome = '" . mysqli_real_escape_string($conexao, $data['nome']) . "'";
    }
    if (isset($data['descricao'])) {
        $campos[] = "descricao = '" . mysqli_real_escape_string($conexao, $data['descricao']) . "'";
    }
    if (isset($data['quantidade'])) {
        $campos[] = "qtd = " . (int)$data['quantidade'];
    }
    if (isset($data['marca'])) {
        $campos[] = "marca = '" . mysqli_real_escape_string($conexao, $data['marca']) . "'";
    }
    if (isset($data['preco'])) {
        $campos[] = "preco = " . (float)$data['preco'];
    }
    if (isset($data['validade'])) {
        $campos[] = "validade = '" . mysqli_real_escape_string($conexao, $data['validade']) . "'";
    }

    // Concatena os campos para criar a query de atualização parcial
    if (!empty($campos)) {
        $sql = "UPDATE Produtos SET " . implode(', ', $campos) . " WHERE id = $id";
        $result = mysqli_query($conexao, $sql);

        if ($result) {
            echo json_encode(["message" => "Produto atualizado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao atualizar o produto"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Nenhum dado para atualizar"]);
    }
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Produto atualizado com sucesso!', 'produto' => $produto]);
}


?>




