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
 *  This file defines the search form.
 *
 * @package    local_dbapis
 * @copyright  2023 Your name <your@email>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_dbapis\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 *  Class for the search form.
 *
 * @package    local_dbapis
 * @copyright  2023 Your name <your@email>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_form extends \moodleform {
    /**
     * Define the form.
     */
    public function definition() {
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'searchterm', get_string('searchterm', 'local_dbapis')); // Add elements to your form.
        $mform->setType('searchterm', PARAM_TEXT); // Set type of element.

        $submitlabel = get_string('search');
        $mform->addElement('submit', 'submitmessage', $submitlabel);
    }
}
