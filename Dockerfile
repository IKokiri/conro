FROM ubuntu:latest
RUN apt-get update -y && apt-get install mysql-server -y
CMD bash