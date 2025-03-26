<?php

// Hook to show a message when the installation of the local_message plugin is finished.
// See class/hook/installation_finished.php too
// https://moodledev.io/docs/4.4/apis/core/hooks#example-of-hook-creation
function xmldb_local_message_install() {
    $hook = new \local_message\hook\installation_finished();
    \core\di::get(\core\hook\manager::class)->dispatch($hook);
}
