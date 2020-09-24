FROM postgres:12

LABEL authors="Ryan Durham <ryan@stagerightlabs.com>"

# Install vim
RUN apt update && apt install vim -y

# Copy over the .psqlrc configuration file
COPY --chown=postgres:postgres .psqlrc /var/lib/postgresql/

# Copy our init.sql into the container
# This will only be run if the persistence volume is empty
COPY --chown=postgres:postgres init.sql /docker-entrypoint-initdb.d/

WORKDIR /var/lib/postgresql
ENV PATH "$PATH:/var/lib/postgresql"
