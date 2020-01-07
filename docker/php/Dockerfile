FROM php:7.1-fpm

# パッケージリストの更新
RUN ["apt-get", "update"]

# vimのインストール/更新
RUN ["apt-get", "install", "-y", "vim"]

# libpng-devを有効に。PNG形式のファイル読み書きのためのライブラリ
RUN ["apt-get", "install", "-y", "libpng-dev"]

# zlib は gzip と PKZIP で使われている deflate 圧縮法を実装したライブラリ 
RUN ["apt-get", "install", "-y", "zlib1g-dev"]

# RUN echo 'PATH=$PATH:/usr/sbin' >> ~/.bashrc

# # PDOを有効にする phpフォルダが作られるusr/src --with~~はオプション
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-install mbstring gd pdo pdo_mysql mysqli
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip

RUN echo 'error_reporting = E_ALL' >> /usr/local/etc/php/conf.d/99_myconf.ini
RUN echo 'date.timezone = Asia/Tokyo' >> /usr/local/etc/php/conf.d/99_myconf.ini
RUN echo 'max_input_vars = 10000' >> /usr/local/etc/php/conf.d/99_myconf.ini

# デバッグしやすいように色つけてくれたり
RUN pecl install Xdebug 2.7.0
COPY php.xdebug.ini /usr/local/etc/php/conf.d/
COPY session.ini /usr/local/etc/php/conf.d/