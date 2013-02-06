<?php
include "menu.php";
include "conexao.php";

$deletarFerias = $_GET['deletarFerias'];
if ($deletarFerias != "") {

	mysql_query("DELETE FROM tab_ferias WHERE num_id_colaborador = '$deletarFerias'");

}

$deletar = $_GET['deletar'];
if ($deletar != "") {

	mysql_query("DELETE FROM tab_colaborador WHERE id_colaborador = '$deletar'");
	
	$verificar_ferias = mysql_query("SELECT * FROM tab_ferias WHERE num_id_colaborador = '$deletar'");
	
	if (mysql_num_rows($verificar_ferias)) {
	
		mysql_query("DELETE FROM tab_ferias WHERE num_id_colaborador = '$deletar'");
	
	}

}
?>

<div id="conteudo">
	<br /><br />
	<legend>Lista Geral de F&eacute;rias</legend>

	<br />

	<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabelaferias">
		<thead>
			<tr>
				<th>DRT</th>
				<th>Nome</th>
				<th>Admiss&atilde;o</th>
				<th>&Uacute;lt. F&eacute;rias</th>
				<th>Cidade</th>
				<th>F&eacute;rias</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$rsFerias = mysql_query("SELECT * FROM tab_colaborador ORDER BY dt_ultferias_fim DESC");

			while ($ferias = mysql_fetch_object($rsFerias)) {
				$rsCidade = mysql_query("SELECT * FROM tab_cidade WHERE id_cidade = $ferias->num_id_cidade");
				$cidade = mysql_fetch_object($rsCidade);



			?>
			<tr>
				<td align="center"><?php echo $ferias->num_drt; ?></td>
				<td><a href="ferias.php?deletar=<?php echo $ferias->id_colaborador; ?>"><img src="img/ico_small_inativo.png" align="absmiddle" width="8" height="8"></a>&nbsp;<?php echo "<a href='cad-colaborador.php?editar=" . $ferias->id_colaborador . "'>" . $ferias->nome_colaborador . "</a>" ?></td>
				<td align="center"><?php echo DataBr($ferias->dt_admissao); ?></td>
				<td align="center"><?php if (DataBr($ferias->dt_ultferias_inicio) == "00/00/0000") { echo "--------"; } else { echo DataBr($ferias->dt_ultferias_inicio) . " &agrave; " . DataBr($ferias->dt_ultferias_fim); } ?></td>
				<td align="center"><?php echo $cidade->nome_cidade; ?></td>				
				<td align="center">
					<?php
					$rsFeriasMarcada = mysql_query("SELECT * FROM tab_ferias WHERE num_id_colaborador = $ferias->id_colaborador");
					$feriasMarcada = mysql_fetch_object($rsFeriasMarcada);
					if ($feriasMarcada->num_id_colaborador == 0) {
					?>
					<a href="marcar-ferias.php?id=<?php echo $ferias->id_colaborador; ?>">Marcar</a>
					<?php
					} else {
						
						$dataFeriasMarcada = strtotime($feriasMarcada->dt_fim_ferias);
						$dataAtual = strtotime(date('Y-m-d'));
						
						if ($dataFeriasMarcada < $dataAtual) {

							mysql_query("UPDATE tab_colaborador SET dt_ultferias_inicio = '$feriasMarcada->dt_inicio_ferias', dt_ultferias_fim = '$feriasMarcada->dt_fim_ferias' WHERE id_colaborador = $feriasMarcada->num_id_colaborador");
							mysql_query("DELETE FROM tab_ferias WHERE num_id_colaborador = $ferias->id_colaborador");

						}

						echo DataBr($feriasMarcada->dt_inicio_ferias) . " &agrave; " . DataBr($feriasMarcada->dt_fim_ferias) . " <a href='ferias.php?deletarFerias=" . $ferias->id_colaborador . "'><img src='img/ico_deletar.png' width='9' height='9' /></a>";
					}
					?>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>

</div>

<?php include "footer.php"; ?>