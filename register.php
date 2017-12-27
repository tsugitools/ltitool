<?php

$REGISTER_LTI2 = array(
"name" => "External Tool",
"FontAwesome" => "fa-globe",
"short_name" => "LTI Proxy",
"description" => "Launch another Learning Tools Interoperability (LTI) tool.  Supports grade-passback and in-tool analytics.",
"messages" => array("launch"),
    "privacy_level" => "public",  // anonymous, name_only, public
    "license" => "Apache",
    "languages" => array(
        "English"
    ),
    "analytics" => array(
        "internal"
    ),
    "source_url" => "https://github.com/tsugitools/lti_tool",
    "placements" => array(
        "course_navigation", "editor_button", "homework_submission",
        "link_selection"
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

