<?php
class TemplateViewSingleWindow extends TWindow
{
    public function __construct()
    {
        parent::__construct();
        parent::setTitle('Título da janela');
        parent::setSize(0.5,null); // 50% da janela e altura dinamica
        parent::removePadding();
        
        $html =  new THtmlRenderer('app/resources/page_window.html');
        
        $replaces = [];
        $replaces['title'] = 'Título';
        $replaces['body'] = 'Conteúdo';
        $replaces['footer'] = 'Rodapé';
        
        $html->enableSection('main',$replaces);
        
        parent::add($html);
        
    }
}