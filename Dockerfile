FROM richarvey/nginx-php-fpm:latest

COPY . .

# Install required dependencies
RUN apk update

# Install the `npm` package
RUN apk add --no-cache npm

# Install NPM dependencies
RUN npm install

# Build Vite assets
RUN npm run build

# Storage
RUN chmod -R 777 /var/www/html/storage
RUN chown -R nginx:nginx /var/www/html/storage

CMD ["/start.sh"]
