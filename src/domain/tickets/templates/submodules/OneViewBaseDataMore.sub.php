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
				<h4 class="widgettitle title-light"><span
							class="iconfa iconfa-group"></span><?php echo $this->__('subtitle.people'); ?></h4>

				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.author'); ?></label>
					<div class="span6">
						<input type="text" disabled="disabled"
							   value="<?php $this->e($ticket->userFirstname); ?> <?php $this->e($ticket->userLastname); ?>"/>
					</div>
				</div>

				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.editor'); ?></label>
					<div class="span6">

						<select data-placeholder="<?php echo $this->__('label.filter_by_user'); ?>"
								name="editorId" class="user-select span11">
							<option value=""><?php echo $this->__('label.not_assigned_to_user'); ?></option>
							<?php foreach ($this->get('users') as $userRow) { ?>

								<?php echo "<option value='" . $userRow["id"] . "'";

								if ($ticket->editorId == $userRow["id"]) { echo " selected='selected' ";}

								echo ">" . $this->escape($userRow["firstname"] . " " . $userRow["lastname"]) . "</option>"; ?>

							<?php } ?>
						</select>
					</div>
				</div>


			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle title-light"><span
							class="iconfa iconfa-calendar"></span><?php echo $this->__('subtitles.dates'); ?></h4>
				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.ticket_date'); ?></label>
					<div class="span6">

						<input type="text" class="dates" id="submittedDate" disabled="disabled"
							   value="<?php echo $ticket->date; ?>" name="date"/>
					</div>
				</div>

				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.due_date'); ?></label>
					<div class="span6">
						<input type="text" class="dates" id="deadline"
							   value="<?php echo $ticket->dateToFinish; ?>"
							   name="dateToFinish"/>
					</div>
				</div>

				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.working_date_from_to'); ?></label>
					<div class="span6">
						<input type="text" class="dates" style="width:90px; float:left;" name="editFrom"
							   value="<?php echo $ticket->editFrom; ?>"/> -
						<input type="text" class="dates" style="width:90px;" name="editTo"
							   value="<?php echo $ticket->editTo; ?>"/>
					</div>
				</div>

			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle title-light"><span
							class="iconfa iconfa-time"></span><?php echo $this->__('subtitle.time_tracking'); ?></h4>
				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.planned_hours'); ?></label>
					<div class="span6">
						<input type="text" value="<?php $this->e($ticket->planHours); ?>" name="planHours"/>
					</div>
				</div>

				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.estimated_hours_remaining'); ?></label>
					<div class="span6">
						<input type="text" value="<?php $this->e($ticket->hourRemaining); ?>" name="hourRemaining"/>
						<a href="javascript:void(0)" class="infoToolTip" data-placement="left" data-toggle="tooltip" data-original-title="<?php echo $this->__('tooltip.how_many_hours_remaining'); ?>">
							&nbsp;<i class="fa fa-question-circle"></i>&nbsp;</a>
					</div>
				</div>

				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.booked_hours'); ?></label>
					<div class="span6">
						<input type="text" disabled="disabled"
							   value="<?php echo $this->get('timesheetsAllHours'); ?>"/>
					</div>
				</div>

				<div class="form-group">
					<label class="span4 control-label"><?php echo $this->__('label.actual_hours_remaining'); ?></label>
					<div class="span6">
						<input type="text" disabled="disabled" value="<?php echo $remainingHours; ?>"/>
					</div>
				</div>



			</div>
		</div>

	</div>

</div>


