<?php
class EditorHtml extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Html editor');
        
        $html = new THtmlEditor('conteudo_html'); // Inicia um editor de html
        $html->setSize('100%',200);
        $html->setOption('placeholder', 'Digite aqui ...');
        
        $this->form->addFields([$html]); // Coloca o editor no form
        
        $this->form->addAction('Enviar', new TAction([$this,'onSend']),'far:check-circle green');
        
        parent::add($this->form);
    }
    
    public function onSend($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);
        
        new TMessage('info',$data->conteudo_html);
    }
}
