<?php
require_once "../config.php";

use \Tsugi\Util\LTI;
use \Tsugi\Core\LTIX;
use \Tsugi\Core\Settings;
use \Tsugi\UI\SettingsForm;

// Retrieve the launch data if present
$LAUNCH = LTIX::requireData();
$p = $CFG->dbprefix;
$displayname = $USER->displayname;

if ( SettingsForm::handleSettingsPost() ) {
    header( 'Location: '.addSession('index.php') ) ;
    return;
}

$title = Settings::linkGet('title', '');
if ( strlen($title) < 1 ) $title = $LAUNCH->link->title;
$url = Settings::linkGet('url', '');
$key = Settings::linkGet('key', '');
$secret = Settings::linkGet('secret', '');
$sendName = Settings::linkGet('sendName', '');
$sendEmail = Settings::linkGet('sendEmail', '');
$newWindow = Settings::linkGet('newWindow', '');
$debug = Settings::linkGet('debug', '');
$custom = Settings::linkGet('custom', '');

// Start of the output
$OUTPUT->header();
$OUTPUT->bodyStart();
$OUTPUT->topNav();
$OUTPUT->flashMessages();

if ( $USER->instructor ) {
    $OUTPUT->welcomeUserCourse();
    SettingsForm::button(true);
    SettingsForm::start();
    echo("<p>Configure the LTI Tool<p>\n");
    SettingsForm::text('title',__('Title'));
    SettingsForm::text('url',__('URL'));
    SettingsForm::text('key',__('Key'));
    SettingsForm::text('secret',__('Secret'));
    SettingsForm::checkbox('sendName',__('Send Student Names to Tool'));
    SettingsForm::checkbox('sendEmail',__('Send Student Email Addresses to Tool'));
    SettingsForm::checkbox('newWindow',__('Open in New Window'));
    SettingsForm::checkbox('debug',__('Pause launch for debugging'));
    SettingsForm::textarea('custom',__('Custom parameters key=value on lines'));
    SettingsForm::done();
    SettingsForm::end();
}

if ( strlen($url) < 1 || strlen($key) < 1 || strlen($secret) < 1 ) {
    echo('<br clear="all"><p>'.__("This LTI tool is not yet configured.").'</p>'."\n");
    $OUTPUT->footer();
    return;
}

if ( strlen($title) < 1 ) $title = __("External tool");

$parms = $LAUNCH->newLaunch($sendName,$sendEmail);

LTI::addCustom($parms, $custom);

$form_id = "tsugi_form_id_".bin2Hex(openssl_random_pseudo_bytes(4));
$parms['ext_lti_form_id'] = $form_id;

$parms = LTI::signParameters($parms, $url, "POST", $key, $secret,
     __("Finish Launch"), $CFG->product_instance_guid, $CFG->servicename);

// $debug = true;
if ( $LAUNCH->user->instructor ) {
    $content = LTI::postLaunchHTML($parms, $url, $debug, "_pause" );
    echo(__('Pausing to allow for Instructor configuration.')."\n");
    echo(__('Continue to')."\n");
    echo('<a href="#" onclick="document.'.$form_id.'.submit();return false">'.htmlentities($title).'</a>'."\n");
} else {
    $content = LTI::postLaunchHTML($parms, $url, $debug );
}

echo("<!-- Start of content -->\n");
print($content);
echo("<!-- End of content -->\n");

?>

<div class="tsugi_overlay" id="overlay" style="display:none">
<img src="<?= $CFG->staticroot ?>/img/logos/apereo-logo-blue-spin.svg" id="spinn" width="100px" height="100px">
</div>

<?php
/*
echo("<pre>Global Tsugi Objects:\n\n");
var_dump($USER);
var_dump($CONTEXT);
var_dump($LINK);

echo("\n<hr/>\n");
echo("Session data (low level):\n");
echo($OUTPUT->safe_var_dump($_SESSION));
*/

$OUTPUT->footerStart();
?>
<script>
// showOverlay("#overlay", "#spinn");
</script>
<?php
$OUTPUT->footerEnd();

