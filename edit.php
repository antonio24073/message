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
 * Version details
 *
 * @package    local_message
 * @copyright  2025 Antonio Augusto (http://obawp.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


use \local_message\form\edit;   

require_once(__DIR__.'/../../config.php');

$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Edit Message');
$PAGE->set_heading('Edit Message');




// require_once(__DIR__.'/classes/form/edit.php');


$mform = new edit();

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/message/manage.php', get_string('cancelled_message', 'local_message'));
} else if ($fromform = $mform->get_data()) {
    $record_to_insert = new \stdClass();
    $record_to_insert->messagetext = $fromform->messagetext;
    $record_to_insert->messagetype = $fromform->messagetype;
    $DB->insert_record('local_message', $record_to_insert);
} 


echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();

