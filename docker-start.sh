#!/bin/bash

### BEGIN OF FUNCTIONS ##

# ------------------------------------------------------------
# Verifica se 'docker' e 'docker-compose' estão instalados.
# ------------------------------------------------------------
function docker_installed {

	docker_exists=$(command -v docker)
	compose_exists=$(command -v docker-compose)

	if [[ ( -z $docker_exists ) || ( -z $compose_exists ) ]]; then
		echo "ERROR: Make sure 'docker' and 'docker-compose' are installed."
		exit 1
	fi
}

# ------------------------------------------------------------
# Cria os arquivos de configuração.
# ------------------------------------------------------------
function local_config {
	cd $_ROOT
	mkdir -pv .local
	touch .local/.bash_history

	if [[ ( -f .env ) && ( ! -L .env ) ]]; then
		mv -fv .env .local/
	elif [[ ( ! -f .env ) || ( -L .env ) ]]; then
		cp ../template.env .local/.env
	fi

	ln -fsv .local/.env
	cd $from_dir
}

# ------------------------------------------------------------
# Instala as dependências usando o 'composer'.
# ------------------------------------------------------------
function composer_install {

	cmd_exists=$(command -v composer)
	img_exists=$(docker images composer -q)
	cmd_to_run='composer install --ignore-platform-reqs'

	if [ ! -z $cmd_exists ]; then
		$cmd_to_run
	else
		docker run --rm -it \
			-u ${_UID}:${_GID} \
			-v /etc/localtime:/etc/localtime:ro \
			-v ${_ROOT}:${_ROOT} \
			-w ${_ROOT} \
			$cmd_to_run
	fi

	if [ -z $img_exists ]; then
		docker image rm composer
	fi
}

# ------------------------------------------------------------
# Remove entradas repetidas no histórico do bash.
# ------------------------------------------------------------
function history_prune {

	mv -f $_ROOT/.local/.bash_history /tmp
	awk '!seen[$0]++' /tmp/.bash_history | grep -v exit > $_ROOT/.local/.bash_history
}

### END OF FUNCTIONS ###


### BEGIN OF CHECKS/VARS ###

docker_installed

case "$OSTYPE" in
  linux*)   LOCAL_IP=`ip route get 1 | awk '{print $NF;exit}'` ;;
  darwin*)  LOCAL_IP=$(ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1') ;;
  win*)     LOCAL_IP=$( ipconfig | awk '/192.168./ {print $NF;exit}' ) ;;
  msys*)     LOCAL_IP=$( ipconfig | awk '/192.168./ {print $NF;exit}' ) ;;
esac

echo "Iniciando Docker/XDebug em: $LOCAL_IP"
export _XDEBUG_REMOTE_HOST=$LOCAL_IP
export _XDEBUG_REMOTE_PORT=9000

from_dir=$PWD
_ROOT=$(dirname ${BASH_SOURCE[0]})

if [ $_ROOT == . ]; then
	_ROOT=$from_dir
fi

curr_folder=$(basename $_ROOT)
yml_file="$_ROOT/docker/docker-compose.yml"
compose_default_args="-f $yml_file -p $curr_folder"

export _HOSTNAME=$curr_folder
export _GID=$(id -g)
export _UID=$(id -u)
export _ROOT

if [ ! -d "$_ROOT/.local" ]; then
	local_config
fi

if [ ! -d "$_ROOT/vendor" ]; then
	composer_install
fi

### END OF CHECKS/VARS ###

if [ "$1" == "build" ];
  then
        docker-compose $compose_default_args up -d --build
  else
        docker-compose $compose_default_args up -d
fi

docker-compose $compose_default_args exec console bash
history_prune
docker-compose $compose_default_args down
