<?php 
   
   function incluir_produto($conexao, $u){

        $sql = "INSERT INTO Produtos (nome, descricao, quantidade, marca, preco, validade) VALUES ('$u->nome','$u->descricao', '$u->quantidade', '$u->marca','$u->preco','$u->validade');";
        $res = mysqli_query($conexao, $sql);
        if (!$res) {
            die("Erro ao tentar incluir: " . mysqli_error($conexao));
        }
        
        fecharConexao($conexao);
        return $res;
   };

?>

