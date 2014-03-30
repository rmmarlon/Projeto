
<?php require_once("tabs.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Criando abas</title>

<?php tabs_header(); ?>

</head>

<body>

<div style="width:600px;">
<div align="center">

<p>

<?php tabs_start();?>


<?php tab("Aba um");?>
<strong> Este é o texto da primeira aba </strong></p>
</div>

<p align="center"> </p>
<?php tab("Aba dois");?>
<strong> Este é o texto da segunda aba </strong></p>


<p>
<?php tab("Aba tres");?>
<strong> Este é o texto da terceira aba </strong></p>
<img src="eu e grazi.png" width="400" height="500" />
<P>

<p>
<?php tab("Aba Quatro");?>
<strong> </strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <label for="textfield"></label>
      <input type="text" name="textfield" id="textfield" />
    nome
    </form></td>
  </tr>
  <tr>
    <td><form id="form2" name="form2" method="post" action="">
      <label for="textarea"></label>
      <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<p><strong> </strong></p>

<P>
<?php tabs_end();?>


</body>
</html>