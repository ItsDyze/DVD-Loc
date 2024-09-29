<?php
/**
 * @var ErrorModel $data
 */

use Models\ErrorModel;

?>

<p>
    Le serveur a rencontré une erreur.
</p>
<?php

if( IS_DEV )
{
    echo '<p>' . var_dump($data->exception->getMessage()) .'</p>';
}