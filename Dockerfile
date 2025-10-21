FROM wordpress:latest

# Installeer PDO en PDO MySQL extensies
RUN docker-php-ext-install pdo pdo_mysql
