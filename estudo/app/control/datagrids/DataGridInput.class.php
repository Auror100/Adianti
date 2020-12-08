<?php
class DataGridInput extends TPage
{
     private $form;
     
     private $datagrid;
     
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new TForm;
        
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid); // Criando a data grid e modelando no padrão bootstrap
        $this->datagrid->disableDefaultClick(); // Tirando o clique default
        $this->datagrid->width = '100%';

        
        $col_id = new TDataGridColumn('id', 'Código','center','10%');
        $col_nome = new TDataGridColumn('nome','Nome','left','30%');
        $col_cidade = new TDataGridColumn('cidade','Cidade','left','30%');
        $col_estado = new TDataGridColumn('estado','Estado','left','30%');
        

        
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_cidade);
        $this->datagrid->addColumn($col_estado);
        
        $action1 = new TDataGridAction([$this,'onView'],['id' => '{id}','nome' => '{nome_original}']); //Pegando o id e o nome
        $action2 = new TDataGridAction([$this,'onDelete'],['id' => '{id}','nome' => '{nome_original}']);
        
        $action1->setUseButton(true); // Transformando em um botão quadrado
        $action2->setUseButton(true);
        
        
        $this->datagrid->addAction($action1,'Visualiza','fa:search blue');
        $this->datagrid->addAction($action2,'Exclui','fa:trash red');
        //após definir colunas, e ações... criar a estrutura
        
        
        $this->datagrid->createModel(); // Cria a datagrid que foi setada
        
        $botao = TButton::create('salvar',[$this,'onSave'],'Salvar','fa:save green'); // Criando botão de save
        $this->form->addField($botao);
        
        /*
        $item = new stdClass;
        $item->id =1;
        $item->nome = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenesse';
        
        $this->datagrid->addItem($item);
        */
        $panel = new TPanelGroup('Datagrid');
        $panel->add($this->datagrid);
        $panel->addFooter($botao); //Colocando o botão 
        $this->form->add($panel);
        
        parent::add($this->form);
        
    }
    
    public function onSave($param)
    {
        $data =$this->form->getData();
        $this->form->setData($data);
        
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
    
    public function onView($param)
    {
        new TMessage('info','ID' . $param['id'] . '- Nome:' . $param['nome']);
    }
    
      public function onDelete($param)
    {
        new TMessage('error','ID' . $param['id'] . '- Nome:' . $param['nome']);
    }
    
    

    
    public function onReload()
    {
        $this->datagrid->clear(); // Limpa  a data grid
        
        $item = new stdClass;
        $item->id =1;
        //$item->nome = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenessee (US)';
        $item->nome_original = 'Aretha Franklin';
        
        $item->nome = new TEntry('nome'. $item->id); // Campo de nome
        $item->nome->setValue($item->nome_original); // Pegando o valor da variavel
        $item->nome->setSize('100%');
        $this->form->addField($item->nome);        
        $this->datagrid->addItem($item);
        
        
        $item = new stdClass;
        $item->id =2;
        $item->nome_original = 'Eric Clapton';
        $item->nome = 'Eric Clapton';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        
        $item->nome = new TEntry('nome'. $item->id);
        $this->form->addField($item->nome);
        
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id =3;
        $item->nome_original = 'Chris Brown';
        $item->nome = 'Chris brown';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $item->nome = new TEntry('nome'. $item->id);
        $this->form->addField($item->nome);
        
        $this->datagrid->addItem($item);
        
       
        
    }
    
    public function show()
    {
        $this->onReload(); // Recarrega as informações
        parent::show();
    }
}


