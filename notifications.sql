-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 30, 2023 at 08:07 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `params` text COLLATE utf8mb4_unicode_ci,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `session_id`, `from`, `to`, `body`, `type`, `date`, `params`, `deleted`) VALUES
(246, '', '233242158047', 'RabbitPro', 'https://api.hubtel.com/v1/messages/send/?From=RabbitPro&To=233242158047&Content=test2&ClientID=wahugbbx&ClientSecret=cfjrfknr', 'SMS', '2020-08-12 22:30', '{\"Rate\":1,\"MessageId\":\"093990a9-2a2d-4bae-8df8-fc74f6f59bce\",\"Status\":0,\"NetworkId\":\"62001\"}', 0),
(247, '', 'info@rabbitpro.net', 'vsaggor@gmail.com', '\r\n				<html>\r\n				<head>\r\n				  <title>Notification</title>\r\n				</head>\r\n				<body>\r\n				  <p></p>\r\n				  \r\n				</body>\r\n				</html>\r\n				', 'Email', '2020-08-12 23:08', '1', 0),
(248, '', 'info@rabbitpro.net', 'vsaggor@gmail.com', '\r\n				<html>\r\n				<head>\r\n				  <title>Notification</title>\r\n				</head>\r\n				<body>\r\n				  <p>test message</p>\r\n				  \r\n				</body>\r\n				</html>\r\n				', 'Email', '2020-08-12 23:10', '1', 0),
(249, '', 'info@rabbitpro.net', 'vsaggor@gmail.com', 'test message', 'Email', '2020-08-12 23:12', '1', 0),
(251, '', '', '', '', '', '2023-04-30 00:27', 'SmsMessageSid=SMb2c041ef94ca0d4ec8f7731ba74dbfbe&NumMedia=0&ProfileName=VSA&SmsSid=SMb2c041ef94ca0d4ec8f7731ba74dbfbe&WaId=233242158047&SmsStatus=received&Body=Hi&To=whatsapp%3A%2B14155238886&NumSegments=1&ReferralNumMedia=0&MessageSid=SMb2c041ef94ca0d4ec8f7731ba74dbfbe&AccountSid=ACb5829a39039cd39a0436d02559e20b92&From=whatsapp%3A%2B233242158047&ApiVersion=2010-04-01', 0),
(252, 'SM4dc28192ae781ec9ee83c9b1b7db8d0c', 'whatsapp:+233242158047', 'whatsapp:+14155238886', 'Hi', 'Incoming', '2023-04-30 00:36', 'SmsMessageSid=SM4dc28192ae781ec9ee83c9b1b7db8d0c&NumMedia=0&ProfileName=VSA&SmsSid=SM4dc28192ae781ec9ee83c9b1b7db8d0c&WaId=233242158047&SmsStatus=received&Body=Hi&To=whatsapp%3A%2B14155238886&NumSegments=1&ReferralNumMedia=0&MessageSid=SM4dc28192ae781ec9ee83c9b1b7db8d0c&AccountSid=ACb5829a39039cd39a0436d02559e20b92&From=whatsapp%3A%2B233242158047&ApiVersion=2010-04-01', 0),
(253, NULL, NULL, NULL, NULL, 'Incoming', '2023-04-30 00:39', '', 0),
(254, NULL, NULL, NULL, NULL, 'Incoming', '2023-04-30 00:40', NULL, 0),
(255, 'SM4c9b41ea57f13fd38fca6238be80215d', 'whatsapp:+233242158047', 'whatsapp:+14155238886', 'Hi', 'Incoming', '2023-04-30 00:56', 'SmsMessageSid=SM4c9b41ea57f13fd38fca6238be80215d&NumMedia=0&ProfileName=VSA&SmsSid=SM4c9b41ea57f13fd38fca6238be80215d&WaId=233242158047&SmsStatus=received&Body=Hi&To=whatsapp%3A%2B14155238886&NumSegments=1&ReferralNumMedia=0&MessageSid=SM4c9b41ea57f13fd38fca6238be80215d&AccountSid=ACb5829a39039cd39a0436d02559e20b92&From=whatsapp%3A%2B233242158047&ApiVersion=2010-04-01', 0),
(256, 'SM4bcca1e372acc469839a00d19bf5377d', 'whatsapp:+233242158047', 'whatsapp:+14155238886', 'Hi', 'Incoming', '2023-04-30 01:12', 'SmsMessageSid=SM4bcca1e372acc469839a00d19bf5377d&NumMedia=0&ProfileName=VSA&SmsSid=SM4bcca1e372acc469839a00d19bf5377d&WaId=233242158047&SmsStatus=received&Body=Hi&To=whatsapp%3A%2B14155238886&NumSegments=1&ReferralNumMedia=0&MessageSid=SM4bcca1e372acc469839a00d19bf5377d&AccountSid=ACb5829a39039cd39a0436d02559e20b92&From=whatsapp%3A%2B233242158047&ApiVersion=2010-04-01', 0),
(257, 'SM826cd80482ad2e132ca832379795e7c1', 'whatsapp:+14155238886', 'whatsapp:+233242158047', 'Please reply with a letter of your choice:\n\n*A.* Check Balance\n*B.* Airtime topup\n*C.* Money Transfer\n*D.* Chat with a customer service representative\n\n*Z.* To Exit', 'Outgoing', '2023-04-30 01:12', '[Twilio.Api.V2010.MessageInstance accountSid=ACb5829a39039cd39a0436d02559e20b92 sid=SM826cd80482ad2e132ca832379795e7c1]', 0),
(258, 'SM03dff24b0a8f512a7c64918633a66c19', 'whatsapp:+233242158047', 'whatsapp:+14155238886', 'A', 'Incoming', '2023-04-30 01:13', 'SmsMessageSid=SM03dff24b0a8f512a7c64918633a66c19&NumMedia=0&ProfileName=VSA&SmsSid=SM03dff24b0a8f512a7c64918633a66c19&WaId=233242158047&SmsStatus=received&Body=A&To=whatsapp%3A%2B14155238886&NumSegments=1&ReferralNumMedia=0&MessageSid=SM03dff24b0a8f512a7c64918633a66c19&AccountSid=ACb5829a39039cd39a0436d02559e20b92&From=whatsapp%3A%2B233242158047&ApiVersion=2010-04-01', 0),
(259, 'SM2aea2d322ee48916660089fe00e30b13', 'whatsapp:+14155238886', 'whatsapp:+233242158047', 'Here is your account balances:\n\n*1* 2014******23\nEmmanuel Adu\nCurrent Account\n*GHS 2000*\n\n2013********56\nEmmanuel Adu\nSavings Account\n*GHS 5000*', 'Outgoing', '2023-04-30 01:13', '[Twilio.Api.V2010.MessageInstance accountSid=ACb5829a39039cd39a0436d02559e20b92 sid=SM2aea2d322ee48916660089fe00e30b13]', 0),
(260, 'SM3a56d58ad0f83d10fd5edd4e0fc36f02', 'whatsapp:+14155238886', 'whatsapp:+233242158047', 'Do you want to perform another transaction?\n\n*Y.*  Yes\n*N.* No', 'Outgoing', '2023-04-30 01:13', '[Twilio.Api.V2010.MessageInstance accountSid=ACb5829a39039cd39a0436d02559e20b92 sid=SM3a56d58ad0f83d10fd5edd4e0fc36f02]', 0),
(261, 'SM3434e11d5b3feca46aadfe5fa2f4d22e', 'whatsapp:+233242158047', 'whatsapp:+14155238886', 'N', 'Incoming', '2023-04-30 01:14', 'SmsMessageSid=SM3434e11d5b3feca46aadfe5fa2f4d22e&NumMedia=0&ProfileName=VSA&SmsSid=SM3434e11d5b3feca46aadfe5fa2f4d22e&WaId=233242158047&SmsStatus=received&Body=N&To=whatsapp%3A%2B14155238886&NumSegments=1&ReferralNumMedia=0&MessageSid=SM3434e11d5b3feca46aadfe5fa2f4d22e&AccountSid=ACb5829a39039cd39a0436d02559e20b92&From=whatsapp%3A%2B233242158047&ApiVersion=2010-04-01', 0),
(262, 'SMf185e705a4946140dc843b3dcbfb5854', 'whatsapp:+14155238886', 'whatsapp:+233242158047', 'Thank you for banking with us. Enjoy the rest of the day', 'Outgoing', '2023-04-30 01:14', '[Twilio.Api.V2010.MessageInstance accountSid=ACb5829a39039cd39a0436d02559e20b92 sid=SMf185e705a4946140dc843b3dcbfb5854]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `api_key` varchar(150) DEFAULT NULL,
  `verify_email_status` int(11) DEFAULT NULL,
  `verify_phone_status` int(11) DEFAULT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `email_verification_code` varchar(45) DEFAULT NULL,
  `session_status` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `pass_reset_hash` varchar(255) DEFAULT NULL,
  `date_modified` varchar(45) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `api_key`, `verify_email_status`, `verify_phone_status`, `usergroup_id`, `email_verification_code`, `session_status`, `status`, `pass_reset_hash`, `date_modified`, `deleted`) VALUES
(1, NULL, '+233242158047', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
