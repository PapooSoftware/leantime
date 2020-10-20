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
<div class="row" id="projectProgressContainer">
	<div class="col-md-12">


		<h5 class="subtitle"><?=$this->__("subtitles.my_projects")?></h5>



		<div class="row">
			<div class="col-md-12">
				<ul class="sortableTicketList" >
					<?php
					$progress = $this->get('projectProgress');

					foreach($this->get('projects') as $row){



						?>
						<li class="ui-state-default" id="milestone_<?php echo $row['id']; ?>" >
							<div class="ticketBox fixed">


								<div class="row">

									<div class="col-md-7">

										<strong><a href="<?=BASE_URL ?>/projects/changeCurrentProject/<?php echo $row['id'];?>"/><?php echo $row['name']; ?></a>
										</strong>
									</div>
									<div class="col-md-5" style="text-align:right">
										<?=sprintf($this->__("text.percent_complete"), round($progress[$row['id']]['percent'],0))?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $progress[$row['id']]['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress[$row['id']]['percent']; ?>%">
												<span class="sr-only"><?=sprintf($this->__("text.percent_complete"), $progress[$row['id']]['percent'])?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<?=$this->__("subtitles.number_of_tickets");?>: <?php echo $row['numberOfTickets']; ?>
									</div>
									<div class="col-md-6">
										<?=$this->__("subtitles.planned_finished"); ?>: <?php if ($progress[$row['id']]['plannedCompletionDate']) { print_r($progress[$row['id']]['plannedCompletionDate']);} else { print_r(" - ");} ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<?=$this->__("subtitles.client"); ?>: <?php print_r($row['clientName']); ?>
									</div>
									<div class="col-md-6">
										<?=$this->__("subtitles.budget");?>: <?php print_r($row['dollarBudget']); ?>
									</div>
								</div>
							</div>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
		<br /><br />
	</div>
</div>