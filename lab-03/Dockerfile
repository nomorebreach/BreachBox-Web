# Use standard PHP Apache image
FROM php:7.4-apache

# Install ping (required for the app to work)
RUN apt-get update && \
    apt-get install -y iputils-ping && \
    rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY index.php index.php

# Create the flag in the root directory
# The challenge is to read this file
RUN echo "CTF{C0mm4nd_1nj3ct10n_1s_Crit1c4l}" > /flag.txt

# Set permissions
RUN chown root:root /flag.txt
RUN chmod 444 /flag.txt
RUN chown -R www-data:www-data /var/www/html

# Expose web port
EXPOSE 80