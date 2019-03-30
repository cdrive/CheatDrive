/**
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Thomas Citharel <tcit@tcit.fr>
 * @copyright 2017
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


/** global: OC */
$(document).ready(function() {

	var deleteAccountButton = $('#deleteaccount');

	var iconDelete = $('span.icon-delete');
	var iconLoading = $('span.icon-loading-small');
	var deletingDataMessage = $('p.deleting-data-msg');

	/**
	 * Show and hide status when deleting account
	 * @param toggle boolean
	 * @private
	 */
	function _deleteAccountToggleView(toggle) {
		if (toggle) {
			iconLoading.show();
			iconDelete.hide();
			deletingDataMessage.show();
			deleteAccountButton.attr('disabled','disabled');
		} else {
			iconLoading.hide();
			iconDelete.show();
			deleteAccountButton.removeAttr('disabled');
			deletingDataMessage.hide();
		}
	}

	/**
	 * Do the actual delete call
	 * @private
	 */
	function _deleteAccount() {
		if (OC.PasswordConfirmation.requiresPasswordConfirmation()) {
			OC.PasswordConfirmation.requirePasswordConfirmation(_.bind(_deleteAccount, this));
			return;
		}

		_deleteAccountToggleView(true);

		$.ajax(OC.generateUrl('/apps/drop_account/delete'), {
			method: 'POST',
			data: {
				confirm: $('#drop_account_confirm').prop('checked'),
			}
		}).done(function() {
			OC.reload();
		}).fail(function() {
			_deleteAccountToggleView(false);
			OC.Notification.showTemporary(t('drop_account', 'Error while deleting the account'));
		});
	}

	/**
	 * Show and hide the delete button
	 */
	$('#drop_account_confirm').change(function () {
		if (this.checked) {
			deleteAccountButton.removeAttr('disabled');
		} else {
			deleteAccountButton.attr('disabled','disabled');
		}
	});

	deleteAccountButton.on('click', _deleteAccount);
});
