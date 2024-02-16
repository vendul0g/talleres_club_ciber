
FROM ubuntu:latest

MAINTAINER Club_ciberseguridad_FIUM

ENV DEBIAN_FRONTEND noninteractive

RUN apt update && apt install -y net-tools \
	iputils-ping \
	curl \	
	git \
	nano \
	apache2 \
	php \
	php-mysql \
	mariadb-server \
	netcat \
	ncat \
	vsftpd \
	ftp 

COPY ./BD.sql  /tmp/bd.sql
COPY ./page/ /var/www/html
COPY ./resources/script.sh /tmp/script.sh
COPY ./resources/create.sh /tmp/create.sh

ENTRYPOINT a2dismod --force autoindex && service apache2 start  && cd /tmp && ./script.sh && ./create.sh  &&service vsftpd start && service mariadb start && mysql -u root  < /tmp/bd.sql && echo 'fl4g{y0u_4r3_4m3zing}' > /home/secret/flag.txt && echo 'fl4g{sh4d0w_Is_d4ng3r0us}' > /home/javier/flag.txt  &&  /bin/bash
