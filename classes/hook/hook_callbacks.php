<?php

namespace local_message\hook;

use \core\hook\output\before_footer_html_generation;
use stdClass;

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
            global $DB, $USER;

            $params = [
                'userid' => $USER->id
            ];
            $sql = "SELECT lm.id, lm.messagetext, lm.messagetype 
                        FROM {local_message} lm
                        LEFT OUTER JOIN {local_message_read} lmr ON lm.id = lmr.messageid
                        WHERE lmr.userid <> :userid
                        OR lmr.userid IS NULL";

            $messages = $DB->get_records_sql($sql, $params);

            // $messages = $DB->get_records('local_message');
            foreach ($messages as $message) {
                switch ($message->messagetype) {
                    case 0:
                        \core\notification::warning($message->messagetext);
                        break;
                    case 1:
                        \core\notification::success($message->messagetext);
                        break;
                    case 2:
                        \core\notification::error($message->messagetext);
                        break;
                    case 3:
                        \core\notification::info($message->messagetext);
                        break;
                }

                $readrecord = new stdClass();
                $readrecord->userid = $USER->id;
                $readrecord->messageid = $message->id;
                $readrecord->timeread = time();
                $DB->insert_record('local_message_read', $readrecord);
            }
        }
    }
}

