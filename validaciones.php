<?php

function codigo_producto($var)
{
    return preg_match('/^PROD[0-9]{4}$/',$var);
    //EJEMPLO PROD0001
}



?>