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

use core\message\message;

require_once(__DIR__.'/../../config.php');

$PAGE->set_url(new moodle_url('/local/message/manage.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('manage_messages_title', 'local_message'));
$PAGE->set_heading(get_string('manage_messages_title', 'local_message'));
// $PAGE->set_pagelayout('standard');
// $PAGE->set_pagetype('manage-messages');
// $PAGE->set_url($CFG->wwwroot.'/local/message/manage.php');


echo $OUTPUT->header();

$messages = $DB->get_records('local_message', null, 'id');

$messages = array_values($messages);
$editurl = new moodle_url('/local/message/edit.php');

$template_context = (object) [
    'messages' => $messages,
    'editurl' => $editurl
];

echo $OUTPUT->render_from_template('local_message/manage', $template_context);

echo $OUTPUT->footer();
