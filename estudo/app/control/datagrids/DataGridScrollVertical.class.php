<?php
class DataGridScrollVertical extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid); // Criando a data grid e modelando no padrão bootstrap
        $this->datagrid->width = '100%';
        $this->datagrid->style='mind-width:1900px';
        $this->datagrid->enablePopover('Detalhes' , '<b>ID</id> {id} <br> <b>Nome</b> {nome}'); // Popover que aparece ao passar o mouse sobre uma linha
        
        $this->datagrid->setHeight(300); // Dá uma altura máxima para a datagrid
        $this->datagrid->makeScrollable(); // Habilita a barra de rolagem
        
        $col_id = new TDataGridColumn('id', 'Código','center');
        $col_nome = new TDataGridColumn('nome','Nome','left');
        $col_cidade = new TDataGridColumn('cidade','Cidade','left');
        $col_estado = new TDataGridColumn('estado','Estado','left');
        $col_email =  new TDataGridColumn('email','Email','left');
        $col_telefone =  new TDataGridColumn('telefone','Telefone','left');
        
        $col_id->title = 'Clique nesta coluna para ação';
        
        
        $this->datagrid->addColumn($col_id, new TAction([$this,'onColumnAction'],['coluna' => 'id']));
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_cidade);
        $this->datagrid->addColumn($col_estado);
        $this->datagrid->addColumn($col_email);
        $this->datagrid->addColumn($col_telefone);
                
        $action1 = new TDataGridAction([$this,'onView'],['id' => '{id}' , 'nome' =>'{nome}','teste' => '5']);
        $action2 = new TDataGridAction([$this,'onDelete'],['id' => '{id}', 'nome' =>'{nome}']);
        
        $action1->setUseButton(true); // Transformando em um botão quadrado
        $action2->setUseButton(true);
        
        
        $this->datagrid->addAction($action1,'Visualiza','fa:search blue');
        $this->datagrid->addAction($action2,'Exclui','fa:trash red');
        //após definir colunas, e ações... criar a estrutura
        
        
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
        
        $panel->getBody()->style = 'overflow-x:auto';
        
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
    
    
    public function onReload()
    {
        $this->datagrid->clear(); // Limpa  a data grid
        
        for($n=1;$n<=40;$n++){
        
        $item = new stdClass;
        $item->id =$n;
        $item->nome = 'Fulano'.$n;
        $item->cidade = 'Cidade'.$n;
        $item->estado = 'Estado'.$n;
        $item->email = 'fulano@email'.$n;
        $item->telefone='2345678';
        $this->datagrid->addItem($item);
        
       }
        
    }
    
    public function show()
    {
        $this->onReload(); // Recarrega as informações
        parent::show();
    }
}

