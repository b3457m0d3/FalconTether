<?php if (!defined('APPLICATION')) exit();

// Conversations
$Configuration['Conversations']['Version'] = '2.0.18.4';

// Database
$Configuration['Database']['Name'] = 'bo0m3r_forum';
$Configuration['Database']['Host'] = 'localhost';
$Configuration['Database']['User'] = 'bo0m3r_api';
$Configuration['Database']['Password'] = 'w1nn1ng';

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledPlugins
$Configuration['EnabledPlugins']['GettingStarted'] = 'GettingStarted';
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['Facebook'] = TRUE;
$Configuration['EnabledPlugins']['Twitter'] = TRUE;
$Configuration['EnabledPlugins']['cleditor'] = TRUE;
$Configuration['EnabledPlugins']['OpenID'] = TRUE;
$Configuration['EnabledPlugins']['GoogleSignIn'] = TRUE;
$Configuration['EnabledPlugins']['VanillaInThisDiscussion'] = TRUE;
$Configuration['EnabledPlugins']['Tagging'] = TRUE;
$Configuration['EnabledPlugins']['VanillaStats'] = TRUE;

// Garden
$Configuration['Garden']['Title'] = 'Project Name';
$Configuration['Garden']['Cookie']['Salt'] = '14RKXHWQ3T';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = '1';
$Configuration['Garden']['Registration']['Method'] = 'Captcha';
$Configuration['Garden']['Registration']['ConfirmEmailRole'] = '8';
$Configuration['Garden']['Registration']['CaptchaPrivateKey'] = '6Ldh39ASAAAAAELzidH5MxbmTNuwUbVYTmxlgzWY ';
$Configuration['Garden']['Registration']['CaptchaPublicKey'] = '6Ldh39ASAAAAAMudETSDSw297GZz_0wIuUFLgPoY ';
$Configuration['Garden']['Registration']['InviteExpiration'] = '-1 week';
$Configuration['Garden']['Registration']['InviteRoles'] = 'a:5:{i:3;s:1:"0";i:4;s:1:"0";i:8;s:1:"0";i:32;s:1:"0";i:16;s:1:"0";}';
$Configuration['Garden']['Email']['SupportName'] = 'Project Name';
$Configuration['Garden']['Version'] = '2.0.18.4';
$Configuration['Garden']['RewriteUrls'] = TRUE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['InputFormatter'] = 'Markdown';
$Configuration['Garden']['InstallationID'] = 'E98E-42C82138-AC6FDD80';
$Configuration['Garden']['InstallationSecret'] = 'b26d113b10838991d9d2b5af8ef124cc4065a5f2';

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Registration'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';
$Configuration['Plugins']['Facebook']['ApplicationID'] = '101729633296909';
$Configuration['Plugins']['Facebook']['Secret'] = 'aa4b32e02c20853b1d156582f4d925db';
$Configuration['Plugins']['GoogleSignIn']['Enabled'] = TRUE;
$Configuration['Plugins']['OpenID']['Enabled'] = TRUE;
$Configuration['Plugins']['Tagging']['Enabled'] = TRUE;
$Configuration['Plugins']['Twitter']['ConsumerKey'] = 'KpkWO7AA0h5TPO3C49ka3g';
$Configuration['Plugins']['Twitter']['Secret'] = 'x5Cy94hwI3wxoP75I34jxqe13Z5TIWoAVtCDJ0CaBc';

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';

// Vanilla
$Configuration['Vanilla']['Version'] = '2.0.18.4';

// Last edited by b3457m0d3 (24.59.104.152)2012-04-30 05:13:16