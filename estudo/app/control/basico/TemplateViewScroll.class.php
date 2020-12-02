<?php
class TemplateViewScroll extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $scroll = new TScroll; // Objeto de rolagem
        $scroll->setSize('100%','300');
        
        $table = new TTable;
        $scroll->add($table); //Adicionando objeto dentro de objeto
        
        for($n=1; $n<=20;$n++)
        {
            $object = new TEntry('field' . $n);
            $table->addRowSet('Field' . $n, $object);
        }
        
        parent::add($scroll);
    }
}
