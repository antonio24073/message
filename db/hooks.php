<?php

defined('MOODLE_INTERNAL') || die();

$callbacks = [
    [
        'hook' => \core\hook\output\before_footer_html_generation::class,
        'callback' => [\local_message\hook\hook_callbacks::class, 'before_footer_hook'],
        'priority' => 500,
    ],
];


// global $PAGE;
// $renderer = $PAGE->get_renderer('core', 'admin');
// $hook = new \core\hook\output\before_footer_html_generation($renderer);
// $hook->add_html("<h1>olá mundo</h1>");
// \core\di::get(\core\hook\manager::class)->dispatch($hook);