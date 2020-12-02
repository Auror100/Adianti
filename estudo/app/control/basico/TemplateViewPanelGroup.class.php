<?php
class TemplateViewPanelGroup extends TPage
{
    public function __construct()
    {
        parent::__construct();
    
        $panel = new TPanelGroup('Título do panel'); // Objeto painel
        
        $table = new TTable;
        $table->border = 1;
        $table->style = 'border-collapse:collapse';
        $table->width = '100%';
        $table->addRowSet('A1','A2');
        $table->addRowSet('B1','B2');
        
        $panel->add($table); // Adicionando um objeto dentro do outro
        $panel->addFooter('rodapé');
        
        parent::add($panel);
    }
}
