
<?php

    $tipos = array('numerico' => 'number',
                    'cadena' => 'text',
                    'mail' => 'email');

    $tiposSQL = array('numerico' => 'int',
                      'cadena' => 'varchar',
                    )
?>

<html>

<head>
    <title>Ejercicio XML</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="hero-unit">
            <h1>Ejercicio XML</h1>
            <small>Carlos Suarez - Jefferson Garzon - Jobelo Quintero</small>
        </div>
    </div>
    <div class="container">
    <?php

        $doc = simplexml_load_file('data.xml');
        foreach ($doc as $element) {
            $gestor = fopen('formulario'.$element->getName().'.php', 'w+');
            fwrite($gestor, '<html><head><title>'.$element->getName().'</title><link rel="stylesheet" href="css/bootstrap.css"></head><body>');
            fwrite ($gestor, '<div class="container">') ;
            fwrite ($gestor, '<h3>'.strtoupper($element->getName()).'</h3>');
            fwrite ($gestor, '<form>') ;
            foreach ($element as $field) {
                fwrite ($gestor,'<div class="control-group"> <label for="'.$field->getName().'" class="control-label">'.$field->getName().'</label>'); 
                fwrite ($gestor,  '<div class="controls">');
                fwrite ($gestor,  '<input id="'.$field->getName().'" ');

                if ($field->attributes()['validador']) {

                    $t = $field->attributes()['validador'];
                    fwrite ($gestor, 'type="'.$tipos[(string)$t].'"' );
                }
                else if ($field->attributes()['tipo']) {

                    $t = $field->attributes()['tipo'];
                    fwrite ($gestor, 'type="'.$tipos[(string)$t].'"');
                }

                fwrite ($gestor,'>');
                fwrite ($gestor, '</div>');
                fwrite ($gestor, '</div>');
            }
            fwrite ($gestor,'<button type= "submit" class="btn btn-primary">Guardar</button>'); 
            fwrite ($gestor, '<a href="index.php" class="btn pull-right">Regresar</a>');
            fwrite ($gestor,'</form>');
            fwrite($gestor, '</div></body></html>');
            fclose($gestor);
            echo '<a href="formulario'.$element->getName().'.php" class="btn btn-primary">'.$element->getName().'</a>';
        }
    ?>

    <?php
        $gestorSQL = fopen('modelos.sql', 'w+');

        foreach ($doc as $element) {
            fwrite ($gestorSQL,'CREATE TABLE '.$element->getName());
            fwrite ($gestorSQL,'(');
            $counter = 0;
            foreach ($element as $field) {
                fwrite ($gestorSQL,$field->getName());
                $t = $field->attributes()['tipo'];
                fwrite ($gestorSQL,' '.$tiposSQL[(string)$t].' ');
                fwrite ($gestorSQL,'('.$field->attributes()['ext'].')');
                if ($counter != sizeof($element)-1)
                    fwrite ($gestorSQL, ',');
                $counter++;
            }
            fwrite ($gestorSQL,');');
        }
        fclose($gestorSQL);
    ?>
    </div>
</body>
</html>