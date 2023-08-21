<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Delete post
 *
 * @package    local_dbapis
 * @copyright  2023 Your Name <you@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$id  = required_param('id', PARAM_INT); // Message id.
$returnurl = required_param('returnurl', PARAM_TEXT);

require_login();

$context = context_system::instance();

require_capability('local/dbapis:deleteanymessage', $context);

require_sesskey();

$DB->delete_records('local_dbapis', ['id' => $id]);

redirect($returnurl, get_string('postdeleted', 'local_dbapis'));
