FROM nginx:1.18-alpine

COPY ./docker/nginx/config/default.conf /etc/nginx/conf.d/default.conf

RUN apk update
RUN apk add bash bash-doc bash-completion

WORKDIR /var/www