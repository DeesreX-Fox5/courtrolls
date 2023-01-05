<?php
defined('_JEXEC') or die('Restricted access');
//add script declaration
$document = JFactory::getDocument();
$document->addScript("//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js");
$document->addStyleSheet("//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css");
$document->addScriptDeclaration("

	$(document).ready( function () {
		$('#roll_table').DataTable();
	} );
	
	
	");

$form = $this->getForm();


?>
<!--bootstrap collapse div-->

<!--make div below collapse -->



<div >
    <table id="roll_table">
        <thead>
		<?php echo $this->loadTemplate("header") ?>
        </thead>
        <tbody>
		<?php foreach ($this->rolls as $key => $roll) {
			foreach ($roll as $file) {
				$this->file = $file;
				echo $this->loadTemplate("file");
			}
		} ?>
        </tbody>
    </table>
</div>

<script>
    var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
    var collapseList = collapseElementList.map(function (collapseEl) {
        return new bootstrap.Collapse(collapseEl)
    })
</script>

