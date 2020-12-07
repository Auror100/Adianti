<?php
class DataGridImagens extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style= 'width:100%';
        
        $col_id = new TDataGridColumn('id','Còdigo','center');
        $col_descricao = new TDataGridColumn('descricao','Descricao','center');
        $col_imagem = new TDataGridColumn('imagem','Imagem','center');
        
        $col_imagem->setTransformer
        (
            function($imagem,$object,$row)
            {
                $obj = new TImage($imagem); // Propriedade de imagem
                $obj->style = 'width:140px;height:120px;';
                
                return $obj;
            }
        );
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_descricao);
        $this->datagrid->addColumn($col_imagem);
        
       
        $this->datagrid->createModel();
        
        $panel = new TPanelGroup('Datagrid com cálculos');
        $panel->add($this->datagrid);
        
        parent::add($panel);
        
    }
    
    public function onReload()
    {
        $this->datagrid->clear();
        
        $item = new stdClass;
        $item->id=1;
        $item->descricao = 'pendrive';
        $item->imagem='app/images/pendrive.jpg'; // Caminho da imagem
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id=2;
        $item->descricao = 'HD Externo';
        $item->imagem='app/images/hd.jpg';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id=3;
        $item->descricao = 'notebook';
        $item->imagem='app/images/notebook.jpg';
        $this->datagrid->addItem($item);
    }
    
    public function show() // Sem modificar esse super método, os dados de onReload não irá aparecer
    {
        $this->onReload();
        parent::show();
    }
}

