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

 namespace local_message;

 
class manager
{
    public function add_message($message_text, $message_type)
    {
        $record_to_insert = new \stdClass();
        $record_to_insert->messagetext = $message_text;
        $record_to_insert->messagetype = $message_type;
        try {
            global $DB;
            return $DB->insert_record('local_message', $record_to_insert, false);
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return false;
        }
    }
    public function get_messages($userid)
    {

        $params = [
            'userid' => $userid
        ];
        $sql = "SELECT lm.id, lm.messagetext, lm.messagetype 
                    FROM {local_message} lm
                    LEFT OUTER JOIN {local_message_read} lmr ON lm.id = lmr.messageid AND lmr.userid = :userid
                    WHERE lmr.userid IS NULL";

        try {
            global $DB;
            return $DB->get_records_sql($sql, $params);
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return false;
        }
    }
    public function mark_as_read($messageid, $userid)
    {
        
        $record_to_insert = new \stdClass();
        $record_to_insert->messageid = $messageid;
        $record_to_insert->userid = $userid;
        try {
            global $DB;
            return $DB->insert_record('local_message_read', $record_to_insert, false);
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return false;
        }
    }
    public function delete_message($messageid)
    {
        $params = [
            'id' => $messageid
        ];
        $sql = "DELETE FROM {local_message} WHERE id = :id";
        try {
            global $DB;
            return $DB->execute($sql, $params);
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return false;
        }
    }
}
