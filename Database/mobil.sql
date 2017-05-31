-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2016 at 06:17 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `level` varchar(5) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `nama`, `level`) VALUES
('21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE IF NOT EXISTS `mobil` (
  `inc` int(9) NOT NULL AUTO_INCREMENT,
  `mobil_id` varchar(14) NOT NULL,
  `mobil_nama` varchar(90) NOT NULL,
  `mobil_kategori` varchar(7) NOT NULL,
  `harga_rental` int(20) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `barang_id` (`mobil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`inc`, `mobil_id`, `mobil_nama`, `mobil_kategori`, `harga_rental`) VALUES
(1, 'MB-1', 'Avanza', 'Mobil K', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `mobilmasuk`
--

CREATE TABLE IF NOT EXISTS `mobilmasuk` (
  `inc` int(9) NOT NULL,
  `mobilmasuk_id` varchar(9) NOT NULL,
  `no_fak` varchar(14) NOT NULL,
  `tgl_trans` varchar(10) NOT NULL,
  `total` double(20,0) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `beli_id` (`mobilmasuk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobilmasuk`
--

INSERT INTO `mobilmasuk` (`inc`, `mobilmasuk_id`, `no_fak`, `tgl_trans`, `total`) VALUES
(1, 'TRX-1', 'FAK-1', '29/05/2016', 400000);

-- --------------------------------------------------------

--
-- Table structure for table `mobilmasuk_detail`
--

CREATE TABLE IF NOT EXISTS `mobilmasuk_detail` (
  `mobilmasuk_id` varchar(9) NOT NULL,
  `mobil_id` varchar(14) NOT NULL,
  `mobil_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(5) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_rental` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL,
  KEY `beli_id` (`mobilmasuk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobilmasuk_detail`
--

INSERT INTO `mobilmasuk_detail` (`mobilmasuk_id`, `mobil_id`, `mobil_nama`, `kategori`, `qty`, `satuan`, `harga_rental`, `harga_total`) VALUES
('TRX-1', 'MB-1', 'Avanza', 'Mobil', 2, 'unit', 200000, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE IF NOT EXISTS `rental` (
  `inc` int(9) NOT NULL,
  `rental_id` varchar(14) NOT NULL,
  `no_nota` varchar(14) NOT NULL,
  `tgl_rental` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pelanggan_nama` varchar(90) NOT NULL,
  `total` double(20,0) NOT NULL,
  `jml_bayar` double(20,0) NOT NULL,
  `tgl_kembali` varchar(10) NOT NULL,
  `denda` varchar(10) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `username` (`username`),
  KEY `jual_id` (`rental_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`inc`, `rental_id`, `no_nota`, `tgl_rental`, `username`, `pelanggan_nama`, `total`, `jml_bayar`, `tgl_kembali`, `denda`) VALUES
(1, 'RTL-1', 'nota-1', '29/05/2016', '21232f297a57a5a743894a0e4a801fc3', 'umum', 200000, 200000, '29/05/2016', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `rental_detail`
--

CREATE TABLE IF NOT EXISTS `rental_detail` (
  `rental_id` varchar(9) NOT NULL,
  `mobil_id` varchar(14) NOT NULL,
  `mobil_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(5) NOT NULL,
  `lama` smallint(7) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_rental` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL,
  KEY `jual_id` (`rental_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental_detail`
--

INSERT INTO `rental_detail` (`rental_id`, `mobil_id`, `mobil_nama`, `kategori`, `qty`, `lama`, `satuan`, `harga_rental`, `harga_total`) VALUES
('RTL-1', 'MB-1', 'Avanza', 'Mobil', 1, 1, 'unit', 200000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `mobil_id` varchar(14) NOT NULL,
  `mobil_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(5) NOT NULL,
  `satuan` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`mobil_id`, `mobil_nama`, `kategori`, `qty`, `satuan`) VALUES
('MB-1', 'Avanza', 'Mobil', 2, 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `temp_mobilmasuk_detail`
--

CREATE TABLE IF NOT EXISTS `temp_mobilmasuk_detail` (
  `mobilmasuk_id` varchar(9) NOT NULL,
  `mobil_id` varchar(14) NOT NULL,
  `mobil_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(7) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_rental` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_rental_detail`
--

CREATE TABLE IF NOT EXISTS `temp_rental_detail` (
  `rental_id` varchar(9) NOT NULL,
  `mobil_id` varchar(14) NOT NULL,
  `mobil_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(7) NOT NULL,
  `lama` smallint(7) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_rental` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
