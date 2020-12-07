<?php
class DataGridCalculos extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style= 'width:100%';
        
        $col_id = new TDataGridColumn('id','Còdigo','center');
        $col_descricao = new TDataGridColumn('descricao','Descricao','left');
        $col_qtde = new TDataGridColumn('qtde','Quantidade','center');
        $col_desconto = new TDataGridColumn('desconto','Desconto','left');
        $col_preco = new TDataGridColumn('preco','Preco','right');
        $col_subtotal = new TDataGridColumn('= {qtde} * ({preco} - {desconto})','Subtotal','right'); // Realizando uma equação dentro da variável
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_descricao);
        $this->datagrid->addColumn($col_qtde);
        $this->datagrid->addColumn($col_preco);
        $this->datagrid->addColumn($col_desconto);
        $this->datagrid->addColumn($col_subtotal);
        
        
        
        $formata_valor = function ($valor,$objeto,$row) // Maneira de reaproveitar uma função
        {
            if(is_numeric($valor))
            {
                return 'R$' . number_format($valor,2,',','.');
            }
            
            return $valor;  
        };
        
        $col_preco->setTransformer($formata_valor);
        $col_desconto->setTransformer($formata_valor);
        $col_subtotal->setTransformer($formata_valor);
        
        $col_subtotal->setTotalFunction
        (
            function($valores)
            {
                return array_sum((array) $valores); // Vai somar o array que está vindo de col_subtotal
            }
        );
        
        
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
        $item->descricao = 'chocolate';
        $item->qtde = 1;
        $item->preco = 5;
        $item->desconto = 0.2;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id=2;
        $item->descricao = 'Suco de uva';
        $item->qtde = 5;
        $item->preco = 8;
        $item->desconto = 0.4;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id=3;
        $item->descricao = 'vinho tinto';
        $item->qtde = 7;
        $item->preco = 25;
        $item->desconto = 2;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id=4;
        $item->descricao = 'cerveja';
        $item->qtde = 8;
        $item->preco = 4;
        $item->desconto = 0.2;
        $this->datagrid->addItem($item);
    }
    
    public function show() // Sem modificar esse super método, os dados de onReload não irá aparecer
    {
        $this->onReload();
        parent::show();
    }
}