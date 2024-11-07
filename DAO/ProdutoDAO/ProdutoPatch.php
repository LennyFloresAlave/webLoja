<?php 
   
   function editar_produto_parcialmente($conexao) {
      $dados = json_decode(file_get_contents('php://input'));
  
      // Verifica se a propriedade 'tabela' existe
      if (!isset($dados->tabela)) {
          echo json_encode(['error' => 'A propriedade "tabela" é obrigatória.']);
          fecharConexao($conexao);
          return false;
      }
  
      $tabela = $dados->tabela;
      $id = $dados->id;
  
      // Verifica se o ID foi fornecido
      if (!isset($dados->id)) {
          echo json_encode(['error' => 'ID é obrigatório.']);
          fecharConexao($conexao);
          return false;
      }
  
      // Verifica se o campo a ser atualizado foi fornecido
      $campo = array_keys((array) $dados)[2];
      $valor = $dados->$campo;
  
      $verificar_sql = "SELECT id FROM $tabela WHERE id = $id";
      $verificar_res = mysqli_query($conexao, $verificar_sql);
  
      if (mysqli_num_rows($verificar_res) == 0) {
          echo json_encode(['error' => 'ID inválido.']);
          fecharConexao($conexao);
          return false;
      }
  
      // Formata a consulta SQL
      $sql = "UPDATE $tabela SET $campo = '$valor' WHERE id = $id;";
      $res = mysqli_query($conexao, $sql) or die(json_encode(['error' => 'Erro ao tentar editar.']));
  
      fecharConexao($conexao);
  
      return json_encode(['message' => 'Produto atualizado com sucesso.']);
  }
  
 
?>