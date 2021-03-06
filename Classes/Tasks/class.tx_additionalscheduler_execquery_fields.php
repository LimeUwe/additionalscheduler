<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 CERDAN Yohann (cerdanyohann@yahoo.fr)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
class tx_additionalscheduler_execquery_fields extends \Sng\Additionalscheduler\AdditionalFieldProviderInterface {

    public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {

        if (empty($taskInfo['additionalscheduler_exec_query'])) {
            if ($parentObject->CMD == 'edit') {
                $taskInfo['additionalscheduler_exec_query'] = $task->query;
            } else {
                $taskInfo['additionalscheduler_exec_query'] = '';
            }
        }

        if (empty($taskInfo['additionalscheduler_exec_email'])) {
            if ($parentObject->CMD == 'edit') {
                $taskInfo['additionalscheduler_exec_email'] = $task->email;
            } else {
                $taskInfo['additionalscheduler_exec_email'] = '';
            }
        }

        if (empty($taskInfo['additionalscheduler_exec_emailtemplate'])) {
            if ($parentObject->CMD == 'edit') {
                $taskInfo['additionalscheduler_exec_emailtemplate'] = $task->emailtemplate;
            } else {
                $taskInfo['additionalscheduler_exec_emailtemplate'] = '';
            }
        }

        $additionalFields = array();

        $fieldID = 'task_path';
        $fieldCode = '<textarea name="tx_scheduler[additionalscheduler_exec_query]" id="' . $fieldID . '" cols="50" rows="10" />' . $taskInfo['additionalscheduler_exec_query'] . '</textarea>';
        $additionalFields[$fieldID] = array(
            'code'     => $fieldCode,
            'label'    => 'LLL:EXT:additional_scheduler/Resources/Private/Language/locallang.xml:query',
            'cshKey'   => 'additional_scheduler',
            'cshLabel' => $fieldID
        );

        $fieldID = 'task_email';
        $fieldCode = '<input type="text" name="tx_scheduler[additionalscheduler_exec_email]" id="' . $fieldID . '" value="' . $taskInfo['additionalscheduler_exec_email'] . '" size="50" />';
        $additionalFields[$fieldID] = array(
            'code'     => $fieldCode,
            'label'    => 'LLL:EXT:additional_scheduler/Resources/Private/Language/locallang.xml:email',
            'cshKey'   => 'additional_scheduler',
            'cshLabel' => $fieldID
        );

        $fieldID = 'task_emailtemplate';
        $fieldCode = '<input type="text" name="tx_scheduler[additionalscheduler_exec_emailtemplate]" id="' . $fieldID . '" value="' . $taskInfo['additionalscheduler_exec_emailtemplate'] . '" size="50" />';
        $additionalFields[$fieldID] = array(
            'code'     => $fieldCode,
            'label'    => 'LLL:EXT:additional_scheduler/Resources/Private/Language/locallang.xml:emailtemplate',
            'cshKey'   => 'additional_scheduler',
            'cshLabel' => $fieldID
        );

        return $additionalFields;
    }

    public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
        $result = TRUE;
        if (empty($submittedData['additionalscheduler_exec_query'])) {
            $parentObject->addMessage($GLOBALS['LANG']->sL('LLL:EXT:additional_scheduler/Resources/Private/Language/locallang.xml:savedirerror'), \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $result = FALSE;
        }
        return $result;
    }

    public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task) {
        $task->query = $submittedData['additionalscheduler_exec_query'];
        $task->email = $submittedData['additionalscheduler_exec_email'];
        $task->emailtemplate = $submittedData['additionalscheduler_exec_emailtemplate'];
    }

}

?>
