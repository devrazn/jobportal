<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$template['active_template'] = 'default';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land. 
|   You may also include default markup, wrappers and attributes here 
|   (though not recommended). Region keys must be translatable into variables 
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We 
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the 
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/

/*
|--------------------------------------------------------------------------
| Template Configurations
|--------------------------------------------------------------------------
*/

//Default
$template['default']['template'] = 'layout/layout-home.php';
$template['default']['regions'] = array(
   'title',
   'nav',
   'menu',
   'breadcrumb',
   'content',
   'sidebar',
   'footer',
);
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;





//Offline
$template['offline']['template'] = 'layout/layout-offline.php';
$template['offline']['regions'] = array(
   'title',
  'content'
);
$template['offline']['parser'] = 'parser';
$template['offline']['parser_method'] = 'parse';
$template['offline']['parse_template'] = FALSE;


//HOME
$template['home']['template'] = 'layout/layout-home.php';
$template['home']['regions'] = array(
   'title',
  'content_left',
  'content_right'
 
);
$template['home']['parser'] = 'parser';
$template['home']['parser_method'] = 'parse';
$template['home']['parse_template'] = FALSE;

//REGISTER
$template['register']['template'] = 'layout/layout-register.php';
$template['register']['regions'] = array(
   'title',
   'meta_description',
   'meta_key_word',
  'content_middle'
 
);
$template['register']['parser'] = 'parser';
$template['register']['parser_method'] = 'parse';
$template['register']['parse_template'] = FALSE;


$template['two']['template'] = 'layout/layout-two.php';
$template['two']['regions'] = array(
 'title',
   'meta_description',
   'meta_key_word',
  'content_left',
  'content_right'
 
);
$template['two']['parser'] = 'parser';
$template['two']['parser_method'] = 'parse';
$template['two']['parse_template'] = FALSE;


$template['member']['template'] = 'layout/layout-member.php';
$template['member']['regions'] = array(
 'title',
   'meta_description',
   'meta_key_word',
  'content_left',
  'content_right'
 
);
$template['member']['parser'] = 'parser';
$template['member']['parser_method'] = 'parse';
$template['member']['parse_template'] = FALSE;






/* End of file template.php */
/* Location: ./system/application/config/template.php */