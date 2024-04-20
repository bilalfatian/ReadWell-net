-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 04:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `language` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `book_path` varchar(255) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `average_rating` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `user_id`, `title`, `content`, `language`, `cover_image`, `book_path`, `approved`, `hidden`, `views`, `average_rating`, `created_at`, `updated_at`) VALUES
(14, 1, 'Time', 'this is just a test', 'English', '439Lxqgw04nmAxyxSnssK2wlrckX9iWVy0PTfasF.webp', '', 1, 1, 0, 0.00, '2023-06-12 10:02:52', '2024-04-19 12:26:29'),
(16, 1, 'The Wicked King', '\"The Wicked King\" is the second installment in Holly Black\'s captivating fantasy series, \"The Folk of the Air.\" Set in the treacherous and enchanting world of Faerie, it follows the cunning mortal Jude Duarte as she navigates a perilous game of power and politics. With alliances shifting and betrayal lurking around every corner, Jude must outmaneuver the deceitful Prince Cardan and navigate the dangerous court of the High King. Filled with twists, intrigue, and forbidden romance, \"The Wicked King\" delves deeper into the dark and enchanting realm of Faerie, leaving readers eagerly anticipating what comes next.', 'English', 'DSeBYnPyleR2PNP6XPU2E2qxpcsdxwZjnXL2u9v0.jpg', 'PoS7rR3UDQ8p8N7ksr6DkBditGxZec5Ilk9ViVHi.pdf', 1, 1, 0, 0.00, '2024-04-19 12:58:05', '2024-04-19 12:58:05'),
(17, 9, 'Alone', '\"Alone\" is a gripping survival thriller that follows the harrowing journey of Sarah, a young woman who finds herself stranded in the wilderness after a tragic accident leaves her isolated from civilization. With only her wits and instincts to rely on, Sarah must confront the unforgiving elements and the haunting specter of her past as she fights for her survival. As days turn into weeks, Sarah\'s resilience is put to the ultimate test, forcing her to confront her deepest fears and darkest secrets. \"Alone\" is a heart-pounding tale of resilience, redemption, and the indomitable human spirit in the face of unimaginable adversity.', 'English', 'NfwUpZWRSvZITpesSKGyTp98MGW5oL7H6AyIINyl.webp', '', 1, 1, 0, 0.00, '2024-04-19 13:00:14', '2024-04-19 22:02:59'),
(18, 1, 'Soule', '\"Soule\" is a mesmerizing debut novel by Olivia Wilson, weaving a spellbinding tale of love, loss, and the timeless quest for identity. Set against the backdrop of a quaint New England town, the story follows the enigmatic protagonist, Emily Soule, as she grapples with the sudden disappearance of her twin sister, Anna. Haunted by cryptic dreams and inexplicable visions, Emily embarks on a soul-stirring journey to unravel the mystery surrounding her sister\'s vanishing act. Along the way, she encounters a cast of eccentric characters and uncovers long-buried family secrets that threaten to shatter everything she thought she knew about herself and her lineage. Blending elements of magical realism with poignant introspection, \"Soule\" is a poignant exploration of sisterhood, self-discovery, and the enduring power of love across time and space.', 'English', 'k8XgplWThuOZPFLMRpWaxkDUsK5MAEDSECkP2EIM.jpg', '', 1, 1, 0, 0.00, '2024-04-19 13:06:13', '2024-04-19 13:06:13'),
(19, 9, 'Balle Fatale', '\"Balle Fatale\" is a dazzling novel that transports readers to the glamorous and intrigue-filled world of competitive ballroom dancing. Written by acclaimed author, Samantha Michaels, the story follows the talented yet conflicted dancer, Ava Reynolds, as she strives to overcome personal demons and pursue her dreams of championship glory. Set against the backdrop of glittering ballrooms and fierce competition, Ava must navigate the treacherous waters of love, rivalry, and self-discovery. With each graceful step and dramatic turn, she learns that the path to victory is paved with sacrifice, determination, and unwavering passion. \"Ball Fatale\" is a captivating tale of ambition, romance, and the transformative power of dance, sure to enchant readers with its blend of heart-pounding excitement and timeless elegance.', 'French', 'e64mJ5BIYPsX0BwPRW16ihQ9VWXdWznmXQJ5yWSm.png', '', 1, 1, 0, 0.00, '2024-04-19 13:07:49', '2024-04-19 13:07:58'),
(20, 1, 'La Roue Du Temps', '\"La Roue du Temps\" est une épopée envoûtante qui transporte les lecteurs dans un monde de magie, d\'aventure et de destinée. Écrite par l\'auteur acclamé Robert Jordan, cette saga épique commence avec \"L\'Œil du Monde\" et s\'étend sur une série de romans captivants. L\'histoire se déroule dans un univers riche en détails, où le temps est représenté comme une roue infinie tissant les fils du destin. Au cœur de cette saga se trouve le protagoniste Rand al\'Thor, un jeune homme ordinaire dont le destin est étroitement lié à la prophétie du Dragon Réincarné, celui qui est destiné à changer le monde ou à le détruire.\r\n\r\nAlors que Rand et ses compagnons entreprennent un voyage périlleux à travers des contrées dangereuses, ils rencontrent une myriade de personnages fascinants, des intrigues politiques complexes et des forces mystérieuses qui cherchent à contrôler le sort du monde. Avec ses thèmes de courage, de sacrifice et de lutte contre les ténèbres, \"La Roue du Temps\" captive les lecteurs avec son intrigue épique et son monde magnifiquement détaillé. C\'est une œuvre magistrale qui transporte les lecteurs dans un voyage inoubliable à travers les âges, où le destin des nations repose entre les mains de héros improbables.', 'French', 'DIRy9d96NSLJCaOrouBQ3wEVVbiZ18BRvjRZDLlH.jpg', '', 1, 1, 0, 0.00, '2024-04-19 13:10:25', '2024-04-19 13:10:25'),
(21, 1, 'Our last summer', 'this is just a test', 'English', 'hUiKNaQCIc0RFaECdH1UeSW7OrYqFYYwxV1trSwO.webp', '', 1, 1, 0, 0.00, '2024-04-19 13:16:03', '2024-04-19 13:16:03'),
(22, 1, 'sword', 'this is just a test', 'English', 'fwrWna37gChJB0dfqyFlJPydDt2a4qj3Y29R2PVq.webp', '', 1, 1, 0, 0.00, '2024-04-19 13:16:21', '2024-04-19 13:16:21'),
(23, 1, 'the killer poison', 'this is just a test', 'Afrikaans', 'RGUveg0yGFBIJCMotfk5dKE1KTxL3IumMzoHPYJw.jpg', '', 1, 1, 0, 0.00, '2024-04-19 13:16:45', '2024-04-19 13:16:45'),
(24, 9, 'memory', 'this is just a test', 'English', 'pIXRZOqeLYHlP6aoHNyHlTNbBM5qGgjglywwwNNO.jpg', '', 1, 1, 0, 0.00, '2024-04-19 13:17:04', '2024-04-19 18:45:08'),
(25, 9, 'french Evolution', 'this is just a test', 'Afrikaans', 'TvSB34CPnv6Aiwnl0GRkBoBZvWcWujYoANFKd16t.jpg', '', 1, 1, 0, 0.00, '2024-04-19 13:17:41', '2024-04-19 13:18:39'),
(26, 9, 'Million to one', 'this is just a test', 'Afrikaans', 'm51WxoF49ZJOV3sq9vTOj1owTyQzMTZRflZlUeJr.webp', '', 1, 1, 0, 0.00, '2024-04-19 13:20:35', '2024-04-19 13:20:44'),
(27, 9, 'Don\'t look back', 'this is a good book', 'English', 't7ulmet46VJCBONHXXL8AdXs8AQKpF2XLiOd5lL5.png', 'JkkZvYu0cqtgEvKNBqiAz2rz8fiz0RUXK10KscYp.pdf', 1, 1, 0, 0.00, '2024-04-19 22:04:08', '2024-04-19 22:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_rating`
--

CREATE TABLE `book_rating` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `book_id`, `content`, `created_at`, `updated_at`) VALUES
(12, 1, 16, 'Just finished this book, and WOW! It\'s like my heart went on an adventure right along with the characters. 💫 Highly recommend diving into this gem!', '2024-04-19 14:03:15', '2024-04-19 14:03:15'),
(13, 9, 16, 'Can\'t stop thinking about this book! It\'s got me feeling all the feels and wishing I could jump right back into its world. 📚💖', '2024-04-19 14:03:44', '2024-04-19 14:03:44'),
(14, 9, 16, 'Took a chance on this book, and let me tell you, it paid off BIG TIME! Couldn\'t put it down for the life of me. Consider me officially obsessed!', '2024-04-19 14:04:05', '2024-04-19 14:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_19_134807_create_books_table', 1),
(6, '2023_05_19_140220_create_categories_table', 1),
(7, '2023_05_19_140701_create_book_category_table', 1),
(8, '2023_05_19_142735_create_comments_table', 1),
(9, '2023_05_19_143025_create_book_rating_table', 1),
(10, '2023_05_19_144221_create_user_book_table', 1),
(11, '2023_05_28_181222_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `user_role` enum('amateur','professional','admin') NOT NULL DEFAULT 'amateur',
  `description` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_picture`, `user_role`, `description`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Élodie', 'bilalfatian@gmail.com', '$2y$10$z9NMUtXIVwLoKcSNk2GW7.olVMyKhaVVXPWunieYnNQ5F.S7HNqAi', '6RWdOaujOiFi4flUuGhRQfStLv2jApmib3zZKley.jpg', 'professional', 'I am Élodie, a lover of words, lost in the labyrinth of stories both written and imagined. With a heart entwined with the ink of countless tales, I navigate through life with a pen as my compass and a book as my map.', '2023-06-03 05:25:39', NULL, '2023-06-02 22:22:28', '2024-04-19 19:22:49'),
(9, 'Bilal', 'radwa@gmail.com', '$2y$10$Z8Lf0NqiEExb5BwckFoBheEzLpFFZgrq1OyFpWIjT1hbVhx2grpHW', 'MibbICnsjXANcc6hYJc5iaEa1FfDk6uzVndymxVQ.jpg', 'amateur', 'I\'m Bilal, a wanderer of words, lost in the poetry of life\'s whispers, and a dreamer weaving tales under the moon\'s gentle gaze.', NULL, NULL, '2023-06-11 23:20:08', '2024-04-19 22:02:09'),
(10, 'Admin', 'admin@gmail.com', '$2y$10$fsRyBPYnz6siFoXIfU7ZLudolDahpSBGe929h8T7EHYwZ9nCxoid.', 'zs4NlFdLyy0pEEnNNdYScD25JBxv5wuzD6Tjxiy0.webp', 'admin', 'I\'m the Admin', NULL, '2024-04-19 22:12:13', '2024-04-19 21:12:13', '2024-04-19 21:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_book`
--

CREATE TABLE `user_book` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `favorite` tinyint(1) NOT NULL DEFAULT 0,
  `saved` tinyint(1) NOT NULL DEFAULT 0,
  `later` tinyint(1) NOT NULL DEFAULT 0,
  `recently_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `progress` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_user_id_foreign` (`user_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_category_book_id_foreign` (`book_id`),
  ADD KEY `book_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `book_rating`
--
ALTER TABLE `book_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_rating_user_id_foreign` (`user_id`),
  ADD KEY `book_rating_book_id_foreign` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_book_id_foreign` (`book_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_book`
--
ALTER TABLE `user_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_book_user_id_foreign` (`user_id`),
  ADD KEY `user_book_book_id_foreign` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_rating`
--
ALTER TABLE `book_rating`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_book`
--
ALTER TABLE `user_book`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_rating`
--
ALTER TABLE `book_rating`
  ADD CONSTRAINT `book_rating_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_rating_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_book`
--
ALTER TABLE `user_book`
  ADD CONSTRAINT `user_book_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_book_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
