FROM php:8.4-cli-alpine

COPY src/ /app

WORKDIR /app

EXPOSE 8080

CMD php -S 0.0.0.0:8080