<?php
$clave = base64_encode('Vamos_por_mas_tfc');
echo $clave.'<br>';
$pasword = password_hash('280754',PASSWORD_BCRYPT, array("cost" => 12, "salt" => $clave));
echo $pasword;
echo '<br>';
if (password_verify('123abc$$', '$2y$12$Vm1GdGIzTmZjRzl5WDIxa.HmMIPaibhM6ZZZZfpshkrq8qdg5jRm2')) {
    echo 'La contrasenia es valida!';
} else {
    echo 'La contraseña no es válida.';
}
//print_r(get_loaded_extensions());
?>