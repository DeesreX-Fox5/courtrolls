<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

$permission = $this->getPermission();
?>

<tr>
	<th>Roll</th>
    <th>Judge</th>
    <th>Date</th>
    <th>Valid Until</th>
    <th>Download</th>
    <?php if($permission) {
        echo "<th>Delete</th>";
    } ?>
</tr>

