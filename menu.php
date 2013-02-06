<?php
Function SomarData($data, $dias, $meses, $ano) {

    $data = explode("/", $data);
    $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano) );
    return $newData;
}

Function DataEn ($data) {

    $data = substr($data, 6,4) . "-" . substr($data, 3,2) . "-" . substr($data, 0,2);
    return $data;
}

Function DataBr ($data) {

    $data = substr($data,8,2) . "/" . substr($data,5,2) . "/" . substr($data,0,4);
    return $data;
}

$fundo1 = "#F5F5F5"; //primeira cor de fundo da tabela
$fundo2 = "#F9F9F9"; //segunda cor de fundo da tabela
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Controle de F&eacute;rias</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="style.css" />

    <style type="text/css" title="currentStyle">
        @import "inc/media/css/demo_page.css";
        @import "inc/media/css/demo_table_jui.css";
        @import "inc/media/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
    </style>

    <script type="text/javascript" language="javascript" src="inc/media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="inc/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="inc/media/js/jquery.maskedinput-1.3.js"></script>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            oTable = $('#tabelaferias').dataTable({
                "bJQueryUI": true,
                "iDisplayLength": 200,
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "sProcessing":   "A processar...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "N&atilde;o foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 at&eacute; 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Procurar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "&uacute;ltimo"
                    }
}
            });
        } );
    </script>

    <script language="JavaScript">
        function DataHora (evento, objeto){
            var keypress=(window.event)?event.keyCode:evento.which;
            campo = eval (objeto);
            if (campo.value == '00/00/0000')
            {
                campo.value=""
            }

            caracteres = '0123456789';
            separacao1 = '/';
            separacao2 = ' ';
            separacao3 = ':';
            conjunto1 = 2;
            conjunto2 = 5;
            conjunto3 = 10;
            conjunto4 = 13;
            conjunto5 = 16;
            if ((caracteres.search(String.fromCharCode (keypress)) != -1) && campo.value.length < (19))
            {
                if (campo.value.length == conjunto1)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto2)
                    campo.value = campo.value + separacao1;
            }
            else
                event.returnValue = false;
        }

</script>
  <body>
      <div id="container">

          <div id="menu">
            <?php
            if ($_SERVER['SCRIPT_NAME'] != "/ferias/imp-rel-ferias.php") {
            ?>
            <a href="ferias.php">In&iacute;cio</a>
            <a href="rel-ferias.php">Relat&oacute;rio de F&eacute;rias</a>
            <a href="cad-colaborador.php">Cadastrar Colaborador</a>
            <?php } ?>
            <!--<h4 class="cadastro">Cadastros</h4>
            <a href="cad_cidade.php">Cidade</a><br>
            <a href="cad_posto.php">Postos</a><br>
            <a href="cad_colaborador.php">Colaborador</a>

            <h4 class="controle">Controles</h4>
            <a href="ferias.php">Lista Geral de F&eacute;rias</a><br>
            <a href="rec_marcadas.php">Reciclagens Marcadas</a><br>
			<a href="certificados.php">Entrega de Certificados</a>

            <h4 class="relatorio">Relat&oacute;rios</h4>
            <a href="rel_reciclagens.php">Reciclagens Marcadas</a><br>
			<a href="rel_reciclagens_ano.php">Reciclagens Anual</a>

            <h4 class="editar">Editar / Excluir</h4>
            <a href="edit_cidade.php">Cidade</a><br>
            <a href="edit_posto.php">Postos</a><br>
            <a href="edit_colaborador.php">Colaborador</a>

            <h4 class="inativo">Inativos</h4>
            <a href="inat_colaborador.php">Colaboradores</a>-->
        </div>