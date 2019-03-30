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

namespace OCA\DropAccount\Controller;

use OCP\Activity\IManager;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Http\Response;
use OCP\IGroupManager;
use OCP\ILogger;
use OCP\IRequest;
use OCP\IUser;
use OCP\IUserSession;

class AccountController extends Controller {

	/** @var IUserSession */
	protected $userSession;

	/** @var ILogger */
	protected $logger;

	/** @var IManager */
	protected $activityManager;

	/** @var IGroupManager */
	protected $groupManager;

	/**
	 * constructor of the controller
	 *
	 * @param string $appName
	 * @param IRequest $request
	 * @param IUserSession $userSession
	 * @param ILogger $logger
	 * @param IManager $activityManager
	 * @param IGroupManager $groupManager
	 */
	public function __construct($appName,
								IRequest $request,
								IUserSession $userSession,
								ILogger $logger,
								IManager $activityManager,
								IGroupManager $groupManager) {
		parent::__construct($appName, $request);
		$this->userSession = $userSession;
		$this->logger = $logger;
		$this->activityManager = $activityManager;
		$this->groupManager = $groupManager;
	}

	/**
	 * @NoAdminRequired
	 * @PasswordConfirmationRequired
	 *
	 * @return Response
	 */
	public function delete() {
		$user = $this->userSession->getUser();
		$username = $user->getUID();
		try {
			$event = $this->createActivity($user);
			$this->activityManager->publish($event);
		} catch (\Exception $e) {
			$this->logger->error('There has been an issue sending the delete activity to admins');
			$this->logger->logException($e, ['app' => 'drop_account']);
		}

		if ($user->delete()) {
			$this->logger->info(sprintf('User %s deleted it\'s account', $username));

			$this->userSession->logout();
			return new JSONResponse([], 200);
		}
		return new JSONResponse([], 200);
	}

	/**
	 * @param IUser $user
	 * @return \OCP\Activity\IEvent
	 */
	protected function createActivity(IUser $user)
	{
		$username = $user->getUID();
		$event = $this->activityManager->generateEvent();
		$event
			->setApp('drop_account')
			->setType('account_deletion')
			->setObject('user', 0, $username)
			->setAuthor($username)
			->setSubject('account_self_deletion', ['name' => $username, 'type' => 'account'])
		;

		$admins = $this->groupManager->get('admin')->getUsers();
		foreach ($admins as $admin) {
			$event->setAffectedUser($admin->getUID());
		}

		return $event;
	}
}
