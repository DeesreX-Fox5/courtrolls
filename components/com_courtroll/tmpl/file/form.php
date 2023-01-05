<?php
// No direct access to this file  
defined('_JEXEC') or die('Restricted access');

$model = $this->model;
$form = $model->getForm();

?>


<form action="<?php echo JRoute::_('index.php?option=com_courtroll'); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate"  enctype="multipart/form-data">
  <div class="form-horizontal">
    <fieldset class="adminform">
      <legend> Add New File </legend>
      <div class="row-fluid">
        <div class="span6">
          <?php echo $form->renderFieldset('roll');  ?>
        </div>
      </div>
    </fieldset>
  </div>
    
  <div class="btn-toolbar">
    <div class="btn-group">
      <button type="submit" class="btn btn-primary">
        <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
      </button>
    </div>
    <div class="btn-group">
      <button type="submit" class="btn btn-default" name="controller">
        <span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
      </button>
    </div>
  </div>

  <input type="hidden" name="task" value="upload.upload"/>
    <?php echo JHtml::_('form.token'); ?>

</form>