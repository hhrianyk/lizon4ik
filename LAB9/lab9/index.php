<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <title>Лабораторна робота 9: Робота з базою даних на мові PHP</title>
   <link rel="STYLESHEET" type="text/css" href="../heads.css">

   <style>
      tr.br td {
         margin-left: 1.5cm;
         text-align: center;
         width: 120px;
         font-size: 5.5mm;
      }

      h3.code-ex {
         margin-left: 0.8cm;
         font-size: 0.5cm;
         color: black;
         text-align: justify;
         text-indent: 1.3cm;
      }

      .CodeMirror {
         margin-bottom: 30px;
      }

      .content {
         font-size: 0.4cm;
      }
   </style>

</head>
<?php include("../assets/insert_cm.php"); ?>

<body>
   <h1>ЛАБОРАТОРНА РОБОТА №9</h1>
   <h2><span class="beg">Тема:</span> Робота з базою даних на мові PHP</h2>
   <h2><span class="beg">Мета:</span> Оволодіти основними навичками роботи з базою даних MySQL на мові
      програмування PHP, включаючи підключення до бази даних, виконання SQL-запитів, обробку результатів
      та використання безпечних методів доступу до даних, щоб створити функціональні веб-застосунки.
   </h2>
   <a name="beg"></a>
   <h3>ЗМІСТ</h3>
   <dl>
      <dt><a class="com" href="#vv">Вступ</a></dt>
      <dt><a class="com" href="#1">1 Підключення до БД MySQL</a></dt>
      <dd><a class="com" href="#1.1">1.1 Підключення з використанням розширення MySQLi</a></dd>
      <dd><a class="com" href="#1.2">1.2 Підключення з використанням розширення PDO</a></dd>
      <dt><a class="com" href="#2">2 SQL-запити</a></dd>
      <dd><a class="com" href="#2.1">2.1 Виконання SQL-запитів за допомогою MySQLi та PDO</a></dd>
      <dd><a class="com" href="#2.2">2.2 Підготовлені запити з використанням розширень MySQLi та PDO</a></dd>
      <dt><a class="com" href="https://www.php.net/manual/en/">Довідник PHP</a></dt>
      <dt><a class="com" href="#zad">Індивідуальні завдання</a></dt>
   </dl>


   <a name="vv"></a>
   <h4>Вступ</h4>
   <p>Зазвичай для зберігання даних використовуються бази даних. PHP дозволяє використовувати різні системи
      управління базами даних, але на сьогодні найпопулярнішою у поєднанні з PHP є
      Система Управління Базами Даних MySQL (СУБД MySQL).<br>
      <span class="txt_abz">MySQL</span> - це безкоштовна система управління базами даних, розроблена компанією Oracle,
      яка дозволяє взаємодіяти з базою даних за допомогою SQL-команд. MySQL досить легко встановлювати та налаштовувати.
      Крім того, ця СУБД може працювати на всіх популярних операційних системах, таких як Windows, MacOS, Linux.
      MySQL відмінно підходить як для невеликих, так і для великих проєктів.<br>
      <span class="txt_abz">Сам</span> процес встановлення та налаштування MySQL можна знайти в відповідному
      керівництві - Керівництво з MySQL. У цьому випадку ми розглянемо тільки взаємодію PHP з MySQL.<br>
      <span class="txt_abz">Формально</span> існують два способи підключення до MySQL з PHP:
   </p>
   <ul class="list">
      <li>Бібліотека <a class="svoj" href="https://www.php.net/manual/en/book.mysqli.php">MySQLi</a>
         (Покращена MySQL);
      </li>
      <li>Бібліотека <a class="svoj" href="https://www.php.net/manual/en/book.pdo.php">PDO</a>
         (Об'єкти Даних PHP).
      </li>
   </ul>
   <p>Перевагою <span class="svoj">PDO</span> є те, що вона дозволяє працювати не тільки з MySQL, але й
      з іншими системами управління базами даних, такими як Firebird, PostgreSQL, SQLite, Oracle, MS SQL Server і так далі.
      За допомогою <span class="svoj">PDO</span> можна використовувати загальний підхід для підключення до підтримуваних
      систем баз даних, де часто достатньо змінити рядок підключення, що, звісно, надає більше гнучкості.
      Крім того, особливістю <span class="svoj">PDO</span> є те, що ця бібліотека представляє об'єктно-орієнтований
      підхід до роботи з базами даних.<br>
      <span class="txt_abz">Розширення</span> <span class="svoj">MySQLi</span> обмежене тільки однією СУБД - MySQL.
      <span class="svoj">MySQLi</span> надає два способи взаємодії
      з базами даних: об'єктно-орієнтований та процедурний. До переваг <span class="svoj">MySQLi</span>
      часто відносять той факт, що воне більше орієнтоване на специфіку MySQL, можливості, що є специфічними для цієї СУБД,
      і швидше використовує нововведення, що з'являються з новими версіями MySQL. Крім того, як перевагу
      <span class="svoj">MySQLi</span> часто називають більшу продуктивність і
      швидкість порівняно з <span class="svoj">PDO</span>.<br>
      <span class="txt_abz">В будь-якому</span> випадку на сьогодні обидва підходи досить поширені. Тому ми розглянемо,
      як працювати з MySQL як через <span class="svoj">PDO</span>, так і через <span class="svoj">MySQLi</span>.<br>
      <span class="txt_abz">Обидві</span> бібліотеки - і <span class="svoj">mysqli</span>, і
      <span class="svoj">pdo_mysql</span> - за замовчуванням включені в базовий комплект PHP.
      Просто треба незначно змінити файл конфігурації php.ini, щоб почати працювати з цими бібліотеками.<br>
      <span class="txt_abz">Для використання</span> бібліотеки mysqli для роботи з MySQL, вам потрібно
      розкоментувати відповідний рядок в файлі php.ini. Розкоментування означає видалення символу коментаря (;)
      перед рядком з налаштуванням.<br>
      <span class="txt_abz">Зазвичай</span>, ви знайдете такий рядок у файлі php.ini:<br><br>
      <span class="html">;extension=mysqli<br><br></span>
      <span class="txt_abz">Для</span> включення бібліотеки mysqli, просто видаліть символ коментаря (;),
      щоб рядок виглядав так:<br><br>
      <span class="html">extension=mysqli<br><br></span>
      <span class="txt_abz">Для</span> використання бібліотеки <span class="svoj">pdo_mysql</span> для роботи з MySQL
      вам також потрібно розкоментувати відповідний рядок у файлі php.ini.
      <span class="txt_abz">Зазвичай</span>, ви знайдете такий рядок у файлі php.ini:<br><br>
      <span class="html">;extension=pdo_mysql<br><br></span>
      <span class="txt_abz">Щоб</span> включити бібліотеку <span class="svoj">pdo_mysql</span>, видаліть символ коментаря (;),
      щоб рядок виглядав так:<br><br>
      <span class="html">extension=pdo_mysql<br><br></span>
      <span class="txt_abz">Після</span> цього збережіть зміни у файлі php.ini та перезавантажте сервер
      веб-застосунків для того, щоб зміни набули чинності. Тепер ви зможете використовувати обидві бібліотеки,
      <span class="svoj">mysqli</span> і <span class="svoj">pdo_mysql</span>, для роботи з базою даних MySQL в PHP.
   </p>

   <a name="1"></a>
   <p> <a class="out" href="#beg" style="margin-left:80%">Зміст</a></p>

   <h4>1 Підключення до БД MySQ</h4>

   <a name="1.1"></a>
   <h4 class="pod">1.1 Підключення з використанням розширення MySQLi </h4>
   <p>Для початку вам потрібно встановити з'єднання з сервером MySQL. Використовуйте конструктор класу
      <span class="svoj">mysqli</span> для створення об'єкта, який представляє з'єднання з сервером.
   </p>
   <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
\$db = new mysqli("localhost", "користувач", "пароль", "назва бази даних");
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
   <p>В цьому коді:</p>
   <ul class="list">
      <li>"localhost" - це хост, на якому розташована база даних. Вам потрібно вказати ім'я сервера,      
         на якому запущений MySQL.
      </li>
      <li>"користувач" - ім'я користувача бази даних, яке ви використовуєте для доступу до бази даних.</li>
      <li>"пароль" - пароль користувача бази даних.</li> 
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
   <p>Якщо підключення не вдалося, виведеться повідомлення про помилку і виконання скрипту призупиниться.<br>
      <span class="txt_abz">Пам'ятайте</span> про обробку помилок, які можуть виникнути під час роботи з базою даних.
      Використовуйте блоки <span class="svoj">try</span> та <span class="svoj">catch</span>, або перевіряйте значення
      <span class="svoj">connect_error</span> та <span class="svoj">error</span>, як показано вище, для виявлення
      та обробки помилок.
   </p>

   <a name="1.2"></a>
   <p> <a class="out" href="#beg" style="margin-left:80%">Зміст</a></p>
   <h4 class="pod">1.2 Підключення з використанням розширення PDO</h4>
   <p>Для підключення до бази даних MySQL з використанням <span class="svoj">PDO</span> використовуйте наступний код:</p>
   <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
try {
    \$db = new PDO("mysql:host=localhost;dbname=назва_бази_даних", "користувач", "пароль");
    \$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException \$e) {
    die("Помилка підключення: " . \$e->getMessage());
}
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         //showCodeAndResult($code, ['Наприклад', 'Результат']);
         ?>
      </div>
   </div>
   <p>В цьому коді:</p>
   <ul class="list">
      <li>"localhost" - це хост, на якому розміщена база даних.</li>
      <li>"назва_бази_даних" - назва бази даних, з якою ви хочете взаємодіяти.</li>
      <li>"користувач" - ім'я користувача бази даних.</li>
      <li>"пароль" - пароль користувача бази даних.</li>
   </ul>
   <p>Всі помилки та виключення мають бути оброблені для забезпечення стабільності та безпеки вашого застосунку.
      У цьому випадку використовуйте блоки <span class="svoj">try</span> та <span class="svoj">catch</span>
      для обробки винятків типу <span class="svoj">PDOException</span>.</p>

   <a name="2"></a>
   <p> <a class="out" href="#beg" style="margin-left:80%">Зміст</a></p>
   <h4>2 SQL-запити</h4>
   <a name="2.1"></a>
   <h4 class="pod">2.1 Виконання SQL-запитів за допомогою MySQLi та PDO</h4>
   <p> Після успішного підключення ви можете використовувати об'єкт <span class="svoj">$db</span> для виконання
      SQL-запитів до бази даних та отримання результатів з використанням <span class="svoj">MySQLi</span>.
      Наприклад, виконайте запит <span class="svoj">SELECT</span>і виведіть результати.
   </p>
   <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
\$sql = "SELECT ім'я, прізвище FROM користувачі";
\$result = \$db->query(\$sql);

if (\$result) {
    while (\$row = \$result->fetch_assoc()) {
        echo "Ім'я: " . \$row['ім'я'] . ", Прізвище: " . \$row['прізвище'] . "<br>";
    }
    \$result->close();
} else {
    echo "Помилка запиту: " . \$db->error;
}
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
   <p>Метод <span class="svoj">fetch_assoc()</span> використовується для отримання асоціативного масиву,
      який містить дані результату SQL-запиту. Цей метод дозволяє отримати рядок результату у вигляді
      асоціативного масиву, де ключами є назви стовпців (полів), а значеннями - відповідні значення з цього рядка. <br>
      <span class="txt_abz">Для виконання SQL-запитів</span> за допомогою бібліотеки <span class="svoj">pdo_mysql</span>
      використовуйте метод <span class="svoj">query</span> об'єкта <span class="svoj">PDO</span>.
   </p>
   <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
try {
    \$sql = "SELECT * FROM таблиця";
    \$stmt = \$db->query(\$sql);

    while (\$row = \$stmt->fetch(PDO::FETCH_ASSOC)) {
        // Обробка даних
    }
} catch (PDOException \$e) {
    echo "Помилка запиту: " . \$e->getMessage();
}
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
   <p>Метод <span class="svoj">fetch()</span> використовується для отримання наступного рядка результату SQL-запиту.
      Він дозволяє послідовно перебирати всі рядки результату запиту, доки не буде досягнута остання доступна запис.
   </p>

   <a name="2.2"></a>
   <p> <a class="out" href="#beg" style="margin-left:80%">Зміст</a></p>

   <h4 class="pod">2.2 Підготовлені запити з використанням розширень MySQLi та PDO</h4>
   <p> Для зменшення вразливості до SQL-ін'єкцій та спрощення роботи з даними використовуйте підготовлені запити.<br>
      <span class="txt_abz">Метод</span> <span class="svoj">prepare()</span> використовується для створення підготовленого
      SQL-запиту в контексті розширень <span class="svoj">MySQLi</span> та <span class="svoj">PDO</span>.
      Підготовлені запити корисні з точки зору безпеки та оптимізації, оскільки вони дозволяють вам вставляти параметри
      в запит безпосередньо, уникнути SQL-ін'єкцій та використовувати один і той же запит з різними значеннями параметрів.<br>
      <span class="txt_abz">Метод</span> <span class="svoj">bind_param()</span> у розширенні
      <span class="svoj">MySQLi</span> та методи <span class="svoj"> bindParam()</span> і <span class="svoj">bindValue()</span>
      у розширенні <span class="svoj">PDO</span> використовуються для прив'язки параметрів до підготовленого SQL-запиту.
      Вони дозволяють передавати значення параметрів безпосередньо у підготовлений запит і виконувати запит з цими значеннями.<br>
      <span class="txt_abz">Метод</span> <span class="svoj">execute()</span> використовується для виконання підготовленого
      SQL-запиту в контексті розширень <span class="svoj">MySQLi</span> та <span class="svoj">PDO</span>.
      Цей метод запускає виконання запиту з параметрами, які були попередньо прив'язані до підготовленого запиту методом
      <span class="svoj">bind_param()</span> в <span class="svoj">MySQLi</span> або методами
      <span class="svoj">bindParam()</span> і <span class="svoj">bindValue()</span> в <span class="svoj">PDO</span>.<br>
      <span class="txt_abz">Далі</span> наведений приклад підготовленого запиту з використанням <span class="svoj">MySQLi</span>.
   </p>
   <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
// Параметри підключення до бази даних
\$host = "localhost";
\$user = "користувач";
\$password = "пароль";
\$database = "назва_бази_даних";

// Підключення до бази даних
\$conn = new mysqli(\$host, \$user, \$password, \$database);

// SQL-запит з підготовленими параметрами
\$sql = "SELECT ім'я, прізвище FROM користувачі WHERE id = ?";

// Підготовлений запит
\$stmt = \$conn->prepare(\$sql);

// Параметри запиту
\$userId = 1; // Замініть на бажаний ідентифікатор користувача

// Прив'язка параметрів
\$stmt->bind_param("i", \$userId);

// Виконання підготовленого запиту
\$stmt->execute();

// Отримання результатів
\$result = \$stmt->get_result();

if (\$result) {
    while (\$row = \$result->fetch_assoc()) {
        // Обробка даних
    }
} else {
    echo "Помилка запиту: " . \$conn->error;
}

// Закриття підготовленого запиту та з'єднання
\$stmt->close();
\$conn->close();
EOF;
         codeStart('Приклад №1');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
   <p>У цьому прикладі <span class="svoj">bind_param()</span> використовується для прив'язки параметра ? в SQL-запиту
      до змінної <span class="svoj">$userId</span>. Після прив'язки параметра ви викликаєте <span class="svoj">execute()</span>,
      щоб виконати підготовлений запит з вказаним значенням параметра. Цей підхід дозволяє вам безпечно вставляти значення
      параметрів в SQL-запити і уникати SQL-ін'єкцій.</p>
   <p>Використання <span class="svoj">execute()</span> з <span class="svoj">PDO</span>.</p>
   <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
// Параметри підключення до бази даних
\$host = "localhost";
\$user = "користувач";
\$password = "пароль";
\$database = "назва_бази_даних";

try {
    // Підключення до бази даних
    \$conn = new PDO("mysql:host=\$host;dbname=\$database", \$user, \$password);
    \$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL-запит з підготовленими параметрами
    \$sql = "SELECT ім'я, прізвище FROM користувачі WHERE id = :userId";
    
    // Підготовлений запит
    \$stmt = \$conn->prepare(\$sql);
    
    // Параметри запиту
    \$userId = 1; // Замініть на бажаний ідентифікатор користувача
    
    // Прив'язка параметрів
    
    \$stmt->bindParam(':userId', \$userId, PDO::PARAM_INT);
    
    // Виконання підготовленого запиту
    \$stmt->execute();
    
    // Отримання результатів
    while (\$row = \$stmt->fetch(PDO::FETCH_ASSOC)) {
        // Обробка даних
    }
} catch (PDOException \$e) {
    echo "Помилка підключення або запиту: " . \$e->getMessage();
}

EOF;
         codeStart('Приклад №2');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
   <p>У цьому прикладі <span class="svoj">bindParam()</span> використовується для прив'язки параметра
      <span class="svoj">:userId</span> в SQL-запиту до змінної <span class="svoj">$userId</span>.
      Параметр також має вказаний тип даних <span class="svoj">PDO::PARAM_INT</span>, що вказує,
      що значення цього параметра є цілим числом. Після прив'язки параметра ви викликаєте
      <span class="svoj">execute()</span>, щоб виконати підготовлений запит з вказаними значеннями параметрів.<br>
      <span class="txt_abz">Цей підхід</span> дозволяє вставляти значення параметрів в SQL-запити і
      уникати SQL-ін'єкцій, а також надає більшу гнучкість в опрацюванні типів даних параметрів.
   </p>

   <p>Методи <span class="svoj">bindParam()</span> і <span class="svoj">bindValue()</span> в розширенні
      <span class="svoj">PDO</span> використовуються для прив'язки значень до параметрів в підготовленому SQL-запиті.
      Обидва методи виконують схожу функцію, але є деякі відмінності:
   <ul class="list">
      <li>bindParam() дозволяє вказати параметр за посиланням на змінну. Це означає, 
         що якщо значення змінної змінюється після прив'язки параметра і до виклику execute(), 
         то це нове значення буде використане в запиті.
         Ви можете вказати тип даних параметра (наприклад, PDO::PARAM_INT, PDO::PARAM_STR, тощо), 
         що дозволяє зробити конвертацію типів.
      </li>
      <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
\$stmt->bindParam(':paramName', \$value, PDO::PARAM_TYPE);
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
      
   <li>bindValue() дозволяє вставити значення параметра безпосередньо в запит, і воно залишиться незмінним після прив'язки.
      Ви також можете вказати тип даних параметра.
      </li>
      <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
\$stmt->bindValue(':paramName', \$value, PDO::PARAM_TYPE);
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>
   </ul>      
   <p>Обидва методи є корисними і можуть бути використані в залежності від ваших потреб. Вибір між ними залежить від того, 
      чи ви бажаєте, щоб значення параметра залишалося незмінним після прив'язки (в такому випадку ви можете 
      використовувати <span class="svoj">bindValue()</span>), або ви бажаєте, щоб параметр посилався на змінну 
      і оновлювався автоматично (в такому випадку ви можете використовувати <span class="svoj">bindParam()</span>).<br>
      <span class="txt_abz">Приклади</span> використання обох методів:
      <div class="container">
      <div class="content">
         <?php
         $code = <<< EOF
// Використання bindParam()
\$stmt = \$conn->prepare("SELECT ім'я, прізвище FROM користувачі WHERE id = :userId");
\$userId = 1;
\$stmt->bindParam(':userId', \$userId, PDO::PARAM_INT);
\$userId = 2; // Значення параметра буде оновлене

// Використання bindValue()
\$stmt = \$conn->prepare("SELECT ім'я, прізвище FROM користувачі WHERE id = :userId");
\$userId = 1;
\$stmt->bindValue(':userId', \$userId, PDO::PARAM_INT);
\$userId = 2; // Значення параметра залишиться незмінним
EOF;
         codeStart('Наприклад');
         echo $code;
         codeEnd();
         ?>
      </div>
   </div>

   <a name="zad"></a>
   <p> <a class="out" href="#beg" style="margin-left:80%">Зміст</a></p>

   <h4>Індивідуальні завдання </h4>
   <p> Використовуючи розроблений у лабораторній роботі 7-8 багатосторінковий сайт, виконати такі дії:</p>
   <ul class="list">
      <li>Додати сторінку з формою, за допомогою якої користувач може завантажити файл із зображенням на сервер.</li>
      <li>Додати БД, в якій на сервері зберігатимуться дані користувача, його відповіді на запитання та
         файл із завантаженою картинкою. БД повнна бути нормалізованою до 3-ї нормальної форми.
         Роботу з БД виконати за допомогою розширення:
         <ul class="list2">
            <li>MySQLi для парних номерів; </li>
            <li>PDO для непарних номерів.</li>
         </ul>
      </li>
      <li>Додати кнопку, за якою користувач може переглянути завантажену ним картинку
         та/або його відповіді (використовувати підготовлені запити).
      </li>
   </ul>



   <?php include("../assets/codemirror.html"); ?>

</body>

</html>