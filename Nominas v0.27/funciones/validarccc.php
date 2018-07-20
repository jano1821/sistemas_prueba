<?php

function ccc_valido($ofi,$ccc)
{
	$APesos = Array(1,2,4,8,5,10,9,7,3,6); // Array de "pesos"
	$DC1=0;
	$DC2=0;
	$x=8;
	while($x>0) {
		$digito=$ofi[$x-1];
		$DC1=$DC1+($APesos[$x+2-1]*($digito));
		$x = $x - 1;
	}
	$Resto = $DC1%11;
	$DC1=11-$Resto;
	if ($DC1==10) $DC1=1;
	if ($DC1==11) $DC1=0;              // Dígito control Entidad-Oficina

	$x=10;
	while($x>0) {
		$digito=$ccc[$x-1];
		$DC2=$DC2+($APesos[$x-1]*($digito));
		$x = $x - 1;
	}
	$Resto = $DC2%11;
	$DC2=11-$Resto;
	if ($DC2==10) $DC1=1;
	if ($DC2==11) $DC1=0;         // Dígito Control C/C

	$DigControl=($DC1)."".($DC2);   // los 2 números del D.C.
	return $DigControl;
}
?>