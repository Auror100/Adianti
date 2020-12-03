<?php
class FormularioVertical extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder('meu_form');
        $this->form->setFormTitle('Formulário vertical');
        $this->form->setFieldSizes('100%'); // Colocando os campos a ocuparem 100% do espaço que sobre, isso faz o nome do campo ficar em cima e não no lado
        
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $genero = new TCombo('genero');
        $status = new TCombo('status');
        
        $cnh = new TEntry('cnh');
        $documento = new TEntry('documento');
        $dt_nascimento = new TDate('dt_nascimento');
        $fone_residencial = new TEntry('fone_residencial');
        $fone_celular = new TEntry('fone_celular');
        
        $row = $this->form->addFields
        (
            [new TLabel('ID'),$id],
            [new TLabel('Nome'),$nome],
            [new TLabel('Genero'),$genero],
            [new TLabel('Status'),$status],
        
        );
        
        $row->layout = ['col-sm-2','col-sm-6','col-sm-2','col-sm-2'];
        
        
        $row = $this->form->addFields
        (
            [new TLabel('CNH'),$cnh],
            [new TLabel('Documento'),$documento],
            [new TLabel('Nascimento'),$dt_nascimento],
            [new TLabel('Fone res.'),$fone_residencial],
            [new TLabel('Fone res.'),$fone_celular],       
        );
        
        $row->layout = ['col-sm-2','col-sm-3','col-sm-3','col-sm-2','col-sm-2'];
        
        parent::add($this->form);
    }
}
