CREATE TABLE `Users` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `Users` (`id`, `name`) VALUES
(1, 'Ernest'),
(2, 'Howard');
