FROM php:7.1-alpine

ENV PS1='\u@\h:\w\$ '

ARG GID=1000
ARG UID=1000
ARG USER=developer
ARG LOCAL_IP_TESTE=${_LOCAL_IP_TESTE}
ARG LOCAL_PORT_TESTE=${_LOCAL_PORT_TESTE}

# Instalando extensoes necessarias do PHP
    RUN apk add -q --update curl git zip autoconf alpine-sdk bash sudo nano \
        && pecl install xdebug \

    RUN docker-php-ext-enable xdebug \
        && echo "Iniciando Docker/XDebug em: ${LOCAL_IP_TESTE}:${LOCAL_PORT_TESTE}" \
        && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" >> $PHP_INI_DIR/conf.d/xdebug.ini \
        && echo -e "xdebug.remote_enable=1" >> $PHP_INI_DIR/conf.d/xdebug.ini \
        && echo -e "xdebug.remote_host=${HOST_XDEBUG}" >> $PHP_INI_DIR/conf.d/xdebug.ini \
        && echo -e "xdebug.remote_port=${PORT_XDEBUG}" >> $PHP_INI_DIR/conf.d/xdebug.ini \
        && echo -e "xdebug.remote_autostart=1" >> $PHP_INI_DIR/conf.d/xdebug.ini \
        && echo -e "xdebug.remote_connect_back=0" >> $PHP_INI_DIR/conf.d/xdebug.ini \
        && echo -e "xdebug.idekey='dockerTeste'" >> $PHP_INI_DIR/conf.d/xdebug.ini

    RUN apk del autoconf alpine-sdk \
        && rm -rf /var/cache/apk/* \
        && echo "memory_limit=-1" > $PHP_INI_DIR/conf.d/memory-limit.ini \
        && echo "date.timezone=${PHP_TIMEZONE:-UTC}" > $PHP_INI_DIR/conf.d/date_timezone.ini

# Instalando o Composer
    RUN curl -o composer-setup.php https://getcomposer.org/installer \
        && curl -o composer-setup.sig https://composer.github.io/installer.sig  \
        && php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) !== trim(file_get_contents('composer-setup.sig'))) { unlink('composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
        && php composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer \
        && php -r "unlink('composer-setup.php');" \
        && php -r "unlink('composer-setup.sig');" \
        && composer global -q require "phpunit/phpunit:^6.00"

# Dando permissoes e criando os diretorios do repositorio
    RUN mkdir -pv /home/${USER} \
	&& addgroup -g ${GID} ${USER} \
	&& adduser -DS \
		-h /home/${USER} \
		-u ${UID} \
		-G ${USER} \
		${USER} \
	&& echo "${USER} ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/${USER} \
	&& chown -Rv ${USER} /home/${USER}

ENV WEBDRIVER_DOCKER="http://${LOCAL_IP_TESTE}:4444/wd/hub"
ENV PATH="$PATH:/src"

USER ${USER}