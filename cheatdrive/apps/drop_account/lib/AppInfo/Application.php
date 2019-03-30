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

namespace OCA\DropAccount\AppInfo;

use OCA\DropAccount\Controller\SettingsController;
use OCP\AppFramework\App;
use OCP\ILogger;

class Application extends App {
	public function __construct ()
	{
		parent::__construct('drop_account');

		$container = $this->getContainer();
		$container->registerAlias('SettingsController', SettingsController::class);
	}
}
