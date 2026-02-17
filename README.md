# weather-service

## Project Description

This is a simple Weather Web Service built using PHP.  
The service retrieves weather data for a city chosen by the user and runs inside a Docker container to ensure reproducibility on any machine.

---

## Weather API Used

**Open-Meteo API**

https://open-meteo.com/

This API does not require an API key.

---

## Environment Variables

No environment variables are required because Open-Meteo API is free and does not require authentication.

---

## How to Build and Run Using Docker

### 1. Create Dockerfile

We created a Dockerfile with the following content:

```dockerfile
FROM php:8.4-cli-alpine

COPY src/ /app

WORKDIR /app

EXPOSE 8080

CMD php -S 0.0.0.0:8080
```

### 2. Build Docker Image

```bash
docker build -t weather-service .
```

### 3. Run the Container

```bash
docker run -p 8080:8080 weather-service
```

### 4. Access the Service

```
http://localhost:8080/weather.php?city=Gaza
```

---

## How to Test

### Example using browser:

```
http://localhost:8080/weather.php?city=Gaza
```

### Example using curl:

```bash
curl "http://localhost:8080/weather.php?city=Gaza"
```

---

## How to Stop the Container

- **macOS/Linux**: `Command + C` or `Ctrl + C`
- **Windows**: `Ctrl + C`

