<?php

namespace local_message\hook;

use \local_message\manager;
use \core\notification;
use \core\hook\output\before_footer_html_generation;

class hook_callbacks
{

    //add html block in the bottom in all pages
    public static function before_footer_hook(before_footer_html_generation $hook): void
    {
        $hook->add_html("before footer hook");

        // $message = "Example messages";
        // \core\notification::error($message);
        // \core\notification::warning($message);
        // \core\notification::info($message);
        // \core\notification::success($message);

        global $PAGE;

        if ($PAGE->pagetype == 'my-index') {
            global $USER;

            $manager = new manager();
            $messages = $manager->get_messages($USER->id);

            // $messages = $DB->get_records('local_message');
            foreach ($messages as $message) {
                switch ($message->messagetype) {
                    case 0:
                        notification::warning($message->messagetext);
                        break;
                    case 1:
                        notification::success($message->messagetext);
                        break;
                    case 2:
                        notification::error($message->messagetext);
                        break;
                    case 3:
                        notification::info($message->messagetext);
                        break;
                }

                $manager->mark_as_read($USER->id, $message->id);
            }
        }
    }
}

