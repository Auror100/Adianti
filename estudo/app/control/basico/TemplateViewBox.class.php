<?php
class TemplateViewBox extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $notebook1 = new TNotebook;
        $notebook2 = new TNotebook;
        
        $notebook1->appendPage('Page1', new TLabel('Page 1'));
        $notebook1->appendPage('Page2', new TLabel('Page 2'));
        
        $notebook2->appendPage('Page1', new TLabel('Page 1'));
        $notebook2->appendPage('Page2', new TLabel('Page 2'));
        
        $vbox = new TVBox; // Criador de caixas empilhadas
        $vbox->style = 'width:100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml',__CLASS__));
        $vbox->add($notebook1);
        $vbox->add($notebook2);
        
        parent::add($vbox);
        
    }
}
