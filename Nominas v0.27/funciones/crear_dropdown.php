<?php

function crear_dropdown( $name, array $options, $selected=null )
{
	//utilizar una variable para guardar el codigo html del dropdown
    $dropdown = '<select name="'.$name.'" id="'.$name.'">'."\n";
    //guardar en una variable el numero (id) del valor que debe ser seleccionado en el dropdown
    $selected = $selected;
    //por cada elemento recibido del array crear un linea html de option para el dripdown
    foreach( $options as $key=>$option )
    {
    	  // comparar el elemento (key) con el número del valor seleccionado,
    	  //si el valor seleccionado no es nulo, guardar la palabra selected en la variable select
        $select = $selected==$key ? ' selected' : null;
        //insertar en la pagina html el codigo creado:
        // <option value="1" selected> nombre_de_la_opcion guardada en el array </option>
        $dropdown .= '<option value="'.$key.'"'.$select.'>'.$option.'</option>'."\n";
    }
    // fin del codigo html para el select dropdown
    $dropdown .= '</select>'."\n";
    //fin de la función, devuelvo la variable dropdow, para evitar un warning de php
    return $dropdown;
    
}
?>