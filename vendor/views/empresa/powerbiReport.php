https://github.com/attilaersek/powerbi-php-sample
<?php
$clientId = "9b6c3371-2198-4ea4-9786-e0896f2e32e4";
$clientSecret = "a7381ab5-b35a-4464-bad5-7ec0b8720d4b";
$tenantId = "6e1272ee-0ae5-412e-a544-6e1121962433";
$reportId = "ec6b1814-20a6-4ed4-81ed-2f3f4a88d700&autoAuth=true&ctid=6e1272ee-0ae5-412e-a544-6e1121962433";
$groupId = "daaa3a9c-54c6-46dd-b129-8c9ebcfee3cb";

// Obtener token de autenticaci¨®n
$tokenUrl = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token";
$data = [
    'grant_type' => 'client_credentials',
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'scope' => 'https://analysis.windows.net/powerbi/api/.default'
];
$options = [
    'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];
$context = stream_context_create($options);
$response = file_get_contents($tokenUrl, false, $context);
$responseData = json_decode($response, true);
$accessToken = $responseData['access_token'];

// Obtener token de incrustaci¨®n
$embedTokenUrl = "https://api.powerbi.com/v1.0/myorg/groups/$groupId/reports/$reportId/GenerateToken";
$embedData = json_encode(['accessLevel' => 'view']);
$options = [
    'http' => [
        'header' => "Content-Type: application/json\r\nAuthorization: Bearer $accessToken\r\n",
        'method' => 'POST',
        'content' => $embedData
    ]
];
$context = stream_context_create($options);
$response = file_get_contents($embedTokenUrl, false, $context);
$embedResponse = json_decode($response, true);
$embedToken = $embedResponse['token'];
$embedUrl = "https://app.powerbi.com/reportEmbed?reportId=$reportId&groupId=$groupId";
var_dump($embedUrl);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Incrustado de Power BI</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.9.0/powerbi.min.js"></script>
</head>
<body>
    <div id="reportContainer" style="height:600px;width:100%;"></div>
    <script>
        var models = window['powerbi-client'].models;
        var embedConfig = {
            type: 'report',
            tokenType: models.TokenType.Embed,
            accessToken: '<?php echo $embedToken; ?>',
            embedUrl: '<?php echo $embedUrl; ?>',
            id: '<?php echo $reportId; ?>'
        };
        var reportContainer = document.getElementById('reportContainer');
        powerbi.embed(reportContainer, embedConfig);
    </script>
</body>
</html>
