FROM alpine:3.6

RUN apk update

ARG NOVNC_DEP="\
		bash \
		expect \
		git \
		net-tools \
		procps \
		python \
		wget \
		"
ARG NOVNC_DIR=/opt/novnc
ARG NOVNC_URL="https://github.com/douglasbefore/noVNC/archive/v1.0.0-beta.tar.gz"

RUN apk add ${NOVNC_DEP}

RUN mkdir -pv ${NOVNC_DIR} \
	&& cd ${NOVNC_DIR} \
	&& echo "caminho NVC: ${NOVNC_DIR}" \
	&& wget ${NOVNC_URL} -qO - | tar -xzvf - --strip-components=1 \
	&& ln -fsv vnc.html index.html \
	&& echo -e "set timeout 120\nspawn ./utils/launch.sh\nexpect \"Using local websockify\"\nsend \\x03" | expect \
	&& echo -e "#!/bin/sh\n${PWD}/utils/launch.sh --vnc \$@:5900\nexit \$?" > /usr/bin/connect \
	&& chmod +x -v /usr/bin/connect

ENV VNC_VIEW_ONLY=true
ENV VNC_PW = ''

WORKDIR ${NOVNC_DIR}

ENTRYPOINT ["connect"]
