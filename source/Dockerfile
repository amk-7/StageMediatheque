FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx 
RUN apt install software-properties-common -y && type apt-add-repository && apt-add-repository ppa:ansible/ansible && apt list -a ansible && apt install ansible
RUN add-apt-repository ppa:ondrej/php && apt-get update
RUN apt-get install -y php7.4 && apt-get install php7.4-pgsql php-7.4-pdo
#COPY usersc.php ./usr/share/nginx/html/index.php
ENTRYPOINT ["nginx", "-g", "daemon off;"]
