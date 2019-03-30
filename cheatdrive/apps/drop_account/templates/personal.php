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

script('drop_account', 'personal');
style('drop_account', 'personal');

?>

<div class="section">
    <h2 data-anchor-name="drop-account"><?php p($l->t('Delete my account')); ?></h2>
    <div id="delete-account-settings">
			<p class="settings-hint">
				<?php p($l->t('Deleting your account will delete all your files and data from the apps you use, such as calendar and contacts.')) ?>
				<b><?php p($l->t('This action is irreversible!')) ?></b>
			</p>
			<p class="settings-hint">
				<?php p($l->t('After confirming the deletion of your account, you will be redirected to the login page.')); ?>
			</p>
			<?php if ($_['onlyUser']) { ?>
				<div class="warnings">
					<?php p($l->t("You are the only user of this instance, you can't delete your account.")); ?>
				</div>
			<?php }
			if ($_['onlyAdmin']) { ?>
				<div class="warnings">
					<?php p($l->t("You are the only admin of this instance, you can't delete your account.")); ?>
				</div>
			<?php }
			if ((!$_['onlyUser']) && (!$_['onlyAdmin'])) { ?>
				<h3><?php p($l->t('Do you really wish to delete your account?')); ?></h3>
				<input type="checkbox" id="drop_account_confirm" name="drop_account_confirm" value="0" class="checkbox" />
					<label for="drop_account_confirm"><?php p($l->t('Check this to confirm the deletion request')); ?></label>
					<br />
				<p>
					<button class="button" id="deleteaccount" disabled="disabled">
						<span class="icon icon-delete"></span>
						<span class="icon icon-loading-small" style="display: none"></span>
						<span><?php p($l->t('Delete my account')); ?></span>
					</button>
				</p>
				<p class="deleting-data-msg"><?php p($l->t('Deleting your data…')); ?></p>
			<?php } ?>
	</div>
</div>
