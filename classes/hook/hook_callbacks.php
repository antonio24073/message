<?php
namespace local_message\hook;
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
    }
}


// global $PAGE;
// $renderer = $PAGE->get_renderer('core', 'admin');
// $hook = new \core\hook\output\before_footer_html_generation($renderer);
// $hook->add_html("<h1>olá mundo</h1>");
// \core\di::get(\core\hook\manager::class)->dispatch($hook);
