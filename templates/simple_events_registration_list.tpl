<div class="ser_event_list">
	<h2><?php echo $this->listHeadline; ?></h2>
	<?php if($this->blnShowList): ?>
		<table cellspacing="0" cellpadding="0" class="sortable" id="<?php echo $this->listid; ?>" summary="<?php echo $this->listsummary; ?>">
			<thead>
				<tr>
					<th><?php echo $this->head['no']; ?></th>
					<th><?php echo $this->head['firstname']; ?></th>
					<th><?php echo $this->head['lastname']; ?></th>
					<th><?php echo $this->head['email']; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; foreach($this->list as $v): ?>
					<tr class="<?php echo $v['class'] ?>">
						<td><?php echo ++$i; ?></td>
						<td><?php echo $v['firstname']; ?></td>
						<td><?php echo $v['lastname']; ?></td>
						<td><?php echo $v['email']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p class="message"><?php echo $this->listMessage; ?></p>
	<?php endif; ?>
</div>
