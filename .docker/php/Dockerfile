ARG PHP_IMAGE=8.1.6-cli-alpine
ARG ROAD_RUNNER_IMAGE=2.10.2

#Download rr binary
FROM spiralscout/roadrunner:$ROAD_RUNNER_IMAGE as builder

FROM php:$PHP_IMAGE

RUN apk update \
    && apk add --no-cache  \
        oniguruma \
        oniguruma-dev \
        libgcrypt \
        libgcrypt-dev \
        ca-certificates \
        pcre-dev \
        curl \
        libcurl \
        git \
        openssh-client \
        openssl-dev \
        wget \
        libmcrypt-dev \
        freetype-dev libpng-dev libjpeg-turbo-dev libxml2-dev autoconf g++ imagemagick-dev imagemagick libtool make \
        icu-dev \
        libxslt-dev \
        zip \
        nano \
        patch \
        gnu-libiconv \
        tmux \
        bash \
        libzip-dev \
        ${PHPIZE_DEPS} \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    opcache soap xsl zip pcntl bcmath sockets pdo_mysql \
    && pecl install -o -f redis imagick &&  rm -rf /tmp/pear &&  docker-php-ext-enable redis imagick \
    && docker-php-source delete \
    && apk del ${BUILD_DEPENDS}

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY ./composer.json /var/www

RUN composer install --no-autoloader --no-scripts && \
    composer clear-cache && \
    composer dump --optimize --no-scripts

COPY ./ /var/www

RUN composer run-script post-create-project-cmd

COPY --from=builder /usr/bin/rr /var/server/
COPY ./.rr.yaml /var/server/

CMD ["/var/server/rr", "serve", "-d"]
