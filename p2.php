<!DOCTYPE html>
<html>
<head>
    <title>JSON Proxy Example</title>
</head>
<body>
    <h1>JSON Proxy Example</h1>
    <div id="data-container"></div>

    <script>
        // AJAX request to the PHP proxy script
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'p2.php?url=https://api.wolfite.net/404-quotes.json', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Successful response, parse the JSON data
                    var jsonData = JSON.parse(xhr.responseText);

                    // Display the JSON data on the web page
                    var dataContainer = document.getElementById('data-container');
                    // Convert the JSON object to a formatted string for display
                    var formattedJsonData = JSON.stringify(jsonData, null, 2);
                    // Convert any special characters (e.g., <, >, &) to their HTML entities to prevent XSS
                    var escapedFormattedJsonData = document.createElement('div');
                    escapedFormattedJsonData.textContent = formattedJsonData;
                    dataContainer.appendChild(escapedFormattedJsonData);
                } else {
                    // Handle errors if necessary
                    console.error('Error fetching data: ' + xhr.status);
                }
            }
        };

        xhr.send();
    </script>
</body>
</html>
