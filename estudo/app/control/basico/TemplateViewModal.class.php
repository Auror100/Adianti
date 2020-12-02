<?php
class TemplateViewModal extends TWindow
{
    public function __construct()
    {
        parent::__construct();
        
        parent::setSize(0.6,null);
        parent::removePadding();
        parent::removeTitleBar(); // Remove a barra de título padrão
        parent::disableEscape(); // Retira o fechar padrão
        
        $html= new THtmlRenderer('app/resources/modal.html');
        
        $replaces = [];
        $replaces['title'] = 'Título';
        $replaces['body'] = 'Conteúdo';
        $replaces['footer'] = 'Rodapé';
        
        $html->enableSection('main',$replaces);
        
        parent::add($html);
    }
}
