<?php

//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template']    = 'layouts/frontend';
$config['layout']['default']['title']       = 'Independent Plastics';
$config['layout']['default']['js_dir']      = 'assets/js/';
$config['layout']['default']['css_dir']     = 'assets/css/';
$config['layout']['default']['img_dir']     = 'assets/images/';
$config['layout']['default']['javascripts'] = array(
  'bootstrap.min','build/global.min','moment','daterangepicker','select2.min','function','custom' 
  'bootstrap.min','build/global.min','moment','daterangepicker','select2.min','function','custom' 
  'build/global.min','moment','daterangepicker','select2.min','function','custom' 
>>>>>>> .r31
);
 
$config['layout']['default']['stylesheets'] = array('bootstrap.min','style','daterangepicker',"select2.min");

$config['layout']['default']['description'] = '';
$config['layout']['default']['keywords']    = '';

$config['layout']['default']['http_metas']  = array(
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Independent Plastics',
);

?>
