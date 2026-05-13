fetch('https://api.openweathermap.org/data/2.5/weather?q=Colombo&appid=2f7646d7540b10f5906812da2e6c793a&units=metric')
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
})
.then(response => {
    
    console.log(response);

  
    document.getElementById("myParagraph").innerHTML = response.weather[0].description + " - " + response.main.temp + "°C";
})
.catch(err => {
    console.log(err);
  
    document.getElementById("myParagraph").innerHTML = 'Failed to load weather data. Error: ' + err.message;
});
  