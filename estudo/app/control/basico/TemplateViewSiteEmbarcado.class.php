<?php
class TemplateViewSiteEmbarcado extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $object =  new TElement('iframe'); // Embarca
        $object->width = '100%';
        $object->height = '600px';
        $object->src ="http://www.adianti.com.br/framework_files/template-material/";
        $object->frameborder = '0';

        
        parent::add($object);
    }
}
