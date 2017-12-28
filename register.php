<?php

$REGISTER_LTI2 = array(
"name" => "External Tool (LTI)",
"FontAwesome" => "fa-globe",
"short_name" => "LTI Proxy",
"description" => "Launch another Learning Tools Interoperability (LTI) tool.
Supports grade-passback and in-tool analytics.",
"messages" => array("launch", "launch_grade"),
    "privacy_level" => "public",  // anonymous, name_only, public
    "license" => "Apache",
    "languages" => array(
        "English"
    ),
    "analytics" => array(
        "internal"
    ),
    "source_url" => "https://github.com/tsugitools/ltitool",
    // For now Tsugi tools delegate this to /lti/store
    "placements" => array(
        /*
        "course_navigation", "homework_submission",
        "course_home_submission", "editor_button",
        "link_selection", "migration_selection", "resource_selection",
        "tool_configuration", "user_navigation"
        */
    ),
    "screen_shots" => array(
        "store/screen-01.png",
        "store/screen-02.png",
        "store/screen-03.png",
        "store/screen-analytics.png"
    )
);

