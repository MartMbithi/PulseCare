-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 10:08 AM
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
-- Database: `pulsecare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(200) NOT NULL,
  `appointment_user_id` int(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `appointment_service_id` int(200) NOT NULL,
  `appointment_status` varchar(200) NOT NULL DEFAULT 'Pending',
  `appointment_more_details` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `appointment_user_id`, `appointment_date`, `appointment_service_id`, `appointment_status`, `appointment_more_details`) VALUES
(1, 554, '2024-09-10', 1, 'Approved', 'This is a test appointment'),
(4, 555, '2024-09-10', 4, 'Approved', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, '),
(5, 562, '2024-09-24', 11, 'Approved', 'This is my appointment'),
(6, 555, '2024-09-27', 11, 'Approved', 'This is my test appointment');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(200) NOT NULL,
  `feedback_user_id` int(200) NOT NULL,
  `feedback_service_id` int(200) NOT NULL,
  `feedback_title` longtext NOT NULL,
  `feedback_details` longtext NOT NULL,
  `feedback_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `feedback_user_id`, `feedback_service_id`, `feedback_title`, `feedback_details`, `feedback_date`) VALUES
(1, 554, 1, 'What a service', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, ', '2024-09-24 09:20:05.913276'),
(3, 555, 4, 'Best Service Ever', 'Best Service Ever Best Service Ever Best Service Ever Best Service Ever', '2024-09-25 08:06:04.908430'),
(4, 555, 11, 'Best Service Ever', 'Best Service EverBest Service EverBest Service EverBest Service EverBest Service EverBest Service EverBest Service EverBest Service EverBest Service Ever', '2024-09-25 08:06:10.926897');

-- --------------------------------------------------------

--
-- Table structure for table `medical_services`
--

CREATE TABLE `medical_services` (
  `service_id` int(200) NOT NULL,
  `service_code` varchar(200) NOT NULL,
  `service_name` varchar(200) NOT NULL,
  `service_details` longtext NOT NULL,
  `service_assigned_user_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_services`
--

INSERT INTO `medical_services` (`service_id`, `service_code`, `service_name`, `service_details`, `service_assigned_user_id`) VALUES
(1, '0000', 'Paediatrics', 'Cardiology, Neurology, Endocrinology, Nephrology, Infectious Diseases, Pulmonology, Oncology, Critical Care, Gastroenterology, Neonatology, General Paediatrics, Clinical paediatric service.\r\n    Four specialized Paediatrics wards on third floor, 3A Cardiology, Pulmonology and infectious diseases, 3B Neurology, Endocrinology, 3C Gastroenterology, Nephrology & 3D Haematology and Rheumatology.\r\n    Paediatrics Specialized units on second floor: Paediatric ICU, Renal, and Kangaroo Mother care\r\n    Paediatrics Specialized unit on first floor: New Born Unit and Neonatal ICU and Oncology ward (ward 1E)\r\n    On the ground floor, a Paediatrics Emergency Unit (PEU) and Paediatrics Outpatient Consultants Clinics including Outpatient Chemotherapy Clinic, Paediatrics CCC (Comprehensive Care Clinic), and various follow up clinics for all inpatient specialized services and PDU (Paediatric Demonstration Unit) which offer immunization, nutrition, and well-baby clinic care.\r\n', 554),
(4, '001', 'Cancer Treatment', 'Chemotherapy, Hormone therapy, Immunotherapy, Radiation therapy, Targeted therapy, Brachytherapy, Pain & Palliative Care and Patient Navigation', 554),
(5, '002', 'Mental health', '\r\n    Child Psychiatry Clinic on Mondays from 8AM\r\n    Adolescent Psychiatry Clinic on Tuesday from 8AM\r\n    Psychotherapy Clinic on Tuesday from 8AM\r\n    Adult (General) Psychiatry Clinic on Wednesday from 8AM\r\n    Gender Based Violence Management daily from Monday to Friday\r\n    Liaison Psychiatry services 24/7\r\n    Social work evaluation, referral and management\r\n    Rehabilitation through Occupational therapy\r\n    Support Group sessions for people suffering from depression once a month\r\n    Support Group sessions for persons recovering from alcohol and drugs, once a month\r\n', 554),
(6, '003', 'Nutrition services', '\r\n    The Diet Advisory Clinic (DAC)\r\n    Maternal and Child Health Clinic (MCHC) (No.66)\r\n    Obstetrics and Gynaecology Clinic (No.18)\r\n    Paediatric Outpatient Clinic (No.23)\r\n    Diabetes and Endocrinology Centre\r\n    Renal Clinic\r\n', 554),
(7, '004', 'Comprehensive Care Service', 'Clinical care which antiretroviral drug initiation, treatment of opportunistic infections and monitoring of patients\r\nSpecialized advance HIV Care clinics including senior citizen, MDT\r\nLaboratory services; both baseline and monitoring tests. For example, CD4/CD8, Complete Blood Count, Liver Function Tests and Renal Function Tests\r\nPharmacy services such as Free ARV’s and medicines for opportunistic infections\r\nPrevention of Mother to Child Transition (PMTCT) and family planning service in our ANC and reproductive Clinics\r\nGender Based Violence (GBV) screening\r\nNutritional counseling and supplementation\r\nPost-exposure Prophylaxis to rape survivors, occupational needle pricks and exposure to contaminated blood and body fluids\r\nAdvocating for care and support for HIV/AIDS patients through Post Test Clubs and recruitment by expert patients\r\nSocial work services; this includes coordinating networking between Comprehensive Care Centre (CCC) and other HIV/AIDS service providers, follow up and linkages\r\nTB screening and treatment', 554),
(8, '005', 'Dermatology ', '\r\n    Phototherapy 3 panel UVA, UVB and PUVA\r\n    Cryotherapy\r\n    Chemical and electrocautery\r\n    Skin related diagnostic procedures\r\n', 554),
(9, '008', 'Endoscopy ', '\r\n    Gastroscopy\r\n    Colonoscopy\r\n    Flexible sigmoidoscopy\r\n    Endoscopic retrograde cholangiopancreatography (ERCP)\r\n    Percutaneous endoscopic gastrostomy (PEG tube)\r\n    Polypectomy/ endoscopic mucosal resection (EMR)\r\n    Balloon dilatation\r\n    Oesophageal stenting\r\n    Biliary stenting\r\n    Band Ligation\r\n    Bronchoscopy\r\n', 554),
(10, '0010', 'Haemophilia ', '\r\n    Review of new patients who present with bleeding disorder and need diagnosis\r\n    Infusion of a factor (either factor VIII (8) or factor IX (9)) to patients with haemophilia on follow up\r\n    Review of existing patients who present with bleeds and offer initial management (icepack, analgesic, splinting of limb where necessary as well as on-demand factor administration)\r\n    Follow up and administration of Emicizumab (monoclonal antibody that has been developed for patients with Factor 8 deficiency)\r\n    Daily review and factor administration of patients admitted to the wards\r\n    Participating in trainings (in and out of the hospital) to capacity build health care team to manage patients with haemophilia and other bleeding disorders\r\n', 554),
(11, '0011', 'Renal ', '\r\n    Kidney biopsy\r\n    Hemodialysis & other extracorporeal treatments\r\n    Dialysis access insertion and removal\r\n    Arterio-venous fistulae fashioning\r\n    Kidney transplantation\r\n', 554);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(200) NOT NULL,
  `user_names` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_phone` varchar(200) NOT NULL,
  `user_access_level` varchar(200) NOT NULL,
  `user_designation` varchar(200) DEFAULT NULL,
  `user_change_password` int(200) NOT NULL DEFAULT 1,
  `user_account_status` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_names`, `user_email`, `user_password`, `user_phone`, `user_access_level`, `user_designation`, `user_change_password`, `user_account_status`) VALUES
(6, 'Martin Mbithi', 'martin@pulsecare.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '074-084-7563', 'System Administrator', 'System Administrator', 0, 0),
(554, 'James Kinuthia', 'j.kinuthia@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '+25474087645', 'Doctor', 'Doctor', 0, 0),
(555, 'James Kinuthia Mona', 'j.mona@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '+25474087645', 'Patient', 'Patient', 0, 0),
(557, 'Stephen Kimani', 'steph@pulsecare.com', 'ea2f9475cb22329b79701672bf7f6f9acb1521c6', '074568920', 'System Administrator', 'Database Admin', 1, 0),
(561, 'Jane Kinuthia', 'jkinuthia@pulsecare.com', 'ea2f9475cb22329b79701672bf7f6f9acb1521c6', '07458623', 'Doctor', 'Doctor', 1, 0),
(562, 'Evon Doe', 'e.doe@gmail.com', '52ff8d0b1e1a0665aa7b0cbe6626a25415f92e27', '0737229776', 'Patient', 'Engineer', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `AppointmentUserID` (`appointment_user_id`),
  ADD KEY `AppointmentServiceID` (`appointment_service_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `FeedbackUserID` (`feedback_user_id`),
  ADD KEY `FeedbackServiceID` (`feedback_service_id`);

--
-- Indexes for table `medical_services`
--
ALTER TABLE `medical_services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `ServiceAssignedUserID` (`service_assigned_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medical_services`
--
ALTER TABLE `medical_services`
  MODIFY `service_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `AppointmentServiceID` FOREIGN KEY (`appointment_service_id`) REFERENCES `medical_services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AppointmentUserID` FOREIGN KEY (`appointment_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `FeedbackServiceID` FOREIGN KEY (`feedback_service_id`) REFERENCES `medical_services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FeedbackUserID` FOREIGN KEY (`feedback_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical_services`
--
ALTER TABLE `medical_services`
  ADD CONSTRAINT `ServiceAssignedUserID` FOREIGN KEY (`service_assigned_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
