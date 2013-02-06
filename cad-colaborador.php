<?php
include "menu.php";
include "conexao.php";
include "inc/rb.php";

$cadastrar = $_POST['cadastrar'];
$editar = $_GET['editar'];
$editarCol = $_POST['editarCol'];

if (isset($cadastrar)) {

    //R::setup('mysql:host=localhost;dbname=db_ferias','root', '');

    //$cadFerias = R::dispense('tab_colaborador');
    //$cadFerias->formartBeanID('id_colaborador');

    //$cadFerias->num_drt = $_POST['drt'];
    //$cadFerias->nome_colaborador = $nome = $_POST['nome'];
    //$cadFerias->num_id_cidade = $cidade = $_POST['cidade'];
    //$cadFerias->num_id_posto = $posto = $_POST['posto'];
    //$cadFerias->dt_admissao = DataEn($_POST['dataAdm']);
    //$cadFerias->dt_ultferias_inicio = DataEn($_POST['dtInicioFerias']);
    //$cadFerias->dt_ultferias_fim = $dtFimferias = DataEn($_POST['dtFimFerias']);
    //$cadFerias->funcao = $funcao = $_POST['funcao'];

    //$id_colaborador = R::store($cadFerias);

	$drt = $_POST['drt'];
	$nome = $_POST['nome'];
	$dataAdm = DataEn($_POST['dataAdm']);
	$cidade = $_POST['cidade'];
	$posto = $_POST['posto'];
	$dtInicioFerias = DataEn($_POST['dtInicioFerias']);
	$dtFimferias = DataEn($_POST['dtFimFerias']);
	$funcao = $_POST['funcao'];
	
	$verif_colab = "SELECT nome_colaborador FROM tab_colaborador WHERE nome_colaborador = '$nome'";
    $exec_verif_colab = mysql_query($verif_colab);

    if (mysql_num_rows($exec_verif_colab) > 0) {

      $cad_colab = "erro";

    }
    else {

		mysql_query("INSERT INTO tab_colaborador (num_drt, nome_colaborador, num_id_cidade, num_id_posto, dt_admissao, dt_ultferias_inicio, dt_ultferias_fim, funcao) VALUES ('$drt', '$nome', '$cidade', '$posto', '$dataAdm', '$dtInicioFerias', '$dtFimferias', '$funcao')");
	
	}

}

if (isset($editar)) {

    $rsEditar = mysql_query("SELECT * FROM tab_colaborador WHERE id_colaborador = $editar");
    $editar = mysql_fetch_object($rsEditar);

}

if (isset($editarCol)) {
    $drt = $_POST['drt'];
    $nome = $_POST['nome'];
    $dataAdm = DataEn($_POST['dataAdm']);
    $cidade = $_POST['cidade'];
    $posto = $_POST['posto'];
    $dtInicioFerias = DataEn($_POST['dtInicioFerias']);
    $dtFimferias = DataEn($_POST['dtFimFerias']);
    $funcao = $_POST['funcao'];

    mysql_query("UPDATE tab_colaborador SET num_drt = '$drt', nome_colaborador = '$nome', num_id_cidade = '$cidade', num_id_posto = '$posto', dt_admissao = '$dataAdm', dt_ultferias_inicio = '$dtInicioFerias', dt_ultferias_fim = '$dtFimferias', funcao = '$funcao' WHERE id_colaborador = $editarCol");

    header("Location: ferias.php");
}

?>

<script>

jQuery(function($) {

	$("#dataAdm").mask("99/99/9999");
	$("#dtInicioFerias").mask("99/99/9999");
	$("#dtFimFerias").mask("99/99/9999");

});

</script>

<div id="centro">

	<p>Cadastrar Colaborador</p><br /><br />

	<form action="cad-colaborador.php" method="post">
		<label>DRT:</label>
		<input type="text" name="drt" size="7" autofocus value="<?php echo $editar->num_drt; ?>" /><br />

		<label>Nome:</label>
		<input type="text" name="nome" onkeyup="this.value = this.value.toUpperCase();" size="50" value="<?php echo $editar->nome_colaborador; ?>" /><br/>

		<label>Data Admiss&atilde;o:</label>
		<input type="text" name="dataAdm" id="dataAdm" size="10" value="<?php echo DataBr($editar->dt_admissao); ?>" /><br/>

		<label>Cidade:</label>
		<select name="cidade">
			<option value="">Selecione uma Cidade</option>
			<?php
            $buscar_cidade = "SELECT * FROM tab_cidade ORDER BY nome_cidade ASC";
            $ex_buscar_cidade = mysql_query($buscar_cidade);
            while ($buscar_cidade = mysql_fetch_array($ex_buscar_cidade)){
            ?>
            <option value="<?php echo $buscar_cidade['id_cidade']; ?>" <?php if ($buscar_cidade['id_cidade'] == $editar->num_id_cidade) { echo "selected"; } ?>><?php echo $buscar_cidade['nome_cidade']; ?></option>
            <?php
            }
            ?>
        </select><br/>

        <label>Posto:</label>
        <select name="posto">
			<option value="">Selecione uma Posto</option>
			<?php
            $buscar_posto = "SELECT * FROM tab_posto ORDER BY nome_posto ASC";
            $ex_buscar_posto = mysql_query($buscar_posto);
            while ($buscar_posto = mysql_fetch_array($ex_buscar_posto)){
            ?>
            <option value="<?php echo $buscar_posto['id_posto']; ?>" <?php if ($buscar_posto['id_posto'] == $editar->num_id_posto) { echo "selected"; } ?>><?php echo $buscar_posto['nome_posto']; ?></option>
            <?php
            }
            ?>
        </select><br/>

        <label>&Uacute;ltima F&eacute;rias:</label>
        <input type="text" name="dtInicioFerias" id="dtInicioFerias" size="10" value="<?php echo DataBr($editar->dt_ultferias_inicio); ?>" /> a <input type="text" name="dtFimFerias" id="dtFimFerias" size="10" value="<?php echo DataBr($editar->dt_ultferias_fim); ?>" /><br/>

        <label>Fun&ccedil;&atilde;o:</label>
        <select name="funcao">
        	<option value="">Escolha uma Fun&ccedil;&atilde;o</option>
        	<option value="VIGILANTE" <?php if ($editar->funcao == "VIGILANTE") { echo "selected"; } ?>>VIGILANTE</option>
        	<option value="PORTEIRO" <?php if ($editar->funcao == "PORTEIRO") { echo "selected"; } ?>>PORTEIRO</option>
        	<option value="AUX. LIMPEZA" <?php if ($editar->funcao == "AUX. LIMPEZA") { echo "selected"; } ?>>AUX. LIMPEZA</option>
        </select><br/><br/>

        <?php
        if (isset($editar)) {
            echo "<input type='hidden' name='editarCol' value='" . $editar->id_colaborador . "' />";
        } else {
            echo "<input type='hidden' name='cadastrar' value='1' />";
        }
        ?>
        <input type="submit" value="Cadastrar" />

	</form>
	
	<?php
	if ($cad_colab == "erro") {
	?>
	<div id="aviso_erro">
		Colaborador já esta Cadastrado. Cadastre Outro!
	</div>
	<?php
	}
	?>

</div>

<?php include "footer.php"; ?>