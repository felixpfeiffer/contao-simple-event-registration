
<div class="ser_wrapper">

	<p class="info_places<?php echo $this->places_class ?>"><?php echo $this->places; ?></p>
	
	<?php if($this->message): foreach($this->message as $message): ?><p class="message<?php echo $message['message_class']; ?>"><?php echo $message['message']; ?></p><?php endforeach;endif; ?>
	
	<?php if($this->blnShowForm): ?>
	<form action="<?php echo $this->action; ?>" method="post">
		<div class="formbody">
			<input type="hidden" name="FORM_SUBMIT" value="tl_simple_event_registration" />
			<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
			<div class="checkbox_container">
				<span><input type="checkbox" name="register" id="opt_register" class="checkbox" value="1" /> <label for="opt_register"><?php echo $this->checkbox_label; ?></label></span>
			</div>
			<?php if($this->ser_quantity): ?>
			<div class="select_container">
				<label for="ctrl_quantity"><?php echo $this->quantity_label; ?></label> 
				<select name="quantity_select" id="ctrl_quantity" class="select">
					<?php for($i=1;$i<=$this->quantity;$i++): ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<?php endif; ?>
			<div class="submit_container">
				<input type="submit" class="submit" value="<?php echo $this->submit; ?>" />
			</div>
		</div>
	</form>
	<?php endif; ?>
	<?php if($this->blnShowDiscardForm): ?>
	<form action="<?php echo $this->action; ?>" method="post">
		<div class="formbody">
			<input type="hidden" name="FORM_SUBMIT" value="tl_simple_event_cancelation" />
			<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
			<div class="checkbox_container">
				<span><input type="checkbox" name="unregister" id="opt_unregister" class="checkbox" value="1" /> <label for="opt_unregister"><?php echo $this->unregister_checkbox_label; ?></label></span>
			</div>
			<div class="submit_container">
				<input type="submit" class="submit" value="<?php echo $this->unsubmit; ?>" />
			</div>
		</div>
	</form>
	<?php endif; ?>
</div>