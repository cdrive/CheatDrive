<?php
/**
 * @copyright Copyright (c) 2017 Thomas Citharel <tcit@tcit.fr>
 *
 * @author Thomas Citharel <tcit@tcit.fr>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\DropAccount\Settings;

use OCA\DropAccount\AppInfo\Application;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IGroupManager;
use OCP\IUserManager;
use OCP\IUserSession;
use OCP\Settings\ISettings;

class Personal implements ISettings {

	/** @var Application */
	private $app;

	/** @var IUserSession */
	private $userSession;

	/**
	 * @var IUserManager
	 */
	private $userManager;

	/**
	 * @var IGroupManager
	 */
	private $groupManager;

	public function __construct(Application $app, IUserSession $userSession, IUserManager $userManager, IGroupManager $groupManager) {
		$this->app = $app;
		$this->userSession = $userSession;
		$this->userManager = $userManager;
		$this->groupManager = $groupManager;
	}

	/**
	 * @return TemplateResponse returns the instance with all parameters set, ready to be rendered
	 * @since 9.1
	 */
	public function getForm()
	{
		$templateOwner = $this->app->getContainer()->getAppName();
		$templateName = 'personal';
		$onlyUser = $this->userManager->countUsers() < 2;
		$onlyAdmin = $this->groupManager->get('admin')->count() < 2 && $this->groupManager->isAdmin($this->userSession->getUser()->getUID());

		return new TemplateResponse($templateOwner, $templateName, [
			'onlyUser' => $onlyUser,
			'onlyAdmin' => $onlyAdmin,
		], '');
	}

	/**
	 * @return string the section ID, e.g. 'sharing'
	 * @since 9.1
	 */
	public function getSection()
	{
		return 'drop_account';
	}

	/**
	 * @return int whether the form should be rather on the top or bottom of
	 * the admin section. The forms are arranged in ascending order of the
	 * priority values. It is required to return a value between 0 and 100.
	 *
	 * E.g.: 70
	 * @since 9.1
	 */
	public function getPriority()
	{
		return 40;
	}
}
