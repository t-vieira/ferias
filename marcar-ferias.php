<?php
include "menu.php";
include "conexao.php";

$id = $_GET['id'];

$rsMarcarFerias = mysql_query("SELECT * FROM tab_colaborador WHERE id_colaborador = $id");
$marcarFerias = mysql_fetch_object($rsMarcarFerias);

$marcar = $_POST['marcar'];

if ($marcar == 1) {

	$dt_inicial = $_POST['dt_inicial'];
	$dias = $_POST['dias'];
	$dt_fim = SomarData($dt_inicial, $dias - 1, 0, 0);

	$dt_inicial_en = DataEn($dt_inicial);
	$dt_fim_en = DataEn($dt_fim);

	$inserir_ferias = "INSERT INTO tab_ferias (num_id_colaborador, num_dias, dt_inicio_ferias, dt_fim_ferias) VALUES ('$marcarFerias->id_colaborador', '$dias', '$dt_inicial_en', '$dt_fim_en')";

	mysql_query($inserir_ferias) OR DIE ("Não foi possivel cadastrar");

	header("Location: ferias.php");

}

?>
<script>
jQuery(function($) {

	$("#dt_inicial").mask("99/99/9999");

});
</script>
<div id="centro">
	<p>Marcar f&eacute;rias de <b><?php echo $marcarFerias->nome_colaborador; ?></b>.<br /><br />

	<form action="marcar-ferias.php?id=<?php echo $marcarFerias->id_colaborador; ?>" method="post">
		<label>Data Inicial:</label>
		<input type="text" name="dt_inicial" id="dt_inicial" size="10" onKeyPress="DataHora(event, this)" /><br />
		<label>Total de Dias:</label>
		<input type="text" name="dias" size="2" /><br /><br />
		<input type="hidden" name="marcar" value="1" />
		<input type="submit" value="Marcar F&eacute;rias" />
	</form>
</div>

<?php include "footer.php"; ?>