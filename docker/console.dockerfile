FROM php:7-cli-alpine

RUN apk update

RUN apk add -f \
		autoconf \
		bash \
		bash-completion \
		g++ \
		make \
		sudo \
	&& pecl install xdebug \
	&& docker-php-ext-enable xdebug \
	&& echo -e "xdebug.remote_enable=on\nxdebug.remote_autostart=on" >> ${PHP_INI_DIR}/conf.d/xdebug.ini

ENV PS1='\u@\h:\w\$ '

ARG GID=1000
ARG UID=1000
ARG USER=developer

RUN mkdir -pv /home/${USER} \
	&& rm -frv /root \
	&& ln -fsv /home/${USER} /root \
	&& addgroup -g ${GID} ${USER} \
	&& adduser -DS \
		-h /home/${USER} \
		-u ${UID} \
		-G ${USER} \
		${USER} \
	&& echo "${USER} ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/${USER} \
	&& chown -Rv ${USER} /home/${USER}

USER ${USER}
