<?php 

    class Produto{
        public $id;
        public $nome;
        public $descricao;
        public $quantidade;
        public $marca;
        public $preco;
        public $validade;

        function __construct($id_informado, $nome_informado, $descricao_informada, $quantidade_informada, $marca_informada, $preco_informado, $validade_informada){
            $this->id = $id_informado;
            $this->nome = $nome_informado;
            $this->descricao = $descricao_informada;
            $this->quantidade = $quantidade_informada;
            $this->marca = $marca_informada;
            $this->preco = $preco_informado;
            $this->validade = $validade_informada;
        }

        
    }
?>
