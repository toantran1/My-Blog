FROM ubuntu:20.04

RUN DEBIAN_FRONTEND=noninteractive

RUN apt-get update

# Install apache
RUN apt-get install -y apache2

# Install php
RUN apt-get install -y php libapache2-mod-php php-mcrypt php-mysql
	
# Install mysql
RUN echo "mysql-server mysql-server/root_password password root" | debconf-set-selections \
    && echo "mysql-server mysql-server/root_password_again password root" | debconf-set-selections \
    && apt-get install -y mysql-server
	
WORKDIR /var/www/html

RUN mkdir /boot_script
COPY start.sh /boot_script
RUN chmod a+x /boot_script/*


ENTRYPOINT ["/boot_script/start.sh"]

EXPOSE 80