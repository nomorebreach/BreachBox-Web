# Use standard PHP Apache image
FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY index.php index.php

# Create uploads directory and set permissions
# This is crucial: www-data needs write access to save the uploaded files
RUN mkdir uploads && \
    chown -R www-data:www-data /var/www/html/uploads && \
    chmod 755 /var/www/html/uploads

# Create the flag in the root directory
# The challenge is to read this file via a web shell
RUN echo "CTF{Unr3strict3d_Upl0ad_L3ads_To_RCE}" > /flag.txt

# Secure the flag (root owned, readable by others)
RUN chown root:root /flag.txt
RUN chmod 444 /flag.txt

# Expose web port
EXPOSE 80