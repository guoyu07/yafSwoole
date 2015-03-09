yafSwoole
========

* Yaf with Swoole Http_Server
* In high-concurrency situations,will be better than php-fpm

## Requirements

* PHP 5.3+
* yaf 2.2+
* Swoole 1.7.8+
* Linux, OS X and basic Windows support (Thinks to cygwin)

## Installation Yaf
1. Install via pecl
    
    ```
    pecl install yaf
    ```

2. Install from source

    ```
    git clone https://github.com/php/pecl-system-yaf.git
    cd pecl-system-yaf
    phpize
    ./configure
    make && make install
    ```

## Installation Swoole

1. Install via pecl
    
    ```
    pecl install swoole
    ```

2. Install from source

    ```
    git clone https://github.com/swoole/swoole-src.git
    cd swoole-src
    phpize
    ./configure
    make && make install
    ```

## How to run
1. cd yiiSwoole/application
2. php server.php
3. Open your browser and enter http://ip:9501

## Run with php-fpm
1. This application in a state of  beta,if you find some bug,it can run with php-fpm to fix bug
2. Set nginx root dir with yafSwoole/application
3. Open your browser and enter http://ip/index.php

##Thanks
1. When beginning,this project fork from https://github.com/LinkedDestiny/swoole-yaf
2. this fork will add some thirdparty lib to yaf


