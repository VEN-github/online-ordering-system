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
RUN cd storage/app
RUN ls -la
RUN cd app
RUN ls -la
RUN mkdir public
RUN chmod -R 777 storage/app/public

CMD ["/start.sh"]
