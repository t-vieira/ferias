<?php
include "menu.php";
include "conexao.php";
?>

<script>
jQuery(function($) {

	$("#dt_inicial").mask("99/9999");

});
</script>

<div id="centro">
	<p>Coloque abaixo o per&iacute;odo que deseja o relat&oacute;rio.<br /><br />

	<form action="imp-rel-ferias.php" method="post">
		<label>M&ecirc;s e Ano:</label>
		<input type="text" name="dt_inicial" id="dt_inicial" size="7" /> Ex.: mm/AAAA<br />
		<input type="hidden" name="relatorio" value="1" />
		<input type="submit" value="Ver Relat&oacute;rio" />
	</form>
</div>

<?php include "footer.php"; ?>