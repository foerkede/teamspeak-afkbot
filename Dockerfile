FROM php:cli
COPY . /app
WORKDIR /app
CMD [ "php", "./afkbot.php" ]
