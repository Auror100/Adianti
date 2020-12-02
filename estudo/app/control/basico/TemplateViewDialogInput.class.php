<?php
class TemplateViewDialogInput extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $form = new BootstrapFormBuilder('input_form'); // Criador de form
        
        $login =  new TEntry('login');
        $pass =  new TEntry('pass');
        
        $form->addFields([new TLabel('Login')],[$login]);
        $form->addFields([new TLabel('Senha')],[$pass]);
        
        $form->addAction('Confirma',new TAction([__CLASS__,'onConfirm1']), 'fa:save green');
        
        new TInputDialog('título',$form); // Caixa de diálogo
    }
    
    public static function onConfirm1($param)
    {
        new TMessage('info',json_encode($param));
    }
}
