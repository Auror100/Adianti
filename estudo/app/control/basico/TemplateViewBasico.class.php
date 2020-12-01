<?php
class TemplateViewBasico extends TPage
{
    public function __construct()
    {
         parent::__construct();
         
         try
         {
             $html = new THtmlRenderer('app/resources/template-basico.html'); // Integra o html de outro página
             
             $costumer =  new stdClass; //objeto plano
             $costumer->id = 5;
             $costumer->name = 'Peter';
             $costumer->address = 'Street 1';
             
             
             $replaces= []; //Vetor de substituições
             $replaces['id'] = $costumer->id;
             $replaces['name'] = $costumer->name;
             $replaces['address'] = $costumer->address;
             
             
             $html->enableSection('main',$replaces);
             
             
             $replaces2 = [];
             
             $replaces2['obs']='funcionei';
             
             $html->enableSection('outros',$replaces2);
             
             parent::add($html);
         }
         catch (Exception $e)
         {
             new TMessage('error',$e->getMessage());
         }
    }
}
