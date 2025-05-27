<?php
require("../globals.php");

// Enable error reporting for debugging
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

use OpenEMR\Services\UserService;
$userService = new UserService();
$user = $userService->getCurrentlyLoggedInUser();
?>
<!DOCTYPE html>

<head>
    <title>Zoom WebSDK CDN</title>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="origin-trial" content="">
</head>

<body>
    <input hidden id="sdkClientId" type="text" value="<?php echo $user['sdk_client_id'] ?>">
    <input hidden id="sdkClientSecret" type="text" value="<?php echo $user['sdk_client_secret'] ?>">
    <script src="https://source.zoom.us/3.9.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/zoom-meeting-3.9.0.min.js"></script>
    <script src="js/tool.js"></script>
    <script src="js/vconsole.min.js"></script>
    <script src="js/meeting.js"></script>

    <script>

    </script>
</body>

</html>