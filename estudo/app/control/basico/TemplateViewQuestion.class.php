<?php
class TemplateViewQuestion extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $action1 = new TAction([$this,'onActionYes']); // Chama uma ação
        $action1->setParameter('nome','acao1');
        
        $action2 = new TAction([$this,'onActionNo']);
        $action2->setParameter('nome','acao2');
        
        new TQuestion('Você gostaria de executar esta operação ?',$action1,$action2); // Realiza uma pergunta
        
    }
    
    public static function onActionYes($param)
    {
        new TMessage('info','Você escolheu Sim:'. $param['nome']);
    }
    
    public static function onActionNo($param)
    {
        new TMessage('error','Você escolheu Não:'. $param['nome']);
    }

}
