<?php
    // INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
    require_once('../../../conexao.php');

    $categoria = @$_POST['txtCat'];
    $sub_categoria = @$_POST['txtSub'];

    echo "<select class='sm-width form-control form-control-sm' name='sub-categoria' id='sub-categoria'>";

      if (@$sub_categoria > 0) {
        $query2 = $pdo->query("SELECT * FROM tb_sub_categorias WHERE id = '$sub_categoria'" );
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $nomeSub = $res2[0]['nome'];
        echo "<option value='".$sub_categoria."' >". $nomeSub ."</option>";
      }
      
      $res = $pdo->query("SELECT * FROM tb_sub_categorias where id_categoria = '$categoria' order by nome asc");
      $dados = $res->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($dados); $i++) { 
        foreach ($dados[$i] as $key => $value) {}

         if(@$nomeSub != $dados[$i]['nome']){
          echo "<option value='" . $dados[$i]['id'] . "'>" . $dados[$i]['nome'] . "</option>";
         }
      }

    echo "</select>";


    




