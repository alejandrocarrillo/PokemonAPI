FROM php:8.0.14-apache
RUN a2enmod rewrite
RUN a2enmod headers
RUN mkdir /var/www/html/PokemonAPI
ADD . /var/www/html/PokemonAPI
EXPOSE 80
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]