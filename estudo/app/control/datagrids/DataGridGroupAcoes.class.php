<?php
class DataGridGroupAcoes extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid); // Criando a data grid e modelando no padrão bootstrap
        $this->datagrid->width = '100%';
        $this->datagrid->enablePopover('Detalhes' , '<b>ID</id> {id} <br> <b>Nome</b> {nome}'); // Popover que aparece ao passar o mouse sobre uma linha
        
        $col_id = new TDataGridColumn('id', 'Código','center','10%');
        $col_nome = new TDataGridColumn('nome','Nome','left','30%');
        $col_cidade = new TDataGridColumn('cidade','Cidade','left','30%');
        $col_estado = new TDataGridColumn('estado','Estado','left','30%');
        
        $col_id->title = 'Clique nesta coluna para ação';
        
        
        $this->datagrid->addColumn($col_id, new TAction([$this,'onColumnAction'],['coluna' => 'id']));
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_cidade);
        $this->datagrid->addColumn($col_estado);
        
        $action1 = new TDataGridAction([$this,'onView'],['id' => '{id}' , 'nome' =>'{nome}','teste' => '5']); // Criando ações para o  DataGrid
        $action2 = new TDataGridAction([$this,'onDelete'],['id' => '{id}', 'nome' =>'{nome}']);
        $action3 = new TDataGridAction([$this,'onPrint'],['id' => '{id}', 'nome' =>'{nome}']);
        
        $action1->setUseButton(true); // Transformando em um botão quadrado
        $action2->setUseButton(true);
        
        
        //$this->datagrid->addAction($action1,'Visualiza','fa:search blue');
        //$this->datagrid->addAction($action2,'Exclui','fa:trash red');
        //após definir colunas, e ações... criar a estrutura
        
        $action1->setLabel('Visualiza'); // Agora os titulos e os icones dos botões devem ser setados de forma separada
        $action1->setImage('fa:search blue');
        
        $action2->setLabel('Exclui');
        $action2->setImage('fa:trash red');
        
        $action3->setLabel('Imprime');
        $action3->setImage('fa:print green');
        
        $action_group = new TDataGridActionGroup('Ações','fa:th'); // Criando o menu que conterá as ações 
        $action_group->addHeader('Grupo 1');
        $action_group->addAction($action1);
        $action_group->addAction($action2);
        $action_group->addSeparator(); // Cria uma separação de opções
        $action_group->addHeader('Grupo 2');
        $action_group->addAction($action3);
        
        $this->datagrid->addActionGroup($action_group); // Coloca o menu de ações no DataGrid
        
        $this->datagrid->createModel(); // Cria a datagrid que foi setada
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
        
        parent::add($panel);
        
    }
    
    public function onView($param)
    {
        new TMessage('info','ID' . $param['id'] . '- Nome:' . $param['nome']);
    }
    
      public function onDelete($param)
    {
        new TMessage('error','ID' . $param['id'] . '- Nome:' . $param['nome']);
    }
    
    
       public function onColumnAction($param)
    {
        new TMessage('info','Coluna clicada' . $param['coluna']);
    }
    
    
     public function onPrint($param)
    {
        new TMessage('info','Coluna clicada' . $param['coluna']);
    }
    
    
    public function onReload()
    {
        $this->datagrid->clear(); // Limpa  a data grid
        
        $item = new stdClass;
        $item->id =1;
        $item->nome = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenessee (US)';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id =2;
        $item->nome = 'Eric Clapton';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id =3;
        $item->nome = 'Chris brown';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $this->datagrid->addItem($item);
        
    }
    
    public function show()
    {
        $this->onReload(); // Recarrega as informações
        parent::show();
    }
}
