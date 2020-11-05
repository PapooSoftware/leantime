<?php

	$ticket = $this->get('ticket');
	$remainingHours = $this->get('remainingHours');
	$statusLabels = $this->get('statusLabels');
	$ticketTypes = $this->get('ticketTypes');

?>

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle title-lightno"><span
							class="iconfa iconfa-leaf"></span><?php echo $this->__('subtitle.settings'); ?>
				</h4>

				<div class="form-group">

					<div class="span12">
						<label class=" control-label"><?php echo $this->__('label.milestone'); ?></label>
						<div class="form-group">
							<select name="dependingTicketId" class="span12">
								<option value=""><?php echo $this->__('label.not_assigned_to_milestone'); ?></option>
								<?php foreach ($this->get('milestones') as $milestoneRow) { ?>

									<?php echo "<option value='" . $milestoneRow->id . "'";

									if (($ticket->dependingTicketId == $milestoneRow->id)) {
										echo " selected='selected' ";
									}

									echo ">" . $this->escape($milestoneRow->headline) . "</option>"; ?>

								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">

					<div class="span12">
						<label class=" control-label"><?php echo $this->__('label.todo_type'); ?></label>
						<select id='type' name='type' class="span12">
							<?php foreach ($ticketTypes as $types) {

								echo "<option value='" . strtolower($types) . "' ";
								if (strtolower($types) == strtolower($ticket->type)) echo "selected='selected'";

								echo ">" . $this->__("label." . strtolower($types)) . "</option>";

							} ?>
						</select><br/>
					</div>
				</div>
				<div class="form-group">

					<div class="span12">
						<label class=" control-label"><?php echo $this->__('label.todo_status'); ?></label>
						<input type="hidden" name="prevStatus"
							   value="<?php echo $ticket->status ?>"/>
						<select id="status-select" class="span12" name="status"
								data-placeholder="<?php echo $statusLabels[$ticket->status]["name"]; ?>">

							<?php foreach ($statusLabels as $key => $label) { ?>
								<option value="<?php echo $key; ?>"
									<?php if ($ticket->status == $key) {
										echo "selected='selected'";
									} ?>
								><?php echo $this->escape($label["name"]); ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">

					<div class="span12">
						<label class=" control-label"><?php echo $this->__('label.sprint'); ?></label>
						<select id="sprint-select" class="span12" name="sprint"
								data-placeholder="<?php echo $ticket->sprint ?>">
							<option value=""><?php echo $this->__('label.not_assigned_to_sprint'); ?></option>
							<?php
							if ($this->get('sprints')) {
								foreach ($this->get('sprints') as $sprintRow) { ?>
									<option value="<?php echo $sprintRow->id; ?>"
										<?php if ($ticket->sprint == $sprintRow->id) {
											echo "selected='selected'";
										} ?>
									><?php $this->e($sprintRow->name); ?></option>
								<?php }
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group">

					<div class="span12">
						<label class=" control-label"><?php echo $this->__('label.effort'); ?></label>
						<select id='storypoints' name='storypoints'
								class="span12">
							<option value=""><?php echo $this->__('label.effort_not_defined'); ?></option>
							<?php foreach ($this->get('efforts') as $effortKey => $effortValue) {
								echo "<option value='" . $effortKey . "' ";
								if ($effortKey == $ticket->storypoints) {
									echo "selected='selected'";
								}
								echo ">" . $effortValue . "</option>";
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="span12">
						<label class=" control-label"><?php echo $this->__('label.tags'); ?></label>
						<input type="text"
							   value="<?php $this->e($ticket->tags); ?>"
							   name="tags" id="tags"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


