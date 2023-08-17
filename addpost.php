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
 * Add post.
 *
 * @package    local_dbapis
 * @copyright  2023 Your Name <you@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/dbapis/addpost.php'));
$PAGE->set_pagelayout('standard');

$strtitle = get_string('pluginname', 'local_dbapis');
$strheading = get_string('addpost', 'local_dbapis');

$PAGE->set_title($strtitle);
$PAGE->set_heading($strtitle);

// Add breadcrumbs.
$navbar = $PAGE->navbar;
$navbar->add($strtitle, new moodle_url('/local/dbapis/'));
$navbar->add($strheading)->make_active();

require_login();

if (isguestuser()) {
    throw new moodle_exception('noguest');
}

$messageform = new \local_dbapis\form\message_form();

if ($data = $messageform->get_data()) {

    // We are getting the user input as is.
    // TODO: Ensure user input is safe to use.
    $message = required_param('message', PARAM_RAW);

    // We are just displaying the form data here.
    // TODO: Save the data to the database.
    echo $OUTPUT->header();

    echo html_writer::start_tag('div', ['class' => 'border p-3 my-3']);
    echo $message;
    echo html_writer::end_tag('div');

    echo html_writer::link($PAGE->url, get_string('continue'), ['class' => 'btn btn-link']);

    echo $OUTPUT->footer();

    exit;
}

echo $OUTPUT->header();
echo $OUTPUT->heading($strheading, 2);

$messageform->display();

echo $OUTPUT->footer();
