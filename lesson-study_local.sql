-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 05 2023 г., 07:07
-- Версия сервера: 5.6.51-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson-study.local`
--

-- --------------------------------------------------------

--
-- Структура таблицы `db_list_books`
--

CREATE TABLE `db_list_books` (
  `book_id` int(11) NOT NULL,
  `book_photo` varchar(250) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_price` int(11) NOT NULL,
  `book_publishing` varchar(250) NOT NULL,
  `book_isbn` varchar(150) NOT NULL,
  `book_language` varchar(50) NOT NULL,
  `book_author_name` varchar(255) NOT NULL,
  `book_year_publication` int(4) NOT NULL,
  `book_number_page` int(11) NOT NULL,
  `book_about_author` text NOT NULL,
  `book_annotation` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_list_book_materials`
--

CREATE TABLE `db_list_book_materials` (
  `book_material_id` int(11) NOT NULL,
  `book_material_parent_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_material_theme` varchar(250) NOT NULL,
  `book_material` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_list_courses`
--

CREATE TABLE `db_list_courses` (
  `course_id` int(11) NOT NULL,
  `course_photo` varchar(250) NOT NULL,
  `course_name` varchar(250) NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_author_name` varchar(250) NOT NULL,
  `course_about` text NOT NULL,
  `course_introduction` varchar(250) NOT NULL,
  `course_for_who_is` text NOT NULL,
  `course_what_will_you_learn` text NOT NULL,
  `course_author_info` text NOT NULL,
  `course_date_started` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_list_courses`
--

INSERT INTO `db_list_courses` (`course_id`, `course_photo`, `course_name`, `course_price`, `course_author_name`, `course_about`, `course_introduction`, `course_for_who_is`, `course_what_will_you_learn`, `course_author_info`, `course_date_started`, `status`) VALUES
(5, 'imagecplus.jpg', 'C++', 10000, 'Администратор', '<p>Первые версии языка C++ (си-плюс-плюс, еще его называют &laquo;си-пи-пи&raquo; и &laquo;плюсы&raquo;) появились в начале 1980-х годов. Их создатель &mdash; датский программист из компании Bell Laboratories Бьерн Страуструп. Он моделировал распределения вызовов по АТС (автоматическим телефонным станциям).</p>\r\n\r\n<p>Тогда у Страуструпа было два типа языков: низкоуровневые и языки на основе Фортрана или Алгола, которые были очень медленными.</p>\r\n', '<p>C++ &mdash; как конструктор Lego: вы можете собрать свой замок мечты, а можете кричать от боли, наступая на забытые на полу детали. На нем пишут игры и обучают нейросети, благодаря ему работает поиск Google и роботы торговых бирж. Вместе с Никитой', '<p>Да, если вы хотите разрабатывать сложные продукты и сервисы. Опытные C++-программисты &mdash; это разработчики ИИ, беспилотных автомобилей, нейронных сетей, банковских, поисковых и ГИС-систем, операционных систем, микроконтроллеров, браузеров, серверов и видеоигр.</p>\r\n', '<p>C++ &mdash; производительный язык, он помогает дорожным картам в GPS не тупить и строить оптимальные маршруты, любимым играм &mdash; не лагать и выдавать максимальное качество с выкрученными до предела настройками графики, банковским сервисам &mdash; быть круглосуточными, а переводам &mdash; моментальными.</p>\r\n\r\n<p>Производительность &mdash; важная характеристика любой компьютерной игры. Counter-Strike, StarCraft: Brood War, Diablo I, World of Warcraft &mdash; все они появились давно и были написаны на C++, как и операционные системы консолей Xbox и PlayStation, ядра популярных игровых движков Unreal Engine или Unity, на базе которых сделано огромное количество 3D-игр, симуляторов, шутеров и стратегий.</p>\r\n', '', '07.04.2023', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `db_list_course_materials`
--

CREATE TABLE `db_list_course_materials` (
  `course_material_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_material_theme` varchar(250) NOT NULL,
  `course_material` text NOT NULL,
  `exercise` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_list_course_materials`
--

INSERT INTO `db_list_course_materials` (`course_material_id`, `course_id`, `course_material_theme`, `course_material`, `exercise`) VALUES
(1, 5, 'Уроки C++ с нуля / Урок #2 - Первая программа на С++', '<iframe width=\"1280\" height=\"720\" src=\"https://www.youtube.com/embed/llovDtQN_u4\" title=\"Уроки C++ с нуля / Урок #2 - Первая программа на С++\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '<p>TEST TEST</p>\r\n'),
(2, 5, 'Тест', '<iframe width=\"1280\" height=\"720\" src=\"https://www.youtube.com/embed/4MFOBeUCPkw\" title=\"Музыка гиперразума - Плейлист безграничной производительности\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '2test');

-- --------------------------------------------------------

--
-- Структура таблицы `db_list_current_reviews`
--

CREATE TABLE `db_list_current_reviews` (
  `id_list_current_reviews` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `author_fio` varchar(255) NOT NULL,
  `text_reviews` text NOT NULL,
  `arrival_date` varchar(50) NOT NULL,
  `order_date` int(11) NOT NULL,
  `appraisal` int(1) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_list_newsletter_subscription`
--

CREATE TABLE `db_list_newsletter_subscription` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  `order_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_list_newsletter_subscription`
--

INSERT INTO `db_list_newsletter_subscription` (`id`, `email`, `date_added`, `order_date`) VALUES
(1, 'janatmaksat@gmail.com', '10.03.2023', '1678451580');

-- --------------------------------------------------------

--
-- Структура таблицы `db_users`
--

CREATE TABLE `db_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname_user` varchar(255) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `level_user` int(3) NOT NULL,
  `access` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_users`
--

INSERT INTO `db_users` (`id_user`, `username`, `password`, `fname_user`, `name_user`, `level_user`, `access`) VALUES
(1, '7(707) 199-5202', '827ccb0eea8a706c4c34a16891f84e7b', 'Шындалы', 'Саламат', 1, 1),
(2, '7(707) 937-0793', '827ccb0eea8a706c4c34a16891f84e7b', 'Адилбеков', 'Адилбеков', 1, 1),
(3, '7(777) 777-7777', '827ccb0eea8a706c4c34a16891f84e7b', 'sdf', 'sdf', 1, 0),
(4, '7(747) 562-9170', '827ccb0eea8a706c4c34a16891f84e7b', ' ', 'Maksat', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `db_users_access_to_books`
--

CREATE TABLE `db_users_access_to_books` (
  `user_access_to_book_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_users_access_to_books`
--

INSERT INTO `db_users_access_to_books` (`user_access_to_book_id`, `id_user`, `book_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `db_users_access_to_courses`
--

CREATE TABLE `db_users_access_to_courses` (
  `user_access_to_course_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_users_access_to_courses`
--

INSERT INTO `db_users_access_to_courses` (`user_access_to_course_id`, `id_user`, `course_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `db_users_admin`
--

CREATE TABLE `db_users_admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname_user` varchar(255) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `level_user` int(3) NOT NULL,
  `access` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_users_admin`
--

INSERT INTO `db_users_admin` (`id_user`, `username`, `password`, `fname_user`, `name_user`, `level_user`, `access`) VALUES
(1, 'ssh', 'c0356641f421b381e475776b602a5da8', 'Шындалы', 'Саламат', 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `db_list_books`
--
ALTER TABLE `db_list_books`
  ADD PRIMARY KEY (`book_id`);

--
-- Индексы таблицы `db_list_book_materials`
--
ALTER TABLE `db_list_book_materials`
  ADD PRIMARY KEY (`book_material_id`);

--
-- Индексы таблицы `db_list_courses`
--
ALTER TABLE `db_list_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Индексы таблицы `db_list_course_materials`
--
ALTER TABLE `db_list_course_materials`
  ADD PRIMARY KEY (`course_material_id`);

--
-- Индексы таблицы `db_list_current_reviews`
--
ALTER TABLE `db_list_current_reviews`
  ADD PRIMARY KEY (`id_list_current_reviews`);

--
-- Индексы таблицы `db_list_newsletter_subscription`
--
ALTER TABLE `db_list_newsletter_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_users`
--
ALTER TABLE `db_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `db_users_access_to_books`
--
ALTER TABLE `db_users_access_to_books`
  ADD PRIMARY KEY (`user_access_to_book_id`);

--
-- Индексы таблицы `db_users_access_to_courses`
--
ALTER TABLE `db_users_access_to_courses`
  ADD PRIMARY KEY (`user_access_to_course_id`);

--
-- Индексы таблицы `db_users_admin`
--
ALTER TABLE `db_users_admin`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `db_list_books`
--
ALTER TABLE `db_list_books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_list_book_materials`
--
ALTER TABLE `db_list_book_materials`
  MODIFY `book_material_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_list_courses`
--
ALTER TABLE `db_list_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `db_list_course_materials`
--
ALTER TABLE `db_list_course_materials`
  MODIFY `course_material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `db_list_current_reviews`
--
ALTER TABLE `db_list_current_reviews`
  MODIFY `id_list_current_reviews` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_list_newsletter_subscription`
--
ALTER TABLE `db_list_newsletter_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `db_users`
--
ALTER TABLE `db_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `db_users_access_to_books`
--
ALTER TABLE `db_users_access_to_books`
  MODIFY `user_access_to_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `db_users_access_to_courses`
--
ALTER TABLE `db_users_access_to_courses`
  MODIFY `user_access_to_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `db_users_admin`
--
ALTER TABLE `db_users_admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
