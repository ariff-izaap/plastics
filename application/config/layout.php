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
  'build/global.min','bootbox.min','moment',"jquery.mockjax","bootstrap-editable",'daterangepicker','bootstrap-select','select2.min','jquery.ui.timepicker','jquery.validate.min','validation','function');
 
$config['layout']['default']['stylesheets'] = array('bootstrap.min','style','daterangepicker',"select2.min","bootstrap-editable", "custom",'jquery.ui.timepicker','bootstrap-select');

$config['layout']['default']['description'] = '';
$config['layout']['default']['keywords']    = '';

$config['layout']['default']['http_metas']  = array(
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Independent Plastics',
);

?>
