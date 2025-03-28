<?php

use \local_message\form\edit;
use \local_message\manager;
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

require_once __DIR__ . '/../../config.php';

$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Edit Message');
$PAGE->set_heading('Edit Message');

$messageid = optional_param('messageid', null, PARAM_INT);

$mform = new edit();

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . '/local/message/manage.php', get_string('cancelled_message', 'local_message'));
} else if ($fromform = $mform->get_data()) {
    $manager  = new manager();
    if($fromform->id) {
        $messages = $manager->update_message($fromform->id, $fromform->messagetext, $fromform->messagetype);
        redirect($CFG->wwwroot . '/local/message/manage.php', get_string('message_updated', 'local_message'));
    }
    $messages = $manager->add_message($fromform->messagetext, $fromform->messagetype);
    redirect($CFG->wwwroot . '/local/message/manage.php', get_string('message_added', 'local_message'));
}

if($messageid) {
    $manager  = new manager();
    $message  = $manager->get_message($messageid);
    if(!$message) {
        redirect($CFG->wwwroot . '/local/message/manage.php', get_string('message_not_found', 'local_message'));
    }
    $mform->set_data($message);
}

echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();
