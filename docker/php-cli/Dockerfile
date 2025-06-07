FROM php:8.4-cli

COPY --from=composer/composer:2-bin /composer /usr/bin/composer
RUN apt-get update && apt-get install -y unzip git

# Install Symfony CLI
COPY --from=ghcr.io/symfony-cli/symfony-cli:5.11.0 /usr/local/bin/symfony /usr/local/bin/symfony

# Clear APT cache
RUN apt-get clean && rm -rf /var/lib/apt/lists

# Create non-root user for container
ARG HOST_USER_UID=10000
ARG HOST_USER_GID=10000
ENV HOST_USER_UID=${HOST_USER_UID}
ENV HOST_USER_GID=${HOST_USER_GID}
RUN addgroup --system --gid ${HOST_USER_GID} nonroot
RUN adduser --system --shell /bin/sh --uid ${HOST_USER_UID} --gid ${HOST_USER_GID} --disabled-password nonroot

# Create /nonexistent directory for Symfony
RUN mkdir /nonexistent && chown nonroot:nonroot /nonexistent

# Switch to non-root user
USER nonroot

# Change the cache path for Composer to be able to set volume for it
RUN mkdir /tmp/composer-cache
ENV COMPOSER_CACHE_DIR=/tmp/composer-cache

WORKDIR /app
