FROM php:8.2.1-apache-buster

ARG user
ARG uid

# Update
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y apt-utils && \
    rm -rf /var/lib/apt/lists/*


# Install useful tools and install important libaries
RUN apt-get -y update && \
    apt-get -y --no-install-recommends install nano wget \
    dialog \
    libsqlite3-dev \
    libsqlite3-0 && \
    apt-get -y --no-install-recommends install default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    libicu-dev && \
    apt-get -y --no-install-recommends install --fix-missing apt-utils \
    build-essential \
    git \
    curl \
    libonig-dev && \ 
    apt-get -y --no-install-recommends install --fix-missing libcurl4 \
    libcurl4-openssl-dev \
    zip \
    openssl && \
    rm -rf /var/lib/apt/lists/* && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Other PHP8 Extensions
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install curl
RUN docker-php-ext-install zip
RUN docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install gettext
RUN docker-php-ext-install calendar
RUN docker-php-ext-install exif

# Enable apache modules
RUN a2enmod rewrite headers

# Cleanup
RUN rm -rf /usr/src/*

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

ENV APACHE_RUN_USER $user
ENV APACHE_RUN_GROUP $user

# Copy existing application directory contents
COPY www/ /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Download and install Node.js
RUN curl -fsSL https://nodejs.org/dist/v16.13.0/node-v16.13.0-linux-x64.tar.xz | tar -xJf - -C /usr/local --strip-components=1

# Check Node.js and npm version
RUN node -v
RUN npm -v

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Check Composer version
RUN composer --version

# Intall composer & node dependencies
RUN composer i
RUN npm i

# RUN Laravel commands
RUN php artisan storage:link
RUN php artisan key:generate

# Set permissions
RUN chown -R prevention:www-data ./public
RUN chown -R prevention:www-data ./storage

# Change user to non-root
USER $user:$user
USER $uid

# Build assets
RUN npm run build