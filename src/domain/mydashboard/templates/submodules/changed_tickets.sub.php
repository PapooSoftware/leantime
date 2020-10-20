<?php
$states = $this->get('states');
$projectProgress = $this->get('projectProgress');
$sprintBurndown = $this->get('sprintBurndown');
$backlogBurndown = $this->get('backlogBurndown');
$efforts = $this->get('efforts');
$statusLabels = $this->get('statusLabels');
$cal = $this->get('calendar');

#print_r($this->get('allTickets'));
#exit();
/**
 * Was brauchts alles
 * - Übersicht über Todos über alle PRojekte hinweg sortiert nach Due Date - kein Due dann hinten dran... oder separat...
 * - ALle meine Projekte - mit % wie weit
 * - Alle meine Meilensteine - sortiert nach Due Date absteigend mit % wie weit
 * - Letze Änderungen über alle Projekte hinweg (amin) - User -> eigene Projekte
 * - NEW assigned TODOs to me
 * - NEW TODOs assigned to my projects
 * - NEW PRojects
 */
?>
<div class="row" id="yourToDoContainer">
	<div class="col-md-12">
		<h5 class="subtitle"><?php echo sprintf($this->__("subtitles.todos_changed"), count($this->get('allTicketsChanged'))) ?></h5>
		<?php
		if(count($this->get('allTicketsChanged')) > 0){
			?>



			<ul class="sortableTicketList" >

				<?php foreach($this->get('allTicketsChanged') as $row){


					if($row['dateModified'] == "0000-00-00 00:00:00" || $row['dateToFinish'] == "1969-12-31 00:00:00") {
						$date = $this->__("text.anytime");

					}else {
						$date = new DateTime($row['dateModified']);
						//$date = $date->format('Y-m-d H:i:s');
						$date = $date->format($this->__("language.dateformat")." - H:i:s");
					}
					?>
					<li class="ui-state-default" id="ticket_<?php echo $row['id']; ?>" >
						<div class="ticketBox fixed" data-val="<?php echo $row['id']; ?>">
							<div class="row">
								<div class="col-md-12 timerContainer" style="padding:5px 15px;" id="timerContainer-<?php echo $row['id'];?>">
									<?php echo $row['projectName'];?>: <strong><a href="<?=BASE_URL ?>/tickets/showTicket/<?php echo $row['id'];?>" ><?php $this->e($row['headline']); ?></a></strong>

									<?php

									if ($login::userIsAtLeast("developer")) {
										$clockedIn = $this->get("onTheClock");
										?>
									<?php } ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12" style="padding:0 15px;">
									<?php echo $this->__("label.changed"); ?>: <?php echo $date; ?>
								</div>
								<div class="col-md-12" style="padding-top:3px;" >
									<div class="right">
									</div>
								</div>

							</div>
						</div>
					</li>
					<?php
				} ?>

			</ul>
		<?php } ?>
	</div>
</div>