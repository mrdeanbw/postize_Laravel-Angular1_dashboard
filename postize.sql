-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2016 at 11:11 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `postize`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Funny', NULL, NULL, NULL),
(2, 'Animals', NULL, NULL, NULL),
(3, 'News', NULL, NULL, NULL),
(4, 'Food', NULL, NULL, NULL),
(5, 'Creepy', NULL, NULL, NULL),
(6, 'Feels', NULL, NULL, NULL),
(7, 'Gaming', NULL, NULL, NULL),
(8, 'Nostalgia', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000001_create_user_table', 1),
('2014_10_12_000002_create_post_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_03_25_105235_create_category_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `category_id`, `title`, `slug`, `description`, `content`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 0, 'This Guy Got 15 Years In Prison After Posting A Selfie On Facebook — And He''s Not The Only One!', 'this-guy-got-15-years-in-prison-after-posting-a-selfie-on-facebook-and-hes-not-the-only-one', 'This chick could land deadly blows, that old dude is crazy though', '<p>fsdf</p>', 'http://localhost/postize/public/thumbs/lLIniR_1.jpg', 0, '2016-03-25 00:53:18', '2016-03-25 01:15:55', NULL),
(3, 1, 0, '13 People Whose Snapchat Game Is Way Stronger Than Yours', '13-people-whose-snapchat-game-is-way-stronger-than-yours', 'When your Snap is so strong, you''ve got to share.', '<p>Snapchat can be used for all kinds of things, if you&rsquo;re a regular user you&rsquo;ll notice many different kinds of snaps, couples who recently broke up and want to make each other jealous, people who pretend like their life is perfect, and of course people who just snap anything especially if they have a pet then 99% of their snaps will be about that pet.&nbsp;But we all have that one friend who never fails to entertain us through his snaps, the following pictures demonstrate&nbsp;how the perfect Snap should be like.</p>\r\n<div>\r\n<h1>1. When your artistic sense kicks in.</h1>\r\n<p><img src="http://localhost/postize/public/content/2016/03/LyPDNq_3.jpg" alt="" width="460" height="451" /></p>\r\n</div>\r\n<p><span class="source"> source: <a>Hellou.co.uk</a> </span></p>\r\n<h1>2. Has science gone too far ?</h1>\r\n<p><img src="http://localhost/postize/public/content/2016/03/ZlJfux_3.jpg" alt="" width="499" height="666" /></p>\r\n<div><a href="http://acidface.tumblr.com/" target="_blank">Tumblr &ndash; Acidface</a>\r\n<h1>3.&nbsp;The Tonight Show Starring&nbsp;Joppa Fallston.</h1>\r\n<p><img src="http://localhost/postize/public/content/2016/03/JpXvBc_3.jpg" alt="" width="500" height="884" /></p>\r\n</div>\r\n<div><a href="http://fallontonight.tumblr.com/post/80370725714/thejimmyfallontonightshow-builtfromfire-just" target="_blank">Tumblr &ndash; fallontonight</a></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<h1>4. Waking up to this must be terrifying.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/VmQylE_3.jpg" alt="" width="499" height="651" /></p>\r\n</div>\r\n<div><a href="http://thisisnothinggoaway.tumblr.com/post/78670130503" target="_blank">Tumblr &ndash; thisisnothinggoaway</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>\r\n<h1>5. When you have too much time on your hands.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/brtGLN_3.jpg" alt="" width="500" height="744" /></p>\r\n</div>\r\n<div><a href="http://izismile.com/2014/03/07/morning_picdump_56_pics.html" target="_blank">Izismile</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div>\r\n<h1>6. Whenever some stranger tries to&nbsp;engage me in conversation.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/lMvaAE_3.jpg" alt="" width="500" height="874" /></p>\r\n</div>\r\n<div><a href="http://justrandomdesigns.tumblr.com/" target="_blank">Just Random Designs</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>\r\n<h1>7. Not following the herd.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/nXvWTD_3.jpg" alt="" width="500" height="820" /></p>\r\n</div>\r\n<div><a href="http://www.polyvore.com/24_funny_clever_snapchat_pics/thing?id=99588071" target="_blank">Polyvore</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>\r\n<h1>8. When snow snitches on you.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/JOYbLq_3.jpg" alt="" width="500" height="745" /></p>\r\n</div>\r\n<div><a href="https://www.reddit.com/r/funny/comments/23akb1/winter_is_not_a_wingman/" target="_blank">Reddit &ndash; SIM_GR8_1</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>\r\n<h1>9. Some pets are just too spoiled.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/ORJDHy_3.jpg" alt="" width="499" height="645" /></p>\r\n</div>\r\n<div><a href="http://theberry.com/2014/04/17/these-people-are-better-at-snapchat-than-you-32-photos/" target="_blank">The Berry</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>\r\n<h1>10.&nbsp;When you treat your pets like children.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/lNcKoV_3.jpg" alt="" width="499" height="575" /></p>\r\n</div>\r\n<div><a href="http://crazyhyena.com/dog-ready-cold-weather-overdressed-funny" target="_blank">Crazy Hyena</a></div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<h1>11. Really Human ?.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/BJipqH_3.jpg" alt="" width="500" height="634" /></p>\r\n</div>\r\n<div><a href="http://i.imgur.com/qvVjV5k.jpg" target="_blank">Imgur</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>\r\n<h1>12. When you have finals next week and your friend sends you this Snap.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/GEZQdL_3.jpg" alt="" width="500" height="888" /></p>\r\n</div>\r\n<div><a href="http://www.appszoom.com/android_applications/entertainment/best-snapchats_jesdr.html" target="_blank">Apps Zoom</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>\r\n<h1>13. The Booty goes up and down.</h1>\r\n<div>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<p><img src="http://localhost/postize/public/content/2016/03/mqfOQj_3.jpg" alt="" width="500" height="750" /></p>\r\n</div>\r\n<div><a href="http://theberry.com/2014/04/17/these-people-are-better-at-snapchat-than-you-32-photos/" target="_blank">The Berry</a></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n<h2><a href="http://diply.com/virginradiolebanon/20-people-who-win-snapchat/223224">h/t Diply</a></h2>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '', 1, '2016-03-25 03:13:04', '2016-03-25 16:20:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `image`, `type`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fletch', 'fletch@fletchy.net', '$2y$10$qBMwCn3mDg9/T2hu7fhRf.7TjdxSEO/GIO4u2OTD9pS4zySCuw95S', 'http://localhost/postize/public/user_avatars/1.jpg', 0, 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `post_slug_unique` (`slug`), ADD KEY `post_user_id_foreign` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
