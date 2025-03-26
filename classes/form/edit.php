<?php

namespace local_message\form;

// moodleform is defined in formslib.php
require_once($CFG->libdir . '/formslib.php');

class edit extends \moodleform
{
    public function definition()
    {
        $mform = $this->_form;

        $mform->addElement('text', 'messagetext', get_string('messagetext', 'local_message'));
        $mform->setType('messagetext', PARAM_NOTAGS);
        $mform->setDefault('messagetext', get_string('messagedefault', 'local_message'));

        $choises = [];
        $choises['3'] = \core\output\notification::NOTIFY_INFO;
        $choises['0'] = \core\output\notification::NOTIFY_WARNING;
        $choises['2'] = \core\output\notification::NOTIFY_ERROR;
        $choises['1'] = \core\output\notification::NOTIFY_SUCCESS;

        $mform->addElement('select', 'messagetype', get_string('messagetype', 'local_message'), $choises);
        $mform->setType('messagetype', PARAM_INT);
        $mform->setDefault('messagetype', 'info');

        $this->add_action_buttons();
    }

    // Custom validation should be added here.
    function validation($data, $files)
    {
        return [];
    }
}
