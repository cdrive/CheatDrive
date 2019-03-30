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

namespace OCA\DropAccount\Activity;

use OCP\Activity\IEvent;
use OCP\Activity\IEventMerger;
use OCP\Activity\IManager;
use OCP\Activity\IProvider;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\L10N\IFactory;

class Provider implements IProvider {
	/**
	 * @var IFactory
	 */
	private $languageFactory;

	/**
	 * @var IURLGenerator
	 */
	private $url;

	/** @var IL10N */
	protected $l;

	/**
	 * @var IEventMerger
	 */
	private $eventMerger;

	/**
	 * @var IManager
	 */
	private $activityManager;

	/**
	 * Provider constructor.
	 *
	 * @param IFactory $languageFactory
	 * @param IURLGenerator $url
	 * @param IEventMerger $eventMerger
	 * @param IManager $activityManager
	 */
	public function __construct(IFactory $languageFactory, IURLGenerator $url, IEventMerger $eventMerger, IManager $activityManager) {
		$this->languageFactory = $languageFactory;
		$this->url = $url;
		$this->eventMerger = $eventMerger;
		$this->activityManager = $activityManager;
	}

	/**
	 * @param string $language The language which should be used for translating, e.g. "en"
	 * @param IEvent $event The current event which should be parsed
	 * @param IEvent|null $previousEvent A potential previous event which you can combine with the current one.
	 *                                   To do so, simply use setChildEvent($previousEvent) after setting the
	 *                                   combined subject on the current event.
	 * @return IEvent
	 * @throws \InvalidArgumentException Should be thrown if your provider does not know this event
	 * @since 11.0.0
	 */
	public function parse($language, IEvent $event, IEvent $previousEvent = null) {
		if ($event->getApp() !== 'drop_account' || $event->getType() !== 'account_deletion') {
			throw new \InvalidArgumentException();
		}

		$this->l = $this->languageFactory->get('drop_account', $language);
		$event->setIcon($this->url->imagePath('core', 'actions/delete.svg'));

		return $this->parseShortVersion($event, $previousEvent);
	}

	/**
	 * @param IEvent $event
	 * @param IEvent $previousEvent
	 * @return IEvent
	 * @throws \InvalidArgumentException
	 * @since 11.0.0
	 */
	public function parseShortVersion(IEvent $event, IEvent $previousEvent = null) {
		$parameters = $event->getSubjectParameters();
		if ($previousEvent === null) {
			$subject = $this->l->t('{name} deleted its account');
		} else {
			$subject = $this->l->t('{name} deleted their account');
		}
		$this->setSubjects($event, $subject, ['name' => $parameters]);
		return $this->eventMerger->mergeEvents('name', $event, $previousEvent);
	}

	/**
	 * @param IEvent $event
	 * @param string $subject
	 * @param array $parameters
	 * @throws \InvalidArgumentException
	 */
	protected function setSubjects(IEvent $event, $subject, array $parameters) {
		$placeholders = $replacements = [];
		foreach ($parameters as $placeholder => $parameter) {
			$placeholders[] = '{' . $placeholder . '}';
			$replacements[] = $parameter['name'];
		}
		$event->setParsedSubject(str_replace($placeholders, $replacements, $subject))
			->setRichSubject($subject, $parameters)
		;
	}

}
