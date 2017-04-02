<?php
$libros = array();
$libros[0] = array('nombre'=>'campo1', 'tipo'=>PDO::PARAM_STR,'direccion'=>PDO::PARAM_INPUT_OUTPUT);
$libros[1] = array('nombre'=>'campo2', 'tipo'=>PDO::PARAM_INT,'direccion'=>PDO::PARAM_INPUT_OUTPUT);
echo $libros[1]['nombre'];
// esto devolver el valor CodeHero, ya que especificamos la fila numero 1 y la columna autor
?>