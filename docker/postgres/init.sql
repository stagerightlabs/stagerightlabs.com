CREATE USER stagerightlabs;
ALTER USER stagerightlabs WITH PASSWORD 'secret';

CREATE DATABASE stagerightlabs_dev OWNER stagerightlabs;
GRANT ALL PRIVILEGES ON DATABASE stagerightlabs_dev TO stagerightlabs;

CREATE DATABASE stagerightlabs_test OWNER stagerightlabs;
GRANT ALL PRIVILEGES ON DATABASE stagerightlabs_test TO stagerightlabs;
