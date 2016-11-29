-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Nov 2016 pada 16.57
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datatwitter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `get_list_followers`
--

CREATE TABLE `get_list_followers` (
  `official` varchar(100) NOT NULL DEFAULT '',
  `created_at` varchar(100) DEFAULT NULL,
  `id_str` varchar(100) NOT NULL,
  `screen_name` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `followers_count` int(11) DEFAULT NULL,
  `friend_count` int(11) DEFAULT NULL,
  `status_count` int(11) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `datenow` date DEFAULT NULL,
  `cursor` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `get_list_following`
--

CREATE TABLE `get_list_following` (
  `official` varchar(100) NOT NULL DEFAULT '',
  `created_at` varchar(100) DEFAULT NULL,
  `id_str` varchar(100) NOT NULL,
  `screen_name` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `followers_count` int(11) DEFAULT NULL,
  `friend_count` int(11) DEFAULT NULL,
  `status_count` int(11) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `datenow` date DEFAULT NULL,
  `cursor` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `get_list_followers`
--
ALTER TABLE `get_list_followers`
  ADD PRIMARY KEY (`official`,`id_str`);

--
-- Indexes for table `get_list_following`
--
ALTER TABLE `get_list_following`
  ADD PRIMARY KEY (`official`,`id_str`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
