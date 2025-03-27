<?php

// Hook to show a message when the installation of the local_message plugin is finished.
// See db/install.php too
// https://moodledev.io/docs/4.4/apis/core/hooks#example-of-hook-creation

namespace local_message\hook;

#[\core\attribute\label('Hook dispatched at the very end of installation of local_message plugin.')]
#[\core\attribute\tags('installation')]
final class installation_finished {
    public function __construct(
    ) {
        // show message after installation
        echo get_string('installation_finished', 'local_message');
    }
}