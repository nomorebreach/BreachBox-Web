# Use the official PHP Apache image
FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Copy the application source code to the web root
COPY index.php index.php

# Copy the flag to the root directory (outside web root)
# This forces the user to use traversal (../../) to reach it
COPY flag.txt /flag.txt

# Set permissions (read-only for flag)
RUN chmod 444 /flag.txt
RUN chown www-data:www-data /var/www/html/index.php

# Expose port 80
EXPOSE 80