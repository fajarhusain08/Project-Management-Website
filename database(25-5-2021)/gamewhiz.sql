-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 07:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamewhiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `manager_id` int(30) NOT NULL,
  `user_ids` text NOT NULL,
  `files` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `manager_id`, `user_ids`, `files`, `date_created`) VALUES
(1, 'Project both', '                                                                        project ini memiliki project member budi dan sari                                                                        ', 0, '2021-06-30', '2021-07-02', 2, '3,4', '', '2021-06-30 07:23:27'),
(2, 'Project Budi', '                                    &lt;p&gt;Projek ini memiliki member hanya budi&lt;/p&gt;                                    ', 3, '2021-06-30', '2021-07-03', 2, '3', '', '2021-06-30 07:24:07'),
(3, 'Projek Sari', '&lt;p&gt;Projek ini hanya memiliki member Sari&lt;/p&gt;', 5, '2021-07-01', '2021-07-08', 2, '4', '', '2021-06-30 07:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `files` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `task`, `description`, `status`, `date_created`, `files`) VALUES
(1, 1, 'Task 1', '                                                          &lt;p&gt;dahjkwkj hsakjdkjawh kdjsahdkjhw&lt;/p&gt;                                                          ', 1, '2021-06-30 07:30:08', ''),
(2, 1, 'Task 2', '&lt;p&gt;adwdsadwjhdjk ajkhdkjwhkd a&amp;nbsp;&lt;/p&gt;', 2, '2021-06-30 07:30:22', ''),
(3, 1, 'task 3', '&lt;p&gt;dawsjhdjka hwdkhdkjsahdw&lt;/p&gt;', 3, '2021-06-30 07:30:33', ''),
(4, 2, 'task 1', '&lt;p&gt;sadwjkhdk jahdkjwjkhd a&lt;/p&gt;', 1, '2021-06-30 07:30:57', ''),
(5, 2, 'task 2', '                                                          &lt;p&gt;dawkdljaslk djlkajldk aldjalkwj dwa&lt;/p&gt;                                                          ', 3, '2021-06-30 07:31:04', ''),
(6, 2, 'task 3', '&lt;p&gt;wadm,ndakmdklawh kjdhawjkhd jkahdjklahwkld&lt;/p&gt;', 3, '2021-06-30 07:31:13', ''),
(7, 3, 'Task 1', '&lt;p&gt;adwjhdjai djkh da&lt;/p&gt;', 3, '2021-06-30 07:31:53', ''),
(8, 3, 'Task 2', '&lt;p&gt;ajdkhajkw dkjlahdkjhawkjd AJkdhlA KJdh&lt;/p&gt;', 3, '2021-06-30 07:32:01', ''),
(9, 3, 'Task 3', '&lt;p&gt;adhajkhdkjah dkajhkdjl ahwjdhakjhdw&amp;nbsp;&lt;/p&gt;', 3, '2021-06-30 07:32:09', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Administrator', 'admin@admin.com', 'default.jpg', '$2y$10$Nkc0x9GAvIeMA3lRQuPcZO/4/d147Jb1JwVONoLfcO/xCdAjO5/S2', 1, 0, 1624700854),
(2, 'Terawan Dharma', 'terawan@manager.com', 'default.jpg', '$2y$10$L3ZOdu4bh3hfqF3xio9RN.d.Tvbih0fPYwPrBfbLl75viiVOfw4k.', 2, 0, 1624708389),
(3, 'Budi Setiawan', 'budi@member.com', 'default.jpg', '$2y$10$0Mg7XP7ovpFSuR.2YWIb5uNvt4QWesf2BpVBWa4tvauPw5.4BE0bm', 3, 0, 1624700945),
(4, 'Sari Indramayu', 'sari@member.com', 'default.jpg', '$2y$10$0tI/eq4AoLMLi0wEl60CcepX2x58WJDy16DkVXrkJnEI4WgfAHLf.', 3, 0, 1624701000),
(5, 'Tiwi Ramadhani', 'tiwi@pembina.com', 'default.jpg', '$2y$10$zJqi5jVZDc08XMpGneLDOOrnqBMDgOgTYzHY9gpcPVnr1/Aqa1Bpq', 4, 0, 1624701077),
(16, 'Megawati uWu', 'mega@manager.com', 'default.jpg', '$2y$10$9ttvrQgpkq.6aNsOY7598OQNXYQEG/qHDP4w5CvbA4WwMY5Y8zui.', 2, 0, 1625016057);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(9, 1, 3),
(11, 2, 3),
(12, 1, 4),
(15, 3, 2),
(16, 3, 3),
(19, 4, 2),
(20, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Project'),
(3, 'User'),
(4, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_productivity`
--

CREATE TABLE `user_productivity` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `date_created` datetime NOT NULL,
  `files` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_productivity`
--

INSERT INTO `user_productivity` (`id`, `project_id`, `task_id`, `comment`, `subject`, `date`, `start_time`, `end_time`, `user_id`, `time_rendered`, `date_created`, `files`) VALUES
(1, 1, 1, '&lt;ul&gt;&lt;li&gt;                                         Tugas 1&lt;/li&gt;&lt;li&gt;Tugas 2&lt;/li&gt;&lt;/ul&gt;', 'Tugas yang harus dijalankan', '2021-06-30', '07:33:00', '19:33:00', 1, 12, '0000-00-00 00:00:00', ''),
(2, 1, 2, 'dawjhkjdha kjhdwkjdkawj', 'awhdjgjak dkahkdjw djaw', '2021-07-01', '07:33:00', '19:33:00', 1, 12, '0000-00-00 00:00:00', ''),
(3, 1, 3, 'awdnjkasnkd bwjkhdawk', 'djkwakdj jkwdhkjaahdasakajaahadaawaaaaa', '2021-06-30', '07:33:00', '19:33:00', 1, 12, '0000-00-00 00:00:00', ''),
(4, 1, 1, 'Mantap Pak', 'Saya setuju', '2021-06-30', '08:04:00', '20:04:00', 2, 12, '0000-00-00 00:00:00', ''),
(5, 1, 1, 'Saya telah mengerjakan Tugas 1 hari ini', 'Tugas 1 Clear', '2021-06-30', '08:06:00', '20:06:00', 3, 12, '0000-00-00 00:00:00', ''),
(6, 1, 1, 'Saya telah menyelesaikan Tugas 2 hari ini', 'Tugas 2 Clear', '2021-06-30', '08:07:00', '20:07:00', 4, 12, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Member'),
(4, 'Pembina');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 2, 'Dashboard', 'project/dashboard', 'fas fa-tachometer-alt', 1),
(2, 3, 'Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 3, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 4, 'Menu Management', 'menu', 'far fa-fw fa-window-maximize', 1),
(5, 4, 'Submenu Management', 'menu/submenu', 'far fa-fw fa-window-restore', 1),
(8, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(9, 3, 'Change Password', 'user/changepassword', 'fas fa-fw fa-lock', 1),
(13, 1, 'User Management', 'admin/usermanagement', 'fas fa-fw fa-users', 1),
(18, 2, 'Projects', 'project', 'fas fa-fw fa-clipboard', 1),
(27, 2, 'Tasks', 'tasks', 'fas fa-fw fa-tasks', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_productivity`
--
ALTER TABLE `user_productivity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_productivity`
--
ALTER TABLE `user_productivity`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
