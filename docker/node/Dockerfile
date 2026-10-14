FROM node:22-alpine

LABEL authors="Ryan Durham <ryan@stagerightlabs.com>"

RUN npm install -g pnpm@12.11.2

USER node

WORKDIR /var/www

CMD [ "pnpm", "dev" ]
