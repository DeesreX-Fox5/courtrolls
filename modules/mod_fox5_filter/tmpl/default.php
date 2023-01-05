<?php

use Fox5\Module\Filter\Site\Helper\ModFilter;
$form = ModFilter::getForm();
defined('_JEXEC') or die;
?>


<!--Make div below collapse-->
<button class="btn btn-primary" type="button" id="button_filter">
    Advanced Search
</button>

<div class="" style="display: none" id="filterCollapse">
    <form id="roll_filter_form" action="#" method="post">
		<?php echo $form->renderFieldset('filter'); ?>
        <button id="roll_filter_button" data-view="<?php echo ModFilter::getViewType() ?>"
                type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
