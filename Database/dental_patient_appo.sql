-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 07:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental_patient_appo`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int(11) NOT NULL,
  `appoDate` date NOT NULL,
  `patID` int(11) NOT NULL,
  `schID` int(11) NOT NULL,
  `numofpatients` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `arrived` varchar(10) NOT NULL,
  `arDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `appoDate`, `patID`, `schID`, `numofpatients`, `status`, `arrived`, `arDate`) VALUES
(1, '2024-04-19', 6, 1, 2, 'Approved', 'Yes', '2024-04-19'),
(2, '2024-04-19', 6, 3, 1, 'Approved', 'No', '0000-00-00'),
(3, '2024-04-30', 9, 3, 1, 'Pending', 'No', '0000-00-00'),
(4, '2024-05-01', 2, 3, 1, 'Approved', 'Yes', '2024-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `clinicinfo`
--

CREATE TABLE `clinicinfo` (
  `clinicID` int(11) NOT NULL,
  `clinicName` varchar(255) NOT NULL,
  `clinicAddress` text NOT NULL,
  `clinicPhone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinicinfo`
--

INSERT INTO `clinicinfo` (`clinicID`, `clinicName`, `clinicAddress`, `clinicPhone`) VALUES
(1, 'Thant 1', 'No.18 Banyardala Street, Tamwe Township, Yangon', '+959337688765'),
(2, 'Thant 2', 'No.70 Thadipahtan Street, Tamwe Township, Yangon', '+959772899645'),
(3, 'Thant 3', 'Zayyar Myittar Nyunt Ward, Maha Thuka St, Yangon', '+959678654545');

-- --------------------------------------------------------

--
-- Table structure for table `denreason`
--

CREATE TABLE `denreason` (
  `denReasonID` int(11) NOT NULL,
  `reasonID` int(11) NOT NULL,
  `dentistsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denreason`
--

INSERT INTO `denreason` (`denReasonID`, `reasonID`, `dentistsID`) VALUES
(1, 10, 1),
(2, 3, 1),
(3, 1, 2),
(4, 6, 2),
(5, 20, 1),
(6, 19, 2),
(7, 18, 3),
(8, 17, 4),
(9, 16, 5),
(10, 15, 6),
(11, 14, 7),
(12, 13, 8),
(13, 12, 9),
(14, 11, 10),
(15, 1, 20),
(16, 2, 19),
(17, 3, 18),
(18, 4, 17),
(19, 5, 16),
(20, 6, 15),
(21, 7, 14),
(22, 8, 13),
(23, 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `dentistID` int(11) NOT NULL,
  `dentistName` varchar(50) NOT NULL,
  `dpassword` varchar(50) NOT NULL,
  `specialization` varchar(200) NOT NULL,
  `contactNumber` varchar(30) NOT NULL,
  `dentistGmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`dentistID`, `dentistName`, `dpassword`, `specialization`, `contactNumber`, `dentistGmail`) VALUES
(1, 'Dr. Sarah White', 'dentist!123', 'Pediatric Dentistry', '09441544141', 'swhite@gmail.com'),
(2, 'Dr. Michael Smith', 'kmd123!@#', 'Orthodontics', '09887655678', 'msmith@gmail.com'),
(3, 'Dr. Emily Jones', 'Ejones123!@#', 'Endodontics (Root Canal Therapy)', '09667887362', 'ejones@gmail.com'),
(4, 'Dr. David Lee', 'dLee123!@#', 'Oral and Maxillofacial Surgery', '09778766543', 'dlee@gmail.com'),
(5, 'Dr. Rachel Garcia', 'rGarcia123!@#', 'Periodontics (Gum Diseases)', '09887655672', 'rgarcia@gmail.com'),
(6, 'Dr. Kevin Nguyen', 'kNguyen123!@#', 'Prosthodontics (Dental Prosthetics)', '0937829856', 'knguyen@gmail.com'),
(7, 'Dr. Jennifer Taylor', 'jTaylor123!@#', 'Cosmetic Dentistry', '097768393653', 'jtaylor@gmail.com'),
(8, 'Dr. Daniel Brown', 'dBrown123!@#', 'Dental Implants', '09774833782', 'dbrown@gmail.com'),
(9, 'Dr. Samantha Patel', 'sPatel123!@#', 'Oral Pathology (Disease Diagnosis)', '09376388383', 'spatel@gmail.com'),
(10, 'Dr. Joshua Clark', 'jClark123!@#', 'Temporomandibular Joint (TMJ) Disorders', '093363663636', 'jclark@gmail.com'),
(11, 'Dr. Olivia Martinez', 'oMartinez123!@#', 'Geriatric Dentistry', '09773566474', 'omartinez@gmail.com'),
(12, 'Dr. Andrew Wilson', 'aWilson123!@#', 'Dental Sleep Medicine', '095567338373', 'awilson@gmail.com'),
(13, 'Dr. Lauren Roberts', 'lRobert123!@#', 'Public Health Dentistry', '096637363636', 'lrobert@gmail.com'),
(14, 'Dr. Matthew Anderson', 'mAnderson123!@#', 'Dental Radiology (Imaging)', '09778777383', 'manderson@gmail.com'),
(15, 'Dr. Sophia Adams', 'sAdams123!@#', 'Forensic Dentistry', '09773666373', 'sadams@gmail.com'),
(16, 'Dr. Nathan Carter', 'nCarter123!@#', 'Dental Anesthesiology', '0988946646646', 'ncarter@gmail.com'),
(17, 'Dr. Laura King', 'lking123!@#', 'Special Needs Dentistry', '09667388393', 'lking@gmail.com'),
(18, 'Dr. Benjamin Evans', 'bEvans123!@#', 'Sports Dentistry', '0988363373', 'bevans@gmail.com'),
(19, 'Dr. Victoria Hughes', 'vHughes123!@#', 'Dental Oncology (Cancer Care)', '09663455353', 'vhughes@gmail.com'),
(20, 'Dr. Christopher Morris', 'cMorris123!@#', 'Holistic Dentistry', '09774844844', 'cmorris@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyid` int(11) NOT NULL,
  `patID` int(11) NOT NULL,
  `rpatName` varchar(50) NOT NULL,
  `history` text NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyid`, `patID`, `rpatName`, `history`, `createdate`) VALUES
(3, 6, 'Thet', 'History 1\r\nHistory 2\r\nHistory 3\r\nHistory 4\r\nHistory 5', '2024-04-19'),
(4, 6, 'Mhue', 'Mhue History 1\r\nMhue History 2\r\nMhue History 3\r\nMhue History 4\r\nMhue History 5\r\nMhue History 6\r\nMhue History 7\r\nMhue History 8', '2024-04-19'),
(5, 2, 'Thet Mhue Wai', 'Medications: Lisinopril 10mg (for hypertension), Aspirin 81mg (for cardiovascular health)\r\nMedical History: Hypertension', '2024-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `mID` int(11) NOT NULL,
  `mName` varchar(50) NOT NULL,
  `mGmail` varchar(100) NOT NULL,
  `mPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`mID`, `mName`, `mGmail`, `mPassword`) VALUES
(1, 'Manager Will Byers', 'mainmanager@gmail.com', 'Manager123!@#');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mID` int(11) NOT NULL,
  `pID` int(11) NOT NULL,
  `message` text NOT NULL,
  `messageDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mID`, `pID`, `message`, `messageDate`) VALUES
(1, 1, 'The staff at this clinic are incredibly friendly and welcoming.', '2024-04-20'),
(2, 2, 'I appreciate that they offer flexible appointment times to accommodate my schedule.', '2024-04-21'),
(3, 3, 'They offer a variety of payment options, making dental care more accessible.', '2024-04-22'),
(4, 4, 'They have state-of-the-art equipment, which made my visit efficient and comfortable.', '2024-04-23'),
(5, 1, 'The clinic\'s location is convenient with ample parking.', '2024-04-24'),
(6, 2, 'They offer a variety of payment options, making dental care more accessible', '2024-04-25'),
(7, 3, 'The dentist was very gentle and made me feel at ease during my procedure.', '2024-04-26'),
(8, 2, 'I received excellent follow-up care after my treatment.', '2024-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PatientID` int(11) NOT NULL,
  `Pname` varchar(20) NOT NULL,
  `Pemail` varchar(100) NOT NULL,
  `Pphone` varchar(30) NOT NULL,
  `Pdob` date NOT NULL,
  `Ppassword` varchar(30) NOT NULL,
  `Paddress` text NOT NULL,
  `Pprofile_img` varchar(255) NOT NULL,
  `regDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatientID`, `Pname`, `Pemail`, `Pphone`, `Pdob`, `Ppassword`, `Paddress`, `Pprofile_img`, `regDate`) VALUES
(1, 'Xio Xio', 'thetmhuewai191@gmail.com', '09441544141', '2002-02-03', 'kmd123!@#', '148 street', 'Thet Mhue Wai.jpg', '2024-04-09'),
(2, 'Thet Mhue Wai', 'waimhuethet@gmail.com', '09776566543', '2002-03-02', 'tmw123!@#', 'Yangon', '2.jpg', '2024-04-09'),
(3, 'John smith', 'smith@gmail.com', '+959441544141', '2000-01-07', 'Smith*123#', 'Yangon', 'smith profile.jpg', '2024-04-21'),
(4, 'Youth', 'youth@gmail.com', '+959556533765', '2002-03-01', '*youth*123', 'Yangon', 'images.jpg', '2024-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `reasonID` int(11) NOT NULL,
  `reasonName` varchar(255) NOT NULL,
  `reasonDetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`reasonID`, `reasonName`, `reasonDetail`) VALUES
(1, 'Bright Smile Dental', 'Represents the goal of giving patients a bright, confident smile through dental care'),
(2, 'Happy Teeth Clinic', 'Gum disease involves inflammation and infection of the gums and surrounding tissues. Treatment aims to remove plaque and tartar buildup through deep cleaning and may include antibiotics or surgical interventions for advanced cases.Focuses on providing treatments that ensure patients have healthy and happy teeth.'),
(3, 'Pearly Whites Dental', 'Emphasizes the desire to make patients\' teeth as white and beautiful as pearls.'),
(4, 'Smile Haven Dentistry', 'A welcoming place where patients can find comfort and leave with a smile.'),
(5, 'Gleam & Grin Dental', 'Promotes dental services that leave patients\' smiles gleaming and joyful.'),
(6, 'Ivory Tower Dentistry', 'Signifies a commitment to excellence and quality dental care.'),
(7, 'Radiant Smiles Dental', 'Strives to create radiant and beautiful smiles for all patients.'),
(8, 'Sunny Dental Care', 'A positive and uplifting atmosphere for dental treatments.'),
(9, 'Minty Fresh Dental', 'Reflects the aim to leave mouths feeling fresh and clean after every visit.'),
(10, 'Cherry Blossom Dentistry', 'Evokes a sense of beauty and delicacy in dental care.'),
(11, 'Sparkle Dental Studio', ' A place that adds sparkle to patients smiles with comprehensive '),
(12, 'Luminous Dentistry', 'Focuses on bringing brightness and radiance to patients oral health.'),
(13, 'Elite Pearl Dental', 'Represents premium and top-tier dental services akin to finding a rare pearl.'),
(14, 'Joyful Grins Clinic', 'Aims to spread joy through confident and healthy smiles.'),
(15, 'Serenity Dental Oasis', ' Offers a calm and serene environment for dental treatments.'),
(16, 'Wholesome Smiles Dental', 'Prioritizes overall dental health for genuine and wholesome smiles.'),
(17, 'Aura Dentistry', 'Emphasizes the positive energy and aura associated with a healthy smile.'),
(18, 'Zenith Dental Center', 'Symbolizes reaching the peak of dental health and aesthetics.'),
(19, 'Bella Vita Dental', 'Focuses on enhancing patients lives through beautiful dental outcomes.'),
(20, 'Evergreen Dental', 'Promotes long-lasting and sustainable dental health for all patients.');

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `recID` int(11) NOT NULL,
  `recName` varchar(100) NOT NULL,
  `recpassword` varchar(30) NOT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `recGmail` varchar(100) NOT NULL,
  `clinicID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`recID`, `recName`, `recpassword`, `contactNumber`, `recGmail`, `clinicID`) VALUES
(1, 'Thant2 receptionist', 'thant2reception', '09778755376', 'thant2@gmail.com', 2),
(2, 'Thant1 receptionist', 'thant1rec!@#', '01700895', 'thant1@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `scheduleID` int(11) NOT NULL,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `denReasonID` int(11) NOT NULL,
  `clinicID` int(11) NOT NULL,
  `totalPatient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`scheduleID`, `date`, `startTime`, `endTime`, `denReasonID`, `clinicID`, `totalPatient`) VALUES
(1, '2024-04-02', '12:30:00', '14:30:00', 1, 1, 7),
(2, '2024-05-03', '13:00:00', '14:00:00', 2, 1, 0),
(3, '2024-05-04', '15:00:00', '16:00:00', 3, 2, 4),
(4, '2024-05-05', '09:00:00', '10:00:00', 4, 2, 20),
(5, '2024-05-03', '09:00:00', '11:00:00', 1, 1, 20),
(6, '2024-05-03', '11:00:00', '13:00:00', 2, 1, 20),
(7, '2024-05-03', '13:00:00', '15:00:00', 3, 1, 20),
(8, '2024-05-03', '15:00:00', '17:00:00', 4, 1, 20),
(9, '2024-05-03', '17:00:00', '19:00:00', 7, 1, 20),
(10, '2024-05-03', '19:00:00', '21:00:00', 8, 1, 20),
(11, '2024-05-03', '09:00:00', '11:00:00', 9, 2, 20),
(12, '2024-05-03', '11:00:00', '13:00:00', 10, 2, 20),
(13, '2024-05-03', '13:00:00', '15:00:00', 11, 2, 20),
(14, '2024-05-03', '15:00:00', '17:00:00', 12, 2, 20),
(15, '2024-05-03', '17:00:00', '19:00:00', 13, 2, 20),
(16, '2024-05-03', '19:00:00', '21:00:00', 14, 2, 20),
(17, '2024-05-10', '21:00:00', '23:00:00', 23, 2, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`);

--
-- Indexes for table `clinicinfo`
--
ALTER TABLE `clinicinfo`
  ADD PRIMARY KEY (`clinicID`);

--
-- Indexes for table `denreason`
--
ALTER TABLE `denreason`
  ADD PRIMARY KEY (`denReasonID`);

--
-- Indexes for table `dentists`
--
ALTER TABLE `dentists`
  ADD PRIMARY KEY (`dentistID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyid`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`mID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`reasonID`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`recID`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`scheduleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clinicinfo`
--
ALTER TABLE `clinicinfo`
  MODIFY `clinicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `denreason`
--
ALTER TABLE `denreason`
  MODIFY `denReasonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `dentists`
--
ALTER TABLE `dentists`
  MODIFY `dentistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `mID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `reasonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `recID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `scheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
