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
<link rel="stylesheet" href="<?=BASE_URL?>/css/spleantime_show.css?v=<?php echo $settings->appVersion; ?>" type="text/css"/>
<div class="pageheader">
    <div class="pageicon"><span class="fa fa-home"></span></div>
    <div class="pagetitle">
        <div class="row">
            <div class="col-lg-8">
                <h1><?php echo $this->__("headlines.project_list_my"); ?></h1>
				<h5><?php echo $this->__("headlines.all_open_data"); ?></h5>
				<br
            </div>
        </div>
    </div>
</div>
</div>


<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

        <div class="row">
			<div class="col-lg-5 maxheight">
				<div class="col-lg-12">
					<?php $this->displaySubmodule('mydashboard-burning_tickets') ?>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="row">
				<div class="col-lg-6">
					<?php $this->displaySubmodule('mydashboard-next_tickets') ?>

				</div>

				<div class="col-lg-6 normargin">
					<?php $this->displaySubmodule('mydashboard-my_projects') ?>

				</div>

				<div class="col-lg-6">
					<?php $this->displaySubmodule('mydashboard-milestones') ?>
				</div>

				<div class="col-lg-6 normargin">
					<?php $this->displaySubmodule('mydashboard-changed_tickets') ?>

				</div>
				</div>
			</div>
		</div>

	</div>
</div>


<script type="text/javascript">

   jQuery(document).ready(function() {

       leantime.dashboardController.prepareHiddenDueDate();
       leantime.ticketsController.initEffortDropdown();
       leantime.ticketsController.initMilestoneDropdown();
       leantime.ticketsController.initStatusDropdown();

       leantime.dashboardController.initProgressChart("chart-area", <?php echo round($projectProgress['percent']); ?>, <?php echo round((100 - $projectProgress['percent'])); ?>);

       <?php if($sprintBurndown != []){ ?>

           //leantime.dashboardController.initBurndown([<?php foreach($sprintBurndown as $value) echo "'".$value['date']."',"; ?>], [<?php foreach($sprintBurndown as $value) echo "'".round($value['plannedNum'], 2)."',"; ?>], [ <?php foreach($sprintBurndown as $value)  { if($value['actualNum'] !== '') echo "'".$value['actualNum']."',"; };  ?> ]);
           leantime.dashboardController.initChartButtonClick('HourlyChartButton', [<?php foreach($sprintBurndown as $value) echo "'".$value['plannedHours']."',"; ?>], [ <?php foreach($sprintBurndown as $value) { if($value['actualHours'] !== '') echo "'".round($value['actualHours'])."',"; };  ?> ]);
           leantime.dashboardController.initChartButtonClick('EffortChartButton', [<?php foreach($sprintBurndown as $value) echo "'".$value['plannedEffort']."',"; ?>], [ <?php foreach($sprintBurndown as $value)  { if($value['actualEffort'] !== '') echo "'".$value['actualEffort']."',"; };  ?> ]);
           leantime.dashboardController.initChartButtonClick('NumChartButton', [<?php foreach($sprintBurndown as $value) echo "'".$value['plannedNum']."',"; ?>], [ <?php foreach($sprintBurndown as $value)  { if($value['actualNum'] !== '') echo "'".$value['actualNum']."',"; };  ?> ]);

       <?php } ?>

       <?php if($backlogBurndown != []){ ?>

           //leantime.dashboardController.initBacklogBurndown([<?php foreach($backlogBurndown as $value) echo "'".$value['date']."',"; ?>], [ <?php foreach($backlogBurndown as $value)  { if($value['actualNum'] !== '') echo "'".$value['actualNum']."',"; };  ?> ]);

           leantime.dashboardController.initBacklogChartButtonClick('HourlyChartButton', [ <?php foreach($backlogBurndown as $value) { if($value['actualHours'] !== '') echo "'".round($value['actualHours'])."',"; };  ?> ]);
           leantime.dashboardController.initBacklogChartButtonClick('EffortChartButton', [ <?php foreach($backlogBurndown as $value)  { if($value['actualEffort'] !== '') echo "'".$value['actualEffort']."',"; };  ?> ]);
           leantime.dashboardController.initBacklogChartButtonClick('NumChartButton', [ <?php foreach($backlogBurndown as $value)  { if($value['actualNum'] !== '') echo "'".$value['actualNum']."',"; };  ?> ]);

       <?php } ?>

       <?php if(isset($_SESSION['userdata']['settings']["modals"]["dashboard"]) === false || $_SESSION['userdata']['settings']["modals"]["dashboard"] == 0){  ?>

           leantime.helperController.showHelperModal("dashboard", 500, 700);

       <?php
            //Only show once per session
            $_SESSION['userdata']['settings']["modals"]["dashboard"] = 1;
       } ?>

    });

</script>