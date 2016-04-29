# php-simple-accounting-system
Учёт успеваемости студентов, работа с экзаменами, статистика по экзаменам 

# Настройка

## 1
Импортируйте дамп базы данных из каталога db

## 2
Создайте в каталоге db файл db_settings.php и добавьте в него следующее:<br>
`<?php`<br>
`$dbhost = "localhost"; //или имя хоста, если БД не на локальном сервере`<br>
`$dbname = "accounting_performance"; //имя вашей БД`<br>
`$dbusername = "root"; //ваш логин`<br>
`$dbpassword = "root"; //ваш пароль`<br>
