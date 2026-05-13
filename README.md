# 🌤️ Weather App — Iterative Web Application (3 Prototypes)

A full-stack weather web application developed iteratively across **3 prototypes** as part of a Software Architecture and Design module (4CS017). The app evolved from a simple static API call to a fully cached, database-backed client-server system.

> 🎓 BSc (Hons) Software Engineering | University of Wolverhampton | Module: 4CS017

---

## 📋 Table of Contents

- [About the Project](#about-the-project)
- [Prototype Evolution](#prototype-evolution)
- [Features (Final Version)](#features-final-version)
- [Architecture](#architecture)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [How It Works](#how-it-works)
- [Technologies Used](#technologies-used)
- [Live Demo Links](#live-demo-links)

---

## About the Project

This project demonstrates **iterative software development** — building and improving a weather application across three prototypes. Each version adds new layers of functionality, performance, and architecture based on reflective evaluation of the previous prototype.

The app fetches real-time weather data using the **OpenWeatherMap API**, displays temperature and weather description for any searched city, and uses a **three-layer caching strategy** (localStorage → MySQL database → API) to minimise redundant calls and improve response times.

---

## 🔄 Prototype Evolution

### Prototype 1 — Static API Call
> *Simple HTML/CSS/JS frontend fetching live weather for Colombo only*

- Hardcoded city (Colombo)
- Direct `fetch()` call to OpenWeatherMap API from the browser
- Displays temperature and weather description
- Sky-themed CSS background
- Basic error handling with `.catch()`

**Limitation:** Fixed city, no search, no data persistence, API key exposed in frontend

---

### Prototype 2 — Search + PHP Backend + MySQL Database
> *Added city search, server-side PHP proxy, and database caching*

- User can search **any city** via input field
- JavaScript sends request to a **PHP backend** (`fetchWeather.php`)
- PHP checks **MySQL database** first — if data exists, returns it (Source: Database)
- If not in DB, fetches from **OpenWeatherMap API**, saves to DB, and returns it (Source: API)
- Shows data source in the UI (`Database` or `API`)
- Enter key support for search

**Improvement:** API key hidden server-side, data persisted in MySQL, reduced API calls

---

### Prototype 3 — localStorage Caching Layer Added
> *Added browser-side caching on top of Prototype 2's architecture*

- **localStorage** checked first before any network request
- If data is cached in localStorage → displayed instantly (no PHP/API call)
- If not in localStorage → falls back to PHP backend (same as Prototype 2)
- On successful fetch, data is saved to localStorage for future visits
- Full **three-tier caching**: localStorage → MySQL → OpenWeatherMap API

**Improvement:** Fastest response time, reduced server and API load, offline resilience

---

## ✨ Features (Final Version)

- 🔍 **City Search** — search weather for any city worldwide
- ⚡ **Three-Layer Caching** — localStorage → MySQL DB → OpenWeatherMap API
- 🖥️ **Source Indicator** — shows whether data came from cache, database, or API
- 🌡️ **Real-Time Weather** — temperature (°C) and weather description
- 🛡️ **Server-Side API Key** — API key protected via PHP backend
- ⌨️ **Keyboard Support** — press Enter to search
- ❌ **Error Handling** — clear feedback for failed requests or invalid cities
- 🎨 **Styled UI** — sky-themed background, clean layout

---

## 🏗️ Architecture

The final app follows a **Client-Server architecture** with three data tiers:

```
User Input (City Name)
        │
        ▼
┌─────────────────────┐
│   Browser (JS)      │
│  Check localStorage │──── HIT ──▶ Display weather instantly
└────────┬────────────┘
         │ MISS
         ▼
┌─────────────────────┐
│   PHP Backend       │
│  (fetchWeather.php) │
│  Check MySQL DB     │──── HIT ──▶ Return DB data + save to localStorage
└────────┬────────────┘
         │ MISS
         ▼
┌─────────────────────┐
│  OpenWeatherMap API │──── Returns weather ──▶ Save to DB + localStorage
└─────────────────────┘
```

---

## 📁 Project Structure

```
weather-app/
│
├── Prototype 1/
│   └── weather/
│       ├── index.html          # Static page for Colombo weather
│       ├── script.js           # Direct API fetch call
│       └── style.css           # Sky background styling
│
├── Prototype 2/
│   └── nethmi_1.1/
│       ├── index.html          # City search input + button
│       ├── script.js           # JS fetches via PHP backend
│       ├── fetchWeather.php    # PHP: DB check → API fetch → DB insert
│       └── style.css           # Styled search UI
│
└── Prototype 3/
    └── weather_3/
        ├── index.html          # Same UI as Prototype 2
        ├── script.js           # localStorage check → PHP fallback
        ├── fetchWeather.php    # Same PHP backend as Prototype 2
        └── style.css           # Same styling
```

---

## 🚀 Getting Started

### Prerequisites

- A web server with **PHP** support (e.g. Apache/XAMPP)
- **MySQL** database
- An **OpenWeatherMap API key** — [get one free here](https://openweathermap.org/api)

### Database Setup

Create a MySQL table for weather caching:

```sql
CREATE DATABASE db_weather;
USE db_weather;

CREATE TABLE weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100),
    temperature VARCHAR(20),
    description VARCHAR(255),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Configuration

In `fetchWeather.php`, update your credentials:

```php
$servername = "localhost";
$username   = "your_db_username";
$password   = "your_db_password";
$dbname     = "db_weather";
$apiKey     = "your_openweathermap_api_key";
```

### Run Locally

Place the project folder inside your web server's root directory (e.g. `htdocs/` for XAMPP) and open:

```
http://localhost/weather_3/index.html
```

---

## ⚙️ How It Works

1. User types a city name and clicks **Search** (or presses Enter)
2. JavaScript checks **localStorage** for cached data
3. If found → weather is displayed immediately from cache
4. If not → JavaScript calls `fetchWeather.php?city=CityName`
5. PHP checks the **MySQL database** for a recent record
6. If found → returns DB data (labelled `Source: Database`)
7. If not → PHP calls **OpenWeatherMap API**, saves result to DB, returns data (labelled `Source: API`)
8. JavaScript saves the result to **localStorage** for next time

---

## 💻 Technologies Used

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, JavaScript (ES6+) |
| Backend | PHP |
| Database | MySQL |
| API | OpenWeatherMap API (REST) |
| Caching | Browser localStorage, MySQL |
| Architecture | Client-Server, 3-Tier Caching |

---

## 🔗 Live Demo Links

- [Prototype 1](https://mi-linux.wlv.ac.uk/~2501573/weather/index.html) — Static Colombo weather
- [Prototype 2](https://mi-linux.wlv.ac.uk/~2501573/nethmi_1.1/index.html) — Search + DB caching
- [Prototype 3](https://mi-linux.wlv.ac.uk/~2501573/weather_3/index.html) — Full localStorage + DB + API

---

## 👩‍💻 Author

**W. Udara Nethmi** 
BSc (Hons) Software Engineering — University of Wolverhampton

---

## 📄 License

Developed for academic purposes as part of module 4CS017 — Software Architecture and Design. Not for commercial use.
