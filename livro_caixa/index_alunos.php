<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title id='titulo'>Livro caixa <?php echo $lc_titulo?></title>
<meta name="LANGUAGE" content="Portuguese" />
<meta name="AUDIENCE" content="all" />
<meta name="RATING" content="GENERAL" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts.js"></script>
</head>
<body style="padding:10px">


<table cellpadding="1" cellspacing="10"  width="900" align="center" style="background-color:#033">

<tr>
<td colspan="11" style="background-color:#005B5B;">
<h2 style="color:#FFF; margin:5px">Livro Caixa - <?php echo $lc_titulo?></h2>
</td>
<td colspan="2" align="right" style="background-color:#005B5B;">
<a style="color:#FFF" href="?mes=<?php echo date('m')?>&ano=<?php echo date('Y')?>">Hoje:<strong> <?php echo date('d')?> de <?php echo mostraMes(date('m'))?> de <?php echo date('Y')?></strong></a>&nbsp; 
</td>
</tr>
<tr>

<td width="70">
<select onchange="location.replace('?mes=<?php echo $mes_hoje?>&ano='+this.value)">
<?php
for ($i=2008;$i<=2020;$i++){
?>
<option value="<?php echo $i?>" <?php if ($i==$ano_hoje) echo "selected=selected"?> ><?php echo $i?></option>
<?php }?>
</select>
</td>


<?php
for ($i=1;$i<=12;$i++){
	?>
    <td align="center" style="<?php if ($i!=12) echo "border-right:1px solid #FFF;"?> padding-right:5px">
    <a href="?mes=<?php echo $i?>&ano=<?php echo $ano_hoje?>" style="
    <?php if($mes_hoje==$i){?>    
    color:#033; font-size:16px; font-weight:bold; background-color:#FFF; padding:5px
    <?php }else{?>
    color:#FFF; font-size:16px;
    <?php }?>
    ">
    <?php echo mostraMes($i);?>
    </a>
    </td>
<?php
}
?>
</tr>
</table>
<br />



<table cellpadding="10" cellspacing="0" width="900" align="center" >
<tr>
<td colspan="2">

<h2><?php echo mostraMes($mes_hoje)?>/<?php echo $ano_hoje?></h2>
</td>
<td align="right">
<a href="javascript:;" onclick="abreFecha('add_cat')" class="bnt">[+] Adicionar Categoria</a>
<a href="javascript:;" onclick="abreFecha('add_movimento')" class="bnt"><strong>[+] Adicionar Movimento</strong></a>
</td>
</tr>

<tr >
<td colspan="3" >

    <?php
if (isset($_GET['cat_err']) && $_GET['cat_err']==1){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Esta categoria não pode ser removida, pois há movimentos associados a esta</strong>
</div>

<?php }?>

    <?php
if (isset($_GET['cat_ok']) && $_GET['cat_ok']==2){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Categoria removida com sucesso!</strong>
</div>

<?php }?>
    
<?php
if (isset($_GET['cat_ok']) && $_GET['cat_ok']==1){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Categoria Cadastrada com sucesso!</strong>
</div>

<?php }?>
    
    <?php
if (isset($_GET['cat_ok']) && $_GET['cat_ok']==3){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Categoria alterada com sucesso!</strong>
</div>

<?php }?>

<?php
if (isset($_GET['ok']) && $_GET['ok']==1){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Movimento Cadastrado com sucesso!</strong>
</div>

<?php }?>

<?php
if (isset($_GET['ok']) && $_GET['ok']==2){
?>

<div style="padding:5px; background-color:#900; text-align:center; color:#FFF">
<strong>Movimento removido com sucesso!</strong>
</div>

<?php }?>
    
    <?php
if (isset($_GET['ok']) && $_GET['ok']==3){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Movimento alterado com sucesso!</strong>
</div>

<?php }?>

<div style=" background-color:#F1F1F1; padding:10px; border:1px solid #999; margin:5px; display:none" id="add_cat">
    <h3>Adicionar Categoria</h3>
    <table width="100%">
        <tr>
            <td valign="top">
    

<form method="post" action="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>">
<input type="hidden" name="acao" value="2" />

Nome: <input type="text" name="nome" size="20" maxlength="50" />

<br />
<br />

<input type="submit" class="input" value="Enviar" />
</form>

            </td>
            <td valign="top" align="right">
                <b>Editar/Remover Categorias:</b><br/><br/>
<?php
$qr=mysql_query("SELECT id, nome FROM lc_cat");
while ($row=mysql_fetch_array($qr)){
?>
                <div id="editar2_cat_<?php echo $row['id']?>">
<?php echo $row['nome']?>  
                    
                     <a style="font-size:10px; color:#666" onclick="return confirm('Tem certeza que deseja remover esta categoria?\nAtenção: Apenas categorias sem movimentos associados poderão ser removidas.')" href="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>&acao=apagar_cat&id=<?php echo $row['id']?>" title="Remover">[remover]</a>
                     <a href="javascript:;" style="font-size:10px; color:#666" onclick="document.getElementById('editar_cat_<?php echo $row['id']?>').style.display=''; document.getElementById('editar2_cat_<?php echo $row['id']?>').style.display='none'" title="Editar">[editar]</a>
                    
                </div>
                <div style="display:none" id="editar_cat_<?php echo $row['id']?>">
                    
<form method="post" action="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>">
<input type="hidden" name="acao" value="editar_cat" />
<input type="hidden" name="id" value="<?php echo $row['id']?>" />
<input type="text" name="nome" value="<?php echo $row['nome']?>" size="20" maxlength="50" />
<input type="submit" class="input" value="Alterar" />
</form> 
                </div>

<?php }?>

            </td>
        </tr>
    </table>
</div>

<div style=" background-color:#F1F1F1; padding:10px; border:1px solid #999; margin:5px; display:none" id="add_movimento">
<h3>Adicionar Movimento</h3>
<?php
$qr=mysql_query("SELECT * FROM lc_cat");
if (mysql_num_rows($qr)==0)
	echo "Adicione ao menos uma categoria";

else{
?>
<form method="post" action="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>">
<input type="hidden" name="acao" value="1" />
<strong>Data:</strong><br />
<input type="text" name="data" size="11" maxlength="10" value="<?php echo date('d')?>/<?php echo $mes_hoje?>/<?php echo $ano_hoje?>" />

<br />
<br />

<strong>Tipo:<br /></strong>
<label for="tipo_receita" style="color:#030"><input type="radio" name="tipo" value="1" id="tipo_receita" /> Receita</label>&nbsp; 
<label for="tipo_despesa" style="color:#C00"><input type="radio" name="tipo" value="0" id="tipo_despesa" /> Despesa</label>

<br />
<br />

<strong>Categoria:</strong><br />
<select name="cat">
<?php
while ($row=mysql_fetch_array($qr)){
?>
<option value="<?php echo $row['id']?>"><?php echo $row['nome']?></option>
<?php }?>
</select>

<br />
<br />

<strong>Descrição:</strong><br />
<input type="text" name="descricao" size="100" maxlength="255" />

<br />
<br />

<strong>Valor:</strong><br />
R$<input type="text" name="valor" size="8" maxlength="10" />

<br />
<br />

<input type="submit" class="input" value="Enviar" />

</form>
<?php }?>
</div>
</td>
</tr>

<tr>
<td align="left" valign="top" width="450" style="background-color:#D3FFE2">

<?php
$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=1 && mes='$mes_hoje' && ano='$ano_hoje'");
$row=mysql_fetch_array($qr);
$entradas=$row['total'];

$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=0 && mes='$mes_hoje' && ano='$ano_hoje'");
$row=mysql_fetch_array($qr);
$saidas=$row['total'];

$resultado_mes=$entradas-$saidas;
?>
<fieldset>
        <legend><strong>Entradas e Saídas deste mês</strong></legend>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td><span style="font-size:18px; color:#030">Entradas:</span></td>
                <td align="right"><span style="font-size:18px; color:#030"><?php echo formata_dinheiro($entradas) ?></span></td>
            </tr>
            <tr>
                <td><span style="font-size:18px; color:#C00">Saídas:</span></td>
                <td align="right"><span style="font-size:18px; color:#C00"><?php echo formata_dinheiro($saidas) ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr size="1" />
                </td>
            </tr>
            <tr>
                <td><strong style="font-size:22px; color:<?php if ($resultado_mes < 0) echo "#C00"; else echo "#030" ?>">Resultado:</strong></td>
                <td align="right"><strong style="font-size:22px; color:<?php if ($resultado_mes < 0) echo "#C00"; else echo "#030" ?>"><?php echo formata_dinheiro($resultado_mes) ?></strong></td>
            </tr>
        </table>
    </fieldset>

</td>

<td width="15">
</td>

<td align="left" valign="top" width="450" style="background-color:#F1F1F1">
<fieldset>
<legend>Balanço Geral</legend>
<?php

$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=1 ");
$row=mysql_fetch_array($qr);
$entradas=$row['total'];

$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=0 ");
$row=mysql_fetch_array($qr);
$saidas=$row['total'];

$resultado_geral=$entradas-$saidas;
?>


<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><span style="font-size:18px; color:#030">Entradas:</span></td>
<td align="right"><span style="font-size:18px; color:#030"><?php echo formata_dinheiro($entradas)?></span></td>
</tr>
<tr>
<td><span style="font-size:18px; color:#C00">Saídas:</span></td>
<td align="right"><span style="font-size:18px; color:#C00"><?php echo formata_dinheiro($saidas)?></span></td>
</tr>
<tr>
<td colspan="2">
<hr size="1" />
</td>
</tr>
<tr>
<td><strong style="font-size:22px; color:<?php if ($resultado_geral<0) echo "#C00"; else echo "#030"?>">Resultado:</strong></td>
<td align="right"><strong style="font-size:22px; color:<?php if ($resultado_geral<0) echo "#C00"; else echo "#030"?>"><?php echo formata_dinheiro($resultado_geral)?></strong></td>
</tr>
</table>

</fieldset>
</td>

</tr>
</table>
<br />


<table cellpadding="5" cellspacing="0" width="900" align="center">
<tr>
<td colspan="2">
    <div style="float:right; text-align:right">
<form name="form_filtro_cat" method="get" action=""  >
<input type="hidden" name="mes" value="<?php echo $mes_hoje?>" >
<input type="hidden" name="ano" value="<?php echo $ano_hoje?>" >
    Filtrar por categoria:  <select name="filtro_cat" onchange="form_filtro_cat.submit()">
<option value="">Tudo</option>