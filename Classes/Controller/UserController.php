<?php
namespace In2\Femanager\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Alex Kellner <alexander.kellner@in2code.de>, in2code
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

/**
 * User Controller
 *
 * @package femanager
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class UserController extends \In2\Femanager\Controller\GeneralController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$users = $this->userRepository->findByUsergroups($this->settings['list']['usergroup'], $this->settings);
		$this->view->assign('users', $users);
	}

	/**
	 * action show
	 *
	 * @param \In2\Femanager\Domain\Model\User $user
	 * @dontvalidate $user
	 * @return void
	 */
	public function showAction(\In2\Femanager\Domain\Model\User $user = NULL) {
		if (!is_object($user)) {
			if (is_numeric($this->settings['show']['user'])) {
				$user = $this->userRepository->findByUid($this->settings['show']['user']);
			} elseif ($this->settings['show']['user'] == '[this]') {
				$user = $this->user;
			}
		}
		$this->view->assign('user', $user);
	}

	/**
	 * File Uploader
	 *
	 * @return void
	 */
	public function fileUploadAction() {
		$fileName = $this->div->uploadFile();
		header("Content-Type: text/plain");
		$result = array(
			'success'=> $fileName ? true : false,
			'uploadName' => $fileName
		);
		echo json_encode($result);
	}

	/**
	 * Just for showing informations
	 *
	 * @return void
	 */
	public function fileDeleteAction() {
	}

	/**
	 * Call this Action from eID to validate field values
	 *
	 * @param \string $validation			Validation string like "required, email, min(10)"
	 * @param \string $value				Given Field value
	 * @param \string $fieldname			Fieldname like "username" or "email"
	 * @return void
	 */
	public function validateAction($validation = NULL, $value = NULL, $field = NULL) {
		$validater = $this->objectManager->get('\In2\Femanager\Domain\Validator\JavaScriptValidator');
		$validater->setValidationSettingsString($validation);
		$validater->setValue($value);
		$validater->setFieldName($field);
		$isValid = $validater->validateField();
		$messages = $validater->getMessages();

		$this->view->assign('messages', $messages);
		$this->view->assign('isValid', $isValid);
	}

}
?>