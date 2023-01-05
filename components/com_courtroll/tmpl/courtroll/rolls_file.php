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


<tr title="<?php echo $this->file->description ?>">
	<td><?php echo $this->file->roll ?></td>
    <td><?php echo implode(", ", $this->getJudge($this->file->id)) ?></td>
    <td><?php echo $this->file->date ?></td>
    <td><?php echo $this->file->date_valid_until ?></td>
    <td>
        <a href="<?php echo $this->file->roll_file; ?>" target="_blank" class="btn btn-sm btn-secondary" >Download</a>
    </td>
    <?php if($permission) {
        echo "<td><a href='index.php?option=com_courtroll&task=courtroll.delete&id=" . $this->file->id . "' class='btn btn-sm btn-danger'>Delete</a></td>";
    } ?>
</tr>

<style>
    .btn-sm{
        padding: 2px;
    }
</style>
