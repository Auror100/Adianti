<?php
class TemplateViewCortinaLateral extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        parent::setTargetContainer('adianti_right_panel'); // Já existe na página mas está escondido por css
        
        $html = new THtmlRenderer('app/resources/cortina.html');
        
        $replaces = [];
        $replaces['title'] = 'Título';
        $replaces['body'] = 'Corpo';
        $replaces['footer'] = 'Rodapé';
        
        $html->enableSection('main',$replaces);
        
        parent::add($html);
    }
    
    public static function onClose() // Função static pois queremos carregar apenas ela e não toda a página
    {
        TScript::create('Template.closeRightPanel()'); // Para rodar scripts
         
    }
}
