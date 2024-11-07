<?php
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Receber dados do corpo da requisição
    $data = json_decode(file_get_contents("php://input"));

    // Aqui você deve ter a lógica para deletar o produto
    if (isset($data->id)) {
        $id = $data->id; // ID do produto a ser excluído

        // Exemplo de SQL para deletar o produto
        $sql = "DELETE FROM Produtos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Produto deletado com sucesso!"]);
        } else {
            echo json_encode(["error" => "Erro ao deletar o produto."]);
        }
    } else {
        echo json_encode(["error" => "ID do produto não fornecido."]);
    }
    exit; // Certifique-se de que não há mais código executado após o retorno
}


?>