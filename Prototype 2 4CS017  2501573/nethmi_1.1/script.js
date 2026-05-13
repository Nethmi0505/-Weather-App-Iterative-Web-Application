
function fetchWeatherData(city) {
  fetch(`fetchWeather.php?city=${city}`)
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        document.getElementById("myParagraph").innerHTML = data.error;
      } else {
        const source = data.source === 'db' ? "Database" : "API";
        document.getElementById("myParagraph").innerHTML = 
          `Weather in ${data.city}: ${data.description} - ${data.temperature}°C (Source: ${source})`;
      }
    })
    .catch(err => {
      console.log(err);
      document.getElementById("myParagraph").innerHTML = 'Failed to load weather data. Error: ' + err.message;
    });
}


document.getElementById("searchButton").addEventListener("click", function() {
  const city = document.getElementById("locationInput").value;
  if (city) {
    fetchWeatherData(city);
  } else {
    alert("Please enter a city name");
  }
});


document.getElementById("locationInput").addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    document.getElementById("searchButton").click();
  }
});

