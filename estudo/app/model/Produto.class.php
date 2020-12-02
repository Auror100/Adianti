<?php
class Produto extends TRecord
{
    const TABLENAME = 'produto';
    const PRIMARYKEY = 'id';
    const IDPOLICY = 'max'; //{max,serial} max = framework gera -- ultimo id +1 serial = banco geral sequencial crescente
    
    public function __construct($id=null , $callObjectLoad=true)
    {
        parent::__construct($id,$callObjectLoad);
        
        parent::addAttribute('descricao');
        parent::addAttribute('estoque');
        parent::addAttribute('preco_venda');
        parent::addAttribute('unidade');
        parent::addAttribute('local_foto');
    }
}
