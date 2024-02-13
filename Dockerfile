
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
	netcat \
	ncat 

COPY ./page/ /var/www/html
COPY ./resources/script.sh /tmp/script.sh

ENTRYPOINT  ./tmp/script.sh  && service apache2 start &&  /bin/bash
