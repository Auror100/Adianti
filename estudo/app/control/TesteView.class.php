<?php
class TesteView extends TPage
{
    public function __construct()
    {
         parent::__construct();
         
         echo 'construtor <br>';
    }
    
    public function onEvento()
    {
        echo 'evento <br>';
    }
    
    public static function onEventoEstatico()
    {
        echo 'evento estatico <br>';
    }
    
    public function show()
    {
        parent::show();
        echo 'show <br>'; // Sobrescrevendo  o método show
    }
}


?>