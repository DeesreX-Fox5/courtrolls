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
        <legend> Pretoria Bar Rolls</legend>
        <div class="row-fluid">
            <div class="span6">
            <?php echo $form->renderFieldset('roll');  ?>
            </div>
        </div>
        </fieldset>
    </div>
    <?php echo JHtml::_('form.token'); ?>
</form>