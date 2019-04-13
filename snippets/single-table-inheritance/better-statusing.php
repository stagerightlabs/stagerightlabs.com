<?php foreach($records as $record) ?>
<tr>
    <td>
        <?php echo $record->referenceNum; ?>
    </td>
    <td>
        <?php echo $record->getActions('client'); ?>
    </td>
</tr>
<?php endforeach; ?>
