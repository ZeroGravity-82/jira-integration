FROM php:8.4-fpm

RUN apt-get update \
    # extension required for MySQL
    && docker-php-ext-install pdo_mysql \
    # extensions recommended for ramsey/uuid
    && apt-get install -y libgmp-dev && docker-php-ext-install bcmath gmp \
    # extension required for XDebug
    && pecl install xdebug-3.4.4 && rm -rf /tmp/pear && docker-php-ext-enable xdebug

# Clear APT cache
RUN apt-get clean && rm -rf /var/lib/apt/lists

# PHP configuration
COPY docker/php-fpm/conf.d /usr/local/etc/php/conf.d

# Create non-root user for container
ARG HOST_USER_UID=10000
ARG HOST_USER_GID=10000
ENV HOST_USER_UID=${HOST_USER_UID}
ENV HOST_USER_GID=${HOST_USER_GID}
RUN addgroup --system --gid ${HOST_USER_GID} nonroot
RUN adduser --system --shell /bin/sh --uid ${HOST_USER_UID} --gid ${HOST_USER_GID} --disabled-password nonroot
RUN sed -i "s/user = www-data/user = nonroot/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = nonroot/g" /usr/local/etc/php-fpm.d/www.conf

WORKDIR /app
