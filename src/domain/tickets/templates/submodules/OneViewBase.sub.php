<?php

    $ticket = $this->get('ticket');
    $remainingHours = $this->get('remainingHours');
    $statusLabels  = $this->get('statusLabels');
    $ticketTypes = $this->get('ticketTypes');

?>

<div class="row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <div class="span12">
                <h4 class="widgettitle title-lightno"><span class="iconfa iconfa-leaf"></span><?php echo $this->__('subtitle.general'); ?></h4>
                <div class="form-group">

                    <div class="span12">
						<label for="headline"><?php echo $this->__('label.ticket_title'); ?>*</label>
                        <input type="text" placeholder="<?php echo $this->__('label.ticket_title'); ?>*" value="<?php $this->e($ticket->headline); ?>" class="headline" name="headline" autocomplete="off"  style="width:99%;"/>

                    </div>
                </div>

            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
				<label for="description"><?php echo $this->__('label.description'); ?>*</label>
                <textarea name="description" rows="10" cols="80" id="ticketDescription"
                          class="tinymce"><?php echo $ticket->description ?></textarea><br/>
                <input type="hidden" name="acceptanceCriteria" value=""/>

            </div>
        </div>
    </div>


</div>


