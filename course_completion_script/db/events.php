<?php
defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname'   => '\core\event\course_completed',
        'callback'    => 'local_course_completion_script_observer::course_completed',
    ],
];

?>