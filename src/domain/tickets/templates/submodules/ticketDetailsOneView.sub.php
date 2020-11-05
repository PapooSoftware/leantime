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
                <h4 class="widgettitle title-light"><span class="iconfa iconfa-leaf"></span><?php echo $this->__('subtitle.general'); ?></h4>
                <div class="form-group">
                    <label class="span4 control-label"><?php echo $this->__('label.ticket_title'); ?>*</label>
                    <div class="span6">
                        <input type="text" value="<?php $this->e($ticket->headline); ?>" name="headline" autocomplete="off"  style="width:99%;"/>

                    </div>
                </div>
                <div class="form-group">
                    <label class="span4 control-label"><?php echo $this->__('label.milestone'); ?></label>
                    <div class="span6">
                        <div class="form-group">
                            <select  name="dependingTicketId"  class="span11" >
                                <option value=""><?php echo $this->__('label.not_assigned_to_milestone'); ?></option>
                                <?php foreach($this->get('milestones') as $milestoneRow){     ?>

                                    <?php echo"<option value='".$milestoneRow->id."'";

                                    if(($ticket->dependingTicketId == $milestoneRow->id)) { echo" selected='selected' ";
                                    }

                                    echo">".$this->escape($milestoneRow->headline)."</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="span4 control-label"><?php echo $this->__('label.todo_type'); ?></label>
                    <div class="span6">
                        <select id='type' name='type' class="span11">
                            <?php foreach ($ticketTypes as $types) {

                                echo "<option value='" . strtolower($types) . "' ";
                                 if(strtolower($types) == strtolower($ticket->type)) echo "selected='selected'";

                                echo ">" . $this->__("label.".strtolower($types)) . "</option>";

                            } ?>
                        </select><br/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="span4 control-label"><?php echo $this->__('label.todo_status'); ?></label>
                    <div class="span6">
						<input type="hidden" name="prevStatus" value="<?php echo $ticket->status ?>" />
                        <select id="status-select" class="span11" name="status"
                                data-placeholder="<?php echo $statusLabels[$ticket->status]["name"]; ?>">

                            <?php  foreach($statusLabels as $key=>$label){?>
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
                    <label class="span4 control-label"><?php echo $this->__('label.sprint'); ?></label>
                    <div class="span6">

                        <select id="sprint-select" class="span11" name="sprint"
                                data-placeholder="<?php echo $ticket->sprint ?>">
                            <option value=""><?php echo $this->__('label.not_assigned_to_sprint'); ?></option>
                            <?php
                            if($this->get('sprints')){
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
                    <label class="span4 control-label"><?php echo $this->__('label.effort'); ?></label>
                    <div class="span6">
                        <select id='storypoints' name='storypoints' class="span11">
                            <option value=""><?php echo $this->__('label.effort_not_defined'); ?></option>
                            <?php foreach ($this->get('efforts') as $effortKey=>$effortValue) {
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
                    <label class="span4 control-label"><?php echo $this->__('label.tags'); ?></label>
                    <div class="span6">
                        <input type="text" value="<?php $this->e($ticket->tags); ?>" name="tags" id="tags"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <h4 class="widgettitle title-light"><span
                            class="iconfa iconfa-asterisk"></span><?php echo $this->__('label.description'); ?>
                </h4>

                <textarea name="description" rows="10" cols="80" id="ticketDescription"
                          class="tinymce"><?php echo $ticket->description ?></textarea><br/>
                <input type="hidden" name="acceptanceCriteria" value=""/>

            </div>
        </div>
    </div>


</div>
<div class="row-fluid">
    <?php if (isset($ticket->id) && $ticket->id != '') : ?>
        <div class="pull-right padding-top">
            <?php echo $this->displayLink('tickets.delTicket', '<i class="fa fa-trash"></i> '.$this->__('links.delete_todo'), array('id' => $ticket->id), array('class' => 'delete')) ?>
        </div>
    <?php endif; ?>

    <input type="submit" name="saveTicket" value="<?php echo $this->__('buttons.save'); ?>"/>
    <input type="submit" name="saveAndCloseTicket" value="<?php echo $this->__('buttons.save_and_close'); ?>"/>

</div>

