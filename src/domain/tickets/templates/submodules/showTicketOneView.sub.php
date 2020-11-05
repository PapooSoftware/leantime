<?php

    defined('RESTRICTED') or die('Restricted access');
	$ticket = $this->get('ticket');

?>
<link rel="stylesheet"
	  href="<?=BASE_URL?>/css/spleantime_oneView.css?v=<?php echo $settings->appVersion; ?>"
	  type="text/css" xmlns="http://www.w3.org/1999/html"/>
<div class="pageheader">

    <div class="pull-right padding-top">
        <a href="<?php echo $_SESSION['lastPage'] ?>" class="backBtn"><i class="far fa-arrow-alt-circle-left"></i> <?=$this->__("links.go_back") ?></a>
    </div>

    <div class="pageicon"><span class="<?php echo $this->getModulePicture() ?>"></span></div>
    <div class="pagetitle">
        <h5><?php $this->e($_SESSION['currentProjectClient']." // ". $_SESSION['currentProjectName']); ?></h5>
        <h1><?=$this->__("headlines.edit_todo") ?></h1>
    </div>

</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>


		<form class="" id="baseForm" action="<?=BASE_URL ?>/tickets/showTicket/<?php echo $ticket->id ?>" method="post" enctype="multipart/form-data" >
				<div class="row">

						<!--<h4 class="widgettitle rowhead"><span class="iconfa iconfa-leaf"></span>Ticket: <?php $this->e($ticket->headline); ?></h4>
-->
					<div class="col-md-9 white-background ticketContainer">
						<div class="subrow white-background"><?php $this->displaySubmodule('tickets-OneViewBase') ?></div>
						<div class="subrow white-background"><?php $this->displaySubmodule('tickets-OneViewsubTasks') ?></div>
						<div class="subrow white-background">	<?php $this->displaySubmodule('tickets-OneViewattachments') ?></div>
						<div class="subrow white-background">	<?php $this->displaySubmodule('tickets-OneViewcomments') ?></div>
					</div>
					<div class="col-md-3 rightWing white-background ticketContainer">
						<?php $this->displaySubmodule('tickets-OneViewBaseDatPrime') ?>
						<?php $this->displaySubmodule('tickets-OneViewBaseDat') ?>
					</div>
				</div>
				<div class="row-fluid white-background ticketContainer pull-leftsub">
					<?php if (isset($ticket->id) && $ticket->id != '') : ?>
						<div class="pull-right padding-top">
							<?php echo $this->displayLink('tickets.delTicket', '<i class="fa fa-trash"></i> '.$this->__('links.delete_todo'), array('id' => $ticket->id), array('class' => 'delete')) ?>
						</div>
					<?php endif; ?>
					<input type="submit" name="saveTicket" value="<?php echo $this->__('buttons.save'); ?>xx"/>
						<button name="saveTicket" onclick="document.getElementById('baseForm').submit();" value=""/><?php echo $this->__('buttons.save'); ?></button>
					<input type="submit" name="saveAndCloseTicket" value="<?php echo $this->__('buttons.save_and_close'); ?>"/>
					</div>

				</div>
			</form>







    </div>
</div>

<script type="text/javascript">

    leantime.ticketsController.initTicketTabs();
    leantime.ticketsController.initTicketEditor();
    leantime.ticketsController.initTagsInput();

    jQuery(window).load(function () {
        jQuery(window).resize();
    });

</script>
