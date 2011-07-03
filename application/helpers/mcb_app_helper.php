<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function application_title() {

    $CI =& get_instance();

    return ($CI->mdl_mcb_data->setting('application_title')) ? $CI->mdl_mcb_data->setting('application_title') : $CI->lang->line('myclientbase');

}

?>
