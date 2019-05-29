FROM centos:centos7

RUN yum install -y gcc-c++ make
RUN curl -sL https://rpm.nodesource.com/setup_10.x | bash -
RUN yum install -y nodejs

RUN yum -y install epel-release
RUN yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN yum -y install --enablerepo=remi,remi-php72 php php-mbstring php-xml php-xmlrpc php-gd php-pdo php-pecl-mcrypt php-mysqlnd php-pecl-mysql php-redis

RUN : > /etc/yum.repos.d/google-chrome.repo
RUN echo '[google-chrome]' >> /etc/yum.repos.d/google-chrome.repo
RUN echo 'name=google-chrome' >> /etc/yum.repos.d/google-chrome.repo
RUN echo 'baseurl=http://dl.google.com/linux/chrome/rpm/stable/$basearch' >> /etc/yum.repos.d/google-chrome.repo
RUN echo 'enabled=1' >> /etc/yum.repos.d/google-chrome.repo
RUN echo 'gpgcheck=1' >> /etc/yum.repos.d/google-chrome.repo
RUN echo 'gpgkey=https://dl-ssl.google.com/linux/linux_signing_key.pub' >> /etc/yum.repos.d/google-chrome.repo
RUN yum -y update
RUN yum -y install google-chrome-stable

# Uncomment to skip the chromium download when installing puppeteer. If you do,
# you'll need to launch puppeteer with:
#     browser.launch({executablePath: 'google-chrome-stable'})
# ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD true

# Add user so we don't need --no-sandbox.
RUN groupadd -r worker && useradd -r -g worker -G audio,video worker \
    && mkdir -p /home/worker/Downloads \
    && chown -R worker:worker /home/worker

# Run everything after as non-privileged user.
USER worker
