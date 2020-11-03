<?php

namespace leantime\domain\controllers {

    use leantime\core;
    use leantime\domain\repositories;
    use leantime\domain\services;
	use pdo;

    class newProject
    {

        /**
         * run - display template and edit data
         *
         * @access public
         */
        public function run()
        {

            if(!isset($_SESSION['lastPage'])) {
                $_SESSION['lastPage'] = BASE_URL."/projects/showAll";
            }

            $tpl = new core\template();
            $projectRepo = new repositories\projects();
            $leancanvasRepo = new repositories\leancanvas();
            $ideaRepo = new repositories\ideas();
            $ticketService = new services\tickets();
            $projectService = new services\projects();
            $language = new core\language();

            if(!core\login::userIsAtLeast("clientManager")) {
                $tpl->display('general.error');
                exit();
            }
			$psettings = array();
            $psettings['allow_more_stati']=$ticketService->getNewStatusLabels();

            $msgKey = '';
            $values = array(
                'id' => '',
                'name' => '',
                'details' => '',
                'clientId' => '',
                'hourBudget' => '',
                'assignedUsers' => array($_SESSION['userdata']['id']),
                'dollarBudget' => '',
                'state' => '',
				'psettings' => $psettings
            );

            if (isset($_POST['save']) === true) {

                if (!isset($_POST['hourBudget']) || $_POST['hourBudget'] == '' || $_POST['hourBudget'] == null) {
                    $hourBudget = '0';
                } else {
                    $hourBudget = $_POST['hourBudget'];
                }


                if (isset($_POST['editorId']) && count($_POST['editorId'])) {
                    $assignedUsers = $_POST['editorId'];
                } else {
                    $assignedUsers = array();
                }

				if(empty($_POST['psettings']))
				{
					$psettings = serialize(array());
				}
				else{
					$psettings = serialize($_POST['psettings']);
				}


                $mailer = new core\mailer();

                $values = array(
                    'name' => $_POST['name'],
                    'details' => $_POST['details'],
                    'clientId' => $_POST['clientId'],
                    'hourBudget' => $hourBudget,
                    'assignedUsers' => $assignedUsers,
                    'dollarBudget' => $_POST['dollarBudget'],
                    'state' => $_POST['projectState'],
					'psettings' => $psettings
                );

                if ($values['name'] === '') {

                    $tpl->setNotification($language->__("notification.no_project_name"), 'error');

                } elseif ($values['clientId'] === '') {

                    $tpl->setNotification($language->__("notification.no_client"), 'error');

                } else {

                    $projectName = $values['name'];
                    $id = $projectRepo->addProject($values);
                    $projectService->changeCurrentSessionProject($id);



                    $users = $projectRepo->getUsersAssignedToProject($id);

                    $mailer->setSubject($language->__('email_notifications.project_created_subject'));
                    $actual_link = BASE_URL."/projects/showProject/" . $id . "";
                    $message = sprintf($language->__('email_notifications.project_created_message'), $actual_link, $id, $projectName, $_SESSION["userdata"]["name"]);
                    $mailer->setHtml($message);

                    $to = array();

                    foreach ($users as $user) {

                        if ($user["notifications"] != 0) {
                            $to[] = $user["username"];
                        }
                    }

                    $mailer->sendMail($to, $_SESSION["userdata"]["name"]);

                    //Take the old value to avoid nl character
                    $values['details'] = $_POST['details'];

                    $tpl->setNotification(sprintf($language->__('notifications.project_created_successfully'), BASE_URL.'/leancanvas/simpleCanvas/'), 'success');
					$_SESSION['currentProject'] = $id;
					//set status tabs
					$this->updateSettingsProjectStatusLabels($_POST['psettings']['allow_more_stati']);

                    $tpl->redirect(BASE_URL."/projects/showProject/". $id);

                }


                $tpl->assign('values', $values);

            }



            $tpl->assign('project', $values);
            $user = new repositories\users();
            $clients = new repositories\clients();



            if(core\login::userIsAtLeast("manager")) {
                $tpl->assign('availableUsers', $user->getAll());
                $tpl->assign('clients', $clients->getAll());
            }else{
                $tpl->assign('availableUsers', $user->getAllClientUsers(core\login::getUserClientId()));
                $tpl->assign('clients', array($clients->getClient(core\login::getUserClientId())));
            }

            $tpl->assign('info', $msgKey);

            $tpl->display('projects.newProject');


        }

		/**
		 * @param string $ticketlabels string
		 * @return bool
		 */
		private function updateSettingsProjectStatusLabels($ticketlabels="")
		{
			$this->db = core\db::getInstance();
			$ticketlabels = trim($ticketlabels);
			$ticketlabelsArray = explode("\n",$ticketlabels);
			$max = count($ticketlabelsArray)-1;
			$save = array();
			#print_r($ticketlabelsArray);

			foreach ($ticketlabelsArray as $k=>$v)
			{
				//last one
				if ($max == $k)
				{
					$save["-1"]=$v;
					continue;
				}

				//normal one
				$save[$k]=$v;
			}

			$saveSer = serialize($save);

			$sql = "INSERT INTO zp_settings
						SET
						`value` = :save,
						 `key` = :key
					";

			$stmn = $this->db->database->prepare($sql);
			$stmn->bindvalue(':key', "projectsettings.".$_SESSION['currentProject'].".ticketlabels", PDO::PARAM_STR);
			$stmn->bindvalue(':save', $saveSer, PDO::PARAM_STR);

			$stmn->execute();
			#exit();
			$stmn->closeCursor();

			return true;
		}

    }

}
