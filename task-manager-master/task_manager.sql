SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `tbl_list`
--

CREATE TABLE `tbl_list` (
  `list_id` int(10) UNSIGNED NOT NULL,
  `list_name` varchar(50) NOT NULL,
  `list_description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_list`
--

INSERT INTO `tbl_list` (`list_id`, `list_name`, `list_description`) VALUES
(1, 'To Do', '                         All the tasks that must be done soon.                     '),
(2, 'Doing', '                            All the Tasks that are currently being done.                      '),
(3, 'Done', 'All the Tasks that are completed                       '),
(7, 'Shopping', 'Tasks for Shopping');

-- --------------------------------------------------------

--
-- Table structure for table `tal_tasks`
--

CREATE TABLE `tal_tasks` (
  `task_id` int(10) UNSIGNED NOT NULL,
  `task_name` varchar(150) NOT NULL,
  `task_description` text NOT NULL,
  `list_id` int(11) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tal_tasks`
--

INSERT INTO `tal_tasks` (`task_id`, `task_name`, `task_description`, `list_id`, `priority`, `deadline`) VALUES
(2, 'icon Design', '                        This is urgent                         ', 1, 'High', '2020-06-03'),
(3, 'Buy Things', 'Okay Buy                      ', 3, 'Medium', '2020-06-12'),
(4, 'Web Page Design', 'All the Tasks for Web Page Design', 1, 'Medium', '2020-06-11'),
(5, 'Application Development', 'All the tasks', 1, 'Low', '2020-07-03'),
(6, 'SEO', 'Search Engine Optimization', 2, 'Medium', '2020-06-19'),
(7, 'Desktop Application Development', 'This is Important', 3, 'Low', '2020-06-26'),
(8, '4K Monitor', 'For Video Editing', 1, 'Medium', '2020-06-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_list`
--
ALTER TABLE `tbl_list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `tal_tasks`
--
ALTER TABLE `tal_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for table `tbl_list`
--
ALTER TABLE `tbl_list`
  MODIFY `list_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tal_tasks`
--
ALTER TABLE `tal_tasks`
  MODIFY `task_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;


