FROM php:8.4-apache
RUN a2enmod rewrite
COPY ./ /var/www/html
RUN rm -f /var/www/html/db.sqlite && \
	chown www-data:www-data -R /var/www/html && \
	find /var/www/html -type f -exec chmod 644 {} \; && \
	find /var/www/html -type d -exec chmod 755 {} \;
EXPOSE 80
