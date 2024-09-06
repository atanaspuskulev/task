<p align="center"><h3>Simple test application</h3></p>

## Тестова задача

## Инсталиране

- Добавете хоста task.test във вашоят host файл;
- Може да използвате директно Docker - docker-compose build --no-cache; docker-compose up;
- Ако не използвате Docker - настройте vhost task.test да сочи към папка public;
- в root-a на проекта - изпълнете composer install; Ако използвате Docker: docker exec -it php_test_app bash и изпълнете composer install;
- phpmyadmin може да бъде достъпен на localhost:8081
- В главната папка има tasks.sql файл, който може да импортирате в базата си. Той създава таблицата и записва тестови данни.

## Пояснения

- Гледал съм всичко да е съвсем просто и кратко (колкото може за тази функционалност).
Все пак съм се постарал да засегна някои теми. Не съм слагал коментари (освен няколко), вярвам, че ако кода е лесен за четене няма нужда от коментари.
