FROM php:cli-alpine
COPY . /app
WORKDIR /app
CMD [ "php", "./afkbot.php" ]
