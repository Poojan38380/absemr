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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: floatUp 6s infinite linear;
        }

        .particle:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            left: 20%;
            animation-delay: 1s;
        }

        .particle:nth-child(3) {
            left: 30%;
            animation-delay: 2s;
        }

        .particle:nth-child(4) {
            left: 40%;
            animation-delay: 3s;
        }

        .particle:nth-child(5) {
            left: 50%;
            animation-delay: 4s;
        }

        .particle:nth-child(6) {
            left: 60%;
            animation-delay: 5s;
        }

        .particle:nth-child(7) {
            left: 70%;
            animation-delay: 0.5s;
        }

        .particle:nth-child(8) {
            left: 80%;
            animation-delay: 1.5s;
        }

        .particle:nth-child(9) {
            left: 90%;
            animation-delay: 2.5s;
        }

        .particle:nth-child(10) {
            left: 15%;
            animation-delay: 3.5s;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Loading container */
        .loading-container {
            text-align: center;
            color: white;
            z-index: 2;
            position: relative;
        }

        /* Main spinner */
        .spinner {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 30px;
            position: relative;
        }

        .spinner::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border: 2px solid transparent;
            border-top: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: spin 2s linear infinite reverse;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Loading text */
        .loading-text {
            font-size: 1.5rem;
            margin-bottom: 20px;
            animation: fadeInOut 2s ease-in-out infinite;
        }

        @keyframes fadeInOut {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }
        }

        /* Progress bar */
        .progress-container {
            width: 300px;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            margin: 20px auto;
            overflow: hidden;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ffd700, #ffed4e, #ffd700);
            background-size: 200% 100%;
            border-radius: 3px;
            animation: progressMove 2s ease-in-out infinite, progressGlow 2s ease-in-out infinite;
            width: 100%;
        }

        @keyframes progressMove {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        @keyframes progressGlow {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
            }

            50% {
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
            }
        }

        /* Dots animation */
        .dots {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 20px;
            margin-top: 20px;
        }

        .dots div {
            position: absolute;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.8);
            animation: dotsBounce 1.2s infinite ease-in-out both;
        }

        .dots div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }

        .dots div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }

        .dots div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }

        @keyframes dotsBounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }

        /* Pulse ring */
        .pulse-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: pulseRing 3s ease-out infinite;
        }

        .pulse-ring::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: pulseRing 3s ease-out infinite 0.5s;
        }

        @keyframes pulseRing {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 1;
            }

            100% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0;
            }
        }

        /* Loading messages */
        .loading-messages {
            margin-top: 30px;
            height: 30px;
            position: relative;
        }

        .message {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            animation: messageSlide 8s infinite;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .message:nth-child(1) {
            animation-delay: 0s;
        }

        .message:nth-child(2) {
            animation-delay: 2s;
        }

        .message:nth-child(3) {
            animation-delay: 4s;
        }

        .message:nth-child(4) {
            animation-delay: 6s;
        }

        @keyframes messageSlide {

            0%,
            20% {
                opacity: 0;
                transform: translateX(-50%) translateY(20px);
            }

            25%,
            45% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            50%,
            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .loading-text {
                font-size: 1.2rem;
            }

            .progress-container {
                width: 250px;
            }

            .spinner {
                width: 60px;
                height: 60px;
            }

            .pulse-ring {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>

<body>
    <!-- Animated background particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Pulse ring effect -->
    <div class="pulse-ring"></div>

    <!-- Main loading content -->
    <div class="loading-container">
        <!-- Main spinner -->
        <div class="spinner"></div>

        <!-- Loading text -->
        <div class="loading-text">Loading...</div>

        <!-- Progress bar -->
        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>

        <!-- Bouncing dots -->
        <div class="dots">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- Rotating messages -->
        <div class="loading-messages">
            <div class="message">Initializing application...</div>
            <div class="message">Loading resources...</div>
            <div class="message">Preparing interface...</div>
            <div class="message">Almost ready...</div>
        </div>
    </div>
    <style>
        .sdk-select {
            height: 34px;
            border-radius: 4px;
        }

        .websdktest button {
            float: right;
            margin-left: 5px;
        }

        #nav-tool {
            margin-bottom: 0px;
        }

        #show-test-tool {
            position: absolute;
            top: 100px;
            left: 0;
            display: block;
            z-index: 99999;
        }

        #display_name {
            width: 250px;
        }


        #websdk-iframe {
            width: 700px;
            height: 500px;
            border: 1px;
            border-color: red;
            border-style: dashed;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            left: 50%;
            margin: 0;
        }
    </style>

    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top" style="display: none;">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Zoom WebSDK CDN</a>
            </div>
            <div id="navbar" class="websdktest">
                <form class="navbar-form navbar-right" id="meeting_form">
                    <div class="form-group">
                        <input type="text" name="display_name" id="display_name" value="3.9.0#CDN" maxLength="100"
                            placeholder="Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="meeting_number" id="meeting_number" value="" maxLength="200"
                            style="width:150px" placeholder="Meeting Number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="meeting_pwd" id="meeting_pwd" value="" style="width:150px"
                            maxLength="32" placeholder="Meeting Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="meeting_email" id="meeting_email" value="" style="width:150px"
                            maxLength="32" placeholder="Email option" class="form-control">
                    </div>

                    <div class="form-group">
                        <select id="meeting_role" class="sdk-select">
                            <option value=0>Attendee</option>
                            <option value=1>Host</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="meeting_china" class="sdk-select">
                            <option value=0>Global</option>
                            <option value=1>China</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="meeting_lang" class="sdk-select">
                            <option value="en-US">English</option>
                            <option value="de-DE">German Deutsch</option>
                            <option value="es-ES">Spanish Español</option>
                            <option value="fr-FR">French Français</option>
                            <option value="jp-JP">Japanese 日本語</option>
                            <option value="pt-PT">Portuguese Portuguese</option>
                            <option value="ru-RU">Russian Русский</option>
                            <option value="zh-CN">Chinese 简体中文</option>
                            <option value="zh-TW">Chinese 繁体中文</option>
                            <option value="ko-KO">Korean 한국어</option>
                            <option value="vi-VN">Vietnamese Tiếng Việt</option>
                            <option value="it-IT">Italian italiano</option>
                            <option value="tr-TR">Turkey-Türkçe</option>
                            <option value="pl-PL">Poland-Polski</option>
                            <option value="id-ID">Indonesian Bahasa Indonesia</option>
                            <option value="nl-NL">Dutch Nederlands</option>
                            <option value="sv-SE">Swedish Svenska</option>
                        </select>
                    </div>
                    <input hidden id="sdkClientId" type="text" value="<?php echo $user['sdk_client_id'] ?>">
                    <input hidden id="sdkClientSecret" type="text" value="<?php echo $user['sdk_client_secret'] ?>">
                    <input type="hidden" value="" id="copy_link_value" />
                    <!-- <button type="submit" class="btn btn-primary" id="join_meeting">Join</button> -->
                    <button type="submit" class="btn btn-primary" id="clear_all">Clear</button>
                    <!-- <button type="button" link="" onclick="window.copyJoinLink('#copy_join_link')"
                        class="btn btn-primary" id="copy_join_link">Copy Direct join link</button> -->


                </form>
            </div>
            <!--/.navbar-collapse -->
        </div>
    </nav>


    <script>

        // Function to get URL parameters
        function getUrlParams() {
            const params = new URLSearchParams(window.location.search);
            const meetingId = params.get('meetingId');
            const meetingPwd = params.get('meetingPwd');
            const meetingRole = params.get('meetingRole');
            const dispalyName = params.get('displayName');
            const meetingEmail = params.get('meetingEmail');

            return { meetingId, meetingPwd, meetingRole, dispalyName, meetingEmail };
        }

        // Function to set the meeting number and password
        function setMeetingDetails() {
            const { meetingId, meetingPwd, meetingRole, dispalyName } = getUrlParams();

            if (meetingId) {
                document.getElementById('meeting_number').value = meetingId;
            }

            if (meetingPwd) {
                document.getElementById('meeting_pwd').value = meetingPwd;
            }

            if (meetingRole) {
                document.getElementById('meeting_role').value = meetingRole;
            }

            if (dispalyName) {
                document.getElementById('display_name').value = dispalyName;
            }

            if (meetingEmail) {
                document.getElementById('meeting_email').value = meetingEmail;
            }
        }

        // Execute the function on page load to set the meeting ID and password
        window.onload = setMeetingDetails;

    </script>

    <script src="https://source.zoom.us/3.9.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/3.9.0/zoom-meeting-3.9.0.min.js"></script>
    <script src="js/tool.js"></script>
    <script src="js/vconsole.min.js"></script>
    <script src="js/index.js"></script>

    <script>


    </script>
</body>

</html>