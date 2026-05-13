<?php
$servername = "mi-linux.wlv.ac.uk";
$username = "2501573";
$password = "zh3d14"; 
$dbname = "db2501573"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$city = $_GET['city']; 


$sql = "SELECT * FROM weather_data WHERE city = '$city' ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    echo json_encode([
        'source' => 'db',
        'temperature' => $row['temperature'],
        'description' => $row['description'],
        'city' => $row['city']
    ]);
} else {
    
    $apiKey = "2f7646d7540b10f5906812da2e6c793a"; 
    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";
    $apiResponse = file_get_contents($apiUrl);
    $weatherData = json_decode($apiResponse, true);

    if ($weatherData['cod'] == 200) {
        
        $temperature = $weatherData['main']['temp'];
        $description = $weatherData['weather'][0]['description'];

        
        $stmt = $conn->prepare("INSERT INTO weather_data (city, temperature, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $city, $temperature, $description);
        $stmt->execute();
        
        
        echo json_encode([
            'source' => 'api',
            'temperature' => $temperature,
            'description' => $description,
            'city' => $city
        ]);
    } else {
        echo json_encode(['error' => 'City not found']);
    }
}

$conn->close();
?>
