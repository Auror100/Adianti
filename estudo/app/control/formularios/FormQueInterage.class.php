<?php
class FormQueInterage extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Sort List');
        
        $list1 = new TSortList('list1'); // Criador de lista de escolhas
        
        /*
            Sort list pegando os dados que vem do banco
            
            $list1 = new TDBSortList('list1','sample','Categoria','id','nome');  
        */
        
        $list2 = new TSortList('list2');
        
        $list1->addItems(['a' =>'Opção', 'b' => 'Opção B', 'c' => 'Opção C']); // Adicionando as opções de escolha
        
        $list1->setSize(200,100); // Os tamanhos devem ficar parecidos
        $list2->setSize(200,100);
        
        $list1->connectTo($list2); // Conectando uma lista a outra
        $list2->connectTo($list1);
        
        $this->form->addFields([$list1,$list2]); // Colocando as duas listas no formulário
        
        $this->form->addAction('Enviar', new TAction([$this,'onSend']),'fa:save');
        
        parent::add($this->form);
    }
    
    public function onSend($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);
        
        echo '<pre>';
        var_dump($data->list1);
        var_dump($data->list2);
        echo '</pre>';
    }
}
