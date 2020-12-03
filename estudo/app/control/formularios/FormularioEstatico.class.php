<?php
class FormularioEstatico extends TPage
{
    public function __construct()
    {
        parent::__construct();
            
         
         $this->form = new BootstrapFormBuilder; // Chama a funcionalidade do bootstrapbuilder que faz forms dinâmicos e responsivos
         $this->form->setFormTitle('Formulário Bootstrap'); // Adiciona título
         
         $id = new TEntry('id');
         $descricao =  new TEntry('descricao');
         $senha = new TPassword('senha'); // Camuflador de campo senha
         
         $this->form->appendPage('Aba 1'); // Criação da primeira aba
         
         $this->form->addFields([new TLabel('ID')],[$id]);
         $this->form->addFields([new TLabel('Descrição')],[$descricao]);
         $this->form->addFields([new TLabel('Senha')],[$senha]);
         
         $this->form->addAction('Enviar', new TAction([$this,'onSend']),'fa:save');
         
         parent::add($this->form);
    }
    
     public static function onSend($param)
     {
         
         new TMessage('info', json_encode($param));
     }
}
