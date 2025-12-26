FROM php:7.4-apache

# Working directory
WORKDIR /var/www/html

# Copy index.php
COPY index.php index.php

# Create a directory for the database in /tmp
# We use /tmp to ensure it is writable by the www-data user
# without complex permission management in the Dockerfile
RUN touch /tmp/ctf_users.db && \
    chmod 666 /tmp/ctf_users.db

# Expose port 80
EXPOSE 80