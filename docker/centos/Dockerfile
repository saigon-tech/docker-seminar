FROM centos:7.4.1708

RUN yum clean all && yum -y update
RUN yum -y install epel-release
RUN yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN yum -y install httpd mod_ssl php72 php72-php php72-php-mbstring php72-php-mysqlnd php72-php-opcache php72-php-gd php72-php-mcrypt php72-php-xml php72-php-xmlrpc

# apache /srv
RUN sed -i -e "s/var\/www\/html/srv\/public/g" /etc/httpd/conf/httpd.conf
RUN sed -i -e "s/    AllowOverride None/    AllowOverride All/g" /etc/httpd/conf/httpd.conf
RUN echo 'Timeout 600' >> /etc/httpd/conf/httpd.conf

# php 72
RUN sed -i -e "s/\;date.timezone =/date.timezone = \"Asia\/Tokyo\"/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/\;mbstring.internal_encoding =/mbstring.internal_encoding = \"UTF-8\"/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/\;mbstring.language =/mbstring.language =/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/memory_limit = 128M/memory_limit = 256M/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/post_max_size = 8M/post_max_size = 256M/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/upload_max_filesize = 2M/upload_max_filesize = 256M/g" /etc/opt/remi/php72/php.ini

# Entrypoint
ADD docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT /docker-entrypoint.sh
