<?php 
         function criarResposta($status, $msg){
            $resp = new Resposta($status, $msg);
     
            return $resp;
         }
    
         function receberDados(){
            $dados = json_decode(file_get_contents('php://input'));
            
            $nome = $dados->nome;
            $descricao = $dados->descricao;
            $quantidade = $dados->quantidade;
            $marca = $dados->marca;
            $preco = $dados->preco;
            $validade = $dados->validade;
    
            $dadosProduto = new Produto("",$nome, $descricao, $quantidade, $marca, $preco, $validade);
            return $dadosProduto;
        }
?>