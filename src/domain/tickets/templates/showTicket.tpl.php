<?php

    defined('RESTRICTED') or die('Restricted access');
	$projectData = $this->get('projectData');
	if ($projectData['psettings']['ticketLayout']==1)
	{
		$this->displaySubmodule('tickets-showTicketOneView');
	}
	else
	{
		$this->displaySubmodule('tickets-showTicketClassic');
	}

?>