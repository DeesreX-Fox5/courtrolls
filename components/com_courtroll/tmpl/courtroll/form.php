<?php
// No direct access to this file  
defined('_JEXEC') or die('Restricted access');
$model = $this->model;
$form = $model->loadform("filter","filter");

$input =  JFactory::getApplication()->input;


$value = $input->get('roll', array(), 'ARRAY');
//$value['roll'] = ($value['roll'] == "") ? $input->get('roll', "", 'STRING') : $value['roll'];

if (isset($value['roll'])) {
    $type = $value['roll'];
} else {
    $type = $input->get('roll', "", 'STRING') ;
}
$form->bind($value);


?>

<form action="<?php echo JRoute::_('index.php?option=com_courtroll&view=roll&layout=rolls'); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate"  enctype="multipart/form-data">

  <div class="form-horizontal">
    <fieldset class="adminform">
      <legend> Filter Through  Uploaded Files </legend>
      <div class="row-fluid">
        <div class="span6">
          <?php echo $form->renderFieldset('roll');  ?> <!-- this is where the filter form is displayed -->
        </div>
      </div>
    </fieldset>
  </div>

  <div class="btn-toolbar">
    <div class="btn-group">
      <button type="submit" class="btn btn-primary">
        <span class="icon-ok"></span>Search
      </button>
    </div>
  </div>


  <?php echo JHtml::_('form.token'); ?>
</form>