<?php
// Read the OpenAPI JSON file
$jsonFile = 'jellyfin-openapi-stable.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);

// Start HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jellyfin API Documentation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #2c3e50; }
        h2 { color: #34495e; }
        h3 { color: #1abc9c; }
        .endpoint { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .params, .responses { margin-left: 20px; }
        .param, .response { margin-bottom: 5px; }
        code { background-color: #f4f4f4; padding: 2px 5px; border-radius: 3px; }
        nav { background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 30px; }
        a { text-decoration: none; color: #2980b9; }
    </style>
</head>
<body>';

echo '<h1>Jellyfin API Documentation</h1>';

// Navigation sections
echo '<nav>';
echo '<h3>Sections</h3>';
echo '<ul>';
foreach ($jsonData['paths'] as $path => $methods) {
    foreach ($methods as $method => $details) {
        $sectionId = str_replace(['/', '{', '}'], ['-', '', ''], $path);
        echo '<li><a href="#' . $sectionId . '">' . strtoupper($method) . ' ' . $path . '</a></li>';
    }
}
echo '</ul>';
echo '</nav>';

// Legend Section
echo '<section id="legend">';
echo '<h2>Legend</h2>';
echo '<p><strong>HTTP Methods:</strong> GET, POST, PUT, DELETE etc. indicate the type of operation.</p>';
echo '<p><strong>Parameters:</strong> List of inputs required or optional for API calls.</p>';
echo '<p><strong>Responses:</strong> HTTP response codes (e.g., 200 for success, 404 for not found).</p>';
echo '</section>';

// Loop through each path in the JSON and create sections for each
foreach ($jsonData['paths'] as $path => $methods) {
    foreach ($methods as $method => $details) {
        $sectionId = str_replace(['/', '{', '}'], ['-', '', ''], $path);
        
        // Display endpoint and description
        echo '<section id="' . $sectionId . '" class="endpoint">';
        echo '<h2>' . strtoupper($method) . ' ' . $path . '</h2>';
        echo '<p><strong>Description:</strong> ' . $details['summary'] . '</p>';
        
        // Display parameters if any
        if (isset($details['parameters']) && count($details['parameters']) > 0) {
            echo '<h3>Parameters:</h3>';
            echo '<div class="params">';
            foreach ($details['parameters'] as $param) {
                $required = isset($param['required']) && $param['required'] ? ' (required)' : ' (optional)';
                echo '<div class="param"><strong>' . $param['name'] . '</strong> (' . $param['in'] . $required . '): ' . $param['description'] . '</div>';
            }
            echo '</div>';
        }
        
        // Display responses
        echo '<h3>Responses:</h3>';
        echo '<div class="responses">';
        foreach ($details['responses'] as $code => $response) {
            echo '<div class="response">' . $code . ': ' . $response['description'] . '</div>';
        }
        echo '</div>';
        echo '</section>';
    }
}

echo '</body></html>';
?>