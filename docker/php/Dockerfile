# Base image
FROM koder/apache-php-5.3

LABEL maintainer="sgcommander"
LABEL version="1.0.0"

# Install dependencies
RUN apt-get update && apt-get install -y --force-yes \
    php-gettext \
    php-pear \
    php5-gd \
    mysql-server-5.6 \
    php5-mysql \
    php-apc

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# Permissions
RUN chmod 777 -R /var/www/logs
RUN chmod 777 -R /var/www/templates/default/cache
RUN chmod 777 -R /var/www/web/images/firmas/jugador
RUN echo "www-data:password" | chpasswd
RUN usermod -aG sudo www-data
RUN ln -s /var/www/docker-init.sh /etc/my_init.d/01_docker-init.sh