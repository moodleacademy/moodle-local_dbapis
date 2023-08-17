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
$PAGE->set_url(new moodle_url('/local/dbapis/search.php'));
$PAGE->set_pagelayout('standard');

$strtitle = get_string('pluginname', 'local_dbapis');
$strheading = get_string('searchposts', 'local_dbapis');

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

$searchform = new \local_dbapis\form\search_form();

if ($data = $searchform->get_data()) {

    // We are getting the user input as is.
    // TODO: Ensure user input is safe to use.
    $searchterm = required_param('searchterm', PARAM_RAW);

    // We are just displaying the form data here.
    // TODO: Query the database for the search term.
    echo $OUTPUT->header();

    echo html_writer::start_tag('div', ['class' => 'border p-3 my-3']);
    echo $searchterm;
    echo html_writer::end_tag('div');

    echo html_writer::link($PAGE->url, get_string('continue'), ['class' => 'btn btn-link']);

    echo $OUTPUT->footer();

    exit;
}

echo $OUTPUT->header();
echo $OUTPUT->heading($strheading, 2);

$searchform->display();

echo $OUTPUT->footer();
