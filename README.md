Run:

`docker-compose up --build`

`docker exec -it blog-microservices_posts_1 php artisan migrate --database=mysql_posts`

`docker exec -it blog-microservices_comments_1 php artisan migrate --database=mysql_comments`

Go to `localhost:8000`