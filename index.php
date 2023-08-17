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
 * Index file
 *
 * @package    local_dbapis
 * @copyright  2023 Your Name <you@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/dbapis/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_dbapis'));

require_login();

if (isguestuser()) {
    throw new moodle_exception('noguest');
}

echo $OUTPUT->header();

echo html_writer::start_tag('div', array('class' => 'p-3 my-3'));

echo html_writer::link(
    new moodle_url('/local/dbapis/addpost.php'),
    get_string('addpost', 'local_dbapis'),
    ['class' => 'btn btn-link d-block text-left']
);

echo html_writer::link(
    new moodle_url('/local/dbapis/search.php'),
   get_string('searchposts', 'local_dbapis'),
    ['class' => 'btn btn-link d-block text-left']
);

echo html_writer::end_tag('div');

echo $OUTPUT->footer();
