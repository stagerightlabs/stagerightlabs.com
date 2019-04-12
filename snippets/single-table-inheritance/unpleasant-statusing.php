<?php foreach ($records as $record) ?>
<tr>
    <td><?php echo $record->referenceId; ?></td>
    <td>
        <?php if ($record->status == 'new') ?>
        <a href="...">Cancel</a>
        <a href="...">Assign to Nurse</a>
        <?php endif; ?>
        <?php if ($record->status == 'acquired') ?>
        <a href="...">Prepare Summary</a>
        <a href="...">View PDFs</a>
        <?php endif; ?>
        <?php if ($record->status == 'summarized') ?>
        <a href="...">Review Summary</a>
        <a href="...">Approve</a>
        <a href="...">Reject</a>
        <?php endif; ?>
        <?php if ($record->status == 'approved') ?>
        <a href="...">View</a>
        <a href="...">Process Payment</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
