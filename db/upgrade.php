<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin upgrade steps are defined here.
 *
 * @package     local_dbapis
 * @category    upgrade
 * @copyright   2023 Your Name <you@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Execute local_dbapis upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_dbapis_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2023081701) {

        // Define table local_dbapis_history to be created.
        $table = new xmldb_table('local_dbapis_history');

        // Adding fields to table local_dbapis_history.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('messageid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('message', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '1');

        // Adding keys to table local_dbapis_history.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_dbapis_history.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Now copy the data from table local_dbapis to local_dbapis_history.
        $rs = $DB->get_recordset('local_dbapis');

        foreach ($rs as $record) {
            $record->messageid = $record->id; // The id is messageid.
            $record->id = null; // New id for this record will be generated.
            $DB->insert_record('local_dbapis_history', $record);
        }

        $rs->close();

        // Dbapis savepoint reached.
        upgrade_plugin_savepoint(true, 2023081701, 'local', 'dbapis');
    }

    return true;
}
