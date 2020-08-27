FROM nginx:alpine

LABEL maintaner="Ryan Durham <ryan@stagerightlabs.com>"

ARG NAME=www-data
ENV NAME ${NAME}
RUN deluser nginx && \
    delgroup www-data && \
    adduser -s /bin/sh -D -u 1000 -g '' ${NAME} ${NAME} && \
    chown -R www-data:www-data /var/cache/nginx

# remove default conf
RUN rm /etc/nginx/conf.d/default.conf

# add configuration
COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d/gzip.conf /etc/nginx/conf.d/gzip.conf
COPY conf.d/proxy.conf /etc/nginx/conf.d/proxy.conf
COPY conf.d/fastcgi.conf /etc/nginx/conf.d/fastcgi.conf

# add dommain conf
COPY domains/stagerightlabs.test.conf /etc/nginx/domains/stagerightlabs.test.conf

# fix perms
RUN mkdir -p /var/www && chown ${NAME}:${NAME} /var/www

# process
CMD ["nginx"]
EXPOSE 80
