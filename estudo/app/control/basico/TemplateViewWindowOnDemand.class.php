<?php
class TemplateViewWindowOnDemand extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $window = TWindow::create('Título',0.8,null);
        
        $html = new THtmlRenderer('app/resources/window_demand.html');
        
        $replaces = [];
        $replaces['title'] = 'Título';
        $replaces['body'] =  'Conteúdo';
        $replaces['footer'] = 'Rodapé';
        
        $html->enableSection('main',$replaces);
        
        $window->add($html);
        $window->show();
    }
}
