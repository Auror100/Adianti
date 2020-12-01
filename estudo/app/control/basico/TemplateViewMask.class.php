<?php
class TemplateViewMask extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            $html = new THtmlRenderer('app/resources/template_masks.html');
            
            $replace = [];
            $replace['date'] = date('Y-m-d');
            $replace['datetime'] = date('Y-m-d H:i:s');
            $replace['number'] =  1200.78;
            $replace['value1'] = 10;
            $replace['value2'] = 10;
            $replace['value3'] = 2;
            
            $html->enableSection('main',$replace);
            
            parent::add($html);
        }
        catch (Exception $e)
        {
            new TMessage('error',  $e->getMessage());
        }
    }
}
