ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive

# Start as root
USER root

# always run apt update when start and after add new source list, then clean up at end.
RUN pecl channel-update pecl.php.net \
    && apt-get update -y \
    && apt-get install -y --no-install-recommends \
    apt-utils \
    curl \
    git \
    gnupg2 \
    less \
    locales \
    openssh-client \
    unzip

################################################################################
# INSTALL BASH COMPLETION:
################################################################################

ARG INSTALL_BASH_COMPLETION=false

RUN if [ ${INSTALL_BASH_COMPLETION} = true ]; then \
    apt-get install -y --no-install-recommends bash-completion \
    ;fi

################################################################################
# INSTALL BCMATH:
################################################################################

ARG INSTALL_BCMATH=false

RUN if [ ${INSTALL_BCMATH} = true ]; then \
    # Install the bcmath extension
    docker-php-ext-install bcmath \
    ;fi

################################################################################
# INSTALL BZIP2:
################################################################################

ARG INSTALL_BZIP=true

RUN if [ ${INSTALL_BZIP} = true ]; then \
    apt-get install -y libbz2-dev && docker-php-ext-install bz2 \
    ;fi

################################################################################
# INSTALL CALENDAR:
################################################################################

ARG INSTALL_CALENDAR=false

RUN if [ ${INSTALL_CALENDAR} = true ]; then \
    docker-php-ext-install calendar \
    ;fi

################################################################################
# INSTALL COMPOSER:
################################################################################
ARG INSTALL_COMPOSER=true

RUN if [ ${INSTALL_COMPOSER} = true ]; then \
    curl https://composer.github.io/installer.sig | tr -d '\n' > installer.sig \
    && curl https://getcomposer.org/installer -o composer-setup.php \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === file_get_contents('installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php'); unlink('installer.sig');" \
    && mv composer.phar /usr/local/bin/composer \
    ;fi

ARG COMPOSER_REPO_PACKAGIST
ENV COMPOSER_REPO_PACKAGIST ${COMPOSER_REPO_PACKAGIST}

RUN if [ ${INSTALL_COMPOSER} = true ]; then \
    if [ ${COMPOSER_REPO_PACKAGIST} ]; then \
    composer config -g repo.packagist composer ${COMPOSER_REPO_PACKAGIST} \
    ;fi \
    ;fi

################################################################################
# INSTALL GD:
################################################################################

ARG INSTALL_GD=true

RUN if [ ${INSTALL_GD} = true ]; then \
    apt-get install -y libpng-dev libjpeg-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    ;fi

################################################################################
# INSTALL GHOSTSCRIPT:
################################################################################

ARG INSTALL_GHOSTSCRIPT=false

RUN if [ ${INSTALL_GHOSTSCRIPT} = true ]; then \
    # Install the ghostscript extension
    # for PDF editing
    apt-get install -y poppler-utils ghostscript \
    ;fi

################################################################################
# INSTALL GMP:
################################################################################

ARG INSTALL_GMP=false

RUN if [ ${INSTALL_GMP} = true ]; then \
    apt-get install -y libgmp-dev && docker-php-ext-install gmp \
    ;fi

################################################################################
# INSTALL ICONV:
################################################################################

ARG INSTALL_ICONV=true

RUN if [ ${INSTALL_ICONV} = true ]; then \
    docker-php-ext-install iconv \
    ;fi

################################################################################
# INSTALL IMAGE OPTIMIZERS:
################################################################################

ARG INSTALL_IMAGE_OPTIMIZERS=false

RUN if [ ${INSTALL_IMAGE_OPTIMIZERS} = true ]; then \
    apt-get install -y jpegoptim optipng pngquant gifsicle \
    ;fi

################################################################################
# INSTALL IMAGEMAGICK:
################################################################################

ARG INSTALL_IMAGEMAGICK=false

RUN if [ ${INSTALL_IMAGEMAGICK} = true ]; then \
    apt-get install -y libmagickwand-dev imagemagick \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    ;fi

################################################################################
# INSTALL IMAP:
################################################################################

ARG INSTALL_IMAP=false

RUN if [ ${INSTALL_IMAP} = true ]; then \
    apt-get install -y libc-client-dev libkrb5-dev \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap \
    ;fi

################################################################################
# INSTALL INTL:
################################################################################

ARG INSTALL_INTL=false

RUN if [ ${INSTALL_INTL} = true ]; then \
    # Install intl and requirements
    apt-get install -y zlib1g-dev libicu-dev g++ && docker-php-ext-install intl \
    ;fi

################################################################################
# INSTALL LDAP:
################################################################################

ARG INSTALL_LDAP=false

RUN if [ ${INSTALL_LDAP} = true ]; then \
    apt-get install -y libldap2-dev \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    ;fi

################################################################################
# INSTALL MEMCACHED:
################################################################################

ARG INSTALL_MEMCACHED=false

RUN if [ ${INSTALL_MEMCACHED} = true ]; then \
    # Install the php memcached extension
    apt-get install -y libmemcached-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    ;fi

################################################################################
# INSTALL MONGODB:
################################################################################

ARG INSTALL_MONGO=false

RUN if [ ${INSTALL_MONGO} = true ]; then \
    # Install the mongodb extension
    pecl install mongodb && docker-php-ext-enable mongodb \
    ;fi

################################################################################
# INSTALL MSSQL:
################################################################################

ARG INSTALL_MSSQL=false

RUN set -eux; \
    if [ ${INSTALL_MSSQL} = true ]; then \
    if [ $(php -r "echo PHP_MAJOR_VERSION;") = "5" ]; then \
    apt-get install -yqq php5.6-sybase freetds-bin freetds-common libsybdb5 \
    && php -m | grep -q 'mssql' \
    && php -m | grep -q 'pdo_dblib' \
    ;else \
    ########################################################################
    #  The following steps were taken from
    #  https://github.com/Microsoft/msphpsql/wiki/Install-and-configuration
    ########################################################################
    curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
    apt-get update -yqq && \
    ACCEPT_EULA=Y apt-get install -yqq msodbcsql17 mssql-tools unixodbc unixodbc-dev libgss3 odbcinst locales && \
    ln -sfn /opt/mssql-tools/bin/sqlcmd /usr/bin/sqlcmd && \
    ln -sfn /opt/mssql-tools/bin/bcp /usr/bin/bcp && \
    echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    locale-gen && \
    if [ $(php -r "echo PHP_MAJOR_VERSION;") = "7" ] && [ $(php -r "echo PHP_MINOR_VERSION;") = "2" ]; then \
    pecl install pdo_sqlsrv-5.8.1 sqlsrv-5.8.1 \
    ;elif [ $(php -r "echo PHP_MAJOR_VERSION;") = "7" ] && [ $(php -r "echo PHP_MINOR_VERSION;") = "1" ]; then \
    pecl install pdo_sqlsrv-5.6.1 sqlsrv-5.6.1 \
    ;elif [ $(php -r "echo PHP_MAJOR_VERSION;") = "7" ] && [ $(php -r "echo PHP_MINOR_VERSION;") = "0" ]; then \
    pecl install pdo_sqlsrv-5.3.0 sqlsrv-5.3.0 \
    ;elif [ $(php -r "echo PHP_MAJOR_VERSION;") = "8" ] && [ $(php -r "echo PHP_MINOR_VERSION;") = "1" ]; then \
    pecl install pdo_sqlsrv-5.10.0 sqlsrv-5.10.0 \
    ;else \
    pecl install pdo_sqlsrv sqlsrv \
    ;fi && \
    echo "extension=sqlsrv.so"     > /usr/local/etc/php/conf.d/20-sqlsrv.ini && \
    echo "extension=pdo_sqlsrv.so" > /usr/local/etc/php/conf.d/20-pdo_sqlsrv.ini && \
    php -m | grep -q 'sqlsrv' && \
    php -m | grep -q 'pdo_sqlsrv' \
    ;fi \
    ;fi

################################################################################
# INSTALL MYSQL:
################################################################################

ARG INSTALL_MYSQLI=false

RUN if [ ${INSTALL_MYSQLI} = true ]; then \
    docker-php-ext-install mysqli pdo_mysql \
    ;fi

################################################################################
# INSTALL NODEJS:
################################################################################

ARG INSTALL_NODEJS_LTS=false

RUN if [ ${INSTALL_NODEJS_LTS} = true ]; then \
    curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt install -y nodejs \
    ;fi

################################################################################
# INSTALL OCI8:
################################################################################

ARG INSTALL_OCI8=false
ARG ORACLE_INSTANT_CLIENT_MIRROR=https://github.com/diogomascarenha/oracle-instantclient/raw/master/

ENV LD_LIBRARY_PATH="/opt/oracle/instantclient_12_1"
ENV OCI_HOME="/opt/oracle/instantclient_12_1"
ENV OCI_LIB_DIR="/opt/oracle/instantclient_12_1"
ENV OCI_INCLUDE_DIR="/opt/oracle/instantclient_12_1/sdk/include"
ENV OCI_VERSION=12

RUN if [ ${INSTALL_OCI8} = true ]; then \
    # Install wget
    apt update && apt install --no-install-recommends -y wget \
    # Install Oracle Instantclient
    && mkdir /opt/oracle \
    && cd /opt/oracle \
    && wget ${ORACLE_INSTANT_CLIENT_MIRROR}instantclient-basic-linux.x64-12.1.0.2.0.zip \
    && wget ${ORACLE_INSTANT_CLIENT_MIRROR}instantclient-sdk-linux.x64-12.1.0.2.0.zip \
    && unzip /opt/oracle/instantclient-basic-linux.x64-12.1.0.2.0.zip -d /opt/oracle \
    && unzip /opt/oracle/instantclient-sdk-linux.x64-12.1.0.2.0.zip -d /opt/oracle \
    && ln -s /opt/oracle/instantclient_12_1/libclntsh.so.12.1 /opt/oracle/instantclient_12_1/libclntsh.so \
    && ln -s /opt/oracle/instantclient_12_1/libclntshcore.so.12.1 /opt/oracle/instantclient_12_1/libclntshcore.so \
    && ln -s /opt/oracle/instantclient_12_1/libocci.so.12.1 /opt/oracle/instantclient_12_1/libocci.so \
    && rm -rf /opt/oracle/*.zip \
    # Install PHP extensions deps
    && apt update \
    && apt install --no-install-recommends -y libaio-dev && \
    # Install PHP extensions
    if [ $(php -r "echo PHP_MAJOR_VERSION;") = "5" ]; then \
    echo 'instantclient,/opt/oracle/instantclient_12_1/' | pecl install oci8-2.0.10; \
    elif [ $(php -r "echo PHP_MAJOR_VERSION;") = "7" ]; then \
    echo 'instantclient,/opt/oracle/instantclient_12_1/' | pecl install oci8-2.2.0; \
    else \
    echo 'instantclient,/opt/oracle/instantclient_12_1/' | pecl install oci8; \
    fi \
    && echo "extension=oci8.so" >> /usr/local/etc/php/conf.d/docker-php-ext-oci8.ini \
    && php -m | grep -q 'oci8' \
    ;fi

################################################################################
# INSTALL OPCACHE:
################################################################################

ARG INSTALL_OPCACHE=false

RUN if [ ${INSTALL_OPCACHE} = true ]; then \
    docker-php-ext-install opcache \
    ;fi

################################################################################
# INSTALL PCNTL
################################################################################

ARG INSTALL_PCNTL=false

RUN if [ ${INSTALL_PCNTL} = true ]; then \
    # Installs pcntl, helpful for running Horizon
    docker-php-ext-install pcntl \
    ;fi

################################################################################
# INSTALL PGSQL
################################################################################

ARG INSTALL_PGSQL=false

RUN if [ ${INSTALL_PGSQL} = true ]; then \
    # Install the pgsql extension
    apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    ;fi

################################################################################
# INSTALL PHPDBG:
################################################################################

ARG INSTALL_PHPDBG=false

RUN if [ ${INSTALL_PHPDBG} = true ]; then \
    # Load the xdebug extension only with phpunit commands
    apt-get install -y --force-yes php${PHP_VERSION}-phpdbg \
    ;fi

################################################################################
# INSTALL PHPREDIS
################################################################################

ARG INSTALL_PHPREDIS=false

RUN if [ ${INSTALL_PHPREDIS} = true ]; then \
    # Install Php Redis Extension
    pecl install -o -f redis &&  docker-php-ext-enable redis \
    ;fi

################################################################################
# INSTALL SUPERVISOR
################################################################################

ARG INSTALL_SUPERVISOR=false

RUN if [ ${INSTALL_SUPERVISOR} = true ]; then \
    apt install supervisor -y \
    ;fi

################################################################################
# INSTALL SYMFONY
################################################################################

ARG INSTALL_SYMFONY_CLI=false

RUN if [ ${INSTALL_SYMFONY_CLI} = true ]; then \
    curl https://get.symfony.com/cli/installer | bash && \
    mv $HOME/.symfony/bin/symfony /usr/local/bin/symfony \
    ;fi

################################################################################
# INSTALL TOKENIZER:
################################################################################

ARG INSTALL_TOKENIZER=false

RUN if [ ${INSTALL_TOKENIZER} = true ]; then \
    docker-php-ext-install tokenizer \
    ;fi

################################################################################
# INSTALL VIM:
################################################################################

ARG INSTALL_VIM=false

RUN if [ ${INSTALL_VIM} = true ]; then \
    apt-get install -y --no-install-recommends vim \
    ;fi

################################################################################
# INSTALL XDEBUG:
################################################################################

ARG INSTALL_XDEBUG=false

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    # Install the xdebug extension
    pecl install xdebug && docker-php-ext-enable xdebug \
    ;fi

################################################################################
# INSTALL ZIPARCHIVE:
################################################################################

ARG INSTALL_ZIP_ARCHIVE=false

RUN if [ ${INSTALL_ZIP_ARCHIVE} = true ]; then \
    apt install libzip-dev -y \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    ;fi

################################################################################
# SET TIMEZONE
################################################################################

ARG TIMEZONE=UTC
ENV TIMEZONE=${TIMEZONE}

RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime \
    && echo $TIMEZONE > /etc/timezone

################################################################################
# CHECK PHP VERSION:
################################################################################

RUN php -v | head -n 1 | grep -q "PHP ${PHP_VERSION}."

################################################################################
# FINAL TOUCH:
################################################################################

COPY ./locale.gen /etc/locale.gen

COPY ./default.conf /usr/local/etc/php-fpm.d/fpm-pool.conf

# Clean up
RUN locale-gen && apt clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/log/lastlog /var/log/faillog

WORKDIR /srv/app

EXPOSE 9000

CMD ["php-fpm"]
