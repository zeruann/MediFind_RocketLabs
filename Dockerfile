FROM dunglas/frankenphp

RUN install-php-extensions pdo_mysql mysqli mbstring

COPY . /app
WORKDIR /app
