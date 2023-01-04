FROM node:lts-alpine

RUN npm install -g http-server

WORKDIR /var/www/html

COPY . .

EXPOSE 8000

CMD [ "http-server", "dist" ]

