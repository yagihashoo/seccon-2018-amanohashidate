FROM ubuntu

ENV DEBIAN_FRONTENT=noninteractive
ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=1
ENV LANG=en_US.UTF-8

COPY flag.txt /flag.txt

RUN groupadd -g 1000 worker && useradd -g worker -u 500 --create-home worker

RUN apt-get -y update && apt-get -y install software-properties-common

RUN set -xe && apt-get -y install --no-install-recommends ca-certificates curl socat xvfb x11vnc fluxbox xterm sudo supervisor

RUN set -xe
RUN curl -fsSL https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add -
RUN echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" > /etc/apt/sources.list.d/google-chrome.list

RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php

RUN apt-get -y dist-upgrade
RUN curl -sL https://deb.nodesource.com/setup_9.x | sudo -E sh -


RUN apt-get -y update
RUN apt-get -y install nodejs php7.2 google-chrome-stable

RUN rm -rf /var/lib/apt/lists/*

ENTRYPOINT sudo -u worker \
           REDIS_BACKEND=redis:6379 \
           QUEUE=worker \
           INTERVAL=5 \
           APP_INCLUDE=/home/worker/worker/app/Worker/Worker.php \
           /home/worker/worker/vendor/bin/resque
