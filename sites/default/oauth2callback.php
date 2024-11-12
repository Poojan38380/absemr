<?php
$ignoreAuth = true;
$_GET['site'] = 'default';
require_once('/var/www/html/absemr/interface/globals.php');
require_once("/var/www/html/absemr/vendor/autoload.php");
require_once("$srcdir/patient.inc");

$clientID = '356874286884-l4b45edkojdj11ug1dvnlt76ghslbf9h.apps.googleusercontent.com';
$clientSecret = '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';
$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/absemr/sites/default/oauth2callback.php';
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirect_uri);
$client->addScope(Google_Service_Calendar::CALENDAR);
if (!isset($_GET['code'])) {
  $authUrl = $client->createAuthUrl();
  header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
  exit;
}
$client->authenticate($_GET['code']);
$accessToken = $client->getAccessToken();
$_SESSION['access_token'] = $accessToken;
$client->setAccessToken($_SESSION['access_token']);
$calendarService = new Google_Service_Calendar($client);
$calendarId = 'loguvan.k@zeoner.com';
$event = new Google_Service_Calendar_Event([
    'start' => ['dateTime' => '2023-04-13T17:00:00.000+05:30'],
    'end' => ['dateTime' => '2023-04-13T17:30:00.000+05:30'],
    'attendees' => array(['email' =>'naveen.k@zeoner.com']),
    'conferenceData' => [
        'createRequest' => [
            'requestId' => 'sample123',
            'conferenceSolutionKey' => ['type' => 'hangoutsMeet']
        ]
    ],
    'summary' => 'sample event with Meet link',
    'description' => 'sample description'
]);
$res = $calendarService->events->insert($calendarId, $event, array('conferenceDataVersion' => 1));
//print_r($res['hangoutLink']);die();

echo  $res['hangoutLink'] ;

die;
?>
