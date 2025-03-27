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

use core\oauth2\rest;

defined('MOODLE_INTERNAL') || die();

global $CFG;

use \local_message\manager;
use \core\output\notification;

class local_manager_test extends advanced_testcase
{
    public function test_add_message()
    {
        $this->resetAfterTest();
        $this->setUser(2);
        $manager = new manager();
        $messages = $manager->get_messages(2);
        $this->assertEmpty($messages);

        $type = notification::NOTIFY_SUCCESS;
        $message = 'Test message';
        $result = $manager->add_message($message, $type);

        $this->assertTrue($result);
        $messages = $manager->get_messages(2);
        $this->assertNotEmpty($messages);

        $this->assertCount(1, $messages);
        $messages = array_pop($messages);

        $this->assertEquals($message, $messages->messagetext);
        $this->assertEquals($type, $messages->messagetype);
    }
    public function test_get_message()
    {
        $this->resetAfterTest();
        $this->setUser(2);
        $manager = new manager();

        $type = notification::NOTIFY_SUCCESS;
        $message = 'Test message';
        $result = $manager->add_message($message . ' 1', $type);
        $result = $manager->add_message($message . ' 2', $type);
        $result = $manager->add_message($message . ' 3', $type);
    }
}
