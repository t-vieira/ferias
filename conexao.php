<?php
// Este arquivo conecta um banco de dados MySQL - Servidor = localhost
$dbname="db_ferias"; // Indique o nome do banco de dados que serﻓ aberto
$usuario="root"; // Indique o nome do usuﻓrio que tem acesso
$password=""; // Indique a senha do usuﻓrio
//1ﻑ passo - Conecta ao servidor MySQL
if(!($id = mysql_connect("localhost",$usuario,$password))) {
   echo "Nﻛo foi possﻎvel estabelecer uma conexﻛo com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
}
//2ﻑ passo - Seleciona o Banco de Dados
if(!($con=mysql_select_db($dbname,$id))) {
   echo "Nﻛo foi possﻎvel estabelecer uma conexﻛo com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
}

function mysqlexecuta($id,$sql,$erro = 1) {
    if(empty($sql) OR !($id))
       return 0; //Erro na conexﻛo ou no comando SQL
   if (!($res = @mysql_query($sql,$id))) {
      if($erro)
        echo "Ocorreu um erro na execuﻫﻛo do Comando SQL no banco de dados. Favor Contactar o Administrador.";
      exit;
   }
    return $res;
 }
?>