<?php
include "menu.php";
include "conexao.php";

$mes = $_POST['dt_inicial'];

if (isset($mes)) {

	$dataRelatorio = explode("/", $mes);

	$data1 = $dataRelatorio[1] . "-" . $dataRelatorio[0] . "-" . "01";
	$data2 = $dataRelatorio[1] . "-" . $dataRelatorio[0] . "-" . "31";

	$rsRelatorio = mysql_query("SELECT * FROM tab_ferias WHERE dt_inicio_ferias BETWEEN '$data1' AND '$data2' ORDER BY dt_inicio_ferias");

}

?>

<div id="conteudo">

	<legend>Relat&oacute;rio de F&eacute;rias do M&ecirc;s <?php echo $mes; ?></legend><br/><br/>

	<table cellpadding=0 cellspacing=0 border=0 width=100%>
		<tr>
			<th>DRT</th>
			<th>Nome</th>
			<th>Fun&ccedil;&atilde;o</th>
			<th>Dias</th>
			<th>Per&iacute;odo</th>
			<th>Cidade</th>
			<th>Posto</th>
		</tr>
		<?php

		while ($relatorio = mysql_fetch_object($rsRelatorio)) {

			$id_colaborador = $relatorio->num_id_colaborador;

			$rsConsultaFerias = mysql_query("SELECT * FROM tab_colaborador WHERE id_colaborador = $id_colaborador");
			$consultaFerias = mysql_fetch_object($rsConsultaFerias);

		?>
		<tr>
			<td align="center" style="padding: 2px;"><?php echo $consultaFerias->num_drt; ?></td>
			<td><?php echo $consultaFerias->nome_colaborador; ?></td>
			<td align="center"><?php echo $consultaFerias->funcao; ?></td>
			<td align="center"><?php echo $relatorio->num_dias; ?></td>
			<td align="center"><?php echo DataBr($relatorio->dt_inicio_ferias) . " &agrave; " . DataBr($relatorio->dt_fim_ferias); ?></td>
			<td align="center">
				<?php
				$numero_cidade = $consultaFerias->num_id_cidade;
				$rsCidade = mysql_query("SELECT * FROM tab_cidade WHERE id_cidade = $numero_cidade");
				$cidade = mysql_fetch_object($rsCidade);
				echo $cidade->nome_cidade;
				?>
			</td>
			<td align="center">
				<?php
				$numero_posto = $consultaFerias->num_id_posto;
				$rsPosto = mysql_query("SELECT * FROM tab_posto WHERE id_posto = $numero_posto");
				$posto = mysql_fetch_object($rsPosto);
				echo $posto->nome_posto;
				?>
			</td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td colspan=6 align=center>
				<a href="ferias.php">Voltar</a>
			</td>		
		</tr>
	</table>

</div>

<?php include "footer.php"; ?>