-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2021 at 03:22 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'Elif', 'faab00b602f33a0f446fd4637ca211cc');

-- --------------------------------------------------------

--
-- Table structure for table `admin_comment`
--

CREATE TABLE `admin_comment` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_comment`
--

INSERT INTO `admin_comment` (`id`, `comment_id`, `content`, `created_at`) VALUES
(1, 2, 'content', '2021-09-18 14:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `name`) VALUES
(1, 'health', 'Health'),
(2, 'cook', 'Cook'),
(3, 'art', 'Art'),
(4, 'science', 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `member_id`, `content`, `post_title`, `created_at`) VALUES
(2, 8, 'Thanks for this useful article ', 'History Of Software', '2021-10-02 15:07:45'),
(3, 9, 'I didn\'t know this information', 'Benefits of Spices', '2021-10-02 15:05:30'),
(4, 9, 'It\'s a very interesting article', 'Living on the Moon', '2021-10-02 14:44:48'),
(11, 9, 'I make this recipe often. It is really easy and delicious', 'Pasta Sauce Recipes', '2021-10-02 14:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `member_id`, `post_id`) VALUES
(1, 9, 2),
(2, 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `email`, `password`) VALUES
(8, 'Elif', 'elif@example.com', '3c3966776c941ab1e3899d347c29f423'),
(9, 'Zeynep', 'zeynep@example.com', '$2y$10$CSHzXe.ntX4WcV4Zp6Bsr.7A25mhnHQLLotyQhPW1YtHcoKcOiKh6');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `created_at`) VALUES
(1, 'm0001_initial.php', '2021-09-01 12:09:15'),
(2, 'm0002_add_password_column.php', '2021-09-01 12:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` text,
  `active` tinyint(1) DEFAULT '0',
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `created_at`, `updated_at`, `image`, `active`, `category`) VALUES
(1, 'Popularity of Programming Language Index', 'The more a language tutorial is searched, the more popular the language is assumed to be. It is a leading indicator. The raw data comes from Google Trends.\r\n\r\nIf you believe in collective wisdom, the PYPL Popularity of Programming Language index can help you decide which language to study, or which one to use in a new software project.\r\nrespectively as follows		\r\nPython, Java, JavaScript, C#, PHP	', '2021-10-02 13:59:29', '2021-10-02 13:59:29', 'about.jpg', 0, 'Science'),
(2, 'History Of Software', 'Software is a set of programmed instructions stored in the memory of stored-program digital computers for execution by the processor. Software is a recent development in human history, and it is fundamental to the Information Age.\r\n\r\nAda Lovelace\'s programs for Charles Babbage\'s Analytical Engine in the 19th century is often considered the founder of the discipline, though the mathematician\'s efforts remained theoretical only, as the technology of Lovelace and Babbage\'s day proved insufficient to build his computer. Alan Turing is credited with being the first person to come up with a theory for software in 1935, which led to the two academic fields of computer science and software engineering.\r\n\r\nThe first generation of software for early stored-program digital computers in the late 1940s had its instructions written directly in binary code, generally written for mainframe computers. Later, the development of modern programming languages alongside the advancement of the home computer would greatly widen the scope and breadth of available software, beginning with assembly language, and continuing on through functional programming and object-oriented programming paradigms.', '2021-10-02 14:01:09', '2021-10-02 14:01:09', 'about2.jpg', 1, 'Science'),
(3, 'Benefits of Spices', 'Cinnamon,this popular spice comes from the bark of the cinnamon tree and is used in everything from pumpkin spice lattes to Cincinnati chili. Cinnamon is especially great for people who have high blood sugar. It lends a sweet taste to food without adding sugar, and studies indicate it can lower blood sugar levels in people with type 2 diabetes.Another is turmeric.Turmeric is best known for its use in Indian curry dishes and has become a trendy superfood for its ability to reduce inflammation — a common cause of discomfort and illness.Ginger is a tropical plant that’s been used in Asian cultures for thousands of years to treat stomach upset, diarrhea and nausea. In the U.S., it comes in a variety of convenient forms — lollipops, candies, capsules and teas. You can also purchase the dried powder in the spice aisle of the grocery store, or buy it fresh to make teas or grate into recipes.', '2021-10-02 14:13:37', '2021-10-02 14:13:37', 'lifestyle3.png', 1, 'Health'),
(4, 'Living on the Moon', 'Humans have stayed for days on the Moon, such as during Apollo 17. One particular challenge for astronauts\' daily life during their stay on the surface is the lunar dust sticking to their suits and being carried into their quarters. Subsequently, the dust was tasted and smelled by the astronauts, calling it the \"Apollo aroma\". This contamination poses a danger since the fine lunar dust can cause health issues.\r\n\r\nIn 2019 at least one plant seed sprouted in an experiment, carried along with other small life from Earth on the Chang\'e 4 lander in its Lunar Micro Ecosystem.', '2021-10-02 14:06:27', '2021-10-02 14:06:27', 'Lunar-Reconnaissance-Orbiter-Moon-scaled.jpg', 1, 'Science'),
(11, ' Pasta Sauce Recipes ', 'Easy Pasta Sauce&#13;&#10;Easy Pasta Sauce. Cooks in 10 minutes. &#13;&#10;&#13;&#10; Prep Time 10 minutes&#13;&#10; Cook Time 10 minutes&#13;&#10; Total Time 20 minutes&#13;&#10; Servings 6 servings&#13;&#10; Calories 144 kcal&#13;&#10;&#13;&#10;&#13;&#10;Ingredients&#13;&#10;2 tablespoons olive oil&#13;&#10;1 medium onion finely diced&#13;&#10;3-5 cloves garlic minced or put through a garlic press&#13;&#10;2 teaspoons dried basil&#13;&#10;pinch red pepper flakes about 1/4 teaspoon&#13;&#10;1/2 teaspoon Kosher salt&#13;&#10;1/2 teaspoon granulated sugar&#13;&#10;1 pat butter, about 2 teaspoons&#13;&#10;1 28 ounce can crushed tomatoes&#13;&#10;1/4 cup water&#13;&#10;Instructions&#13;&#10;Heat the olive oil over high heat until it shimmers. Saute the onions, stirring frequently, until they soften and shine, about three minutes. The onions should sizzle and hiss as they cook. Add the garlic. Stir to combine. This prevents the garlic from burning. Cook an additional two minutes. Add the basil, red pepper flakes, salt, and sugar. Stir to combine. Add the butter. Stir, cook for about a minute.&#13;&#10;&#13;&#10;Add 1/2 can of the crushed tomatoes. Scrape the bottom of the pan to remove any stuck on bits. Reduce heat to low. Add remaining tomatoes. Stir in 1/4 cup water. If the sauce seems too thick, add additional water.&#13;&#10;Allow sauce to simmer for 10 minutes to up to one hour. If simmering for a longer, stir the sauce occasionally and add additional water as needed to keep the sauce at the correct consistency.', '2021-10-02 14:19:52', '2021-10-02 14:19:52', 'makarna.jpg', 1, 'Cook'),
(12, 'About Art', 'Art, in its broadest sense, is a form of communication. It means whatever the artist intends it to mean, and this meaning is shaped by the materials, techniques, and forms it makes use of, as well as the ideas and feelings it creates in its viewers . Art is an act of expressing feelings, thoughts, and observations.', '2021-10-02 14:22:27', '2021-10-02 14:22:27', 'starry.jpg', 1, 'Art');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `email` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`email`, `id`) VALUES
('zeynep@example.com', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_comment`
--
ALTER TABLE `admin_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_comment`
--
ALTER TABLE `admin_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
