<?php
class TemplateViewTable extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $table =  new TTable; // Atributo para tabelas
        $table->border = '1';
        $table->cellpadding = '4';
        $table->style = 'border-collapse: collapse; width:100%';
        
        $row = $table->addRow();
        $row->addCell('Linha A');
        $row->addCell('Linha B');
        
        $title = new TLabel('título','red',18); // Propriedades de TLabel
        
        $row = $table->addRow();
        $cell = $row->addCell($title); // cell == <td>
        $cell->colspan = 2;
        $cell->style = 'padding: 10px';
        
        $id = new TEntry('id'); // TEntry == input
        $nome = new TEntry('nome');
        $endereco= new TEntry('endereco');
        $fone =  new TEntry('fone');
        $obs = new TEntry('obs');
        
        $table->addRowSet('Código', $id);
        $table->addRowSet('Nome', $nome);
        $table->addRowSet('Endereco', $endereco);
        $table->addRowSet('Fone', $fone);
        $table->addRowSet('Obs', $obs);
        
        parent::add($table);
        
        
    }
    
}
