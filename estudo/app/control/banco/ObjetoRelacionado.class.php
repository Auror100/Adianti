<?php
class ObjetoRelacionado extends TPage
{
    public function __construct()
    {
        parent::__construct();
        TTransaction::open('sample');
        TTransaction::dump();
        
       // $contatos = Cliente::find(1)->hasMany('Contato'); // Procura informações na table contato onde o id for igual a 1
       // $contatos = Cliente::find(1)->hasMany('Contato','cliente_id','id','tipo'); // table,chave personalizada, chave personalizada e order by
       // $contatos = Cliente::find(1)->FilterMany('Contato')->where('tipo','=','face')->load();
       // $contatos = Cliente::find(1)->FilterMany('Contato','cliente_id','id','tipo')->where('tipo','=','face')->load();
        
    }
}
