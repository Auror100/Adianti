<?php
class ConfigAgregado extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            TTransaction::dump();
            
            //$total = Venda::sumBy('total'); // Soma dos totais
            //$count = Venda::countDistinctBy('total'); // Conta o número distinto de totais
            //$rows = Venda::groupBy('dt_venda,cliente_id')->sumBy('total'); // Agrupa por id, cliente
            //$total = Venda::where('dt_venda','>','2015-03-12')->sumBy('total'); // Somar as vendas de determinada data
            //$total = Venda::where('dt_venda','>','2015-03-12')->countDistinctBy('id'); // Contar o numero de id distintos depois de determinada data
            //$rows = Venda::where('dt_venda','>','2015-03-12')->groupBy('dt_venda')->maxBy('total'); // O valor máximo
            //$total = Venda::where('dt_venda','>','2015-04-12')->where('dt_venda','<','2019-04-12')->sumBy('total');// Total entre essas datas
              $rows = Venda::where('dt_venda','>','2015-04-12')->where('dt_venda','<','2019-04-12')->groupBy('cliente_id')->sumBy('total');
              
              foreach($rows as $row)
              {
                  print $row->cliente_id;
                  print $row->total;
              }
            
            /*
            echo'<pre>';
            var_dump($rows);
            echo'</pre>';
            */
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}
