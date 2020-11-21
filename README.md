#初期docker起動
docker-compose up -d

#compose install
docker-compose exec php composer install

#DBインストール
docker-compose exec php php artisan migrate

#npm install
docker-compose exec php npm install

#npm起動
docker-compose exec php npm run watch 

