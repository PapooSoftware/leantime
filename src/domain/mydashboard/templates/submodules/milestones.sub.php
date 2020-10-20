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
<div class="row" id="milestoneProgressContainer">
	<div class="col-md-12">
		<h5 class="subtitle"><?=$this->__("headline.milestones") ?></h5>
		<ul class="sortableTicketList" >
			<?php
			if(count($this->get('milestones')) == 0){
				echo"<div class='center'><br /><h4>".$this->__("headlines.no_milestones")."</h4>
                                ".$this->__("text.milestones_help_organize_projects")."<br /><br /><a href='".BASE_URL."/tickets/roadmap'>".$this->__("links.goto_milestones")."</a>";
			}
			?>
			<?php foreach($this->get('milestones') as $row){
				$percent = 0;


				if($row->editTo == "0000-00-00 00:00:00") {
					$date = $this->__("text.no_date_defined");
				}else {
					$date = new DateTime($row->editTo);
					$date= $date->format($this->__("language.dateformat"));
				}
				if($row->percentDone < 100 || $date >= new DateTime()) {
					?>
					<li class="ui-state-default" id="milestone_<?php echo $row->id; ?>" >
						<div class="ticketBox fixed">

							<div class="row">
								<div class="col-md-12">
									<strong><a href="<?=BASE_URL ?>/tickets/editMilestone/<?php echo $row->id;?>" class="milestoneModal"><?php $this->e($row->headline); ?></a></strong>
								</div>
							</div>
							<div class="row">

								<div class="col-md-7">
									<?=$this->__("label.due") ?>
									<?php echo $date; ?>
								</div>
								<div class="col-md-5" style="text-align:right">
									<?=sprintf($this->__("text.percent_complete"), $row->percentDone)?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $row->percentDone; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->percentDone; ?>%">
											<span class="sr-only"><?=sprintf($this->__("text.percent_complete"), $row->percentDone)?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php }
			} ?>

		</ul>
	</div>
</div>
