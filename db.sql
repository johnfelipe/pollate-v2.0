-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 28, 2020 at 01:42 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pollate_code`
--

-- --------------------------------------------------------

--
-- Table structure for table `pl_answers`
--

CREATE TABLE `pl_answers` (
  `id` int(10) unsigned NOT NULL,
  `question` int(10) unsigned NOT NULL,
  `answer` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pl_categories`
--

CREATE TABLE `pl_categories` (
  `id` tinyint(3) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `bg` varchar(255) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL,
  `questions` mediumint(8) unsigned NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL,
  `keywords` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pl_comments`
--

CREATE TABLE `pl_comments` (
  `id` int(10) unsigned NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `question` int(10) unsigned NOT NULL,
  `date` int(11) NOT NULL,
  `content` text NOT NULL,
  `votes` varchar(255) NOT NULL,
  `updated_at` int(10) unsigned NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL,
  `moderat` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pl_configs`
--

CREATE TABLE `pl_configs` (
  `id` tinyint(3) unsigned NOT NULL,
  `variable` varchar(255) DEFAULT NULL,
  `value` text
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pl_configs`
--

INSERT INTO `pl_configs` (`id`, `variable`, `value`) VALUES
(1, 'avatar', 'kkk'),
(2, 'site_title', 'Pollate'),
(3, 'site_url', 'puertokhalid.com'),
(4, 'site_description', 'Puerto Poll Script is an awesome script that lets you run your own poll hosting site. It has been built from scratch using the latest web technologies available such as PHP5, HTML5, and CSS3.'),
(5, 'site_keywords', 'vote,poll,voting,pollate'),
(6, 'site_limit', '12'),
(12, 'site_image', 'https://cdn2.iconfinder.com/data/icons/seo-development-services-filled-line/614/3240_-_Customer_Testimonial-128.png'),
(7, 'site_register', '0'),
(8, 'site_forget', '1'),
(9, 'site_social_login', '0'),
(10, 'site_answers', '8'),
(11, 'site_letters', '1'),
(13, 'admin_color', 'ff8200'),
(14, 'site_comments', '0'),
(15, 'specific_bg', 'd90707'),
(16, 'specific_color', 'ffffff'),
(17, 'specific_true', ''),
(18, 'site_author', 'Pollate');

-- --------------------------------------------------------

--
-- Table structure for table `pl_followers`
--

CREATE TABLE `pl_followers` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pl_notifications`
--

CREATE TABLE `pl_notifications` (
  `id` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `author` mediumint(8) unsigned NOT NULL,
  `user` mediumint(8) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `ntype` varchar(100) NOT NULL,
  `nid` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_pages`
--

CREATE TABLE `pl_pages` (
  `id` tinyint(2) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort` tinyint(2) unsigned NOT NULL,
  `content` longtext NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pl_questions`
--

CREATE TABLE `pl_questions` (
  `id` int(10) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `date` int(11) NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `hideresults` tinyint(1) unsigned NOT NULL,
  `multiple` tinyint(1) unsigned NOT NULL,
  `end_date` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `polltype` tinyint(1) unsigned NOT NULL,
  `category` tinyint(3) unsigned NOT NULL,
  `statistics` varchar(255) NOT NULL,
  `votes` smallint(5) unsigned NOT NULL,
  `updated_at` int(10) unsigned NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL,
  `moderat` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pl_reports`
--

CREATE TABLE `pl_reports` (
  `id` smallint(5) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `title` tinyint(1) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `content` text NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `reply` text NOT NULL,
  `rauthor` int(10) unsigned NOT NULL,
  `rdate` int(10) unsigned NOT NULL,
  `trash` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_resets`
--

CREATE TABLE `pl_resets` (
  `id` smallint(5) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `ip` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_subscribers`
--

CREATE TABLE `pl_subscribers` (
  `id` mediumint(8) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_tags`
--

CREATE TABLE `pl_tags` (
  `id` int(10) unsigned NOT NULL,
  `question` int(10) unsigned NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pl_users`
--

CREATE TABLE `pl_users` (
  `id` int(10) unsigned NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `socials` varchar(255) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  `social_name` varchar(255) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL,
  `address` text NOT NULL,
  `birth` varchar(255) NOT NULL,
  `statistics` text NOT NULL,
  `moderat` varchar(255) NOT NULL,
  `verified` tinyint(1) unsigned NOT NULL,
  `credits` mediumint(9) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `language` tinyint(1) unsigned NOT NULL,
  `updated_at` int(10) unsigned NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `pl_users` (`id`, `firstname`, `lastname`, `username`, `password`, `photo`, `cover`, `date`, `level`, `email`, `socials`, `social_id`, `social_name`, `sex`, `address`, `birth`, `statistics`, `moderat`, `verified`, `credits`, `description`, `language`, `updated_at`, `trash`) VALUES
(1, '', '', 'Khalid', 'f9cabb469d18c8815720e9707370e458', '', '', 1582894374, 6, 'el.bouirtou@gmail.com', 'a:5:{s:8:"facebook";s:12:"khalidpuerto";s:7:"twitter";s:12:"khalidpuerto";s:6:"google";s:12:"khalidpuerto";s:7:"youtube";s:12:"khalidpuerto";s:9:"instagram";s:12:"khalidpuerto";}', '0', '', 1, 'a:3:{i:0;s:2:"AU";i:1;s:2:"--";i:2;s:2:"--";}', 'a:3:{i:0;i:6;i:1;i:12;i:2;i:1993;}', 'a:6:{s:5:"votes";i:0;s:4:"tags";i:0;s:9:"followers";i:0;s:9:"following";i:0;s:9:"questions";i:0;s:8:"comments";i:0;}', '', 1, 5, '', 0, 1582737722, 0);


-- --------------------------------------------------------

--
-- Table structure for table `pl_votes`
--

CREATE TABLE `pl_votes` (
  `id` int(10) unsigned NOT NULL,
  `question` mediumint(8) unsigned NOT NULL,
  `answer` mediumint(10) unsigned NOT NULL,
  `author` mediumint(10) unsigned NOT NULL,
  `ip` varchar(200) NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL,
  `address` varchar(255) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` tinyint(2) unsigned NOT NULL,
  `country` varchar(2) NOT NULL,
  `city` varchar(100) NOT NULL,
  `trash` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pl_answers`
--
ALTER TABLE `pl_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_categories`
--
ALTER TABLE `pl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_comments`
--
ALTER TABLE `pl_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_configs`
--
ALTER TABLE `pl_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_followers`
--
ALTER TABLE `pl_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_notifications`
--
ALTER TABLE `pl_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_pages`
--
ALTER TABLE `pl_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_questions`
--
ALTER TABLE `pl_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_reports`
--
ALTER TABLE `pl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_resets`
--
ALTER TABLE `pl_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_subscribers`
--
ALTER TABLE `pl_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_tags`
--
ALTER TABLE `pl_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_users`
--
ALTER TABLE `pl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_votes`
--
ALTER TABLE `pl_votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pl_answers`
--
ALTER TABLE `pl_answers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_categories`
--
ALTER TABLE `pl_categories`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_comments`
--
ALTER TABLE `pl_comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_configs`
--
ALTER TABLE `pl_configs`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pl_followers`
--
ALTER TABLE `pl_followers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_notifications`
--
ALTER TABLE `pl_notifications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_pages`
--
ALTER TABLE `pl_pages`
  MODIFY `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_questions`
--
ALTER TABLE `pl_questions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_reports`
--
ALTER TABLE `pl_reports`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_resets`
--
ALTER TABLE `pl_resets`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_subscribers`
--
ALTER TABLE `pl_subscribers`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_tags`
--
ALTER TABLE `pl_tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_users`
--
ALTER TABLE `pl_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_votes`
--
ALTER TABLE `pl_votes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;









-- V2






	INSERT INTO `pl_configs` (`id`, `variable`, `value`) VALUES
	(19, 'voting_form', '0'),
	(20, 'credits_question', '20'),
	(21, 'credits_vote', '15'),
	(22, 'credits_comment', '10'),
	(23, 'credits_register', '5'),
	(24, 'facebook_box', 'prof.puertokhalid'),
	(25, 'ads_1', '<img src=\"http://pollogo:8888/images/ads/300x250.png\" alt=\"ADS 300x250\">'),
	(26, 'notreply', 'donotreply@puertokhalid.com'),
	(27, 'home_questions', '5'),
	(28, 'fotget_password_msg', '[color=#666666][color=#666666][size=3][font=Arial, Helvetica, sans-serif][img width=230 height=68]http://localhost:8888/2020/codecanyon/pollate/pollatee/images/pollate-transparent-red.png[/img][/font][/size][/color][/color]\r\n[hr]\r\n[color=#666666][color=#666666][size=3][font=Arial, Helvetica, sans-serif]Hi {name},\r\nWe got a request to reset your Pollate password.\r\n[/font][/size][/color][/color]\r\n[color=#666666][size=3][font=Arial, Helvetica, sans-serif]{button bg=#4CAF50}Reset your password[color=#666666][size=3][font=Arial, Helvetica, sans-serif]{/button}[/font][/size][/color][/font][/size][/color]\r\n[color=#666666][size=3][font=Arial, Helvetica, sans-serif]If you ignore this message, your password will not be changed. If you didn\'t request a password reset, [/font][/size][/color][url=http://puertokhalid.com/puertofamilytree/v1.0.1/contact-us][size=3][font=Arial, Helvetica, sans-serif][color=#333333]let us know[/color][/font][/size][/url][color=#666666][size=3][font=Arial, Helvetica, sans-serif].[/font][/size][/color]\r\n\r\n[color=#666666][color=#abadae][size=2][font=Arial, Helvetica, sans-serif]© Puerto Pollate Script 2020\r\nThis message was sent to [u]{email}[/u] and intended for [u][color=#abadae][size=2][font=Arial, Helvetica, sans-serif]{name}[/font][/size][/color][/u].[/font][/size][/color][/color]\r\n'),
	(29, 'email_verification_msg', '[color=#111111][size=2][font=Verdana, Arial, Helvetica, sans-serif][color=#666666][color=#666666][size=3][font=Arial, Helvetica, sans-serif][img width=230 height=68]http://localhost:8888/2020/codecanyon/pollate/pollatee/images/pollate-transparent-red.png[/img][/font][/size][/color][/color][/font][/size][/color]\r\n[hr]\r\n[color=#666666][size=3][font=Arial, Helvetica, sans-serif]Hi {name},[/font][/size][/color]\r\n[color=#111111][size=2][font=Verdana, Arial, Helvetica, sans-serif][color=#666666][color=#666666][size=3][font=Arial, Helvetica, sans-serif]We got a request to signup in Pollate.com[/font][/size][/color][/color][/font][/size][/color]\r\n[color=#111111][size=2][font=Verdana, Arial, Helvetica, sans-serif][color=#666666][color=#666666][size=3][font=Arial, Helvetica, sans-serif]This message is for verifying your email address.\r\n[/font][/size][/color][/color][/font][/size][/color]\r\n[color=#111111][size=2][font=Verdana, Arial, Helvetica, sans-serif][color=#666666][size=3][font=Arial, Helvetica, sans-serif]{button bg=#4CAF50}Verify your email[color=#666666][size=3][font=Arial, Helvetica, sans-serif]{/button}[/font][/size][/color][/font][/size][/color][/font][/size][/color]\r\n[color=#111111][size=2][font=Verdana, Arial, Helvetica, sans-serif][color=#666666][size=3][font=Arial, Helvetica, sans-serif]If you ignore this message, your membership will delete automatically. If you didn\'t sign up in Pollate.com, just [/font][/size][/color][url=http://puertokhalid.com/puertofamilytree/v1.0.1/contact-us][size=3][font=Arial, Helvetica, sans-serif][color=#333333]let us know[/color][/font][/size][/url][color=#666666][size=3][font=Arial, Helvetica, sans-serif].[/font][/size][/color][/font][/size][/color]\r\n\r\n[color=#111111][size=2][font=Verdana, Arial, Helvetica, sans-serif][color=#666666][color=#abadae][size=2][font=Arial, Helvetica, sans-serif]© Puerto Pollate Script 2020\r\nThis message was sent to [u]{email}[/u] and intended for [u][color=#abadae][size=2][font=Arial, Helvetica, sans-serif]{name}[/font][/size][/color][/u].[/font][/size][/color][/color][/font][/size][/color]\r\n'),
	(30, 'site_plan', '1'),
	(31, 'login_facebook', '1'),
	(32, 'login_twitter', '1'),
	(33, 'login_google', '1'),
	(34, 'login_fbAppId', '647029095485681'),
	(35, 'login_fbAppSecret', '755da4d6fe289e9bbb0ecb8691625764'),
	(36, 'login_fbAppVersion', 'v2.8'),
	(37, 'login_twConKey', 'B1Mpgw8OBfRE79jJJImcIFNP8'),
	(38, 'login_twConSecret', '41Vxwv6EajFkP3pJ3bi6JTXy8Tyg5qEgnklaLYBiHKHnLlecNx'),
	(39, 'login_ggClientId', '413578210395-9jka8tghdgkqlkps9ga0bn9uv1ia1t56.apps.googleusercontent.com'),
	(40, 'login_ggClientSecret', 'YKk4I9K6a-FcwnHpby_n7PWm'),
	(41, 'site_paypal_id', 'pollate@paypal.com'),
	(42, 'site_paypal_live', '0'),
	(43, 'site_paypal_currency', 'USD'),
	(44, 'site_credit_value', '1'),
	(45, 'site_credit_reach', '100'),
	(46, 'ads_2', NULL),
	(47, 'ads_3', NULL),
	(48, 'ads_4', NULL),
	(49, 'ads_5', NULL);




	ALTER TABLE `pl_questions` ADD `pinned` TINYINT(1) NULL DEFAULT '0' AFTER `moderat`;
	ALTER TABLE `pl_pages` ADD `footer` TINYINT(1) NULL DEFAULT '0' AFTER `description`;




	CREATE TABLE `pl_payments` (
	  `id` int(11) NOT NULL,
	  `plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	  `txn_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	  `price` float(10,2) NOT NULL,
	  `currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	  `date` int(11) NOT NULL DEFAULT '0',
	  `author` int(11) NOT NULL DEFAULT '0'
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

	ALTER TABLE `pl_payments` ADD PRIMARY KEY (`id`);
	ALTER TABLE `pl_payments` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


	ALTER TABLE `pl_users` ADD `plan` TINYINT(1) NULL DEFAULT '0' AFTER `trash`;
	ALTER TABLE `pl_users` ADD `txn_id` VARCHAR(50) NULL AFTER `plan`, ADD `lastpayment` INT NULL AFTER `txn_id`;
	ALTER TABLE `pl_votes` ADD `user` INT NULL DEFAULT '0' AFTER `author`;






	CREATE TABLE `pl_plans` (
	  `id` int(11) NOT NULL,
	  `plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `price` float(10,2) DEFAULT NULL,
	  `currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc1` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc2` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc3` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc4` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc5` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc6` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc7` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc8` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `desc9` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `created_at` int(11) DEFAULT '0',
	  `poll_month` int(11) DEFAULT '0',
	  `votes_month` int(11) DEFAULT '0',
	  `iframe` tinyint(1) DEFAULT '0',
	  `gender` tinyint(1) DEFAULT '0',
	  `age` tinyint(1) DEFAULT '0',
	  `location` tinyint(1) DEFAULT '0',
	  `export` tinyint(1) DEFAULT '0',
	  `support` tinyint(1) DEFAULT '0',
	  `ads` tinyint(1) DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	--
	-- Déchargement des données de la table `pl_plans`
	--

	INSERT INTO `pl_plans` (`id`, `plan`, `price`, `currency`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `desc6`, `desc7`, `desc8`, `desc9`, `created_at`, `poll_month`, `votes_month`, `iframe`, `gender`, `age`, `location`, `export`, `support`, `ads`) VALUES
	(1, 'Free Plan', 0.00, '$', '3 polls a months', '10 votes per poll', 'Integrate to your website', 'Poll Statistics by Gender', 'Poll Statistics by Age', 'Poll Statistics by Location', 'Export Poll statistics', 'Priority support', 'No ads', 0, 3, 10, 0, 0, 0, 0, 0, 0, 0),
	(2, 'Basic Plan', 9.99, '$', '5 polls a months', '25 votes per poll', 'Integrate to your website', 'Poll Statistics by Gender', 'Poll Statistics by Age', 'Poll Statistics by Location', 'Export Poll statistics', 'Priority support', 'No ads', 0, 5, 25, 1, 0, 0, 0, 0, 0, 0),
	(3, 'Regular Plan', 19.99, '$', '12 polls a months', 'Unlimited votes per poll', 'Integrate to your website', 'Poll Statistics by Gender', 'Poll Statistics by Age', 'Poll Statistics by Location', 'Export Poll statistics', 'Priority support', 'No ads', 0, 12, 99999999, 1, 1, 1, 1, 0, 0, 0),
	(4, 'Pro Plan', 24.99, '$', 'Unlimited polls a months', 'Unlimited votes per poll', 'Integrate to your website', 'Poll Statistics by Gender', 'Poll Statistics by Age', 'Poll Statistics by Location', 'Export Poll statistics', 'Priority support', 'No ads', 0, 99999999, 99999999, 1, 1, 1, 1, 1, 1, 1);

	--
	-- Index pour les tables déchargées
	--

	--
	-- Index pour la table `pl_plans`
	--
	ALTER TABLE `pl_plans`
	  ADD PRIMARY KEY (`id`);

	--
	-- AUTO_INCREMENT pour les tables déchargées
	--

	--
	-- AUTO_INCREMENT pour la table `pl_plans`
	--
	ALTER TABLE `pl_plans`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;




		CREATE TABLE `pl_payout` (
		  `id` int(11) NOT NULL,
		  `author` int(11) DEFAULT NULL,
		  `credits` int(11) DEFAULT NULL,
		  `price` float DEFAULT NULL,
		  `created_at` int(11) DEFAULT NULL,
		  `accepted_at` int(11) DEFAULT NULL,
		  `status` tinyint(1) DEFAULT '0',
		  `email` varchar(255) DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;


		--
		-- Index pour la table `pl_payout`
		--
		ALTER TABLE `pl_payout`
		  ADD PRIMARY KEY (`id`);

		--
		-- AUTO_INCREMENT pour les tables déchargées
		--

		--
		-- AUTO_INCREMENT pour la table `pl_payout`
		--
		ALTER TABLE `pl_payout`
		  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;





		CREATE TABLE `pl_lang` (
		  `id` int(11) NOT NULL,
		  `fullname` varchar(255) DEFAULT NULL,
		  `shortname` varchar(255) DEFAULT NULL,
		  `flag` varchar(255) DEFAULT NULL,
		  `lang_default` int(11) DEFAULT '0',
		  `created_at` int(11) DEFAULT NULL,
		  `updated_at` int(11) DEFAULT NULL,
		  `content` longtext,
		  `trash` tinyint(1) DEFAULT '0',
		  `sort` smallint(6) DEFAULT '0'
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		--
		-- Déchargement des données de la table `pl_lang`
		--

		INSERT INTO `pl_lang` (`id`, `fullname`, `shortname`, `flag`, `lang_default`, `created_at`, `updated_at`, `content`, `trash`, `sort`) VALUES
		(1, 'Arabic - العربية', 'sa', 'sa', 0, 1587297198, 1587497627, 'YToyNDp7czozOiJydGwiO3M6MToiMSI7czo0OiJsYW5nIjtzOjI6ImFyIjtzOjU6ImNsb3NlIjtzOjg6ItmC2LHZitioIjtzOjc6ImxvYWRpbmciO3M6MjQ6Itis2KfYsSDYp9mE2KrYrdmF2YrZhC4uLiI7czo4OiJ2ZXJpZmllZCI7czoxOToi2K3Ys9in2Kgg2YXZiNir2ZHZgiI7czo1OiJhZG1pbiI7czo4OiLZhdi02LHZgSI7czo4OiJ0aW1lZGF0ZSI7YTo5OntzOjExOiJ0aW1lX3NlY29uZCI7czoxMDoi2KvYp9mG2YrYpyI7czoxMToidGltZV9taW51dGUiO3M6MTA6Itiv2YLZitmC2KkiO3M6OToidGltZV9ob3VyIjtzOjg6Itiz2KfYudipIjtzOjg6InRpbWVfZGF5IjtzOjY6ItmK2YjZhSI7czo5OiJ0aW1lX3dlZWsiO3M6MTA6Itij2LPYqNmI2LkiO3M6MTA6InRpbWVfbW9udGgiO3M6Njoi2LTZh9ixIjtzOjk6InRpbWVfeWVhciI7czo2OiLYudin2YUiO3M6MTE6InRpbWVfZGVjYWRlIjtzOjY6Iti52YLYryI7czo4OiJ0aW1lX2FnbyI7czo2OiLZhdmG2LAiO31zOjM6ImFzayI7YToxMTp7czo5OiJhc2tfdGl0bGUiO3M6MzQ6Itin2LfYsditINiz2KTYp9mE2KfZiyDYrNiv2YrYr9in2YsiO3M6MTA6ImVkaXRfdGl0bGUiO3M6MjM6Itiq2K3YsdmK2LEg2KfZhNiz2KTYp9mEIjtzOjg6Im11bHRpcGxlIjtzOjIzOiLYo9i12YjYp9iqINmF2KrYudiv2K/YqSI7czo2OiJwaW5uZWQiO3M6MTc6Itiz2KTYp9mEINmF2KvYqNiqIjtzOjg6InF1ZXN0aW9uIjthOjM6e3M6NToibGFiZWwiO3M6MTE6Itiz2KTYp9mE2YM6IjtzOjU6InBsYWNlIjtzOjE5OiLYp9mF2YTYoyDYs9ik2KfZhNmDIjtzOjE6InAiO3M6Njk6ItmE2Kcg2YrYs9mF2K0gSFRNTC4g2LPZitiq2YUg2KrYrNin2YfZhCDYp9mE2LPYpNin2YQg2LrZitixINi12KfZhNitLiI7fXM6NDoidHlwZSI7YTo3OntzOjU6ImxhYmVsIjtzOjIwOiLZhtmI2Lkg2KfZhNiz2KTYp9mEOiI7czo2OiJub3JtYWwiO2E6MTp7czo1OiJsYWJlbCI7czoxNzoi2LPYpNin2YQg2LnYp9iv2YoiO31zOjU6Inllc25vIjthOjM6e3M6NToibGFiZWwiO3M6MjI6ItmG2LnZhSAvINmE2Kcg2LPYpNin2YQiO3M6MzoieWVzIjtzOjY6ItmG2LnZhSI7czoyOiJubyI7czo0OiLZhNinIjt9czo2OiJpbWFnZXMiO2E6Mzp7czo1OiJsYWJlbCI7czoxNToi2YXYuSDYp9mE2LXZiNixIjtzOjU6InBsYWNlIjtzOjI2OiLYtdmI2LHYqSDYp9mE2KXYrNin2KjYp9iqOiI7czo2OiJzZWxlY3QiO3M6MTU6Itit2K/YryDYtdmI2LHYqSI7fXM6NToicGxhY2UiO3M6Mjg6Itin2YPYqtioINil2KzYp9io2KrZgyDZh9mG2KciO3M6NzoiYW5zd2VycyI7czoxNzoi2KfZhNil2KzYp9io2KfYqjoiO3M6MzoiYWRkIjtzOjE3OiLYpdi22KfZgdipINit2YLZhCI7fXM6ODoiY2F0ZWdvcnkiO2E6Mjp7czo1OiJsYWJlbCI7czoxMToi2KfZhNmB2KbYqToiO3M6NToicGxhY2UiO3M6MTk6Itin2K7YqtixINiq2LXZhtmK2YEiO31zOjM6ImVuZCI7YToyOntzOjU6ImxhYmVsIjtzOjI4OiLYqtin2LHZitiuINin2YTYp9mG2KrZh9in2KE6IjtzOjU6InBsYWNlIjtzOjM0OiLYrdiv2K8g2KrYp9ix2YrYriDYp9mE2KfZhtiq2YfYp9ihIjt9czo1OiJ0aHVtYiI7YTozOntzOjU6ImxhYmVsIjtzOjk6Iti42YHYsdmKOiI7czo1OiJwbGFjZSI7czoxNToi2K3Yr9ivINi12YjYsdipIjtzOjE6InAiO3M6Njk6ItmE2Kcg2YrYs9mF2K0gSFRNTC4g2LPZitiq2YUg2KrYrNin2YfZhCDYp9mE2LPYpNin2YQg2LrZitixINi12KfZhNitLiI7fXM6NjoiYnV0dG9uIjtzOjEwOiLYpdix2LPYp9mEIjtzOjU6ImFsZXJ0IjthOjY6e3M6ODoicmVxdWlyZWQiO3M6NTU6Itis2YXZiti5INin2YTYrdmC2YjZhCDYp9mE2YXYudmE2YXYqSDYqCAqINmF2LfZhNmI2KjYqSEiO3M6NDoibW9yZSI7czo0MDoi2LnYr9ivINin2YTYpdis2KfYqNin2Kog2KPZg9ir2LEg2YXZhiA4ISI7czo0OiJsZXNzIjtzOjM4OiLYudiv2K8g2KfZhNil2KzYp9io2KfYqiDYo9mC2YQg2YXZhiAyISI7czo2OiJpbWFnZXMiO3M6NTA6Itis2YXZiti5INin2YTYpdis2KfYqNin2Kog2KrYrdiq2KfYrCDYpdmE2Ykg2LXZiNixIjtzOjc6InN1Y2Nlc3MiO3M6NTU6Itin2YbYqtmH2Kog2LnZhdmE2YrYqSDYt9ix2K0g2KfZhNij2LPYptmE2Kkg2KjZhtis2KfYrS4iO3M6NDoiZWRpdCI7czo1Nzoi2KfZhtiq2YfYqiDYudmF2YTZitipINiq2K3YsdmK2LEg2KfZhNiz2KTYp9mEINio2YbYrNin2K0uIjt9fXM6NzoiZGV0YWlscyI7YTo5OntzOjU6InRpdGxlIjtzOjIzOiLYudiv2YQg2KfZhNiq2YHYp9i12YrZhCI7czo1OiJmaXJzdCI7YToyOntzOjU6ImxhYmVsIjtzOjIyOiLYp9mE2KfYs9mFINin2YTYp9mI2YQ6IjtzOjU6InBsYWNlIjtzOjI4OiLYp9mD2KrYqCDYp9iz2YXZgyDYp9mE2KPZiNmEIjt9czo0OiJsYXN0IjthOjI6e3M6NToibGFiZWwiO3M6MTM6Itin2YTZg9mG2YrYqToiO3M6NToicGxhY2UiO3M6Mjg6Itin2YPYqtioINin2LPZhSDYudin2KbZhNiq2YMiO31zOjQ6ImRlc2MiO2E6Mjp7czo1OiJsYWJlbCI7czo3OiLZiNi12YE6IjtzOjU6InBsYWNlIjtzOjQzOiLYp9mD2KrYqCDZiNi12YHZi9inINi12LrZitix2YvYpyDZhNmG2YHYs9mDIjt9czo1OiJwaG90byI7YToyOntzOjU6ImxhYmVsIjtzOjMzOiLYtdmI2LHYqSDYp9mE2YXZhNmBINin2YTYtNiu2LXZijoiO3M6NToicGxhY2UiO3M6MTU6Itit2K/YryDYtdmI2LHYqSI7fXM6NToiY292ZXIiO2E6Mjp7czo1OiJsYWJlbCI7czoyMjoi2LXZiNix2Kkg2KfZhNi62YTYp9mBOiI7czo1OiJwbGFjZSI7czoxNToi2K3Yr9ivINi12YjYsdipIjt9czo3OiJzb2NpYWxzIjtzOjQ1OiLZiNiz2KfYptmEINin2YTYqtmI2KfYtdmEINin2YTYp9is2KrZhdin2LnZijoiO3M6NjoiYnV0dG9uIjtzOjEwOiLYpdix2LPYp9mEIjtzOjU6ImFsZXJ0IjthOjM6e3M6ODoicmVxdWlyZWQiO3M6NTU6Itis2YXZiti5INin2YTYrdmC2YjZhCDYp9mE2YXYudmE2YXYqSDYqCAqINmF2LfZhNmI2KjYqSEiO3M6NDoiZGVzYyI7czo1ODoi2YrYrNioINij2YYg2YrZg9mI2YYg2KfZhNmI2LXZgSDYo9mC2YQg2YXZhiA1MCDYrdix2YHZi9inISI7czo3OiJzdWNjZXNzIjtzOjYxOiLYp9mG2KrZh9iqINi52YXZhNmK2Kkg2KrYrdix2YrYsSDYp9mE2KrZgdin2LXZitmEINio2YbYrNin2K0uIjt9fXM6NjoiZm9vdGVyIjthOjM6e3M6NToibGlua3MiO3M6MTQ6Itin2YTYsdmI2KfYqNi3IjtzOjk6InN1YnNjcmliZSI7YTo1OntzOjU6InRpdGxlIjtzOjE2OiLYp9mE2KXYtNiq2LHYp9mDIjtzOjE6InAiO3M6MTA5OiLYp9i02KrYsdmDINmE2YTYrdi12YjZhCDYudmE2Ykg2KfZhNil2YTZh9in2YUg2YjYp9mE2KPZgdmD2KfYsSDZiNin2YTYo9iu2KjYp9ixINmB2Yog2KjYsdmK2K/ZgyDYp9mE2YjYp9ix2K8uIjtzOjU6InBsYWNlIjtzOjQyOiLYudmG2YjYp9mGINio2LHZitiv2YMg2KfZhNil2YTZg9iq2LHZiNmG2YoiO3M6NjoiYnV0dG9uIjtzOjE2OiLYp9mE2KXYtNiq2LHYp9mDIjtzOjU6ImFsZXJ0IjthOjM6e3M6NToiZXhpc3QiO3M6MzM6ItmE2YLYryDYp9i02KrYsdmD2Kog2KjYp9mE2YHYudmEISI7czo1OiJlbWFpbCI7czo1NToi2YrYsdis2Ykg2KXYr9iu2KfZhCDYqNix2YrYryDYpdmE2YPYqtix2YjZhtmKINi12KfZhNitISI7czo3OiJzdWNjZXNzIjtzOjM5OiLYp9mD2KrZhdmEINin2YTYp9i02KrYsdin2YMg2KjZhtis2KfYrS4iO319czoxMDoic3RhdGlzdGljcyI7YTo2OntzOjU6InRpdGxlIjtzOjE0OiLYp9mE2KXYrdi12KfYoSI7czo1OiJ1c2VycyI7czoyMzoie2NvdW50fSDYp9mE2KPYudi22KfYoS4iO3M6OToicXVlc3Rpb25zIjtzOjIzOiJ7Y291bnR9INin2YTYo9iz2KbZhNipLiI7czo1OiJ2b3RlcyI7czoyMzoie2NvdW50fSDYp9mE2KPYtdmI2KfYqi4iO3M6ODoiY29tbWVudHMiO3M6Mjc6Intjb3VudH0g2KfZhNiq2LnZhNmK2YLYp9iqLiI7czo3OiJhbnN3ZXJzIjtzOjI1OiJ7Y291bnR9INin2YTYpdis2KfYqNin2KouIjt9fXM6NjoiZm9yZ2V0IjthOjU6e3M6NToidGl0bGUiO3M6Mjg6ItmH2YQg2YbYs9mK2Kog2KfZhNit2LPYp9io2J8iO3M6NToiZW1haWwiO3M6ODc6Itin2YPYqtioINin2LPZhSDYp9mE2YXYs9iq2K7Yr9mFINij2Ygg2KfZhNio2LHZitivINin2YTYpdmE2YPYqtix2YjZhtmKINin2YTYrtin2LUg2KjZgyI7czo2OiJidXR0b24iO3M6MjE6Itil2LnYp9iv2Kkg2KrYudmK2YrZhiI7czo1OiJhbGVydCI7YTo0OntzOjg6InJlcXVpcmVkIjtzOjU1OiLYrNmF2YrYuSDYp9mE2K3ZgtmI2YQg2KfZhNmF2LnZhNmF2Kkg2KggKiDZhdi32YTZiNio2KkhIjtzOjU6ImVtYWlsIjtzOjEyMToi2YrYsdis2Ykg2KXYr9iu2KfZhCDYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhSDYo9mIINin2YTYqNix2YrYryDYp9mE2KXZhNmD2KrYsdmI2YbZiiDYp9mE2LDZiiDZgtmF2Kog2KjYp9mE2KrYs9is2YrZhCDYqNmHISI7czo3OiJzdWNjZXNzIjtzOjExNDoi2YTZgtivINij2LHYs9mE2YbYpyDYpdmE2YrZgyDYqNix2YrYr9mL2Kcg2KXZhNmD2KrYsdmI2YbZitmL2Kcg2KPYudiv2Kog2KrYudmK2YrZhiDYsdin2KjYtyDZg9mE2YXYqSDYp9mE2YXYsdmI2LEuIjtzOjU6ImVycm9yIjtzOjExOToi2K3Yr9irINiu2LfYoyDYo9ir2YbYp9ihINil2LHYs9in2YQg2KjYsdmK2K8g2KXZhNmD2KrYsdmI2YbZiiDYpdmE2YrZgyDYjCDZitix2KzZiSDYp9mE2YXYrdin2YjZhNipINmB2Yog2YjZgtiqINii2K7YsSEiO31zOjQ6Im1haWwiO2E6Mjp7czo1OiJ0aXRsZSI7czozMToi2KfYudivINi22KjYtyDZg9mE2YXZhyDYp9mE2LPYsSI7czo3OiJjb250ZW50IjtzOjA6IiI7fX1zOjY6ImhlYWRlciI7YToxNTp7czo2OiJzZWFyY2giO3M6Mzg6ItmH2YQg2KrYsdmK2K8g2KfZhNio2K3YqyDYudmGINi02YrYodifIjtzOjM6ImFzayI7czoxNToi2LfYsditINiz2KTYp9mEIjtzOjc6InByb2ZpbGUiO3M6ODoi2YXZhNmB2YoiO3M6OToicXVlc3Rpb25zIjtzOjI1OiLYpdiv2KfYsdipINin2YTYo9iz2KbZhNipIjtzOjI6ImNwIjtzOjIxOiLZhNmI2K3YqSDYp9mE2KrYrdmD2YUiO3M6NzoiZGV0YWlscyI7czoyMzoi2LnYr9mEINin2YTYqtmB2KfYtdmK2YQiO3M6ODoicGFzc3dvcmQiO3M6MzI6Itiq2LrZitmK2LEg2YPZhNmF2Kkg2KfZhNmF2LHZiNixIjtzOjc6ImNyZWRpdHMiO3M6MTY6Itin2KbYqtmF2KfZhtin2KoiO3M6NjoibG9nb3V0IjtzOjE5OiLYqtiz2KzZitmEINiu2LHZiNisIjtzOjc6ImNvbmZpcm0iO3M6NjQ6ItmH2YQg2KPZhtiqINmF2KrYo9mD2K8g2KPZhtmDINiq2LHZitivINiq2LPYrNmK2YQg2KfZhNiu2LHZiNis2J8iO3M6Njoibm90aWNlIjtzOjEwNDoi2YXZhiDZgdi22YTZgyDZhNin2K3YuCDYo9mGOiDZhNinINiq2YbYs9mOINin2LPYqtmD2YXYp9mEINmF2LnZhNmI2YXYp9iq2YMg2K7Yp9i12Kkg2YPZhNmF2Kkg2YXYsdmI2LHZgy4iO3M6NDoibm90eSI7YTo3OntzOjU6InRpdGxlIjtzOjE0OiLYpdi02LnYp9ix2KfYqiI7czo0OiJyZWFkIjtzOjIwOiLYp9mC2LHYoyDZg9mEINi02YrYoSI7czo0OiJtb3JlIjtzOjQ3OiLYpdi42YfYp9ixINin2YTZhdiy2YrYryDZhdmGINin2YTYpdi02LnYp9ix2KfYqiI7czozOiJ0YWciO3M6MzM6ItmI2LbYuSDYudmE2KfZhdipINi52YTZiSDZhtmB2LPZhyI7czo0OiJ2b3RlIjtzOjIwOiLYo9i22YEg2LXZiNiqINil2YTZiSI7czo3OiJjb21tZW50IjtzOjI0OiLYo9i22YEg2KrYudmE2YrZgiDYudmE2YkiO3M6NjoiZm9sbG93IjtzOjI2OiLYp9io2K/YoyDYqNmF2KrYp9io2LnYqtmDLiI7fXM6MjoiaW4iO3M6MjM6Itiq2LPYrNmK2YQg2KfZhNiv2K7ZiNmEIjtzOjI6InVwIjtzOjY6Itiz2KzZhCI7czo0OiJtZW51IjthOjY6e3M6NDoiaG9tZSI7czoyOToi2KfZhNi12YHYrdipINin2YTYsdim2YrYs9mK2KkiO3M6NToiZnJlc2giO3M6MjE6Itij2LPYptmE2Kkg2KzYr9mK2K/YqSI7czo3OiJwb3B1bGFyIjtzOjIxOiLYo9iz2KbZhNipINi02KfYpti52KkiO3M6NzoibWVtYmVycyI7czoxMDoi2KPZgdix2KfYryI7czoxMDoiY2F0ZWdvcmllcyI7czoxODoi2KfZhNiq2LXZhtmK2YHYp9iqIjtzOjg6ImZvbGxvd2VkIjtzOjI5OiLYp9mE2KPYs9im2YTYqSDYp9mE2YXYqtio2LnYqSI7fX1zOjU6ImxvZ2luIjthOjEwOntzOjU6InRpdGxlIjtzOjIzOiLYqtiz2KzZitmEINin2YTYr9iu2YjZhCI7czo4OiJmYWNlYm9vayI7czo2NDoi2YLZhSDYqNiq2LPYrNmK2YQg2KfZhNiv2K7ZiNmEINio2KfYs9iq2K7Yr9in2YUg2KfZhNmB2YrYs9io2YjZgyI7czo3OiJ0d2l0dGVyIjtzOjQxOiLYqtiz2KzZitmEINin2YTYr9iu2YjZhCDYudio2LEg2KrZiNmK2KrYsSI7czo2OiJnb29nbGUiO3M6MjY6Itin2YTYr9iu2YjZhCDZhdi5INis2YjYrNmEIjtzOjg6InVzZXJuYW1lIjtzOjg3OiLYp9mD2KrYqCDYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhSDYo9mIINin2YTYqNix2YrYryDYp9mE2KXZhNmD2KrYsdmI2YbZiiDYp9mE2K7Yp9i1INio2YMiO3M6ODoicGFzc3dvcmQiO3M6NDg6Itin2YPYqtioINmD2YTZhdipINin2YTZhdix2YjYsSDYp9mE2K7Yp9i12Kkg2KjZgyI7czo0OiJrZWVwIjtzOjI4OiLYo9io2YIg2KrYs9is2YrZhCDYr9iu2YjZhNmKIjtzOjY6ImZvcmdldCI7czoyODoi2YfZhCDZhtiz2YrYqiDYp9mE2K3Ys9in2KjYnyI7czo2OiJidXR0b24iO3M6MjM6Itiq2LPYrNmK2YQg2KfZhNiv2K7ZiNmEIjtzOjU6ImFsZXJ0IjthOjc6e3M6ODoicmVxdWlyZWQiO3M6Nzg6ItmE2YLYryDYqtix2YPYqiDYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhSDYo9mIINmD2YTZhdipINin2YTZhdix2YjYsSDZgdin2LHYutipISI7czo3OiJtb2RlcmF0IjtzOjE0Nzoi2KrZhSDYrdi42LEg2KfZhNi52LbZiNmK2Kkg2YXZhiDZgtio2YQg2KfZhNmF2LTYsdmBINiMINil2LDYpyDZg9mG2Kog2KrYudiq2YLYryDYo9mGINmH2LDYpyDYrti32KMg2Iwg2YHZhNinINiq2KrYsdiv2K8g2YHZiiDYp9mE2KfYqti12KfZhCDYqNmG2KcuIjtzOjEwOiJhY3RpdmF0aW9uIjtzOjc4OiLYqtit2KrYp9isINin2YTYudi22YjZitipINil2YTZiSDYqtmB2LnZitmEINin2YTYqNix2YrYryDYp9mE2KXZhNmD2KrYsdmI2YbZii4iO3M6NzoiYXBwcm92ZSI7czo2MDoi2YrYrNioINij2YYg2KrZiNin2YHZgiDYp9mE2KXYr9in2LHYqSDYudmE2Ykg2KfZhNi52LbZiNmK2KkuIjtzOjc6InN1Y2Nlc3MiO3M6MTAxOiLZhNmC2K8g2YLZhdiqINio2KrYs9is2YrZhCDYp9mE2K/YrtmI2YQg2KjZhtis2KfYrSDYjCDZhtiq2YXZhtmJINmE2YMg2YLYttin2KEg2KPZiNmC2KfYqiDZhdmF2KrYudipLiI7czo2OiJzb2NpYWwiO3M6MjE1OiLZh9mG2KfZgyDZhdi02YPZhNipINmB2Yog2YXYudix2ZHZgdmDINin2YTYp9is2KrZhdin2LnZiiDYjCDYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhSDYp9mE2LDZiiDYqtix2YrYryDYqtiz2KzZitmEINin2YTYr9iu2YjZhCDYqNmHINmE2YrYsyDZhNmDINij2Ygg2YXZiNis2YjYr9mL2Kcg2KjYp9mE2YHYudmEINio2YXYudix2ZHZgSDYp9is2KrZhdin2LnZiiDZhdiu2KrZhNmBISI7czo1OiJlcnJvciI7czo3MToi2KfYs9mFINin2YTZhdiz2KrYrtiv2YUg2KPZiCDZg9mE2YXYqSDYp9mE2YXYsdmI2LEg2LrZitixINmF2KrZiNmB2LHYqSEiO319czo3OiJtZW1iZXJzIjthOjE3OntzOjk6ImZvbGxvd2luZyI7czoxNDoi2KfZhNiq2KfZhNmK2KkiO3M6OToiZm9sbG93ZXJzIjtzOjE0OiLZhdiq2KfYqNi52YjZhiI7czo5OiJxdWVzdGlvbnMiO3M6MTQ6Itin2YTYo9iz2KbZhNipIjtzOjE0OiJtb3JlLXF1ZXN0aW9ucyI7czoyNzoi2KPYs9im2YTYqSDYp9mE2YXYs9iq2K7Yr9mFIjtzOjU6InZvdGVzIjtzOjE0OiLYp9mE2KPYtdmI2KfYqiI7czo4OiJjb21tZW50cyI7czoxNDoi2KrYudmE2YrZgtin2KoiO3M6NDoidGFncyI7czoxNjoi2KfZhNi52YTYp9mF2KfYqiI7czo2OiJmb2xsb3ciO3M6ODoi2KXYqtio2LkiO3M6ODoidW5mb2xsb3ciO3M6Mjc6Itin2YTYutin2KEg2KfZhNmF2KrYp9io2LnYqSI7czoxMjoicHItZm9sbG93ZXJzIjtzOjMwOiLZhdiq2KfYqNi52Ygg2KfZhNmF2LPYqtiu2K/ZhToiO3M6MTI6InByLWZvbGxvd2luZyI7czoyODoi2YrYqtin2KjYuSDYp9mE2YXYs9iq2K7Yr9mFOiI7czoxMToicHItbW9yZS1mbHIiO3M6MzY6Itin2YTZhdiy2YrYryDZhdmGINin2YTZhdiq2KfYqNi52YrZhiI7czoxMToicHItbW9yZS1mbG4iO3M6MzQ6Itin2YTZhdiy2YrYryDZhdmGINin2YTZhdiq2KfYqNi52KkiO3M6OToicGctZm9sbG93IjtzOjExOiLYp9mE2LnYttmIOiI7czoxMjoicGctZm9sbG93ZXJzIjtzOjE1OiLZhdiq2KfYqNi52YjZhjoiO3M6MTI6InBnLWZvbGxvd2luZyI7czoxNToi2KfZhNiq2KfZhNmK2Kk6IjtzOjU6ImFsZXJ0IjthOjQ6e3M6MTA6ImZsLXN1Y2Nlc3MiO3M6NDY6ItmE2YLYryDYp9iq2KjYudiqINin2YTZhdiz2KrYrtiv2YUg2KjZhtis2KfYrS4iO3M6NjoiZmwtb3duIjtzOjM4OiLZhNinINmK2YXZg9mG2YMg2YXYqtin2KjYudipINmG2YHYs9mDISI7czoxMDoiZmwtYWxyZWFkeSI7czo1NToi2YTZgtivINin2KrYqNi52Kog2KjYp9mE2YHYudmEINmH2LDYpyDYp9mE2YXYs9iq2K7Yr9mFISI7czo5OiJmbC1kZWxldGUiO3M6NTc6Itiq2YUg2KXZhNi62KfYoSDZhdiq2KfYqNi52Kkg2KfZhNmF2LPYqtiu2K/ZhSDYqNmG2KzYp9itLiI7fX1zOjk6InF1ZXN0aW9ucyI7YToyMjp7czo2OiJmb2xsb3ciO3M6MjE6Itin2KrYqNi5INin2YTYs9ik2KfZhCI7czo4OiJ1bmZvbGxvdyI7czozNjoi2KXZhNi62KfYoSDZhdiq2KfYqNi52Kkg2KfZhNiz2KTYp9mEIjtzOjY6InJlcG9ydCI7czoyMzoi2KrZgtix2YrYsSDYp9mE2LPYpNin2YQiO3M6NDoiZWRpdCI7czoxMDoi2KrYudiv2YrZhCI7czo2OiJkZWxldGUiO3M6Njoi2K3YsNmBIjtzOjI6ImJ5IjtzOjE4OiLZhdmGINmC2KjZhCB7dXNlcn0iO3M6NToidm90ZXMiO3M6MTQ6Itin2YTYo9i12YjYp9iqIjtzOjQ6InRhZ3MiO3M6MTY6Itin2YTYudmE2KfZhdin2KoiO3M6NzoicmVwbGllcyI7czo4OiLYsdiv2YjYryI7czoxMzoibW9yZS1jb21tZW50cyI7czo0Mzoi2LnYsdi2INin2YTZhdiy2YrYryDZhdmGINin2YTYqti52YTZitmC2KfYqiI7czoxMzoicGxhY2UtY29tbWVudCI7czozMjoi2KfZg9iq2Kgg2KrYudmE2YrZgiDYrNiv2YrYryAuLi4iO3M6MTI6InNlbmQtY29tbWVudCI7czoyMToi2KXYsdiz2KfZhCDYqti52YTZitmCIjtzOjY6ImNhbmNlbCI7czoxMDoi2KXZhNi62KfYoSI7czo2OiJub3VzZXIiO3M6NTA6IntzaWdudXB9INij2Ygge3NpZ25pbn0g2YXZhiDYo9is2YQg2KfZhNiq2LnZhNmK2YIuIjtzOjM6Im5vdyI7czoyNDoi2YHZiiDZh9iw2Kkg2KfZhNmE2K3YuNipIjtzOjY6InBnLWFsbCI7czoxNToi2LnYsdi2INin2YTZg9mEIjtzOjk6InBnLXZvdGVycyI7czoxNzoi2KfZhNmF2LXZiNiq2YjZhjoiO3M6ODoicGctdm90ZXMiO3M6MTU6Itin2YTYo9i12YjYp9iqOiI7czoxMDoicGctdm90ZXMtcSI7czo5OiLYs9ik2KfZhDoiO3M6ODoicGctdGFnZXMiO3M6MTc6Itin2YTYudmE2KfZhdin2Ko6IjtzOjU6InNoYXJlIjthOjU6e3M6NToidGl0bGUiO3M6ODoi2LTYp9ix2YMiO3M6MjoiZmIiO3M6MjY6Iti02KfYsdmDINmF2Lkg2YHZitiz2KjZiNmDIjtzOjI6InR3IjtzOjI0OiLYtNin2LHZgyDZhdi5INiq2YjZitiq2LEiO3M6MjoiZ3AiO3M6MjE6Iti02KfYsdmDINmF2LkgR29vZ2xlKyI7czo2OiJpZnJhbWUiO3M6MTA6Itiq2LbZhdmK2YYiO31zOjU6ImFsZXJ0IjthOjc6e3M6MzoiYWxsIjtzOjM1OiLYrNmF2YrYuSDYp9mE2K3ZgtmI2YQg2YXYt9mE2YjYqNipISI7czo3OiJleHBpcmVkIjtzOjEwMjoi2YTYpyDZitmF2YPZhtmDINil2LbYp9mB2Kkg2KrYtdmI2YrYqiDZhNmH2LDYpyDYp9mE2KfYs9iq2LfZhNin2Lkg2YTYo9mG2Ycg2YXZhtiq2YfZiiDYp9mE2LXZhNin2K3ZitipIjtzOjU6InRyYXNoIjtzOjY3OiLYqtmFINmG2YLZhCDYp9mE2LPYpNin2YQg2KXZhNmJINiz2YTYqSDYp9mE2YXZh9mF2YTYp9iqINio2YbYrNin2K0uIjtzOjEwOiJmbC1zdWNjZXNzIjtzOjQwOiLYqtmFINin2KrYqNin2Lkg2KfZhNiz2KTYp9mEINio2YbYrNin2K0uIjtzOjY6ImZsLW93biI7czo0Mjoi2YTYpyDZitmF2YPZhtmDINmF2KrYp9io2LnYqSDYo9iz2KbZhNiq2YMhIjtzOjEwOiJmbC1hbHJlYWR5IjtzOjUxOiLZhNmC2K8g2KfYqtio2LnYqiDYqNin2YTZgdi52YQg2YfYsNinINin2YTYs9ik2KfZhCEiO3M6OToiZmwtZGVsZXRlIjtzOjUzOiLYqtmFINil2YTYutin2KEg2YXYqtin2KjYudipINin2YTYs9ik2KfZhCDYqNmG2KzYp9itLiI7fX1zOjg6InBhc3N3b3JkIjthOjY6e3M6NToidGl0bGUiO3M6MzI6Itiq2LrZitmK2LEg2YPZhNmF2Kkg2KfZhNmF2LHZiNixIjtzOjY6ImJ1dHRvbiI7czoxMDoi2KXYsdiz2KfZhCI7czo3OiJjdXJyZW50IjthOjI6e3M6NToibGFiZWwiO3M6MzM6ItmD2YTZhdipINin2YTYs9ixINin2YTYrdin2YTZitipOiI7czo1OiJwbGFjZSI7czo3MToi2KfZg9iq2Kgg2YfZhtinINmD2YTZhdipINin2YTZhdix2YjYsSDYp9mE2K3Yp9mE2YrYqSDYp9mE2K7Yp9i12Kkg2KjZgy4iO31zOjM6Im5ldyI7YToyOntzOjU6ImxhYmVsIjtzOjI1OiLZg9mE2YXYqSDYs9ixINis2K/Zitiv2Kk6IjtzOjU6InBsYWNlIjtzOjcxOiLYp9mD2KrYqCDZh9mG2Kcg2YPZhNmF2Kkg2KfZhNmF2LHZiNixINin2YTYrNiv2YrYr9ipINin2YTYrtin2LXYqSDYqNmDLiI7fXM6NToicmVuZXciO2E6Mjp7czo1OiJsYWJlbCI7czo1MToi2KPYudivINmD2KrYp9io2Kkg2YPZhNmF2Kkg2KfZhNiz2LEg2KfZhNis2K/Zitiv2Kk6IjtzOjU6InBsYWNlIjtzOjg3OiLYp9mD2KrYqCDZh9mG2Kcg2YXYsdipINij2K7YsdmJINmD2YTZhdipINin2YTZhdix2YjYsSDYp9mE2KzYr9mK2K/YqSDYp9mE2K7Yp9i12Kkg2KjZgy4iO31zOjU6ImFsZXJ0IjthOjQ6e3M6ODoicmVxdWlyZWQiO3M6MzU6Itis2YXZiti5INin2YTYrdmC2YjZhCDZhdi32YTZiNio2KkhIjtzOjM6Im9sZCI7czo1NToi2YPZhNmF2Kkg2KfZhNmF2LHZiNixINin2YTYrdin2YTZitipINi62YrYsSDYtdit2YrYrdipISI7czo1OiJtYXRjaCI7czo3NToi2YTYpyDYqtiq2LfYp9io2YIg2YPZhNmF2Kkg2KfZhNmF2LHZiNixINin2YTYrNiv2YrYr9ipINmF2Lkg2KfZhNiq2YPYsdin2LEhIjtzOjc6InN1Y2Nlc3MiO3M6NDk6Itiq2YUg2KrYudiv2YrZhCDZg9mE2YXYqSDYp9mE2YXYsdmI2LEg2KjZhtis2KfYrS4iO319czo4OiJyZWdpc3RlciI7YToxMzp7czo1OiJ0aXRsZSI7czoyODoi2KfZhti02KfYoSDYrdiz2KfYqCDYrNiv2YrYryI7czo4OiJmYWNlYm9vayI7czo0MToi2KfYtNiq2LHZgyDYudio2LEg2K3Ys9in2Kgg2YHYp9mK2LPYqNmI2YMiO3M6NzoidHdpdHRlciI7czoyMjoi2LPYrNmEINmB2Yog2KrZiNmK2KrYsSI7czo2OiJnb29nbGUiO3M6MjQ6Itin2LTYqtix2YMg2YXYuSDYrNmI2KzZhCI7czo4OiJ1c2VybmFtZSI7YTo0OntzOjU6ImxhYmVsIjtzOjI0OiLYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhToiO3M6NToicGxhY2UiO3M6NDg6Itin2YPYqtioINin2LPZhSDYp9mE2YXYs9iq2K7Yr9mFINin2YTYrtin2LUg2KjZgyI7czoxOiJwIjtzOjcxOiLZitis2Kgg2KPZhiDZitmD2YjZhiDYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhSDYqNmK2YYgMyDZiCAxNSDYrdix2YHZi9inLiI7czoxOiJ3IjtzOjkwOiLZhNinINmK2LPZhditINio2KfYs9iq2K7Yr9in2YUg2KfZhNix2YXZiNiyINmI2KfZhNij2LHZgtin2YUg2YHZiiDYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhS4iO31zOjg6InBhc3N3b3JkIjthOjM6e3M6NToibGFiZWwiO3M6MTg6ItmD2YTZhdmHINin2YTYs9ixOiI7czo1OiJwbGFjZSI7czo0ODoi2KfZg9iq2Kgg2YPZhNmF2Kkg2KfZhNmF2LHZiNixINin2YTYrtin2LXYqSDYqNmDIjtzOjE6InAiO3M6NzI6ItmK2KzYqCDYo9mGINiq2YPZiNmGINmD2YTZhdipINin2YTZhdix2YjYsSA2INij2K3YsdmBINi52YTZiSDYp9mE2KPZgtmELiI7fXM6MTE6InJlLXBhc3N3b3JkIjthOjM6e3M6NToibGFiZWwiO3M6MzM6Itil2LnYp9iv2Kkg2YPZhNmF2Kkg2KfZhNmF2LHZiNixOiI7czo1OiJwbGFjZSI7czo0ODoi2KfZg9iq2Kgg2YPZhNmF2Kkg2KfZhNmF2LHZiNixINin2YTYrtin2LXYqSDYqNmDIjtzOjE6InAiO3M6ODU6ItmK2KzYqCDYo9mGINiq2KrYt9in2KjZgiDYpdi52KfYr9ipINmD2YTZhdipINin2YTZhdix2YjYsSDZhdi5INmD2YTZhdipINin2YTZhdix2YjYsS4iO31zOjU6ImVtYWlsIjthOjM6e3M6NToibGFiZWwiO3M6MzQ6Itin2YTYqNix2YrYryDYp9mE2KXZhNmD2KrYsdmI2YbZijoiO3M6NToicGxhY2UiO3M6NTg6Itin2YPYqtioINin2YTYqNix2YrYryDYp9mE2KfZhNmD2KrYsdmI2YbZiiDYp9mE2K7Yp9i1INio2YMiO3M6MToicCI7czo2MDoi2YXZhiDZgdi22YTZgyDYo9iv2K7ZhCDYqNix2YrYryDYo9mE2YrZg9iq2LHZiNmG2Ykg2LXYrdmK2K0uIjt9czo1OiJiaXJ0aCI7YTo0OntzOjU6ImxhYmVsIjtzOjI1OiLYqtin2LHZitiuINin2YTZhdmK2YTYp9ivIjtzOjM6ImRheSI7czo2OiLZitmI2YUiO3M6NToibW9udGgiO3M6Njoi2LTZh9ixIjtzOjQ6InllYXIiO3M6Njoi2LnYp9mFIjt9czo2OiJnZW5kZXIiO2E6Mzp7czo1OiJsYWJlbCI7czo2OiLYrNmG2LMiO3M6NDoibWFsZSI7czoxMDoi2KfZhNiw2YPYsSI7czo2OiJmZW1hbGUiO3M6ODoi2KPZhtir2YkiO31zOjc6ImFkZHJlc3MiO2E6NDp7czo1OiJsYWJlbCI7czoxMDoi2LnZhtmI2KfZhiI7czo3OiJjb3VudHJ5IjtzOjY6Itio2YTYryI7czo0OiJjaXR5IjtzOjEwOiLZhdiv2YrZhtipIjtzOjU6InN0YXRlIjtzOjg6Itit2KfZhNipIjt9czo2OiJidXR0b24iO3M6MTA6Itil2LHYs9in2YQiO3M6NToiYWxlcnQiO2E6MTM6e3M6ODoicmVxdWlyZWQiO3M6NTU6Itis2YXZiti5INin2YTYrdmC2YjZhCDYp9mE2YXYudmE2YXYqSDYqCAqINmF2LfZhNmI2KjYqSEiO3M6MTM6ImNoYXJfdXNlcm5hbWUiO3M6NzA6ItmK2KzYqCDYo9mGINmK2K3YqtmI2Yog2KfYs9mFINin2YTZhdiz2KrYrtiv2YUg2LnZhNmJINij2K3YsdmBINmB2YLYtyEiO3M6MTY6ImxpbWl0ZWRfdXNlcm5hbWUiO3M6ODY6ItmK2KzYqCDYo9mGINmK2YPZiNmGINin2LPZhSDYp9mE2YXYs9iq2K7Yr9mFINmF2K3Yr9mI2K/Zi9inINio2YrZhiAzINmIIDE1INit2LHZgdmL2KchIjtzOjE0OiJleGlzdF91c2VybmFtZSI7czo0ODoi2KfYs9mFINin2YTZhdiz2KrYrtiv2YUg2YXZiNis2YjYryDYqNin2YTZgdi52YQhIjtzOjEyOiJsaW1pdGVkX3Bhc3MiO3M6ODI6ItmK2KzYqCDYo9mGINiq2YPZiNmGINmD2YTZhdipINin2YTZhdix2YjYsSDZhdit2K/ZiNiv2Kkg2KjZitmGIDYg2YggMTIg2K3YsdmB2YvYpyEiO3M6NjoicmVwYXNzIjtzOjg1OiLYpdi52KfYr9ipINmD2YTZhdipINin2YTZhdix2YjYsSDZitis2Kgg2KPZhiDYqtiq2LfYp9io2YIg2YXYuSDZg9mE2YXYqSDYp9mE2YXYsdmI2LEhIjtzOjExOiJjaGVja19lbWFpbCI7czo1NToi2YrYsdis2Ykg2KXYr9iu2KfZhCDYqNix2YrYryDYpdmE2YPYqtix2YjZhtmKINi12KfZhNitISI7czoxMToiZXhpc3RfZW1haWwiO3M6Njk6Iti52YbZiNin2YYg2KfZhNio2LHZitivINin2YTYpdmE2YPYqtix2YjZhtmKINmF2YjYrNmI2K8g2KjYp9mE2YHYudmEISI7czo1OiJiaXJ0aCI7czo3Mzoi2YrYrNioINij2YYg2YrZg9mI2YYg2KrYp9ix2YrYriDZhdmK2YTYp9iv2YMg2KjZitmGIDEtMS0yMDA1INmIIDEtMS0xOTQyISI7czo3OiJzdWNjZXNzIjtzOjQ4OiLYp9mG2KrZh9iqINi52YXZhNmK2Kkg2KfZhNiq2LPYrNmK2YQg2KjZhtis2KfYrS4iO3M6ODoic3VjY2VzczEiO3M6MTQxOiLYp9mG2KrZh9iqINi52YXZhNmK2Kkg2KfZhNiq2LPYrNmK2YQg2KjZhtis2KfYrS4g2YjZhNmD2YYg2Iwg2YTYpyDZitiy2KfZhCDZitiq2LnZitmGINin2YTZhdmI2KfZgdmC2Kkg2LnZhNmK2YfYpyDZhdmGINmC2KjZhCDYp9mE2KXYr9in2LHYqS4iO3M6ODoic3VjY2VzczIiO3M6MTQ5OiLYp9mG2KrZh9iqINi52YXZhNmK2Kkg2KfZhNiq2LPYrNmK2YQg2KjZhtis2KfYrS4g2YjZhNmD2YYg2Iwg2YTYpyDYqtiy2KfZhCDYqNit2KfYrNipINil2YTZiSDYp9mE2KrZhti02YrYtyDYudio2LEg2KfZhNio2LHZitivINin2YTYpdmE2YPYqtix2YjZhtmKLiI7czo1OiJlcnJvciI7czo3MToi2KfYs9mFINin2YTZhdiz2KrYrtiv2YUg2KPZiCDZg9mE2YXYqSDYp9mE2YXYsdmI2LEg2LrZitixINmF2KrZiNmB2LHYqSEiO319czo2OiJyZXBvcnQiO2E6NTp7czo1OiJ0aXRsZSI7czozNToi2KfZhNil2KjZhNin2Log2LnZhiDYs9ik2KfZhCDYs9mK2KEiO3M6Njoic2VsZWN0IjthOjI6e3M6NToibGFiZWwiO3M6MTM6ItmF2Kcg2YfYsNin2J8iO3M6NjoidmFsdWVzIjthOjM6e2k6MTtzOjE5OiLYs9ik2KfZhCDZhdiq2YPYsdixIjtpOjI7czoxMzoi2LPZitimINis2K/YpyI7aTozO3M6MjY6ItmF2K3YqtmI2Ykg2LrZitixINmE2KfYptmCIjt9fXM6ODoidGV4dGFyZWEiO2E6Mjp7czo1OiJsYWJlbCI7czoxNToi2LTZitihINii2K7YsdifIjtzOjU6InBsYWNlIjtzOjE1OiLYtNmK2KEg2KLYrtix2J8iO31zOjY6ImJ1dHRvbiI7czoxMDoi2KXYsdiz2KfZhCI7czo1OiJhbGVydCI7YTozOntzOjg6InJlcXVpcmVkIjtzOjU1OiLYrNmF2YrYuSDYp9mE2K3ZgtmI2YQg2KfZhNmF2LnZhNmF2Kkg2KggKiDZhdi32YTZiNio2KkhIjtzOjc6InN1Y2Nlc3MiO3M6NDI6Itiq2YUg2KXYsdiz2KfZhCDYp9mE2KrZgtix2YrYsSDYqNmG2KzYp9itLiI7czo1OiJlcnJvciI7czoyMToi2YfZhtin2YMg2K7Yt9ijINmF2KchIjt9fXM6Nzoic2lkZWJhciI7YTo0OntzOjk6InF1ZXN0aW9ucyI7YTo0OntzOjU6InRpdGxlIjtzOjEwOiLYo9iz2KbZhNipIjtzOjM6ImRheSI7czo2OiLZitmI2YUiO3M6NToibW9udGgiO3M6Njoi2LTZh9ixIjtzOjQ6InllYXIiO3M6Njoi2LnYp9mFIjt9czoxMDoiY2F0ZWdvcmllcyI7czoyNzoi2KfZhNmB2KbYp9iqINin2YTYtNi52KjZitipIjtzOjY6InNvY2lhbCI7czo0NDoi2YjYs9in2KbZhCDYp9mE2KrZiNin2LXZhCDYp9mE2KfYrNiq2YXYp9i52YoiO3M6NjoiZm9sbG93IjthOjY6e3M6NToidGl0bGUiO3M6MzE6Itin2YTZhtin2LMg2YrYrNioINij2YYg2YrYqtio2LkiO3M6NDoiZGVzYyI7czoxNToi2YjYtdmBINi12LrZitixIjtzOjU6InZvdGVzIjtzOjE0OiLYp9mE2KPYtdmI2KfYqiI7czo5OiJxdWVzdGlvbnMiO3M6MTQ6Itin2YTYo9iz2KbZhNipIjtzOjk6ImZvbGxvd2VycyI7czoxNDoi2YXYqtin2KjYudmI2YYiO3M6NjoidGFnZ2VkIjtzOjE2OiLYp9mE2YXZiNiz2YjZhdipIjt9fXM6NDoidm90ZSI7YTozOntzOjY6ImZvbGxvdyI7czoyMToi2KfYqtio2Lkg2KfZhNiz2KTYp9mEIjtzOjQ6InN0ZXAiO3M6NDE6ItmK2KzYqCDYp9mE2YLZitin2YUg2KjYrti32YjYqSDYo9iu2YrYsdipIjtzOjU6ImFsZXJ0IjthOjQ6e3M6NzoiYWxyZWFkeSI7czo5Njoi2YTYpyDZitmF2YPZhtmDINil2LHYs9in2YQg2KrYtdmI2YrYqiDYudmE2Ykg2LPYpNin2YQg2KrZhSDYp9mE2KrYtdmI2YrYqiDYudmE2YrZhyDYqNin2YTZgdi52YQhIjtzOjc6ImV4cGlyZWQiO3M6MTAzOiLZhNinINmK2YXZg9mG2YMg2KXYttin2YHYqSDYqti12YjZitiqINmE2YfYsNinINin2YTYp9iz2KrYt9mE2KfYuSDZhNij2YbZhyDZhdmG2KrZh9mKINin2YTYtdmE2KfYrdmK2KkhIjtzOjc6InN1Y2Nlc3MiO3M6NDA6Itiq2YUg2KXYsdiz2KfZhCDYqti12YjZitiq2YMg2KjZhtis2KfYrS4iO3M6NToiZXJyb3IiO3M6NzE6Itin2LPZhSDYp9mE2YXYs9iq2K7Yr9mFINij2Ygg2YPZhNmF2Kkg2KfZhNmF2LHZiNixINi62YrYsSDZhdiq2YjZgdix2KkhIjt9fXM6NjoiYWxlcnRzIjthOjk6e3M6Nzoibm8tZGF0YSI7czo2MDoi2YTYpyDYqtmI2KzYryDYqNmK2KfZhtin2Kog2YHZiiDZgtin2LnYr9ipINio2YrYp9mG2KfYqtmG2KchIjtzOjQ6InBsYW4iO3M6MTEzOiLZhNmK2LMg2YTYr9mK2YMg2KXYsNmGINmE2YTZiNi12YjZhCDYpdmE2Ykg2YfYsNmHINin2YTYtdmB2K3YqSDYjCDZgdij2YbYqiDYqNit2KfYrNipINil2YTZiSDYqtix2YLZitipINiu2LfYqtmDISI7czo4OiJwbGFudm90ZSI7czoxNTI6ItmE2Kcg2YrZhdmD2YbZgyDYp9mE2KrYtdmI2YrYqiDYudmE2Ykg2LPYpNin2YQg2KfZhNmF2LPYqtiu2K/ZhSDZh9iw2Kcg2YTYo9mG2Ycg2YjYtdmEINil2YTZiSDYp9mE2K3YryDYp9mE2KPZgti12Ykg2YXZhiDYp9mE2KPYtdmI2KfYqiDZgdmKINin2YTYtNmH2LEhIjtzOjEwOiJwZXJtaXNzaW9uIjtzOjYzOiLZhNmK2LMg2YTYr9mK2YMg2KXYsNmGINmE2YTZiNi12YjZhCDYpdmE2Ykg2YfYsNmHINin2YTYtdmB2K3YqSEiO3M6NToid3JvbmciO3M6MjE6ItmH2YbYp9mDINiu2LfYoyDZhdinISI7czo2OiJkYW5nZXIiO3M6MTk6Itij2YjZhyDYjCDYs9mG2KfYqCEiO3M6Nzoic3VjY2VzcyI7czoxMToi2KPYrdiz2YbYqiEiO3M6Nzoid2FybmluZyI7czoxMToi2KrYrdiw2YrYsSEiO3M6NDoiaW5mbyI7czoxMzoi2KfZhtiq2KjYp9mHISI7fXM6NToicGxhbnMiO2E6NTp7czo1OiJ0aXRsZSI7czozMzoi2KrYs9i52YrYsSDYqNiz2YrYtyDZhNmE2KzZhdmK2LkhIjtzOjQ6ImRlc2MiO3M6MTk4OiLYo9iz2LnYp9ixINmF2LXZhdmF2Kkg2YTZhNi02LHZg9in2Kog2YXZhiDYrNmF2YrYuSDYp9mE2KPYrdis2KfZhS4g2KfYudix2YEg2K/Yp9im2YXZi9inINmF2Kcg2LPYqtiv2YHYudmHLiDYqtij2KrZiiDYrNmF2YrYuSDYp9mE2K7Yt9i3INmF2Lkg2LbZhdin2YYg2KfYs9iq2LnYp9iv2Kkg2KfZhNij2YXZiNin2YQg2KjZhtiz2KjYqSAxMDDZqi4iO3M6NToibW9udGgiO3M6MTI6Ii/Zg9mEINi02YfYsSI7czozOiJidG4iO3M6MTA6Itin2YTYqNiv2KEiO3M6NToiYWxlcnQiO2E6Mjp7czo3OiJzdWNjZXNzIjtzOjI3OiLYqtmFINit2LPYp9ioINiv2YHYudin2KrZgyEiO3M6Nzoid2FybmluZyI7czo0OToi2YTZgtivINiv2YHYudiqINio2KfZhNmB2LnZhCDZhNmH2LDYpyDYp9mE2LTZh9ixISI7fX1zOjEwOiJzdGF0aXN0aWNzIjthOjE0OntzOjU6InRpdGxlIjtzOjE0OiLYp9mE2KXYrdi12KfYoSI7czo5OiJieWFuc3dlcnMiO3M6MzM6Itil2K3Ytdin2KbZitin2Kog2KjYp9mE2KXYrNin2KjYqSI7czo4OiJieWdlbmRlciI7czozNDoi2KXYrdi12KfYptmK2KfYqiDYrdiz2Kgg2KfZhNis2YbYsyI7czo1OiJieWFnZSI7czozNDoi2KXYrdi12KfYptmK2KfYqiDYrdiz2Kgg2KfZhNi52YXYsSI7czoxMDoiYnlsb2NhdGlvbiI7czo0MDoi2KfZhNil2K3Ytdin2KbZitin2Kog2K3Ys9ioINin2YTZhdmI2YLYuSI7czo0OiJsaXN0IjtzOjI3OiLZgtin2KbZhdipINin2YTZhtin2K7YqNmK2YYiO3M6OToibm9jb3VudHJ5IjtzOjIwOiLZhNinINmK2YjYrNivINio2YTYryI7czo3OiJ2aXNpdG9yIjtzOjg6Itiy2KfYptixIjtzOjg6InVzZXJuYW1lIjtzOjIzOiLYp9iz2YUg2KfZhNmF2LPYqtiu2K/ZhSI7czoxMDoidm90aW5nZGF0ZSI7czoyNToi2KrYp9ix2YrYriDYp9mE2KrYtdmI2YrYqiI7czozOiJhZ2UiO3M6Njoi2LnZhdixIjtzOjY6ImdlbmRlciI7czo2OiLYrNmG2LMiO3M6MzoiYnRuIjtzOjE0OiLYqtit2YXZitmEIFBERiI7czo1OiJhbGVydCI7YToyOntzOjc6InN1Y2Nlc3MiO3M6Mjc6Itiq2YUg2K3Ys9in2Kgg2K/Zgdi52KfYqtmDISI7czo3OiJ3YXJuaW5nIjtzOjQ5OiLZhNmC2K8g2K/Zgdi52Kog2KjYp9mE2YHYudmEINmE2YfYsNinINin2YTYtNmH2LEhIjt9fXM6NjoicGF5b3V0IjthOjEzOntzOjU6InRpdGxlIjtzOjEwOiLYs9mK2LXYsdmBIjtzOjY6InN0aXRsZSI7czoyMzoi2KfYptiq2YXYp9mG2KfYqtmDIHtjY30iO3M6NjoicG9pbnRzIjtzOjg6ItmG2YLYp9i3IjtzOjc6ImNyZWRpdHMiO3M6MTY6Itin2KbYqtmF2KfZhtin2KoiO3M6MjoiY3AiO3M6MTM6ItmD2YUg2YbZgti32KkiO3M6NToiZW1haWwiO3M6MzM6Itin2YTYqNix2YrYryDYp9mE2KXZhNmD2KrYsdmI2YbZiiI7czoyOiJlcCI7czozMToi2KjYsdmK2K/ZgyDYp9mE2KfZhNmD2KrYsdmI2YbZiiI7czo0OiJuZWVkIjtzOjcwOiLYqtit2KrYp9isINil2YTZiSDYp9mE2YjYtdmI2YQg2KXZhNmJIHtjY30g2Iwg2YTYpdis2LHYp9ihINin2YTYs9it2KguIjtzOjM6ImJ0biI7czoxMDoi2KXYsdiz2KfZhCI7czo1OiJwcmljZSI7czoxMDoi2KfZhNiz2LnYsSI7czo2OiJzdGF0dXMiO3M6MTI6Itin2YTYrdin2YTYqSI7czo3OiJjcmVhdGVkIjtzOjE1OiLYo9mG2LTYptiqINmB2YoiO3M6NToiYWxlcnQiO2E6Mjp7czo3OiJzdWNjZXNzIjtzOjI3OiLYqtmFINit2LPYp9ioINiv2YHYudin2KrZgyEiO3M6Nzoid2FybmluZyI7czo0OToi2YTZgtivINiv2YHYudiqINio2KfZhNmB2LnZhCDZhNmH2LDYpyDYp9mE2LTZh9ixISI7fX19', 0, 0),
		(2, 'Türkçe (tr)', 'tr', 'tr', 0, 1587320402, 1587321525, 'YToyMTp7czozOiJydGwiO3M6MToiMCI7czo0OiJsYW5nIjtzOjI6InRyIjtzOjU6ImNsb3NlIjtzOjU6IkthcGF0IjtzOjc6ImxvYWRpbmciO3M6MTQ6IlnDvGtsZW5peW9yLi4uIjtzOjg6InZlcmlmaWVkIjtzOjE4OiJPbmF5bGFubcSxxZ8gSGVzYXAiO3M6NToiYWRtaW4iO3M6NDoiQWRtaSI7czo4OiJ0aW1lZGF0ZSI7YTo5OntzOjExOiJ0aW1lX3NlY29uZCI7czo2OiJzYW5peWUiO3M6MTE6InRpbWVfbWludXRlIjtzOjY6ImRha2lrYSI7czo5OiJ0aW1lX2hvdXIiO3M6NDoic2FhdCI7czo4OiJ0aW1lX2RheSI7czozOiJnw7wiO3M6OToidGltZV93ZWVrIjtzOjU6ImhhZnRhIjtzOjEwOiJ0aW1lX21vbnRoIjtzOjI6ImF5IjtzOjk6InRpbWVfeWVhciI7czo0OiJ5xLFsIjtzOjExOiJ0aW1lX2RlY2FkZSI7czo3OiIxMCB5xLFsIjtzOjg6InRpbWVfYWdvIjtzOjU6IsO2bmNlIjt9czozOiJhc2siO2E6OTp7czo5OiJhc2tfdGl0bGUiO3M6MTM6Illlbmkgc29ydSBzb3IiO3M6MTA6ImVkaXRfdGl0bGUiO3M6MTU6IlNvcnV5dSBkw7x6ZW5sZSI7czo4OiJxdWVzdGlvbiI7YTozOntzOjU6ImxhYmVsIjtzOjg6IlNvcnVudXo6IjtzOjU6InBsYWNlIjtzOjE4OiJTb3J1bnV6dSB5YXrEsW7EsXoiO3M6MToicCI7czo2MDoiSFRNTCBpem5pIHlvay4gVXlndW4gb2xtYXlhbiBzb3J1bGFyxLFuxLF6IHlhecSxbmxhbm1heWFjYWsuIjt9czo0OiJ0eXBlIjthOjc6e3M6NToibGFiZWwiO3M6MTA6IlNvcnUgVGlwaToiO3M6Njoibm9ybWFsIjthOjE6e3M6NToibGFiZWwiO3M6MTY6IsOHb2t0YW4gU2XDp21lbGkiO31zOjU6Inllc25vIjthOjM6e3M6NToibGFiZWwiO3M6MTE6IkV2ZXQvSGF5xLFyIjtzOjM6InllcyI7czo0OiJFdmV0IjtzOjI6Im5vIjtzOjY6IkhhecSxciI7fXM6NjoiaW1hZ2VzIjthOjM6e3M6NToibGFiZWwiO3M6NzoiUmVzaW1saSI7czo1OiJwbGFjZSI7czoxMjoiQ2V2YXAgcmVzbWk6IjtzOjY6InNlbGVjdCI7czoxNDoiUmVzaW0gc2XDp2luaXoiO31zOjU6InBsYWNlIjtzOjMwOiJDZXZhYsSxbsSxesSxIGJ1cmF5YSB5YXrEsW7EsXoiO3M6NzoiYW5zd2VycyI7czo5OiJDZXZhcGxhcjoiO3M6MzoiYWRkIjtzOjk6IkFsYW4gRWtsZSI7fXM6ODoiY2F0ZWdvcnkiO2E6Mjp7czo1OiJsYWJlbCI7czo5OiJLYXRlZ29yaToiO3M6NToicGxhY2UiO3M6MTc6IkthdGVnb3JpIHNlw6dpbml6Ijt9czozOiJlbmQiO2E6Mjp7czo1OiJsYWJlbCI7czoxNDoiQml0acWfIHRhcmloaToiO3M6NToicGxhY2UiO3M6MjI6IkJpdGnFnyB0YXJpaGkgc2XDp2luaXoiO31zOjU6InRodW1iIjthOjM6e3M6NToibGFiZWwiO3M6MTU6IkvDvMOnw7xrIHJlc2ltOiI7czo1OiJwbGFjZSI7czoxNDoiUmVzaW0gc2XDp2luaXoiO3M6MToicCI7czo2MDoiSFRNTCBpem5pIHlvay4gVXlndW4gb2xtYXlhbiBzb3J1bGFyxLFuxLF6IHlhecSxbmxhbm1heWFjYWsuIjt9czo2OiJidXR0b24iO3M6ODoiWWF5xLFubGEiO3M6NToiYWxlcnQiO2E6Njp7czo4OiJyZXF1aXJlZCI7czozMToiKiBpxZ9hcmV0bGkgYWxhbmxhciB6b3J1bmx1ZHVyISI7czo0OiJtb3JlIjtzOjM2OiI4J2RlbiBmYXpsYSBjZXZhcCBzZcOnZW5lxJ9pIG9sYW1heiEiO3M6NDoibGVzcyI7czozMzoiMidkZW4gYXogY2V2YXAgc2XDp2VuZcSfaSBvbGFtYXohIjtzOjY6ImltYWdlcyI7czozNjoiVMO8bSBjZXZhcGxhciBpw6dpbiByZXNpbSBzZcOnaWxtZWxpIjtzOjc6InN1Y2Nlc3MiO3M6MzM6IlNvcnVudXogYmHFn2FyxLF5bGEgeWF5xLFubGFuZMSxLiI7czo0OiJlZGl0IjtzOjMyOiJTb3J1bnV6IGJhxZ9hcsSxeWxhIGTDvHplbmxlbmRpLiI7fX1zOjc6ImRldGFpbHMiO2E6OTp7czo1OiJ0aXRsZSI7czoyNzoiUHJvZmlsIEJpbGdpbGVyaW5pIETDvHplbmxlIjtzOjU6ImZpcnN0IjthOjI6e3M6NToibGFiZWwiO3M6NjoixLBzaW06IjtzOjU6InBsYWNlIjtzOjE0OiJpc21pbml6aSB5YXrEsSI7fXM6NDoibGFzdCI7YToyOntzOjU6ImxhYmVsIjtzOjg6IlNveWlzaW06IjtzOjU6InBsYWNlIjtzOjIxOiJzb3lpc21pbml6aSB5YXrEsW7EsXoiO31zOjQ6ImRlc2MiO2E6Mjp7czo1OiJsYWJlbCI7czoxMzoiSGFra8SxbsSxemRhOiI7czo1OiJwbGFjZSI7czozMDoiS8Sxc2EgYmlyIGHDp8Sxa2xhbWEgeWF6xLFuxLF6Ijt9czo1OiJwaG90byI7YToyOntzOjU6ImxhYmVsIjtzOjE5OiJQcm9maWwgRm90b8SfcmFmxLE6IjtzOjU6InBsYWNlIjtzOjI4OiJQcm9maWwgRm90b8SfcmFmxLEgU2XDp2luaXo6Ijt9czo1OiJjb3ZlciI7YToyOntzOjU6ImxhYmVsIjtzOjE4OiJLYXBhayBGb3RvxJ9yYWbEsToiO3M6NToicGxhY2UiO3M6Mjc6IkthcGFrIEZvdG/En3JhZsSxIFNlw6dpbml6OiI7fXM6Nzoic29jaWFscyI7czoxMzoiU29zeWFsIE1lZHlhOiI7czo2OiJidXR0b24iO3M6NjoiS2F5ZGV0IjtzOjU6ImFsZXJ0IjthOjM6e3M6ODoicmVxdWlyZWQiO3M6MzU6IiogaWxlIGnFn2FyZXRsaSBhbGFubGFyIHpvcnVubHVkdXIhIjtzOjQ6ImRlc2MiO3M6NDU6IkHDp8Sxa2xhbWEgNTAgaGFyZnRlbiBkYWhhIGvEsXNhIG9sbWFsxLFkxLFyISI7czo3OiJzdWNjZXNzIjtzOjQ0OiJQcm9maWwgYmlsZ2lsZXJpbml6IGJhxZ9hcsSxeWxhIGTDvHplbmxlbmRpLiI7fX1zOjY6ImZvb3RlciI7YTozOntzOjU6ImxpbmtzIjtzOjc6IkxpbmtsZXIiO3M6OToic3Vic2NyaWJlIjthOjU6e3M6NToidGl0bGUiO3M6MTQ6IkUtUG9zdGEgQsO8bHRlIjtzOjE6InAiO3M6MTIxOiJQb2xsYXRlIGhha2vEsW5kYWtpIHNvbiBnZWxpxZ9tZWxlcixwYXlsYcWfxLFsYW4gc29uIGFua2V0bGVyIHZlIHllbmlsaWtsZXIgacOnaW4gZS1wb3N0YSBiw7xsdGVuaW1pemUga2F5ZG9sYWJpbGlyc2luaXouIjtzOjU6InBsYWNlIjtzOjE3OiJFLVBvc3RhIEFkcmVzaW5peiI7czo2OiJidXR0b24iO3M6NjoiS2F5ZG9sIjtzOjU6ImFsZXJ0IjthOjM6e3M6NToiZXhpc3QiO3M6NDQ6IkUtcG9zdGEgYsO8bHRlbmltaXplIHphdGVuIGthecSxdGzEsXPEsW7EsXohIjtzOjU6ImVtYWlsIjtzOjQ0OiJMw7x0ZmVuIGdlw6dlcmxpIGJpciBlLXBvc3RhIGFkcmVzaSBnaXJpbml6ISI7czo3OiJzdWNjZXNzIjtzOjQ1OiJFLXBvc3RhIGLDvGx0ZW5pbWl6ZSBiYcWfYXLEsXlsYSBrYXlkb2xkdW51ei4iO319czoxMDoic3RhdGlzdGljcyI7YTo2OntzOjU6InRpdGxlIjtzOjE0OiLEsHN0YXRpc3Rpa2xlciI7czo1OiJ1c2VycyI7czoxMjoie2NvdW50fSDDnHllIjtzOjk6InF1ZXN0aW9ucyI7czoxMjoie2NvdW50fSBTb3J1IjtzOjU6InZvdGVzIjtzOjEwOiJ7Y291bnR9IE95IjtzOjg6ImNvbW1lbnRzIjtzOjEzOiJ7Y291bnR9IFlvcnVtIjtzOjc6ImFuc3dlcnMiO3M6MTM6Intjb3VudH0gQ2V2YXAiO319czo2OiJmb3JnZXQiO2E6NTp7czo1OiJ0aXRsZSI7czoyNDoixZ5pZnJlbml6aSBtaSB1bnV0dHVudXo/IjtzOjU6ImVtYWlsIjtzOjU2OiJrdWxsYW7EsWPEsSBhZMSxbsSxesSxIHZleWEgZS1wb3N0YSBhZHJlc2luaXppIHlhesSxbsSxeiI7czo2OiJidXR0b24iO3M6OToiU8SxZsSxcmxhIjtzOjU6ImFsZXJ0IjthOjQ6e3M6ODoicmVxdWlyZWQiO3M6MzU6IiogaWxlIGnFn2FyZXRsaSBhbGFubGFyIHpvcnVubHVkdXIhIjtzOjU6ImVtYWlsIjtzOjc5OiJMw7x0ZmVuIMO8eWUgb2xkdcSfdW51eiBlLXBvc3RhIGFkcmVzaW5pemkgdmV5YSBrdWxsYW7EsWPEsSBhZMSxbsSxesSxIGdpcmluaXohIjtzOjc6InN1Y2Nlc3MiO3M6NzY6IsWeaWZyZW5pemkgc8SxZsSxcmxheWFiaWxlY2XEn2luaXogbGluayBlLXBvc3RhIGFkcmVzaW5pemUgZ8O2bmRlcmlsbWnFn3Rpci4iO3M6NToiZXJyb3IiO3M6NzM6Ik1haWwgZ8O2bmRlcmlsaXJrZW4gYmlyIGhhdGEgb2x1xZ90dSxsw7x0ZmVuIGRhaGEgc29ucmEgdGVrcmFyIGRlbmV5aW5peiEiO31zOjQ6Im1haWwiO2E6Mjp7czo1OiJ0aXRsZSI7czoyMzoixZ5pZnJlbml6aSBzxLFmxLFybGF5xLEiO3M6NzoiY29udGVudCI7czowOiIiO319czo2OiJoZWFkZXIiO2E6MTU6e3M6Njoic2VhcmNoIjtzOjg6IlNvcnUgQXJhIjtzOjM6ImFzayI7czo4OiJTb3J1IFNvciI7czo3OiJwcm9maWxlIjtzOjg6IlByb2ZpbGltIjtzOjk6InF1ZXN0aW9ucyI7czoxMDoiU29ydWxhcsSxbSI7czoyOiJjcCI7czoxMToiQWRtaW4gUGFuZWwiO3M6NzoiZGV0YWlscyI7czoxNjoiUHJvZmlsaSBEw7x6ZW5sZSI7czo4OiJwYXNzd29yZCI7czoxNzoixZ5pZnJlIERlxJ9pxZ90aXIiO3M6NzoiY3JlZGl0cyI7czoxMDoiS3JlZGlsZXJpbSI7czo2OiJsb2dvdXQiO3M6MTM6IsOHxLFrxLHFnyBZYXAiO3M6NzoiY29uZmlybSI7czo0NDoiw4fEsWvEscWfIHlhcG1hayBpc3RlZGnEn2luaXplIGVtaW4gbWlzaW5pej8iO3M6Njoibm90aWNlIjtzOjcyOiJMw7x0ZmVuIGJpbGdpbGVyaW5pemksw7Z6ZWxsaWtsZSDFn2lmcmVuaXppIGfDvG5jZWxsZW1leWkgdW51dG1hecSxbsSxeiEiO3M6NDoibm90eSI7YTo3OntzOjU6InRpdGxlIjtzOjExOiJCaWxkaXJpbWxlciI7czo0OiJyZWFkIjtzOjExOiJIZXBzaW5pIE9rdSI7czo0OiJtb3JlIjtzOjI3OiJEYWhhIGZhemxhIGJpbGRpcmltIGfDtnN0ZXIiO3M6MzoidGFnIjtzOjI4OiJzb3J1c3VuZGEga2VuZGlzaW5pIHRhZ2xlZGkuIjtzOjQ6InZvdGUiO3M6MTg6InNvcnVudXphIG95IHZlcmRpLiI7czo3OiJjb21tZW50IjtzOjIyOiJzb3J1c3VuYSB5b3J1bSB5YXB0xLEuIjtzOjY6ImZvbGxvdyI7czoyODoic2VuaSB0YWtpcCBldG1leWUgYmHFn2xhZMSxLiI7fXM6MjoiaW4iO3M6MTA6IkdpcmnFnyBZYXAiO3M6MjoidXAiO3M6Nzoiw5x5ZSBPbCI7czo0OiJtZW51IjthOjY6e3M6NDoiaG9tZSI7czo4OiJBbmFzYXlmYSI7czo1OiJmcmVzaCI7czoxNToiRW4gWWVuaSBTb3J1bGFyIjtzOjc6InBvcHVsYXIiO3M6MTY6IlBvcMO8bGVyIFNvcnVsYXIiO3M6NzoibWVtYmVycyI7czo3OiLDnHllbGVyIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjExOiJLYXRlZ29yaWxlciI7czo4OiJmb2xsb3dlZCI7czoyMjoiVGFraXAgRXR0acSfaW0gU29ydWxhciI7fX1zOjU6ImxvZ2luIjthOjEwOntzOjU6InRpdGxlIjtzOjEwOiJHaXJpxZ8gWWFwIjtzOjg6ImZhY2Vib29rIjtzOjIzOiJGYWNlYm9vayBpbGUgR2lyacWfIFlhcCI7czo3OiJ0d2l0dGVyIjtzOjIyOiJUd2l0dGVyIGlsZSBHaXJpxZ8gWWFwIjtzOjY6Imdvb2dsZSI7czoyMToiR29vZ2xlIGlsZSBHaXJpxZ8gWWFwIjtzOjg6InVzZXJuYW1lIjtzOjU2OiJrdWxsYW7EsWPEsSBhZMSxbsSxesSxIHZleWEgZS1wb3N0YSBhZHJlc2luaXppIHlhesSxbsSxeiI7czo4OiJwYXNzd29yZCI7czoyMDoixZ9pZnJlbml6aSB5YXrEsW7EsXoiO3M6NDoia2VlcCI7czoxMzoiQmVuaSBIYXTEsXJsYSI7czo2OiJmb3JnZXQiO3M6MjU6IsWexLBmcmVuaXppIG1pIHVudXR0dW51ej8iO3M6NjoiYnV0dG9uIjtzOjEwOiJHaXJpxZ8gWWFwIjtzOjU6ImFsZXJ0IjthOjc6e3M6ODoicmVxdWlyZWQiO3M6NTg6Ikt1bGxhbsSxY8SxIGFkxLFuxLF6xLEgdmV5YSDFn2lmcmVuaXppIGJvxZ8gYsSxcmFrdMSxbsSxeiEiO3M6NzoibW9kZXJhdCI7czoxMjA6IsOceWVsacSfaW5peiBpcHRhbCBlZGlsbWnFn3RpcixlxJ9lciBiaXIgeWFubMSxxZ9sxLFrIG9sZHXEn3VudSBkw7zFn8O8bsO8eW9yc2FuxLF6IGzDvHRmZW4gYml6aW1sZSBpbGV0acWfaW1lIGdlw6dpbml6LiI7czoxMDoiYWN0aXZhdGlvbiI7czo2Njoiw5x5ZWxpxJ9pbml6aW4gYWt0aWZsZcWfdGlyaWxtZXNpIGnDp2luIGUtcG9zdGEgb25hecSxIGdlcmVrbGlkaXIuIjtzOjc6ImFwcHJvdmUiO3M6Njg6IsOceWVsacSfaW5pemluIGFrdGlmbGXFn3RpcmlsbWVzaSBpw6dpbiB5w7ZuZXRpY2kgb25hecSxIGdlcmVrbGlkaXIuIjtzOjc6InN1Y2Nlc3MiO3M6Njg6IkJhxZ9hcsSxeWxhIGdpcmnFnyB5YXB0xLFuxLF6LCBrZXlpZmxpIHZha2l0IGdlw6dpcm1lbml6IGRpbGXEn2l5bGUhIjtzOjY6InNvY2lhbCI7czoxNDA6IlNvc3lhbCBtZWR5YSBoZXNhcGxhcsSxbsSxeiBpbGUgaWxnaWxpIGJpciBzb3J1biB2YXIuIEJ1IHNvc3lhbCBtZWR5YSBoZXNhYsSxIGRhaGEgw7ZuY2Uga3VsbGFuxLFsbcSxxZ8gb2xhYmlsaXIgeWEgZGEgc2l6ZSBhaXQgb2xtYXlhYmlsaXIhIjtzOjU6ImVycm9yIjtzOjU2OiJTZcOndGnEn2luaXoga3VsbGFuxLFjxLEgYWTEsSB2ZXlhIMWfaWZyZSBrdWxsYW7EsWxhbWF6ISI7fX1zOjc6Im1lbWJlcnMiO2E6MTc6e3M6OToiZm9sbG93aW5nIjtzOjE4OiJUYWtpcCBFdHRpa2xlcmluaXoiO3M6OToiZm9sbG93ZXJzIjtzOjg6IlRha2lww6dpIjtzOjk6InF1ZXN0aW9ucyI7czo0OiJTb3J1IjtzOjE0OiJtb3JlLXF1ZXN0aW9ucyI7czoxNDoiw5x5ZSBTb3J1bGFyxLEiO3M6NToidm90ZXMiO3M6MjoiT3kiO3M6ODoiY29tbWVudHMiO3M6ODoiWW9ydW1sYXIiO3M6NDoidGFncyI7czo5OiJFdGlrZXRsZXIiO3M6NjoiZm9sbG93IjtzOjg6IlRha2lwIEV0IjtzOjg6InVuZm9sbG93IjtzOjEzOiJUYWtpYmkgQsSxcmFrIjtzOjEyOiJwci1mb2xsb3dlcnMiO3M6MTY6IlRha2lwIEV0dGlrbGVyaToiO3M6MTI6InByLWZvbGxvd2luZyI7czoxMzoiVGFraXDDp2lsZXJpOiI7czoxMToicHItbW9yZS1mbHIiO3M6MTA6IkRhaGEgZmF6bGEiO3M6MTE6InByLW1vcmUtZmxuIjtzOjEwOiJEYWhhIGZhemxhIjtzOjk6InBnLWZvbGxvdyI7czo1OiLDnHllOiI7czoxMjoicGctZm9sbG93ZXJzIjtzOjEyOiJUYWtpcMOnaWxlcjoiO3M6MTI6InBnLWZvbGxvd2luZyI7czoxNjoiVGFraXAgRXR0aWtsZXJpOiI7czo1OiJhbGVydCI7YTo0OntzOjEwOiJmbC1zdWNjZXNzIjtzOjMwOiLDnHllIGJhxZ9hcsSxeWxhIHRha2lwIGVkaWxkaSEiO3M6NjoiZmwtb3duIjtzOjMxOiJLZW5kaW5pemkgdGFraXAgZWRlbWV6c2luaXogOikhIjtzOjEwOiJmbC1hbHJlYWR5IjtzOjM2OiJCdSDDvHlleWkgw6dva3RhbiB0YWtpcCBlZGl5b3JzdW51eiEiO3M6OToiZmwtZGVsZXRlIjtzOjM0OiLDnHlleWkgdGFraXAgZXRtZXlpIGLEsXJha3TEsW7EsXohIjt9fXM6OToicXVlc3Rpb25zIjthOjIyOntzOjY6ImZvbGxvdyI7czoxNToiU29ydXl1IFRha2lwIEV0IjtzOjg6InVuZm9sbG93IjtzOjI2OiJTb3J1eXUgVGFraXAgRXRtZXlpIELEsXJhayI7czo2OiJyZXBvcnQiO3M6MTQ6IlNvcnV5dSBSYXBvcmxhIjtzOjQ6ImVkaXQiO3M6ODoiRMO8emVubGUiO3M6NjoiZGVsZXRlIjtzOjM6IlNpbCI7czoyOiJieSI7czoxNzoie3VzZXJ9IHRhcmFmxLFuZGEiO3M6NToidm90ZXMiO3M6Mjoib3kiO3M6NDoidGFncyI7czo4OiJ0YWtpcMOnaSI7czo3OiJyZXBsaWVzIjtzOjU6ImNldmFwIjtzOjEzOiJtb3JlLWNvbW1lbnRzIjtzOjIxOiJEYWhhIGZhemxhIHlvcnVtIGfDtnIiO3M6MTM6InBsYWNlLWNvbW1lbnQiO3M6MTc6IlllbmkgeW9ydW0geWF6Li4uIjtzOjEyOiJzZW5kLWNvbW1lbnQiO3M6MTM6IllvcnVtIGfDtm5kZXIiO3M6NjoiY2FuY2VsIjtzOjk6IsSwcHRhbCBFdCI7czo2OiJub3VzZXIiO3M6NDQ6IllvcnVtIHlhcGFiaWxtZWsgacOnaW4ge3NpZ251cH0gb3Ige3NpZ25pbn0uIjtzOjM6Im5vdyI7czo2OiLFnmltZGkiO3M6NjoicGctYWxsIjtzOjE1OiJIZXBzaW5pIEfDtnN0ZXIiO3M6OToicGctdm90ZXJzIjtzOjE1OiJPeSBLdWxsYW5hbmxhcjoiO3M6ODoicGctdm90ZXMiO3M6NjoiT3lsYXI6IjtzOjEwOiJwZy12b3Rlcy1xIjtzOjU6IlNvcnU6IjtzOjg6InBnLXRhZ2VzIjtzOjEyOiJUYWtpcMOnaWxlcjoiO3M6NToic2hhcmUiO2E6NTp7czo1OiJ0aXRsZSI7czo3OiJQYXlsYcWfIjtzOjI6ImZiIjtzOjE5OiJGYWNlYm9vayd0YSBwYXlsYcWfIjtzOjI6InR3IjtzOjE4OiJUd2l0dGVyJ2RhIHBheWxhxZ8iO3M6MjoiZ3AiO3M6MTg6Ikdvb2dsZSsnZGEgcGF5bGHFnyI7czo2OiJpZnJhbWUiO3M6NToiRW1iZWQiO31zOjU6ImFsZXJ0IjthOjc6e3M6MzoiYWxsIjtzOjI0OiJUw7xtIGFsYW5sYXIgem9ydW5sdWR1ciEiO3M6NzoiZXhwaXJlZCI7czo1MzoiU29ydW51biBzw7xyZXNpIGRvbGR1xJ91bmRhbiBhbmtldGkgb3lsYXlhbWF6c8SxbsSxeiEiO3M6NToidHJhc2giO3M6MjU6IlNvcnUgYmHFn2FyxLF5bGEgc2lsaW5kaS4iO3M6MTA6ImZsLXN1Y2Nlc3MiO3M6MzA6IlNvcnUgYmHFn2FyxLF5bGEgdGFraXAgZWRpbGRpLiI7czo2OiJmbC1vd24iO3M6MzM6IktlbmRpIHNvcnVudXp1IHRha2lwIGVkZW1lenNpbml6ISI7czoxMDoiZmwtYWxyZWFkeSI7czozNjoiQnUgc29ydXl1IMOnb2t0YW4gdGFraXAgZWRpeW9yc3VudXohIjtzOjk6ImZsLWRlbGV0ZSI7czozNDoiU29ydXl1IHRha2lwIGV0bWV5aSBixLFyYWt0xLFuxLF6LiI7fX1zOjg6InBhc3N3b3JkIjthOjY6e3M6NToidGl0bGUiO3M6MjI6IsWeaWZyZW5pemkgRGXEn2nFn3RpcmkiO3M6NjoiYnV0dG9uIjtzOjEwOiJEZcSfacWfdGlyIjtzOjc6ImN1cnJlbnQiO2E6Mjp7czo1OiJsYWJlbCI7czoxOToixZ5pbWRpa2kgxZ9pZnJlbml6OiI7czo1OiJwbGFjZSI7czozMDoixZ5pbWRpa2kgxZ9pZnJlbml6aSB5YXrEsW7EsXouIjt9czozOiJuZXciO2E6Mjp7czo1OiJsYWJlbCI7czoxNToiWWVuaSDFnmlmcmVuaXo6IjtzOjU6InBsYWNlIjtzOjI2OiJZZW5pIMWfaWZyZW5pemkgeWF6xLFuxLF6LiI7fXM6NToicmVuZXciO2E6Mjp7czo1OiJsYWJlbCI7czoyMjoiWWVuaSDFn2lmcmVuaXotdGVrcmFyOiI7czo1OiJwbGFjZSI7czozNjoiWWVuaSDFn2lmcmVuaXppIHRla3JhcmRhbiB5YXrEsW7EsXouIjt9czo1OiJhbGVydCI7YTo0OntzOjg6InJlcXVpcmVkIjtzOjI0OiJUw7xtIGFsYW5sYXIgem9ydW5sdWR1ciEiO3M6Mzoib2xkIjtzOjI4OiLFnmltZGlraSDFn2lmcmVuaXogeWFubMSxxZ8hIjtzOjU6Im1hdGNoIjtzOjM3OiJZZW5pIMWfaWZyZW5peiB0ZWtyYXIgaWxlIHV5dcWfbXV5b3IhIjtzOjc6InN1Y2Nlc3MiO3M6Mzk6IsWeaWZyZW5pemkgYmHFn2FyxLF5bGEgZGXEn2nFn3RpcmRpbml6LiI7fX1zOjg6InJlZ2lzdGVyIjthOjEzOntzOjU6InRpdGxlIjtzOjEyOiJZZW5pIMOceWVsaWsiO3M6ODoiZmFjZWJvb2siO3M6MjM6IkZhY2Vib29rIGlsZSBHaXJpxZ8gWWFwIjtzOjc6InR3aXR0ZXIiO3M6MjI6IlR3aXR0ZXIgaWxlIEdpcmnFnyBZYXAiO3M6NjoiZ29vZ2xlIjtzOjIxOiJHb29nbGUgaWxlIEdpcmnFnyBZYXAiO3M6ODoidXNlcm5hbWUiO2E6NDp7czo1OiJsYWJlbCI7czoxNzoiS3VsbGFuxLFjxLEgQWTEsToiO3M6NToicGxhY2UiO3M6MzI6Imt1bGxhbsSxY8SxIGFkxLFuxLF6xLEgeWF6xLFuxLF6IjtzOjE6InAiO3M6NjE6Ikt1bGxhbsSxY8SxIGFkxLFuxLF6IDMgaWxlIDE1IGthcmFrdGVyIGFyYXPEsW5kYSBvbG1hbMSxZMSxci4iO3M6MToidyI7czo1OToiS3VsbGFuxLFjxLEgYWTEsW7EsXpkYSBzZW1ib2wgdmV5YSBzYXnEsSBrdWxsYW5hbWF6c8SxbsSxei4iO31zOjg6InBhc3N3b3JkIjthOjM6e3M6NToibGFiZWwiO3M6NjoixZ5pZnJlIjtzOjU6InBsYWNlIjtzOjIwOiLFn2lmcmVuaXppIHlhesSxbsSxeiI7czoxOiJwIjtzOjQ3OiLFnmlmcmVuaXogbWluaW11bSA2IGthcmFrdGVyZGVuIG9sdcWfbWFsxLFkxLFyLiI7fXM6MTE6InJlLXBhc3N3b3JkIjthOjM6e3M6NToibGFiZWwiO3M6MTQ6IsWeaWZyZS10ZWtyYXI6IjtzOjU6InBsYWNlIjtzOjMwOiLFn2lmcmVuaXppIHRla3JhcmRhbiB5YXrEsW7EsXoiO3M6MToicCI7czo0OToixZ5pZnJlIHRla3JhcsSxbsSxeiDFn2lmcmVuaXogaWxlIGXFn2xlxZ9tZWxpZGlyLiI7fXM6NToiZW1haWwiO2E6Mzp7czo1OiJsYWJlbCI7czo4OiJFLXBvc3RhOiI7czo1OiJwbGFjZSI7czoyODoiZS1wb3N0YSBhZHJlc2luaXppIHlhesSxbsSxeiI7czoxOiJwIjtzOjQ2OiJMw7x0ZmVuIGdlw6dlcmxpIGJpciBlLXBvc3RhIGFkcmVzaSB5YXrEsW7EsXouIjt9czo1OiJiaXJ0aCI7YTo0OntzOjU6ImxhYmVsIjtzOjEzOiJEb8SfdW0gVGFyaWhpIjtzOjM6ImRheSI7czozOiJHw7wiO3M6NToibW9udGgiO3M6MjoiQXkiO3M6NDoieWVhciI7czo0OiJZxLFsIjt9czo2OiJnZW5kZXIiO2E6Mzp7czo1OiJsYWJlbCI7czo4OiJDaW5zaXlldCI7czo0OiJtYWxlIjtzOjU6IkVya2VrIjtzOjY6ImZlbWFsZSI7czo1OiJLYWTEsSI7fXM6NzoiYWRkcmVzcyI7YTo0OntzOjU6ImxhYmVsIjtzOjU6IkFkcmVzIjtzOjc6ImNvdW50cnkiO3M6NToiw5xsa2UiO3M6NDoiY2l0eSI7czo2OiLFnmVoaXIiO3M6NToic3RhdGUiO3M6NjoiRXlhbGV0Ijt9czo2OiJidXR0b24iO3M6NjoiS2F5ZG9sIjtzOjU6ImFsZXJ0IjthOjEzOntzOjg6InJlcXVpcmVkIjtzOjM1OiIqIGlsZSBpxZ9hcmV0bGkgYWxhbmxhZHIgem9ydW5sZHVyISI7czoxMzoiY2hhcl91c2VybmFtZSI7czo1NDoiS3VsbGFuxLFjxLEgYWTEsW7EsXogc2FkZWNlIGhhcmZsZXJkZW4gb2x1xZ9tYWzEsWTEsXIhIjtzOjE2OiJsaW1pdGVkX3VzZXJuYW1lIjtzOjYxOiJLdWxsYW7EsWPEsSBhZMSxbsSxeiAzIGlsZSAxNSBrYXJha3RlciBhcmFzxLFuZGEgb2xtYWzEsWTEsXIhIjtzOjE0OiJleGlzdF91c2VybmFtZSI7czozNjoiS3VsbGFuxLFjxLEgYWTEsSDDp29rdGFuIGFsxLFubcSxxZ8hIjtzOjEyOiJsaW1pdGVkX3Bhc3MiO3M6NTE6IsWeaWZyZW5peiA2IGlsZSAxMiBrYXJha3RlciBhcmFzxLFuZGEgb2xtYWzEsWTEsXIuISI7czo2OiJyZXBhc3MiO3M6NDk6IsWeaWZyZSB0ZWtyYXLEsW7EsXogxZ9pZnJlbml6IGlsZSBlxZ9sZcWfbWVsaWRpciEiO3M6MTE6ImNoZWNrX2VtYWlsIjtzOjQ0OiJMw7x0ZmVuIGdlw6dlcmxpIGJpciBlLXBvc3RhIGFkcmVzaSBnaXJpbml6ISI7czoxMToiZXhpc3RfZW1haWwiO3M6NDg6IllhemTEscSfxLFuxLF6IGUtcG9zdGEgYWRyZXNpIMOnb2t0YW4ga2F5xLF0bMSxISI7czo1OiJiaXJ0aCI7czozOToiRG/En3VtIHRhcmloaW5peiAxLTEtMjAwNSBhbmQgMS0xLTE5NDIhIjtzOjc6InN1Y2Nlc3MiO3M6NjM6IkJhxZ9hcsSxeWxhIMO8eWUgb2xkdW51eiwga2V5aWZsaSB2YWtpdCBnZcOnaXJtZW5peiBkaWxlxJ9peWxlISI7czo4OiJzdWNjZXNzMSI7czo5OToiQmHFn2FyxLF5bGEgw7x5ZSBvbGR1bnV6IGZha2F0IMO8eWVsacSfaW5pemluIGFrdGlmbGXFn3RpcmlsbWVzaSBpw6dpbiB5w7ZuZXRpY2kgb25hecSxIGdlcmVrbGlkaXIuIjtzOjg6InN1Y2Nlc3MyIjtzOjk3OiJCYcWfYXLEsXlsYSDDvHllIG9sZHVudXogZmFrYXQgw7x5ZWxpxJ9pbml6aW4gYWt0aWZsZcWfdGlyaWxtZXNpIGnDp2luIGUtcG9zdGEgb25hecSxIGdlcmVrbGlkaXIuIjtzOjU6ImVycm9yIjtzOjU2OiJTZcOndGnEn2luaXoga3VsbGFuxLFjxLEgYWTEsSB2ZXlhIMWfaWZyZSBrdWxsYW7EsWxhbWF6ISI7fX1zOjY6InJlcG9ydCI7YTo1OntzOjU6InRpdGxlIjtzOjE0OiJTb3J1IMWfaWtheWV0aSI7czo2OiJzZWxlY3QiO2E6Mjp7czo1OiJsYWJlbCI7czo5OiJCdSBuZWRpcj8iO3M6NjoidmFsdWVzIjthOjM6e2k6MTtzOjE5OiJUZWtyYXJsYW5txLHFnyBzb3J1IjtpOjI7czoxMToiw4dvayBrw7Z0w7wiO2k6MztzOjE2OiJVeWd1bnN1eiBpw6dlcmlrIjt9fXM6ODoidGV4dGFyZWEiO2E6Mjp7czo1OiJsYWJlbCI7czo3OiJCYcWfa2E/IjtzOjU6InBsYWNlIjtzOjc6IkJhxZ9rYT8iO31zOjY6ImJ1dHRvbiI7czo3OiJHw7ZuZGVyIjtzOjU6ImFsZXJ0IjthOjM6e3M6ODoicmVxdWlyZWQiO3M6MzU6IiogaWxlIGnFn2FyZXRsaSBhbGFubGFyIHpvcnVubHVkdXIhIjtzOjc6InN1Y2Nlc3MiO3M6MzA6IlJhcG9yIGJhxZ9hcsSxeWxhIGfDtm5kZXJpbGRpLiI7czo1OiJlcnJvciI7czoxNDoiQmlyIHNvcnVuIHZhciEiO319czo3OiJzaWRlYmFyIjthOjQ6e3M6OToicXVlc3Rpb25zIjthOjQ6e3M6NToidGl0bGUiO3M6NjoiU29ydXN1IjtzOjM6ImRheSI7czo2OiJHw7xuw7wiO3M6NToibW9udGgiO3M6NDoiQXnEsSI7czo0OiJ5ZWFyIjtzOjY6IlnEsWzEsSI7fXM6MTA6ImNhdGVnb3JpZXMiO3M6MjA6IlBvcMO8bGVyIEthdGVnb3JpbGVyIjtzOjY6InNvY2lhbCI7czoxMjoiU29zeWFsIE1lZHlhIjtzOjY6ImZvbGxvdyI7YTo2OntzOjU6InRpdGxlIjtzOjMwOiJUYWtpcCBFZGViaWxlY2XEn2luaXogS2nFn2lsZXIiO3M6NDoiZGVzYyI7czowOiIiO3M6NToidm90ZXMiO3M6NToiT3lsYXIiO3M6OToicXVlc3Rpb25zIjtzOjc6IlNvcnVsYXIiO3M6OToiZm9sbG93ZXJzIjtzOjExOiJUYWtpcMOnaWxlciI7czo2OiJ0YWdnZWQiO3M6OToiRXRpa2V0bGVyIjt9fXM6NDoidm90ZSI7YTozOntzOjY6ImZvbGxvdyI7czoxNToiU29ydXl1IFRha2lwIEV0IjtzOjQ6InN0ZXAiO3M6MjE6IkJpciBhZMSxbSBkYWhhIGthbGTEsSI7czo1OiJhbGVydCI7YTo0OntzOjc6ImFscmVhZHkiO3M6NjM6IkRhbmEgw7ZuY2Ugb3lsYWTEscSfxLFuxLF6IGJpciBzb3J1IGnDp2luIG95IGt1bGxhbmFtYXpzxLFuxLF6ISI7czo3OiJleHBpcmVkIjtzOjY0OiJCdSBzb3J1IGnDp2luIG95bGFtYSBzb25hIGVyZGkhIEJ1IHNlYmVwbGUgb3kga3VsbGFuYW1henPEsW7EsXohIjtzOjc6InN1Y2Nlc3MiO3M6MzE6Ik95dW51eiBiYcWfYXLEsXlsYSBrYXlkZWRpbGRpIS4iO3M6NToiZXJyb3IiO3M6NDM6Ikt1bGxhbsSxY8SxIGFkxLEgdmV5YSDFn2lmcmUga3VsbGFuxLFsYW1heiEiO319czo2OiJhbGVydHMiO2E6Nzp7czo3OiJuby1kYXRhIjtzOjQ3OiJWZXJpdGFiYW7EsW5kYSBoZXJoYW5naSBiaXIga2F5xLF0IGJ1bHVuYW1hZMSxISI7czoxMDoicGVybWlzc2lvbiI7czozOToiQnUgc2F5ZmF5YSBlcmnFn21layBpw6dpbiB5ZXRraW5peiB5b2shIjtzOjU6Indyb25nIjtzOjE0OiJCaXIgc29ydW4gdmFyISI7czo2OiJkYW5nZXIiO3M6MTQ6IkJpciBzb3J1biB2YXIhIjtzOjc6InN1Y2Nlc3MiO3M6MTA6IlRlYnJpa2xlciEiO3M6Nzoid2FybmluZyI7czo3OiJVeWFyxLEhIjtzOjQ6ImluZm8iO3M6NDoiSGV5ISI7fX0=', 0, 0);
		INSERT INTO `pl_lang` (`id`, `fullname`, `shortname`, `flag`, `lang_default`, `created_at`, `updated_at`, `content`, `trash`, `sort`) VALUES
		(3, 'English (en-US)', 'us', 'us', 1, 1587320513, 1587496547, 'YToyNDp7czozOiJydGwiO3M6MToiMCI7czo0OiJsYW5nIjtzOjI6ImVuIjtzOjU6ImNsb3NlIjtzOjU6IkNsb3NlIjtzOjc6ImxvYWRpbmciO3M6MTA6IkxvYWRpbmcuLi4iO3M6ODoidmVyaWZpZWQiO3M6MTU6IlZlcmlmaWVkIGFjb3VudCI7czo1OiJhZG1pbiI7czo1OiJBZG1pbiI7czo4OiJ0aW1lZGF0ZSI7YTo5OntzOjExOiJ0aW1lX3NlY29uZCI7czo2OiJzZWNvbmQiO3M6MTE6InRpbWVfbWludXRlIjtzOjY6Im1pbnV0ZSI7czo5OiJ0aW1lX2hvdXIiO3M6NDoiaG91ciI7czo4OiJ0aW1lX2RheSI7czozOiJkYXkiO3M6OToidGltZV93ZWVrIjtzOjQ6IndlZWsiO3M6MTA6InRpbWVfbW9udGgiO3M6NToibW9udGgiO3M6OToidGltZV95ZWFyIjtzOjQ6InllYXIiO3M6MTE6InRpbWVfZGVjYWRlIjtzOjY6ImRlY2FkZSI7czo4OiJ0aW1lX2FnbyI7czozOiJhZ28iO31zOjM6ImFzayI7YToxMTp7czo5OiJhc2tfdGl0bGUiO3M6MTg6IkFzayBhIG5ldyBxdWVzdGlvbiI7czoxMDoiZWRpdF90aXRsZSI7czoxMzoiRWRpdCBxdWVzdGlvbiI7czo4OiJtdWx0aXBsZSI7czoxNDoiTXVsdGlwbGUgdm90ZXMiO3M6NjoicGlubmVkIjtzOjE1OiJQaW5uZWQgUXVlc3Rpb24iO3M6ODoicXVlc3Rpb24iO2E6Mzp7czo1OiJsYWJlbCI7czoxNDoiWW91ciBRdWVzdGlvbjoiO3M6NToicGxhY2UiO3M6MTg6IkZpbGwgeW91ciBxdWVzdGlvbiI7czoxOiJwIjtzOjUwOiJObyBIVE1MIGFsbG93ZWQuIEludmFsaWQgcXVlc3Rpb24gd2lsbCBiZSBpZ25vcmVkLiI7fXM6NDoidHlwZSI7YTo3OntzOjU6ImxhYmVsIjtzOjE3OiJUeXBlIG9mIHF1ZXN0aW9uOiI7czo2OiJub3JtYWwiO2E6MTp7czo1OiJsYWJlbCI7czoxNToiTm9ybWFsIFF1ZXN0aW9uIjt9czo1OiJ5ZXNubyI7YTozOntzOjU6ImxhYmVsIjtzOjE1OiJZZXMvTm8gUXVlc3Rpb24iO3M6MzoieWVzIjtzOjM6IlllcyI7czoyOiJubyI7czoyOiJObyI7fXM6NjoiaW1hZ2VzIjthOjM6e3M6NToibGFiZWwiO3M6MTE6IndpdGggSW1hZ2VzIjtzOjU6InBsYWNlIjtzOjE1OiJBbnN3ZXJzJyBJbWFnZToiO3M6Njoic2VsZWN0IjtzOjE1OiJTZWxlY3QgYW4gaW1hZ2UiO31zOjU6InBsYWNlIjtzOjIxOiJUeXBlIGhlcmUgeW91ciBhbnN3ZXIiO3M6NzoiYW5zd2VycyI7czo4OiJBbnN3ZXJzOiI7czozOiJhZGQiO3M6OToiQWRkIEZpZWxkIjt9czo4OiJjYXRlZ29yeSI7YToyOntzOjU6ImxhYmVsIjtzOjk6IkNhdGVnb3J5OiI7czo1OiJwbGFjZSI7czoxNzoiU2VsZWN0IGEgY2F0ZWdvcnkiO31zOjM6ImVuZCI7YToyOntzOjU6ImxhYmVsIjtzOjEyOiJFbmRpbmcgZGF0ZToiO3M6NToicGxhY2UiO3M6MjI6IlNlbGVjdCB0aGUgZW5kaW5nIGRhdGUiO31zOjU6InRodW1iIjthOjM6e3M6NToibGFiZWwiO3M6MTA6IlRodW1ibmFpbDoiO3M6NToicGxhY2UiO3M6MTU6IlNlbGVjdCBhbiBpbWFnZSI7czoxOiJwIjtzOjUwOiJObyBIVE1MIGFsbG93ZWQuIEludmFsaWQgcXVlc3Rpb24gd2lsbCBiZSBpZ25vcmVkLiI7fXM6NjoiYnV0dG9uIjtzOjY6IlN1Ym1pdCI7czo1OiJhbGVydCI7YTo2OntzOjg6InJlcXVpcmVkIjtzOjM4OiJBbGwgZmllbGRzIG1hcmtlZCB3aXRoICogYXJlIHJlcXVpcmVkISI7czo0OiJtb3JlIjtzOjI2OiJBbnN3ZXJzIGNvdW50IG1vcmUgdGhhbiA4ISI7czo0OiJsZXNzIjtzOjI2OiJBbnN3ZXJzIGNvdW50IGxlc3MgdGhhbiAyISI7czo2OiJpbWFnZXMiO3M6MjM6IkFsbCBhbnN3ZXJzIG5lZWQgaW1hZ2VzIjtzOjc6InN1Y2Nlc3MiO3M6NDQ6IlF1ZXN0aW9uIGFzayBwcm9jZXNzIGhhcyBlbmRlZCBzdWNjZXNzZnVsbHkuIjtzOjQ6ImVkaXQiO3M6NDU6IlF1ZXN0aW9uIGVkaXQgcHJvY2VzcyBoYXMgZW5kZWQgc3VjY2Vzc2Z1bGx5LiI7fX1zOjc6ImRldGFpbHMiO2E6OTp7czo1OiJ0aXRsZSI7czoxMjoiRWRpdCBEZXRhaWxzIjtzOjU6ImZpcnN0IjthOjI6e3M6NToibGFiZWwiO3M6MTE6IkZpcnN0IE5hbWU6IjtzOjU6InBsYWNlIjtzOjIwOiJ0eXBlIHlvdXIgZmlyc3QgbmFtZSI7fXM6NDoibGFzdCI7YToyOntzOjU6ImxhYmVsIjtzOjEwOiJMYXN0IE5hbWU6IjtzOjU6InBsYWNlIjtzOjIxOiJ0eXBlIHlvdXIgZmFtaWx5IG5hbWUiO31zOjQ6ImRlc2MiO2E6Mjp7czo1OiJsYWJlbCI7czoxMjoiRGVzY3JpcHRpb246IjtzOjU6InBsYWNlIjtzOjQwOiJXcml0ZSBhIHNtYWxsIGRlc2NyaXB0aW9uIGFib3V0IHlvdXJzZWxmIjt9czo1OiJwaG90byI7YToyOntzOjU6ImxhYmVsIjtzOjE0OiJQcm9maWxlIFBob3RvOiI7czo1OiJwbGFjZSI7czoxNToiU2VsZWN0IGFuIGltYWdlIjt9czo1OiJjb3ZlciI7YToyOntzOjU6ImxhYmVsIjtzOjEyOiJDb3ZlciBQaG90bzoiO3M6NToicGxhY2UiO3M6MTU6IlNlbGVjdCBhbiBpbWFnZSI7fXM6Nzoic29jaWFscyI7czoxMzoiU29jaWFsIG1lZGlhOiI7czo2OiJidXR0b24iO3M6NjoiU3VibWl0IjtzOjU6ImFsZXJ0IjthOjM6e3M6ODoicmVxdWlyZWQiO3M6Mzg6IkFsbCBmaWVsZHMgbWFya2VkIHdpdGggKiBhcmUgcmVxdWlyZWQhIjtzOjQ6ImRlc2MiO3M6NDE6IkRlc2NyaXB0aW9uIG11c3QgYmUgbGVzcyB0aGFuIDUwIGxldHRlcnMhIjtzOjc6InN1Y2Nlc3MiO3M6NDQ6IkVkaXQgZGV0YWlscyBwcm9jZXNzIGhhcyBlbmRlZCBzdWNjZXNzZnVsbHkuIjt9fXM6NjoiZm9vdGVyIjthOjM6e3M6NToibGlua3MiO3M6NToiTGlua3MiO3M6OToic3Vic2NyaWJlIjthOjU6e3M6NToidGl0bGUiO3M6OToiU3Vic2NyaWJlIjtzOjE6InAiO3M6NjQ6IlN1YnNjcmliZSB0byByZWNlaXZlIGluc3BpcmF0aW9uLCBpZGVhcywgYW5kIG5ld3MgaW4geW91ciBpbmJveC4iO3M6NToicGxhY2UiO3M6MTg6IllvdXIgRW1haWwgQWRkcmVzcyI7czo2OiJidXR0b24iO3M6OToiU3Vic2NyaWJlIjtzOjU6ImFsZXJ0IjthOjM6e3M6NToiZXhpc3QiO3M6Mjg6InlvdSBoYXZlIGFscmVhZHkgc3Vic2NyaWJlZCEiO3M6NToiZW1haWwiO3M6Mjg6IlBsZWFzZSBpbnB1dCBhIHZhbGlkIGUtbWFpbCEiO3M6Nzoic3VjY2VzcyI7czozMjoiU3Vic2NyaWJlIGNvbXBsZXRlIHN1Y2Nlc3NmdWxseS4iO319czoxMDoic3RhdGlzdGljcyI7YTo2OntzOjU6InRpdGxlIjtzOjEwOiJTdGF0aXN0aWNzIjtzOjU6InVzZXJzIjtzOjE2OiJ7Y291bnR9IE1lbWJlcnMuIjtzOjk6InF1ZXN0aW9ucyI7czoxODoie2NvdW50fSBRdWVzdGlvbnMuIjtzOjU6InZvdGVzIjtzOjE0OiJ7Y291bnR9IFZvdGVzLiI7czo4OiJjb21tZW50cyI7czoxNzoie2NvdW50fSBDb21tZW50cy4iO3M6NzoiYW5zd2VycyI7czoxNjoie2NvdW50fSBBbnN3ZXJzLiI7fX1zOjY6ImZvcmdldCI7YTo1OntzOjU6InRpdGxlIjtzOjE4OiJGb3Jnb3R0ZW4gYWNjb3VudD8iO3M6NToiZW1haWwiO3M6MjY6InR5cGUgeW91ciB1c2VybmFtZSBvciBlbWlsIjtzOjY6ImJ1dHRvbiI7czo1OiJSZXNldCI7czo1OiJhbGVydCI7YTo0OntzOjg6InJlcXVpcmVkIjtzOjM4OiJBbGwgZmllbGRzIG1hcmtlZCB3aXRoICogYXJlIHJlcXVpcmVkISI7czo1OiJlbWFpbCI7czo1ODoiUGxlYXNlIGlucHV0IHlvdXIgdXNlcm5hbWUgb3IgZW1haWwgdGhhdCB5b3Ugc2lnbiB1cCB3aXRoISI7czo3OiJzdWNjZXNzIjtzOjYwOiJXZSBoYXZlIHNlbnQgeW91IGFuIGVtYWlsIHRoYXQgaGF2ZSB5b3UgcmVzZXQgcGFzc3dvcmQgbGluay4iO3M6NToiZXJyb3IiO3M6NjE6IkVycm9yIHdoaWxlIHNlbmRpbmcgeW91IGFuIGVtYWlsLCBwbGVhc2UgdHJ5IGluIGFub3RoZXIgdGltZSEiO31zOjQ6Im1haWwiO2E6Mjp7czo1OiJ0aXRsZSI7czoxOToiUmVzZXQgeW91ciBwYXNzd29yZCI7czo3OiJjb250ZW50IjtzOjA6IiI7fX1zOjY6ImhlYWRlciI7YToxNTp7czo2OiJzZWFyY2giO3M6MzY6ImRvIHlvdSB3YW50IHRvIHNlYXJjaCBmb3Igc29tZXRoaW5nPyI7czozOiJhc2siO3M6MTQ6IkFzayBhIFF1ZXN0aW9uIjtzOjc6InByb2ZpbGUiO3M6MTA6Ik15IHByb2ZpbGUiO3M6OToicXVlc3Rpb25zIjtzOjE2OiJNYW5hZ2UgUXVlc3Rpb25zIjtzOjI6ImNwIjtzOjY6IkNwYW5lbCI7czo3OiJkZXRhaWxzIjtzOjEyOiJFZGl0IERldGFpbHMiO3M6ODoicGFzc3dvcmQiO3M6MTU6IkNoYW5nZSBQYXNzd29yZCI7czo3OiJjcmVkaXRzIjtzOjc6IkNyZWRpdHMiO3M6NjoibG9nb3V0IjtzOjY6IkxvZ291dCI7czo3OiJjb25maXJtIjtzOjI2OiJBcmUgc3VyZSB5b3Ugd2FubmEgbG9nb3V0PyI7czo2OiJub3RpY2UiO3M6ODg6IlBsZWFzZSwgbm90aWNlIHRoYXQ6IGRvIG5vdCBmb3JnZXQgdG8gY29tcGxldGUgeW91ciBpbmZvcm1hdGlvbnMgc3BlY2lhbHkgeW91ciBwYXNzd29yZC4iO3M6NDoibm90eSI7YTo3OntzOjU6InRpdGxlIjtzOjEzOiJOb3RpZmljYXRpb25zIjtzOjQ6InJlYWQiO3M6ODoiUmVhZCBBbGwiO3M6NDoibW9yZSI7czoyMzoiU2hvdyBtb3JlIG5vdGlmaWNhdGlvbnMiO3M6MzoidGFnIjtzOjE0OiJ0YWcgaGltc2VsZiBpbiI7czo0OiJ2b3RlIjtzOjExOiJhZGQgdm90ZSB0byI7czo3OiJjb21tZW50IjtzOjE0OiJhZGQgY29tbWVudCB0byI7czo2OiJmb2xsb3ciO3M6MjA6InN0YXJ0IGZvbGxvd2luZyB5b3UuIjt9czoyOiJpbiI7czo3OiJTaWduIEluIjtzOjI6InVwIjtzOjc6IlNpZ24gVXAiO3M6NDoibWVudSI7YTo2OntzOjQ6ImhvbWUiO3M6NDoiSG9tZSI7czo1OiJmcmVzaCI7czoxNToiRnJlc2ggUXVlc3Rpb25zIjtzOjc6InBvcHVsYXIiO3M6MTc6IlBvcHVsYXIgUXVlc3Rpb25zIjtzOjc6Im1lbWJlcnMiO3M6NzoiTWVtYmVycyI7czoxMDoiY2F0ZWdvcmllcyI7czoxMDoiQ2F0ZWdvcmllcyI7czo4OiJmb2xsb3dlZCI7czoxODoiRm9sbG93ZWQgUXVlc3Rpb25zIjt9fXM6NToibG9naW4iO2E6MTA6e3M6NToidGl0bGUiO3M6NToiTG9naW4iO3M6ODoiZmFjZWJvb2siO3M6MjE6IlNpZ24gaW4gd2l0aCBGYWNlYm9vayI7czo3OiJ0d2l0dGVyIjtzOjIwOiJTaWduIGluIHdpdGggVHdpdHRlciI7czo2OiJnb29nbGUiO3M6MTk6IlNpZ24gaW4gd2l0aCBHb29nbGUiO3M6ODoidXNlcm5hbWUiO3M6Mjc6InR5cGUgeW91ciB1c2VybmFtZSBvciBlbWFpbCI7czo4OiJwYXNzd29yZCI7czoxODoidHlwZSB5b3VyIHBhc3N3b3JkIjtzOjQ6ImtlZXAiO3M6MTc6IktlZXAgbWUgbG9nZ2VkIGluIjtzOjY6ImZvcmdldCI7czoxODoiRm9yZ290dGVuIGFjY291bnQ/IjtzOjY6ImJ1dHRvbiI7czo3OiJTaWduIEluIjtzOjU6ImFsZXJ0IjthOjc6e3M6ODoicmVxdWlyZWQiO3M6MzY6IllvdSBsZWZ0IHVzZXJuYW1lIG9yIHBhc3N3b3JkIGVtcHR5ISI7czo3OiJtb2RlcmF0IjtzOjk4OiJNZW1iZXJzaGlwIGhhcyBiZWVuIGJhbm5lZCBieSBhZG1pbiwgaWYgeW91IHRoaW5rIHRoaXMgaXMgYSBtaXN0YWsgcGxlYXNlIGZlZWwgZnJlZSB0byBjb250YWN0IHVzLiI7czoxMDoiYWN0aXZhdGlvbiI7czozMzoiTWVtYmVyc2hpcCBuZWVkIGVtYWlsIGFjdGl2YXRpb24uIjtzOjc6ImFwcHJvdmUiO3M6NDk6Ik1lbWJlcnNoaXAgbmVlZCB0byBiZSBhcHByb3ZlZCBieSBhZG1pbmlzdHJhdGlvbi4iO3M6Nzoic3VjY2VzcyI7czo2MjoiWW91IGFyZSBsb2dnZWQgaW4gc3VjY2Vzc2Z1bGx5LCBXZSB3aXNoIHlvdSBoYXZpbmcgZ29vZCB0aW1lcy4iO3M6Njoic29jaWFsIjtzOjEzMzoiVGhlcmUgaXMgYSBwcm9ibGVtIHdpdGggeW91ciBzb2NpYWwgSUQsIHRoZSB1c2VybmFtZSB5b3Ugd2FudCB0byBsb2dpbiB3aXRoIGlzIG5vdCB5b3VycyBvciBhbHJlYWR5IGV4aXN0IHdpdGggYSBkaWZmZXJlbnQgc29jaWFsIElEISI7czo1OiJlcnJvciI7czozODoiVXNlcm5hbWUgb3IgcGFzc3dvcmQgaXMgbm90IGF2YWlsYWJsZSEiO319czo3OiJtZW1iZXJzIjthOjE3OntzOjk6ImZvbGxvd2luZyI7czo5OiJGb2xsb3dpbmciO3M6OToiZm9sbG93ZXJzIjtzOjk6IkZvbGxvd2VycyI7czo5OiJxdWVzdGlvbnMiO3M6OToiUXVlc3Rpb25zIjtzOjE0OiJtb3JlLXF1ZXN0aW9ucyI7czoxNDoiVXNlciBRdWVzdGlvbnMiO3M6NToidm90ZXMiO3M6NToiVm90ZXMiO3M6ODoiY29tbWVudHMiO3M6ODoiQ29tbWVudHMiO3M6NDoidGFncyI7czo0OiJUYWdzIjtzOjY6ImZvbGxvdyI7czo2OiJGb2xsb3ciO3M6ODoidW5mb2xsb3ciO3M6ODoiVW5mb2xsb3ciO3M6MTI6InByLWZvbGxvd2VycyI7czoxNzoiVXNlcidzIEZvbGxvd2VyczoiO3M6MTI6InByLWZvbGxvd2luZyI7czoxNzoiVXNlcidzIEZvbGxvd2luZzoiO3M6MTE6InByLW1vcmUtZmxyIjtzOjE0OiJtb3JlIGZvbGxvd2VycyI7czoxMToicHItbW9yZS1mbG4iO3M6MTQ6Im1vcmUgZm9sbG93aW5nIjtzOjk6InBnLWZvbGxvdyI7czo3OiJNZW1iZXI6IjtzOjEyOiJwZy1mb2xsb3dlcnMiO3M6MTA6IkZvbGxvd2VyczoiO3M6MTI6InBnLWZvbGxvd2luZyI7czoxMDoiRm9sbG93aW5nOiI7czo1OiJhbGVydCI7YTo0OntzOjEwOiJmbC1zdWNjZXNzIjtzOjMxOiJVc2VyIGhhcyBmb2xsb3dlZCBzdWNjZXNzZnVsbHkuIjtzOjY6ImZsLW93biI7czoyODoiWW91IGNhbiBub3QgZm9sbG93IHlvdXJzZWxmISI7czoxMDoiZmwtYWxyZWFkeSI7czozNjoiWW91IGhhdmUgYWxyZWFkeSBmb2xsb3dlZCB0aGlzIHVzZXIhIjtzOjk6ImZsLWRlbGV0ZSI7czozOToiVXNlciBoYXMgYmVpbmcgdW5mb2xsb3dlZCBzdWNjZXNzZnVsbHkuIjt9fXM6OToicXVlc3Rpb25zIjthOjIyOntzOjY6ImZvbGxvdyI7czoxNToiRm9sbG93IFF1ZXN0aW9uIjtzOjg6InVuZm9sbG93IjtzOjE3OiJVbmZvbGxvdyBRdWVzdGlvbiI7czo2OiJyZXBvcnQiO3M6MTU6IlJlcG9ydCBRdWVzdGlvbiI7czo0OiJlZGl0IjtzOjQ6IkVkaXQiO3M6NjoiZGVsZXRlIjtzOjY6IkRlbGV0ZSI7czoyOiJieSI7czo5OiJCeSB7dXNlcn0iO3M6NToidm90ZXMiO3M6NToidm90ZXMiO3M6NDoidGFncyI7czo0OiJ0YWdzIjtzOjc6InJlcGxpZXMiO3M6NzoicmVwbGllcyI7czoxMzoibW9yZS1jb21tZW50cyI7czoxODoiVmlldyBtb3JlIGNvbW1lbnRzIjtzOjEzOiJwbGFjZS1jb21tZW50IjtzOjIyOiJXcml0ZSBhIG5ldyBjb21tZW50Li4uIjtzOjEyOiJzZW5kLWNvbW1lbnQiO3M6MTI6IlNlbmQgY29tbWVudCI7czo2OiJjYW5jZWwiO3M6NjoiQ2FuY2VsIjtzOjY6Im5vdXNlciI7czo0MToie3NpZ251cH0gb3Ige3NpZ25pbn0gaW4gb3JkZXIgdG8gY29tbWVudC4iO3M6Mzoibm93IjtzOjg6Ikp1c3QgTm93IjtzOjY6InBnLWFsbCI7czo4OiJTaG93IEFsbCI7czo5OiJwZy12b3RlcnMiO3M6NzoiVm90ZXJzOiI7czo4OiJwZy12b3RlcyI7czo2OiJWb3RlczoiO3M6MTA6InBnLXZvdGVzLXEiO3M6OToiUXVlc3Rpb246IjtzOjg6InBnLXRhZ2VzIjtzOjU6IlRhZ3M6IjtzOjU6InNoYXJlIjthOjU6e3M6NToidGl0bGUiO3M6NToiU2hhcmUiO3M6MjoiZmIiO3M6MTk6IlNoYXJlIHdpdGggRmFjZWJvb2siO3M6MjoidHciO3M6MTg6IlNoYXJlIHdpdGggVHdpdHRlciI7czoyOiJncCI7czoxODoiU2hhcmUgd2l0aCBHb29nbGUrIjtzOjY6ImlmcmFtZSI7czo1OiJFbWJlZCI7fXM6NToiYWxlcnQiO2E6Nzp7czozOiJhbGwiO3M6MjQ6IkFsbCBmaWVsZHMgYXJlIHJlcXVpcmVkISI7czo3OiJleHBpcmVkIjtzOjYxOiJZb3UgY2FuIG5vdCBhZGQgYSB2b3RlIGZvciB0aGlzIHBvbGwgYmVjYXVzZSBpdCBpcyBleHBpcmVkIGluIjtzOjU6InRyYXNoIjtzOjQxOiJRdWVzdGlvbiBoYXMgbW92ZWQgdG8gdHJhc2ggc3VjY2Vzc2Z1bGx5LiI7czoxMDoiZmwtc3VjY2VzcyI7czozNToiUXVlc3Rpb24gaGFzIGZvbGxvd2VkIHN1Y2Nlc3NmdWxseS4iO3M6NjoiZmwtb3duIjtzOjM4OiJZb3UgY2FuIG5vdCBmb2xsb3cgeW91ciBvd24gcXVlc3Rpb25zISI7czoxMDoiZmwtYWxyZWFkeSI7czo0MDoiWW91IGhhdmUgYWxyZWFkeSBmb2xsb3dlZCB0aGlzIHF1ZXN0aW9uISI7czo5OiJmbC1kZWxldGUiO3M6NDM6IlF1ZXN0aW9uIGhhcyBiZWluZyB1bmZvbGxvd2VkIHN1Y2Nlc3NmdWxseS4iO319czo4OiJwYXNzd29yZCI7YTo2OntzOjU6InRpdGxlIjtzOjE1OiJDaGFuZ2UgUGFzc3dvcmQiO3M6NjoiYnV0dG9uIjtzOjY6IlN1Ym1pdCI7czo3OiJjdXJyZW50IjthOjI6e3M6NToibGFiZWwiO3M6MTc6IkN1cnJlbnQgUGFzc3dvcmQ6IjtzOjU6InBsYWNlIjtzOjMyOiJUeXBlIGhlcmUgeW91ciBjdXJyZW50IFBhc3N3b3JkLiI7fXM6MzoibmV3IjthOjI6e3M6NToibGFiZWwiO3M6MTM6Ik5ldyBQYXNzd29yZDoiO3M6NToicGxhY2UiO3M6Mjg6IlR5cGUgaGVyZSB5b3VyIG5ldyBQYXNzd29yZC4iO31zOjU6InJlbmV3IjthOjI6e3M6NToibGFiZWwiO3M6MjE6IlJlLXR5cGUgbmV3IFBhc3N3b3JkOiI7czo1OiJwbGFjZSI7czozNDoiVHlwZSBoZXJlIGFnYWluIHlvdXIgbmV3IFBhc3N3b3JkLiI7fXM6NToiYWxlcnQiO2E6NDp7czo4OiJyZXF1aXJlZCI7czoyNDoiQWxsIGZpZWxkcyBhcmUgcmVxdWlyZWQhIjtzOjM6Im9sZCI7czozNDoiWW91IGN1cnJlbnQgcGFzc3dvcmQgaXMgaW5jb3JyZWN0ISI7czo1OiJtYXRjaCI7czo0MjoiTmV3IHBhc3N3b3JkIGRvc24ndCBtYXRjaCB3aXRoIHRoZSByZXBlYXQhIjtzOjc6InN1Y2Nlc3MiO3M6MzM6IlBhc3N3b3JkIGhhcyBlZGl0ZWQgc3VjY2Vzc2Z1bGx5LiI7fX1zOjg6InJlZ2lzdGVyIjthOjEzOntzOjU6InRpdGxlIjtzOjE4OiJDcmVhdGUgbmV3IGFjY291bnQiO3M6ODoiZmFjZWJvb2siO3M6MjE6IlNpZ24gdXAgd2l0aCBGYWNlYm9vayI7czo3OiJ0d2l0dGVyIjtzOjIwOiJTaWduIHVwIHdpdGggVHdpdHRlciI7czo2OiJnb29nbGUiO3M6MTk6IlNpZ24gdXAgd2l0aCBHb29nbGUiO3M6ODoidXNlcm5hbWUiO2E6NDp7czo1OiJsYWJlbCI7czo5OiJVc2VybmFtZToiO3M6NToicGxhY2UiO3M6MTg6InR5cGUgeW91ciB1c2VybmFtZSI7czoxOiJwIjtzOjUyOiJUaGUgVXNlcm5hbWUgaXMgbXVzdCBiZSBiZXR3ZWVuIDMgYW5kIDE1IGNoYXJhY3RlcnMuIjtzOjE6InciO3M6NjI6IkRvZXMgbm90IGFsbG93IHRoZSB1c2Ugb2Ygc3ltYm9scyBhbmQgbnVtYmVycyBpbiB0aGUgVXNlcm5hbWUuIjt9czo4OiJwYXNzd29yZCI7YTozOntzOjU6ImxhYmVsIjtzOjk6IlBhc3N3b3JkOiI7czo1OiJwbGFjZSI7czoxODoidHlwZSB5b3VyIHBhc3N3b3JkIjtzOjE6InAiO3M6NDI6IlBhc3N3b3JkIGlzIE11c3QgYmUgYXQgbGVhc3QgNiBjaGFyYWN0ZXJzLiI7fXM6MTE6InJlLXBhc3N3b3JkIjthOjM6e3M6NToibGFiZWwiO3M6MTI6IlJlLVBhc3N3b3JkOiI7czo1OiJwbGFjZSI7czoyMToidHlwZSB5b3VyIHJlLXBhc3N3b3JkIjtzOjE6InAiO3M6NDQ6IlJlLXBhc3N3b3JkIGlzIE11c3QgbWF0Y2ggd2l0aCB0aGUgcGFzc3dvcmQuIjt9czo1OiJlbWFpbCI7YTozOntzOjU6ImxhYmVsIjtzOjY6IkVtYWlsOiI7czo1OiJwbGFjZSI7czoyMzoidHlwZSB5b3VyIGVtYWlsIGFkZHJlc3MiO3M6MToicCI7czozNjoiUGxlYXNlIGVudGVyIGEgdmFsaWRlIGVtYWlsIGFkZHJlc3MuIjt9czo1OiJiaXJ0aCI7YTo0OntzOjU6ImxhYmVsIjtzOjEwOiJCaXJ0aCBEYXRlIjtzOjM6ImRheSI7czozOiJEYXkiO3M6NToibW9udGgiO3M6NToiTW9udGgiO3M6NDoieWVhciI7czo0OiJZZWFyIjt9czo2OiJnZW5kZXIiO2E6Mzp7czo1OiJsYWJlbCI7czo2OiJHZW5kZXIiO3M6NDoibWFsZSI7czo0OiJNYWxlIjtzOjY6ImZlbWFsZSI7czo2OiJGZW1hbGUiO31zOjc6ImFkZHJlc3MiO2E6NDp7czo1OiJsYWJlbCI7czo3OiJBZGRyZXNzIjtzOjc6ImNvdW50cnkiO3M6NzoiQ291bnRyeSI7czo0OiJjaXR5IjtzOjQ6IkNpdHkiO3M6NToic3RhdGUiO3M6NToiU3RhdGUiO31zOjY6ImJ1dHRvbiI7czo2OiJTdWJtaXQiO3M6NToiYWxlcnQiO2E6MTM6e3M6ODoicmVxdWlyZWQiO3M6Mzg6IkFsbCBmaWVsZHMgbWFya2VkIHdpdGggKiBhcmUgcmVxdWlyZWQhIjtzOjEzOiJjaGFyX3VzZXJuYW1lIjtzOjM5OiJUaGUgdXNlcm5hbWUgbXVzdCBjb250YWluIG9ubHkgbGV0dGVycyEiO3M6MTY6ImxpbWl0ZWRfdXNlcm5hbWUiO3M6NTc6IlRoZSBVc2VybmFtZSBtdXN0IGJlIGxpbWl0ZWQgYmV0d2VlbiAzIGFuZCAxNSBjaGFyYWN0ZXJzISI7czoxNDoiZXhpc3RfdXNlcm5hbWUiO3M6Mjc6IlVzZXJuYW1lIGlzIGFscmVhZHkgZXhpc3RzISI7czoxMjoibGltaXRlZF9wYXNzIjtzOjU3OiJUaGUgUGFzc3dvcmQgbXVzdCBiZSBsaW1pdGVkIGJldHdlZW4gNiBhbmQgMTIgY2hhcmFjdGVycyEiO3M6NjoicmVwYXNzIjtzOjQ0OiJSZS1wYXNzd29yZCBpcyBNdXN0IG1hdGNoIHdpdGggdGhlIHBhc3N3b3JkISI7czoxMToiY2hlY2tfZW1haWwiO3M6Mjg6IlBsZWFzZSBpbnB1dCBhIHZhbGlkIGUtbWFpbCEiO3M6MTE6ImV4aXN0X2VtYWlsIjtzOjMzOiJFLW1haWwgQWRkcmVzcyBpcyBhbHJlYWR5IGV4aXN0cyEiO3M6NToiYmlydGgiO3M6NTc6IllvdXIgYmlydGggZGF0ZSBuZWVkIHRvIGJlIGJldHdlZW4gMS0xLTIwMDUgYW5kIDEtMS0xOTQyISI7czo3OiJzdWNjZXNzIjtzOjQ0OiJSZWdpc3RyYXRpb24gcHJvY2VzcyBoYXMgZW5kZWQgc3VjY2Vzc2Z1bGx5LiI7czo4OiJzdWNjZXNzMSI7czo4ODoiUmVnaXN0cmF0aW9uIHByb2Nlc3MgaGFzIGVuZGVkIHN1Y2Nlc3NmdWxseS4gQnV0LCBzdGlsbCBuZWVkIGFwcHJvdmVkIGJ5IGFkbWluaXN0cmF0aW9uLiI7czo4OiJzdWNjZXNzMiI7czo3OToiUmVnaXN0cmF0aW9uIHByb2Nlc3MgaGFzIGVuZGVkIHN1Y2Nlc3NmdWxseS4gQnV0LCBzdGlsbCBuZWVkIGFjdGl2YXRlIGJ5IGVtYWlsLiI7czo1OiJlcnJvciI7czozODoiVXNlcm5hbWUgb3IgcGFzc3dvcmQgaXMgbm90IGF2YWlsYWJsZSEiO319czo2OiJyZXBvcnQiO2E6NTp7czo1OiJ0aXRsZSI7czoyODoiUmVwb3J0aW5nIGZvciBhIGJhZCBxdWVzdGlvbiI7czo2OiJzZWxlY3QiO2E6Mjp7czo1OiJsYWJlbCI7czoxMzoiV2hhdCBpcyB0aGlzPyI7czo2OiJ2YWx1ZXMiO2E6Mzp7aToxO3M6MTc6IlJlcGVhdGVkIHF1ZXN0aW9uIjtpOjI7czo4OiJWZXJ5IGJhZCI7aTozO3M6MjE6IkluYXBwcm9wcmlhdGUgY29udGVudCI7fX1zOjg6InRleHRhcmVhIjthOjI6e3M6NToibGFiZWwiO3M6MTU6IlNvbWV0aGluZyBlbHNlPyI7czo1OiJwbGFjZSI7czoxNToiU29tZXRoaW5nIGVsc2U/Ijt9czo2OiJidXR0b24iO3M6NDoiU2VuZCI7czo1OiJhbGVydCI7YTozOntzOjg6InJlcXVpcmVkIjtzOjM3OiJBbGwgZmllbGQgbWFya2VkIHdpdGggKiBhcmUgcmVxdWlyZWQhIjtzOjc6InN1Y2Nlc3MiO3M6Mjk6IlJlcG9ydCBoYXMgc2VuZCBzdWNjZXNzZnVsbHkuIjtzOjU6ImVycm9yIjtzOjIxOiJTb21ldGhpbmcgd2VudCB3cm9uZyEiO319czo3OiJzaWRlYmFyIjthOjQ6e3M6OToicXVlc3Rpb25zIjthOjQ6e3M6NToidGl0bGUiO3M6MTY6IlF1ZXN0aW9ucyBvZiB0aGUiO3M6MzoiZGF5IjtzOjM6IkRheSI7czo1OiJtb250aCI7czo1OiJNb250aCI7czo0OiJ5ZWFyIjtzOjQ6IlllYXIiO31zOjEwOiJjYXRlZ29yaWVzIjtzOjE4OiJQb3B1bGFyIGNhdGVnb3JpZXMiO3M6Njoic29jaWFsIjtzOjEyOiJTb2NpYWwgbWVkaWEiO3M6NjoiZm9sbG93IjthOjY6e3M6NToidGl0bGUiO3M6MjQ6IlBlb3BsZSB5b3Ugc2hvdWxkIGZvbGxvdyI7czo0OiJkZXNjIjtzOjE3OiJTbWFsbCBEZXNjcmlwdGlvbiI7czo1OiJ2b3RlcyI7czo1OiJWb3RlcyI7czo5OiJxdWVzdGlvbnMiO3M6OToiUXVlc3Rpb25zIjtzOjk6ImZvbGxvd2VycyI7czo5OiJGb2xsb3dlcnMiO3M6NjoidGFnZ2VkIjtzOjY6IlRhZ2dlZCI7fX1zOjQ6InZvdGUiO2E6Mzp7czo2OiJmb2xsb3ciO3M6MTU6IkZvbGxvdyBRdWVzdGlvbiI7czo0OiJzdGVwIjtzOjI5OiJPbmUgbGFzdCBzdGVwIG5lZWQgdG8gYmUgZG9uZSI7czo1OiJhbGVydCI7YTo0OntzOjc6ImFscmVhZHkiO3M6NTc6IllvdSBjYW4gbm90IHNlbmQgYSB2b3RlIGZvciBhIHF1ZXN0aW9uIGFscmVhZHkgdm90ZWQgZm9yISI7czo3OiJleHBpcmVkIjtzOjU5OiJZb3UgY2FuIG5vdCBhZGQgYSB2b3RlIGZvciB0aGlzIHBvbGwgYmVjYXVzZSBpdCBpcyBleHBpcmVkISI7czo3OiJzdWNjZXNzIjtzOjMyOiJZb3VyIHZvdHRlIGlzIHNlbnQgc3VjY2Vzc2Z1bGx5LiI7czo1OiJlcnJvciI7czozODoiVXNlcm5hbWUgb3IgcGFzc3dvcmQgaXMgbm90IGF2YWlsYWJsZSEiO319czo2OiJhbGVydHMiO2E6OTp7czo3OiJuby1kYXRhIjtzOjMwOiJObyBkYXRhIGZvdW5kIGluIG91ciBkYXRhYmFzZSEiO3M6NDoicGxhbiI7czo4NDoiWW91IGRvbid0IGhhdmUgcGVybWlzc2lvbiBmb3IgYWNjZXNzaW5nIHRvIHRoaXMgcGFnZSwgeW91IG5lZWQgdG8gdXBncmFkZSB5b3VyIHBsYW4hIjtzOjg6InBsYW52b3RlIjtzOjg5OiJZb3UgY2FudCB2b3RlIGZvciB0aGlzIHVzZXIgcXVlc3Rpb24gYmVjYXVzZSBoZSBoYXMgcmVhY2ggdG8gdGhlIG1heGltdW0gdm90ZXMgcGVyIG1vbnRoISI7czoxMDoicGVybWlzc2lvbiI7czo1MDoiWW91IGhhdmUgbm8gcGVybWlzc2lvbiBmb3IgYWNjZXNzaW5nIHRvIHRoaXMgcGFnZSEiO3M6NToid3JvbmciO3M6MjE6IlNvbWV0aGluZyB3ZW50IHdyb25nISI7czo2OiJkYW5nZXIiO3M6ODoiT2ggc25hcCEiO3M6Nzoic3VjY2VzcyI7czoxMDoiV2VsbCBkb25lISI7czo3OiJ3YXJuaW5nIjtzOjg6Ildhcm5pbmchIjtzOjQ6ImluZm8iO3M6OToiSGVhZHMgdXAhIjt9czo1OiJwbGFucyI7YTo1OntzOjU6InRpdGxlIjtzOjI4OiJTaW1wbGUgUHJpY2luZyBmb3IgRXZlcnlvbmUhIjtzOjQ6ImRlc2MiO3M6MTE4OiJQcmljaW5nIGJ1aWx0IGZvciBidWlzZW5lc3NlcyBvZiBhbGwgc2l6ZXMuIEFsd2F5cyBrbm93IHdoYXQgeW91J2xsIHBheS4gQWxsIHBsYW5zIGNvbXNlIHdpdGggMTAwJSBtb25leSBiYWNrIGd1YXJhbmUuIjtzOjU6Im1vbnRoIjtzOjEwOiIvcGVyIG1vbnRoIjtzOjM6ImJ0biI7czoxMToiR2V0IFN0YXJ0ZWQiO3M6NToiYWxlcnQiO2E6Mjp7czo3OiJzdWNjZXNzIjtzOjM0OiJZb3VyIHBheW1lbnRzIGhhcyBiZWVuIGNhbGN1bGF0ZWQhIjtzOjc6Indhcm5pbmciO3M6MzM6IllvdXIgYWxyZWFkeSBwYWlkIGZvciB0aGlzIG1vbnRoISI7fX1zOjEwOiJzdGF0aXN0aWNzIjthOjE0OntzOjU6InRpdGxlIjtzOjEwOiJTdGF0aXN0aWNzIjtzOjk6ImJ5YW5zd2VycyI7czoyMDoiU3RhdGlzdGljcyBieSBBbnN3ZXIiO3M6ODoiYnlnZW5kZXIiO3M6MjA6IlN0YXRpc3RpY3MgYnkgR2VuZGVyIjtzOjU6ImJ5YWdlIjtzOjE3OiJTdGF0aXN0aWNzIGJ5IEFnZSI7czoxMDoiYnlsb2NhdGlvbiI7czoyMjoiU3RhdGlzdGljcyBieSBMb2NhdGlvbiI7czo0OiJsaXN0IjtzOjE0OiJMaXN0IG9mIFZvdGVycyI7czo5OiJub2NvdW50cnkiO3M6MTA6Ik5vIENvdW50cnkiO3M6NzoidmlzaXRvciI7czo3OiJ2aXNpdG9yIjtzOjg6InVzZXJuYW1lIjtzOjg6IlVzZXJuYW1lIjtzOjEwOiJ2b3RpbmdkYXRlIjtzOjExOiJWb3RpbmcgRGF0ZSI7czozOiJhZ2UiO3M6MzoiQWdlIjtzOjY6ImdlbmRlciI7czo2OiJHZW5kZXIiO3M6MzoiYnRuIjtzOjEyOiJEb3dubG9hZCBQREYiO3M6NToiYWxlcnQiO2E6Mjp7czo3OiJzdWNjZXNzIjtzOjM0OiJZb3VyIHBheW1lbnRzIGhhcyBiZWVuIGNhbGN1bGF0ZWQhIjtzOjc6Indhcm5pbmciO3M6MzM6IllvdXIgYWxyZWFkeSBwYWlkIGZvciB0aGlzIG1vbnRoISI7fX1zOjY6InBheW91dCI7YToxMzp7czo1OiJ0aXRsZSI7czo2OiJQYXlvdXQiO3M6Njoic3RpdGxlIjtzOjE3OiJZb3VyIENyZWRpdHMge2NjfSI7czo2OiJwb2ludHMiO3M6NjoicG9pbnRzIjtzOjc6ImNyZWRpdHMiO3M6NzoiQ3JlZGl0cyI7czoyOiJjcCI7czoxNToiSG93IG11Y2ggcG9pbnRzIjtzOjU6ImVtYWlsIjtzOjU6IkVtYWlsIjtzOjI6ImVwIjtzOjEwOiJZb3VyIEVtYWlsIjtzOjQ6Im5lZWQiO3M6NDc6IllvdSBuZWVkIHRvIHJlYWNoIHRvIHtjY30sIHRvIG1ha2UgYSB3aXRoZHJhd24uIjtzOjM6ImJ0biI7czo0OiJTZW5kIjtzOjU6InByaWNlIjtzOjU6IlByaWNlIjtzOjY6InN0YXR1cyI7czo2OiJTdGF0dXMiO3M6NzoiY3JlYXRlZCI7czoxMDoiQ3JlYXRlZCBhdCI7czo1OiJhbGVydCI7YToyOntzOjc6InN1Y2Nlc3MiO3M6MzQ6IllvdXIgcGF5bWVudHMgaGFzIGJlZW4gY2FsY3VsYXRlZCEiO3M6Nzoid2FybmluZyI7czozMzoiWW91ciBhbHJlYWR5IHBhaWQgZm9yIHRoaXMgbW9udGghIjt9fX0=', 0, 0);


		ALTER TABLE `pl_lang`
		  ADD PRIMARY KEY (`id`);

		ALTER TABLE `pl_lang`
		  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



	ALTER TABLE `pl_votes` ADD `device` VARCHAR(200) NULL AFTER `trash`, ADD `os` VARCHAR(200) NULL AFTER `device`, ADD `browser` VARCHAR(200) NULL AFTER `os`, ADD `state` VARCHAR(200) NULL AFTER `browser`;



	ALTER TABLE `pl_users` ADD `token` VARCHAR(255) NULL AFTER `lastpayment`;





	-- Strict mode

	ALTER TABLE `pl_categories` CHANGE `title` `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `icon` `icon` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `bg` `bg` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `sort` `sort` TINYINT(3) UNSIGNED NULL DEFAULT '0', CHANGE `questions` `questions` MEDIUMINT(8) UNSIGNED NULL DEFAULT '0', CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `keywords` `keywords` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;


	ALTER TABLE `pl_answers` CHANGE `question` `question` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `answer` `answer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `thumbnail` `thumbnail` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0';


	ALTER TABLE `pl_comments` CHANGE `author` `author` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `question` `question` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `date` `date` INT(11) NULL, CHANGE `content` `content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `votes` `votes` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `updated_at` `updated_at` INT(10) UNSIGNED NULL, CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `moderat` `moderat` TINYINT(1) UNSIGNED NULL DEFAULT '0';


	ALTER TABLE `pl_followers` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, CHANGE `user` `user` INT(10) UNSIGNED NULL, CHANGE `author` `author` INT(10) UNSIGNED NULL, CHANGE `date` `date` INT(10) UNSIGNED NULL;


	ALTER TABLE `pl_notifications` CHANGE `date` `date` INT(10) UNSIGNED NULL, CHANGE `author` `author` MEDIUMINT(8) UNSIGNED NULL DEFAULT '0', CHANGE `user` `user` MEDIUMINT(8) UNSIGNED NULL DEFAULT '0', CHANGE `status` `status` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `ntype` `ntype` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `nid` `nid` MEDIUMINT(8) UNSIGNED NULL DEFAULT '0';


	ALTER TABLE `pl_pages` CHANGE `title` `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `sort` `sort` TINYINT(2) UNSIGNED NULL DEFAULT '0', CHANGE `content` `content` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `date` `date` INT(10) UNSIGNED NULL, CHANGE `lastupdate` `lastupdate` INT(10) UNSIGNED NULL, CHANGE `keywords` `keywords` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `description` `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;


	ALTER TABLE `pl_payments` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, CHANGE `plan` `plan` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `txn_id` `txn_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `price` `price` FLOAT(10,2) NULL, CHANGE `currency` `currency` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `status` `status` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `date` `date` INT(11) NULL DEFAULT '0', CHANGE `author` `author` INT(11) NULL DEFAULT '0';


	ALTER TABLE `pl_questions` CHANGE `question` `question` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `keywords` `keywords` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `date` `date` INT(11) NULL, CHANGE `author` `author` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `status` `status` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `hideresults` `hideresults` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `multiple` `multiple` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `end_date` `end_date` INT(11) NULL, CHANGE `thumbnail` `thumbnail` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `polltype` `polltype` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `category` `category` TINYINT(3) UNSIGNED NULL DEFAULT '0', CHANGE `statistics` `statistics` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `votes` `votes` SMALLINT(5) UNSIGNED NULL DEFAULT '0', CHANGE `updated_at` `updated_at` INT(10) UNSIGNED NULL, CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `moderat` `moderat` TINYINT(1) UNSIGNED NULL DEFAULT '0';


	ALTER TABLE `pl_reports` CHANGE `type` `type` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `tid` `tid` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `title` `title` TINYINT(1) NULL, CHANGE `status` `status` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `content` `content` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `author` `author` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `date` `date` INT(10) UNSIGNED NULL, CHANGE `reply` `reply` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `rauthor` `rauthor` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `rdate` `rdate` INT(10) UNSIGNED NULL DEFAULT '0', CHANGE `trash` `trash` TINYINT(1) NULL DEFAULT '0';


	ALTER TABLE `pl_resets` CHANGE `email` `email` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `date` `date` INT(10) UNSIGNED NULL, CHANGE `ip` `ip` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `status` `status` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `token` `token` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;


	ALTER TABLE `pl_subscribers` CHANGE `email` `email` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `date` `date` INT(10) UNSIGNED NULL, CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0';


	ALTER TABLE `pl_users` CHANGE `firstname` `firstname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `lastname` `lastname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `username` `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `password` `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `photo` `photo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `cover` `cover` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `date` `date` INT(11) NULL, CHANGE `level` `level` TINYINT(1) UNSIGNED NULL DEFAULT '1', CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `socials` `socials` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `social_id` `social_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `social_name` `social_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `sex` `sex` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `address` `address` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `birth` `birth` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `statistics` `statistics` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `moderat` `moderat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `verified` `verified` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `credits` `credits` MEDIUMINT(9) UNSIGNED NULL DEFAULT '0', CHANGE `description` `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `language` `language` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `updated_at` `updated_at` INT(10) UNSIGNED NULL, CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0';


	ALTER TABLE `pl_votes` CHANGE `question` `question` MEDIUMINT(8) UNSIGNED NULL DEFAULT '0', CHANGE `answer` `answer` MEDIUMINT(10) UNSIGNED NULL DEFAULT '0', CHANGE `author` `author` MEDIUMINT(10) UNSIGNED NULL DEFAULT '0', CHANGE `ip` `ip` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `date` `date` INT(10) UNSIGNED NULL, CHANGE `sex` `sex` TINYINT(1) UNSIGNED NULL DEFAULT '0', CHANGE `address` `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `birth` `birth` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `age` `age` TINYINT(2) UNSIGNED NULL DEFAULT '0', CHANGE `country` `country` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `city` `city` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `trash` `trash` TINYINT(1) UNSIGNED NULL DEFAULT '0';
