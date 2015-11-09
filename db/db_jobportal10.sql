-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2015 at 07:55 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_login_date` datetime DEFAULT NULL,
  `access_level` int(2) DEFAULT NULL,
  `pw_reset_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `session_id`, `name`, `email`, `last_login_date`, `access_level`, `pw_reset_key`, `status`, `del_flag`) VALUES
(1, 'admin', 'f6e9df2f317718c47bd4b2f7411fcf78dd789a4227b0aef600e7dbb87ceb92b1309445c8fb0b06a0a32a7e5023c2ba49926017bbd4b64dd2c843ed24c974bf89gPTMxV+g77alJs/oMTypRhKzj8Ql5Q==', '', 'admin', 'admin@admin.com', NULL, NULL, '094c0e0c98d61fa663e53f9e5cbe38ce', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms`
--

CREATE TABLE IF NOT EXISTS `tbl_cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `head_text` varchar(255) DEFAULT NULL,
  `content` longtext,
  `type` varchar(10) NOT NULL DEFAULT 'fix',
  `authors` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `meta_keywords` longtext NOT NULL,
  `meta_description` longtext NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `footer_status` int(1) NOT NULL DEFAULT '0',
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tbl_cms`
--

INSERT INTO `tbl_cms` (`id`, `title`, `head_text`, `content`, `type`, `authors`, `page_title`, `meta_keywords`, `meta_description`, `category_id`, `status`, `footer_status`, `del_flag`) VALUES
(23, 'about_us', 'About Us', '<p>\r\n Uno a comprehensive online business directory<br />\r\n Uno is Uno Internet Venture&#39;s latest foray into the field of providing information to cater to immediate, impulsive and urgent requirement of customers for companies, products, and services. Uno&#39;s service is available Online. The online search service has an extensive directory of information from across Nepal that is both accurate as well as varied.<br />\r\n As a user, you enjoy the following features on Uno:<br />\r\n Fast and Accurate Search<br />\r\n Detailed information on businesses to enable you to pick the business that most suits your requirements<br />\r\n As a business, you can reach your customers whenever and wherever they are looking for you using our robust and cost-effective service. In addition to listing your business on the Uno website, you can also<br />\r\n Add photos, price lists and menus.<br />\r\n Add events,deals,offers and announcements.<br />\r\n Track the popularity of and manage your business listing<br />\r\n The Uno Voice service will be available 24X7 for consumers in the near future.</p>\r\n', '0', '', 'About Us', 'About Us', 'About Us', 1, 1, 1, 0),
(35, 'user_activation', 'User Activation', '<p>\r\n <b>Please Check Your e-mail for the activation link</b></p>\r\n', '0', '', 'User Activation', 'User Activation', 'User Activation', 2, 1, 0, 0),
(36, 'activation_success', 'Activation Success', '<p>\n	<b>Your Account is activated. Please <a href=\\"http://uno.com.np/login\\">Login</a></b></p>\n', '0', '', 'Activation Success', 'Activation Success', 'Activation Success', 2, 1, 0, 0),
(37, 'activation_failed', 'Activation Failed', '<p>\n	Activation Failure</p>\n', '0', '', 'Activation Failed', 'Activation Failed', 'Activation Failed', 2, 1, 0, 0),
(41, 'contact_us', 'Contact Us', '<p>\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', '0', 'Contact us', 'Contact us', 'Contact us', 'Contact us', 1, 1, 1, 0),
(42, 'faq', 'FAQ', '<p>\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', '0', 'FAQ', 'FAQ', 'FAQ', 'FAQ', 1, 0, 0, 0),
(43, 'tac', 'Terms & Conditions', '<p>\n	<strong>Terms of Service</strong></p>\n<p>\n	<br />\n	Please read the following agreement carefully before using this website or any service there under.</p>\n<p>\n	<br />\n	YOUR ACCESS TO OR USE OF THE Uno SERVICES AND/OR Uno WEBSITE (AS DEFINED BELOW) CONSTITUTES YOUR ACCEPTANCE OF ALL THE PROVISIONS OF THESE TERMS OF SERVICE.</p>\n<p>\n	<br />\n	IF YOU ARE UNWILLING TO BE BOUND BY THESE TERMS OF SERVICE, DO NOT ACCESS OR USE THE Uno SERVICES AND/OR Uno WEBSITE.</p>\n<p>\n	<br />\n	By using the Uno Services (as defined below) which are owned and operated by Uno Internet Ventures and by accessing the Uno Site located at http://www.Uno.com.np, and all linked pages owned and operated by Uno (the &quot;Uno Site&quot;), you agree to be bound by these terms of service, as well as any other guidelines, rules and additional terms referenced herein, and all such guidelines, terms and rules are hereby incorporated herein by this reference (collectively, &quot;Terms of Service&quot;). Uno&#39;s on-line services which are available at the Uno Site, among other things, offers online local search service that helps buyers quickly and conveniently find businesses and establishments while helping sellers improve the effectiveness of their marketing spends and as a business, (collectively &quot;Uno Services&quot;) to know more about Uno Services, click here. When you access or use any of the Uno Services and/or the Uno Site you agree to be bound by these Terms of Service. These Terms of Service set out the legally binding terms with respect to your use of and our provision of the Uno Site and Uno Services. Please read these Terms of Service carefully.<br />\n	<strong><br />\n	1. Eligibility.</strong><br />\n	Your are must be 18 or over, and you must be capable of entering into a binding contract in your jurisdiction to register as a member of Uno Site or use the Uno Site and/or Uno Services. If you are under the age of 18 or the applicable legal age in your jurisdiction, you can use the Uno Services only in conjunction with, and under the supervision of, your parent or guardian who has agreed to the Terms of Service. If you do not qualify, do not use the Service. By using the Uno Site and/or Uno Services, you represent and warrant that you have the right, authority, competency and capacity to enter into these Terms of Service and to abide by all of the terms and conditions set forth herein.<br />\n	<strong><br />\n	2. Changes to the Agreement or the Uno Services.</strong><br />\n	You agree and understand that these Terms of Service, the Uno Site and the Uno Services may be modified by Uno at any time without prior notice, and such modifications will be effective upon Uno&#39;s posting of the new terms and/or upon implementation of the new changes on the Uno Site or Uno Services. You agree to review the Terms of Service periodically so that you are aware of any modifications. Your continued use of the Uno Services after any modifications indicates your acceptance of the modified Terms of Service. Unless expressly stated otherwise by Uno, any new features, new services, enhancements or modifications to the Uno Services implemented after your initial access to the Service shall be subject to these Terms of Service.<br />\n	<br />\n	<strong>3. Registration and Security.</strong><br />\n	In order to use or access some of the Uno Services, you may be required to register with Uno Site and to select a password and user name, which shall consist of an email address you own and use (&quot;User ID&quot;). If you register, you agree to provide Uno with accurate, complete, and updated registration information and update and rectify the same from time to time. Failure to do so shall constitute a breach of these Terms of Service, which may result in immediate termination of your account. You may not: enter, select or use a false name or an email address owned or controlled by another person with the intent to impersonate that person, or, use as a User ID a name subject to any rights of a person other than yourself without appropriate authorization. Uno reserves the right to refuse registration of, or cancel a User ID in its discretion. You shall be responsible for maintaining the confidentiality of your password and are fully responsible for all activities that occur under your User ID and password. Uno shall not be liable for any loss or damage arising from your failure to comply with the above requirements. Any User ID and password provided to you for your access to the Uno Services shall be for your personal use only. You agree to immediately notify Uno of any unauthorized use of your User ID or password, and ensure that you exit from your account at the end of each session.<br />\n	<br />\n	<strong>4. Use of the Site/Services by Members.</strong><br />\n	You may search the Uno Site database for business and other listings, reviews and business contact information. You may invite people you know to join Uno Site. Uno does not control the information, data, reviews, text, sound, photographs, graphics, video, messages and other materials (&quot;Content&quot;) posted or provided by third parties via the Uno Services or Uno Site, including the content of any business and/or establishment, and does not guarantee the accuracy, integrity or quality of such Content. You understand that by using the Uno Services you may be exposed to Content that is offensive, indecent or objectionable. Under no circumstances will Uno be liable in any way for any Content, including any errors or omissions in any Content, or any loss or damage of any kind incurred as a result of your posting or use of any Content. You are responsible for complying with all laws applicable to the Content you submit via the Uno Services. You agree that you must evaluate and bear all risks associated with the use or posting of any Content, including any reliance on the content, integrity, and accuracy of such Content.</p>\n<p>\n	<br />\n	By using the &ldquo;Send to Phone&rdquo; application/feature in the Uno Site you authorize us &amp; our associate partners to send solicitation messages/service messages/ promotional messages to the mobile phone number provided by you in the Uno Site or call you to offer services.<br />\n	All those sections in the Uno Services that invite user participation will contain views, opinion, suggestion, comments and other information provided by the general public, and Uno will at no point of time be responsible for the accuracy or correctness of such information. Uno reserves the absolute right to accept/reject information from readers and/or advertisements from advertisers and impose/relax Uno Services access rules and regulations for any user(s).<br />\n	<strong>&nbsp;<br />\n	5. Restrictions on Rights to Use.</strong><br />\n	You shall not (and you agree not to allow any third party to):<br />\n	modify, adapt, translate, or reverse engineer any portion of the Uno Site and/or Uno Services; remove any copyright, trademark or other proprietary rights notices contained in or on the Uno Site and/or Uno Services; use any robot, spider, site search/retrieval application, or other device to retrieve or index any portion of the Uno Site and/or Uno Services; collect any information about other users or members (including but not limited to usernames and/or email addresses) for any purpose; reformat or frame any portion of the web pages that are part of the Uno Site and/or Uno Services; create user accounts by automated means or under false or fraudulent pretenses; create or transmit unwanted electronic communications such as &quot;spam&quot; to other users or members of the Uno Site and/or Uno Services or otherwise interfere with other user&#39;s or member&#39;s enjoyment of the Uno Site and/or Uno Services; submit any third party materials or Content without such third party&#39;s prior written consent; submit any Content or material that falsely express or imply that such Content or material is sponsored or endorsed by Uno; submit any Content or material that infringes, misappropriates or violates the intellectual property, publicity, privacy or other proprietary rights of any party; transmit any viruses, worms, defects, Trojan horses or other items of a destructive nature; use of the Uno Site or Uno Services to violate the security of any computer network, crack passwords or security encryption codes, transfer or store illegal material including that are deemed threatening or obscene; copy or store any Content offered on the Uno Site for other than your own personal use and/or use the same for any other purpose (other than your own personal use) whether for commercial purposes or otherwise ; submit Content or materials that are unlawful or promote or encourage illegal activity; submit false or misleading information to Uno or at Uno Site; take any action that imposes, or may impose in our sole discretion, an unreasonable or disproportionately large load on our IT infrastructure; use the Uno Site and/ or Uno Services, intentionally or unintentionally, to violate any applicable local, state, national or international law; or collect or store personal data about other users in connection with the prohibited activities described in this paragraph.<br />\n	<strong><br />\n	6. Content Posted By You on the Uno Site.</strong><br />\n	You shall not post, distribute, or reproduce in any way any copyrighted material, trademarks, or other proprietary information without obtaining the prior written consent of the owner of such proprietary rights. You understand and agree that Uno reserve its right (but has no obligation) to review and delete/remove any Content, business or other listings, (including business name, address, phone, fax, distance, reviews, questions, answers, comments, plans, ideas, rating, reviews or like) that, in the sole judgment of Uno Internet Ventures, violates these Terms of Service or which might be offensive, illegal, or that might violate the rights of, harm, or threaten the safety of other users or members of the Uno Site and/or other website users. You also understand and agree that Uno reserves the right to review, delete or remove any Content without any cause or liability. Notwithstanding anything to the contrary contained herein you are solely responsible for the any Content that you publish, upload, submit or display on the Uno Site or transmit to other members and/or other website users (hereinafter, &quot;Posted Content&quot;).<br />\n	You are solely responsible for any Content submitted, posted or uploaded through your User ID on the Uno Site. You agree that you will only post Content that you believe to be true and you will not purposely provide false or misleading information.</p>\n<p>\n	<br />\n	By posting Posted Content on the Uno Site, you agree to and hereby do grant, and you represent and warrant that you have the right to grant, Uno, its contractors, and the users of the Uno Site an irrevocable, perpetual, exclusive, royalty-free, fully sub-licensable, fully paid up, worldwide license to use, copy, publicly perform, digitally perform, publicly display, and distribute such Posted Content and to prepare derivative works of, or incorporate into other works, such Posted Content and to otherwise exploit the same for commercial or other purposes.<br />\n	You should only provide Content which is in conformity with these Terms of Service.<br />\n	The following is a partial list of the kind of Content and communications that are illegal or prohibited on/through the Uno Site. Uno reserves the right to investigate and take appropriate legal action in its sole discretion against anyone who violates this provision, including without limitation, removing such Content and/or communication from the Uno Services and terminating the membership of such violators or blocking your/violators use of the Uno Services and/or Uno Site. You shall not post Content that: is false or intentionally misleading; is patently offensive, such as Content or messages that promotes racism, bigotry, hatred or physical harm of any kind against any group or individual; harasses or advocates harassment of another person; involves the transmission of unsolicited mass mailing or &quot;spamming&quot;; promotes illegal activities or conduct that is abusive; is threatening, derogatory, indecent, obscene, defamatory or libelous; is pornographic or sexually explicit in nature; and seeks or recommends providers of material that exploits people under the age of 18 in a sexual or violent manner, or seeks or recommends providers that solicit personal information from anyone under 18 years of age.<br />\n	Otherwise illegal and/or immoral in any manner whatsoever.</p>\n<p>\n	<br />\n	<strong>7. Copyright Dispute Policy.</strong><br />\n	Uno has adopted the following general policy toward copyright infringement. ANy Notification of Claimed Infringement must me communicated to Uno Internet Ventures, GPO Box-470,Kathmandu,Nepal by registered postIt is Uno&#39;s policy to block access to or remove material that it believes in good faith to be copyrighted material that has been illegally copied and distributed by any of our advertisers,affiliates, Content providers, members or users; and remove and discontinue service to repeat offenders. If you believe that material or Content residing on or accessible through the Uno Site or Service infringes a copyright, please provide the following information to the Designated Agent listed below:<br />\n	A physical or electronic signature of a person authorized to act on behalf of the owner of the copyright that has been allegedly infringed;<br />\n	Identification of works or materials being infringed; Identification of the material that is claimed to be infringing including information regarding the location of the infringing materials that the copyright owner seeks to have removed, with sufficient detail so that Uno is capable of finding and verifying its existence; Complete contact information about the notifier including address, telephone number and, if available, email address; A statement that the notifier has a good faith belief that the material is not authorized by the copyright owner, its agent, or the law; and<br />\n	Upon Receipt of information pertaining to copyright infringement, Uno may disable access to and/or remove the infringing material<br />\n	If the Content provider, member or user believes that the material that was removed or to which access was disabled is either not infringing, or the Content provider, member or user believes that it has the right to post and use such material from the copyright owner, the copyright owner&#39;s agent, or pursuant to the law, the Content provider, member or user must send the following information to the Designated Agent listed below:<br />\n	A physical or electronic signature of the Content provider, member or user; Identification of the material that has been removed or to which access to has been disabled and the location at which the material appeared before it was removed or disabled; A statement that the Content provider, member or user has a good faith belief that the material was removed or disabled as a result of mistake or a misidentification of the material; and The Content provider&#39;s, member&#39;s or user&#39;s name, address, telephone number, and, if available, email address and a statement that such person or entity consents to the jurisdiction of the Court for the judicial district in which the Content provider&#39;s, member&#39;s or user&#39;s address is located, or if the Content provider&#39;s, member&#39;s or user&#39;s address is located outside Nepal, for any judicial district in which Uno is located, and that such person or entity will accept service of process from the person who provided notification of the alleged infringement.<br />\n	If a counter-notice is received by the Designated Agent, Uno may send a copy of the counter-notice to the original complaining party informing that person that it may replace the removed material or cease disabling it in 10 business days. Unless the copyright owner files an action seeking a court order against the Content provider, member or user, the removed material may be replaced or access to it restored in 10 to 14 business days or more after receipt of the counter-notice, at Uno&#39;s discretion.</p>\n<p>\n	Please contact Uno Internet Ventures, GPO-470, Kuleshwor, Kathmandu, Nepal.</p>\n<p>\n	<br />\n	<strong>8. Privity of Contract with you.</strong><br />\n	If you enter into correspondence or engage in commercial transactions with third parties in connection with your use of the Uno Services, such activity is solely between you and the applicable third party. Uno shall have no liability, obligation or responsibility for any such activity. You hereby release Uno from all claims arising from such activity.</p>\n<p>\n	<br />\n	<strong>9. Privacy.</strong><br />\n	Use of the Uno Site and/or the Uno Services or any Content uploaded/posted in the Uno Site is also governed by our Privacy Policy.To know more about our Privacy Policy click here</p>\n<p>\n	<br />\n	<strong>10. Term.</strong><br />\n	These Terms of Service will remain in full force and effect while you use the Uno Site and/or Uno Services. Either Party may terminate these Terms of Service for any reason, at any time. Sections 9, 10, 11, 12, 13, 14 and 15 shall survive any termination or expiration of these Terms of Service.</p>\n<p>\n	<strong><br />\n	11. Ownership.</strong><br />\n	Except for the Content submitted by members, advertisers or users, which are governed by the provisions contained elsewhere in this Terms of Service, the Uno Services the Uno Site and all aspects thereof, including all copyrights, trademarks, and other intellectual property or proprietary rights therein, is owned by Uno or its licensors. You acknowledge that the Uno Services and any underlying technology or software used in connection with the Uno Services contain Uno&#39;s proprietary information. Shall not modify, reproduce, distribute, create derivative works of, publicly display or in any way exploit, any of the content, software, and/or materials available on the Uno Site, or Uno Services in whole or in part except as expressly provided in Uno&#39;s policies and procedures made available via the Uno Services. Except as expressly and unambiguously provided herein, Uno and its suppliers do not grant you any express or implied rights, and all rights in the Uno Services not expressly granted by Uno to you are retained by Uno.</p>\n<p>\n	<br />\n	<strong>12. Links to Third Party Sites</strong><br />\n	The links in this Uno Site may allow you to leave the Uno Site. These linked sites that are not under the control of Uno are not reviewed or approved by Uno. Uno shall not be responsible for the contents of any linked site or any links contained in a linked site. The inclusion of any linked site does not imply endorsement by Uno of the site. Your correspondence or business dealing with or participation in the sales promotions of advertisers or service providers found on or through the Uno Services, including payment and delivery of related goods or services, and any other terms, conditions, and warranties or representations associated with such dealings, are solely between you and such advertisers or service providers. You assume all risks arising out of or resulting from your transaction of business over the Internet, and you agree that we are not responsible or liable for any loss or result of the presence of information about or links to such advertisers or service providers on the Uno Services. You acknowledge and agree that we are not responsible or liable for the availability, accuracy, authenticity, copyright compliance, legality, decency or any other aspect of the content, advertising, products, services, or other materials on or available from such sites or resources. You acknowledge and agree that your use of these linked sites is subject to different terms of use than these Terms of Service, and may be subject to different privacy practices than those set forth in the Privacy Policy governing the use of the Uno Services. We do not assume any responsibility for review or enforcement of any local licensing requirements that may be applicable to businesses listed on the Uno Services. You acknowledge sole responsibility for and assume all risk arising from your use of any such websites or resources.</p>\n<p>\n	<br />\n	<strong>13. Disclaimer.</strong><br />\n	THE Uno SITE AND Uno SERVICE ARE PROVIDED BY Uno ON AN &quot;AS IS&quot; BASIS. Uno AND ITS LICENSORS AND AFFILIATES MAKE NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS, STATUTORY OR IMPLIED AS TO THE OPERATION OF THE Uno SITE, Uno SERVICES OR SOFTWARE OR THE INFORMATION, CONTENT, MATERIALS, OR PRODUCTS INCLUDED ON THE Uno SITE OR IN ASSOCIATION WITH THE Uno SERVICES. TO THE FULLEST EXTENT PERMISSIBLE BY APPLICABLE LAW, Uno AND ITS LICENSORS AND AFFILIATES DISCLAIM ALL WARRANTIES, EXPRESS, STATUTORY, OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. Uno AND ITS LICENSORS AND AFFILIATES FURTHER DO NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE INFORMATION, TEXT, GRAPHICS, LINKS OR OTHER ITEMS CONTAINED WITHIN THE Uno SITE. Uno SHALL NOT BE RESPONSIBLE IN ANY MANNER FOR THE CONDUCT, OF ANY USER OF THE Uno SITE OR Uno SERVICES. Uno DOES NOT WARRANT OR COVENANT THAT THE Uno SERVICES WILL BE AVAILABLE AT ANY TIME OR FROM ANY PARTICULAR LOCATION, WILL BE SECURE OR ERROR-FREE, THAT DEFECTS WILL BE CORRECTED, OR THAT THE Uno SERVICES IS FREE OF VIRUSES OR OTHER POTENTIALLY HARMFUL COMPONENTS. ANY MATERIAL OR CONTENT DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE Uno SERVICES IS ACCESSED AT YOUR OWN DISCRETION AND RISK AND YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY ANY USER FROM Uno, THE Uno SITE OR THROUGH OR FROM THE Uno SERVICES SHALL CREATE ANY WARRANTY NOT EXPRESSLY STATED HEREIN. Uno SHALL NOT LIABLE FOR ANY KIND OF DAMAGES, LOSSES OR ACTION ARISING DIRECTLY OR INDIRECTLY, DUE TO ACCESS AND/OR USE OF THE CONTENT IN THE Uno SERVICES INCLUDING BUT NOT LIMITED TO ANY DECISIONS BASED ON CONTENT IN THE Uno SERVICES RESULTING IN LOSS OF DATA, REVENUE, PROFITS, PROPERTY, INFECTION BY VIRUSES ETC.</p>\n<p>\n	<strong><br />\n	14. Limitation on Liability.</strong><br />\n	Unoshall not be liable for any failure to perform its obligations hereunder where such failure results from any cause beyond Uno&#39;s reasonable control, including, without limitation, mechanical, electronic or communications failure or degradation (including &quot;line-noise&quot; interference).</p>\n<p>\n	WITHOUT LIMITING THE FOREGOING, Uno AND ITS AFFILIATES AND SUPPLIERS WILL NOT BE LIABLE UNDER ANY THEORY OF LAW, FOR ANY INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES, INCLUDING, BUT NOT LIMITED TO LOSS OF PROFITS, BUSINESS INTERRUPTION, AND/OR LOSS OF INFORMATION OR DATA. SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF INCIDENTAL OR CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATIONS AND EXCLUSIONS MAY NOT APPLY TO YOU. NOTWITHSTANDING ANYTHING TO THE CONTRARY CONTAINED HEREIN, Uno&#39;S MAXIMUM AGGREGATE LIABILITY TO YOU FOR ANY CAUSES WHATSOEVER, AND REGARDLESS OF THE FORM OF ACTION, WILL AT ALL TIMES BE LIMITED TO THE GREATER OF:</p>\n<p>\n	&nbsp;</p>\n<p>\n	(i) THE AMOUNT PAID, IF ANY, BY YOU TO Uno FOR THE Uno SERVICES IN THE 12 MONTHS PRIOR TO THE ACTION GIVING RISE TO LIABILITY OR,</p>\n<p>\n	(ii) NRs. 1,000/-.</p>\n<p>\n	<br />\n	<strong>15. Indemnity.</strong><br />\n	You agree to indemnify and hold Uno, its parents, subsidiaries, affiliates, officers and employees, harmless, including costs and attorneys&#39; fees, from any claim or demand made by any third party due to or arising out of (i) your access to the Uno Site, (ii) your use of the Uno Services, (iii) the violation of these Terms of Service by you, or (iv) the infringement by you, or any third party using your account or User ID or password, of any intellectual property or other right of any person or entity.</p>\n<p>\n	<br />\n	<strong>16. Jurisdiction:</strong><br />\n	The terms of this agreement are exclusively based on and subject to Nepalese law. You hereby irrevocably consent to the exclusive jurisdiction and venue of courts in Nepal in all disputes arising out of or relating to the use of this website. Use of this website is unauthorized in any jurisdiction that does not give effect to all provisions of these terms and conditions, including without limitation this paragraph.</p>\n<p>\n	<br />\n	<strong>17. Miscellaneous.</strong><br />\n	No agency, partnership, joint venture, or employment is created as a result of these Terms of Service and you do not have any authority of any kind to bind Uno in any respect whatsoever. Uno may provide you with notices, including those regarding changes to the Terms of Service by email, regular mail or postings on the Uno Services. These Terms of Service, accepted upon use of the Uno Site, and all terms, guidelines and rules referenced herein contain the entire agreement between you and Uno regarding the use of the Uno Site and/or the Uno Services. The failure of Uno to exercise or enforce any right or provision of these Terms of Service shall not constitute a waiver of such right or provision. The failure of either party to exercise in any respect any right provided for herein shall not be deemed a waiver of any further rights hereunder. If any provision of these Terms of Service is found to be unenforceable or invalid, that provision shall be limited or eliminated to the minimum extent necessary so that these Terms of Service shall otherwise remain in full force and effect and enforceable. Uno reserves the right to investigate complaints or reported violations of these Terms of Service and to take any action we deem necessary and appropriate. Such action may include reporting any suspected unlawful activity to law enforcement officials, regulators, or other third parties. In addition, we may take action to disclose any information necessary or appropriate to such persons or entities relating to user profiles, e-mail addresses, usage history, posted materials, IP addresses and traffic information. Uno reserves the right to seek all remedies available at law and in equity for violations of these Terms of Service. These Terms of Service are not assignable, transferable or sub-licensable by you except with Uno&#39;s prior written consent. The section titles in these Terms of Service are for convenience only and have no legal or contractual effect. These Terms of Service include Uno&#39;s acceptable use policy for Content posted on the Uno Site, Uno&#39;s Privacy Policy, and any notices regarding the Uno Site.</p>\n<p>\n	<br />\n	<strong>18. Contact and Violations.</strong><br />\n	Please contact us with any questions regarding these Terms of Service. Please report any violations of the Terms of Service to info@uno.com.np</p>\n<p>\n	<br />\n	<strong>19. Mark.</strong><br />\n	Uno is a proprietary registered trade mark of Uno Internet Ventures, GPO Box-470, Kuleshwor, kathmandu, Nepal.</p>\n', '0', 'Terms & Condition', 'Terms & Condition', 'Terms & Condition', 'Terms & Condition', 1, 1, 1, 0),
(44, 'advertise_with_us', 'Advertise With Us', '<p>\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', '0', 'Advertise With Us', 'Advertise With Us', 'Advertise With Us', 'Advertise With Us', 1, 0, 0, 0),
(45, 'how_it_works', 'How It Works', '<p>\n	<span style=\\"font-size:14px;\\"><strong>How to create a Business/Professional Page in Uno</strong></span><br />\n	<br />\n	<strong>Tips to create a great business information page on Uno:</strong><br />\n	In a few short steps you can build the most comprehensive information page for your business. This Business Listing feature is totally FREE for business owners or their authorised representatives. You don&#39;t have to pay any hosting, maintenance, or bandwidth costs.</p>\n<p>\n	Uno allows you to enrich your business listing by adding business description, operating hours, contact information, products or services, photo galleries (premium feature), price list / menu (premium feature)&nbsp;etc.</p>\n<p>\n	&nbsp;</p>\n<p>\n	<strong>To add your business on Uno follow these simple steps:</strong><br />\n	Click on the Register link.<br />\n	Fill out your basic details.</p>\n<p>\n	If you are doing this for the first time, you&#39;ll be asked to verify your by clicking on the link you receive in your email. Uno account holder can directly Sign In with their Uno ID and Password.<br />\n	Once you have verified or signed in, you can begin enhancing your business information page. Uno gives you many ways to enrich your business information, these include:<br />\n	<br />\n	<strong>Business Name:</strong> This is the official/registered name of your business.<br />\n	<strong><br />\n	Business Address:</strong> The address should look exactly the way you&#39;d write it on a paper mailing envelope. Uno also lets you plot your address easily on the map. Tip: With a landmark and exact location on map, it becomes easy for customers to locate your business.Contact Details: Be sure to include atleast one contact number. You can add mobile, landline, fax, and toll-free numbers of your business.<br />\n	<br />\n	<strong>Tip:</strong> It&#39;s always good to specify all contact numbers through which customers can reach your business.Operating Hours: These are the working hours during which your business stays open.<br />\n	<br />\n	<strong>Tip: </strong>Customers are more likely to get in touch with you if they know your operating hoursProducts/ Services: These are the products manufactured, sold, serviced by your business. You can even add services offered by your business.<br />\n	<br />\n	<strong>Tip:</strong> Make sure your product/service page has all relevant products and services. This helps more people explore your business, and hence more sales leads.Business Description: A comprehensive description of your business introduces customers to your business.<br />\n	<br />\n	<strong>Tip: </strong>Specifying if you are a manufacturer, retailer, service provider, distributor, etc. gives clarity to people searching for your business.<br />\n	Documents: Upload the photos, catalogues, menu cards, promotions related to your business.This feature is only available to Uno Partner Merchants or the Uno Premium Merchants. Please contact Uno Customer Service Department for further details.<br />\n	<br />\n	<strong>Tip:</strong> Uploading your rate card, menu card, work samples ensures visibility of your business amongst potential customers.<br />\n	Sign Up to create an account with Uno and verify your email.</p>\n<p>\n	<br />\n	Once your business details have been verified by us, you can access your Business dashboard.</p>\n', '0', 'How to create a Business/Professional Page in Uno', 'How to create a Business/Professional Page in Uno', 'How to create a Business/Professional Page in Uno', 'How to create a Business/Professional Page in Uno', 1, 1, 1, 0),
(46, 'why_uno', 'Why Uno', '<p>\n	<strong>Why you need to be on Uno?</strong><br />\n	<br />\n	<strong>1. Get direct business leads</strong><br />\n	Get referrals and direct sales leads for your business by having a presence on Uno. Everyday thousands of people use Uno to find manufacturers, distributors, wholesalers and retailers for specific products and services.<br />\n	<br />\n	<br />\n	<strong>2. Enhance your business information</strong><br />\n	It&#39;s very simple to add contact information, business description, operating hours, photos, catalogs, videos and more for your business listing through Uno.<br />\n	<br />\n	<br />\n	<strong>3. Nepal&#39;s leading business platform</strong><br />\n	Uno has become the number one source to discover local businesses by both consumers and other businesses.<br />\n	<br />\n	<br />\n	<strong>4. It&#39;s simple and FREE</strong><br />\n	In a few short steps you can build the most comprehensive information page for your business. This feature is free for business owners or their authorised representatives. You don&#39;t have to pay any hosting, maintenance, or bandwidth costs.</p>\n', 'fix', 'Why you need to be on Uno?', 'Why you need to be on Uno?', 'Why you need to be on Uno?', 'Why you need to be on Uno?', 1, 1, 1, 0),
(47, 'test_1', 'Test', '<p>\r\n	fszgsvdsafc</p>\r\n', '0', 'asdf', 'asdf', 'adsf', 'adsf', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_us`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `weekday_start_time` varchar(20) DEFAULT NULL,
  `weekday_end_time` varchar(20) DEFAULT NULL,
  `weekend_start_time` varchar(20) DEFAULT NULL,
  `weekend_end_time` varchar(20) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `pos_acc` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_contact_us`
--

INSERT INTO `tbl_contact_us` (`id`, `phone`, `fax`, `email`, `weekday_start_time`, `weekday_end_time`, `weekend_start_time`, `weekend_end_time`, `lat`, `lon`, `pos_acc`, `address`) VALUES
(1, '+977-4-000000', '+977-4-000000', 'enquiry@jobportal.com', '9:30', '5:30', '10:00', '1:30', 27.70378886189014, 85.32323308260948, '', 'Putalisadak, Kathmandu 44600, Nepal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_email_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mailtype` varchar(50) NOT NULL,
  `protocol` varchar(50) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(50) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `receive_email` varchar(255) NOT NULL,
  `charset` varchar(50) NOT NULL,
  `newline` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `del_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_email_settings`
--

INSERT INTO `tbl_email_settings` (`id`, `mailtype`, `protocol`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `receive_email`, `charset`, `newline`, `status`, `del_flag`) VALUES
(1, 'html', 'smtp', 'ssl://smtp.gmail.com', 465, 'neetupradhan96@gmail.com', '', 'enquiry@jobportal.com', 'utf-8', '\\r\\n', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_templates`
--

CREATE TABLE IF NOT EXISTS `tbl_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Dumping data for table `tbl_email_templates`
--

INSERT INTO `tbl_email_templates` (`id`, `template_code`, `subject`, `content`, `status`, `del_flag`) VALUES
(1, 'REGISTRATION', 'Your new password!', '<p>\r\n Dear <strong>[EMAIL]</strong>,<br />\r\n  </p>\r\n<div id="cke_pastebin">\r\n Thank you for registering with Uno. Inorder to activate your account</div>\r\n<div id="cke_pastebin">\r\n please click on the link below.</div>\r\n<p>\r\n <strong>[CONFIRM]</strong><br />\r\n <br />\r\n <strong>Support Team<br />\r\n [SITENAME]</strong></p>\r\n', '', 0),
(14, 'FORGOT_PWD', 'Your new password!', '<p>\r\n Dear <strong>[USERNAME]</strong></p>\r\n<p>\r\n Email: <strong>[EMAIL]</strong><br />\r\n  </p>\r\n<p>\r\n Please click on the link below to reset your password.<br />\r\n <br />\r\n <strong>[LINK]</strong></p>\r\n<p>\r\n Support Team<br />\r\n <strong>[SITENAME]</strong></p>\r\n', '', 0),
(53, 'NEWSLETTER_SUBSCRIBED', 'NEWSLETTER_SUBSCRIBED', '<p>\r\n Hey <strong><span [removed] 12px;"> [EMAIL]</span></strong></p>\r\n<p>\r\n  </p>\r\n<p>\r\n Thank you for subscibing our newsletter.<br />\r\n  </p>\r\n<p>\r\n Support Team<br />\r\n <strong>[SITENAME]</strong></p>\r\n', '', 0),
(52, 'NEWSLETTER_UNSUBSCRIBED', 'NEWSLETTER_UNSUBSCRIBED', '<p>\r\n Hey <strong><span [removed] 12px;"> [EMAIL]</span></strong></p>\r\n<p>\r\n  </p>\r\n<p>\r\n Please write msg for successful unsubscribtion<br />\r\n  </p>\r\n<p>\r\n Support Team<br />\r\n <strong>[SITENAME]</strong></p>\r\n', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_experience`
--

CREATE TABLE IF NOT EXISTS `tbl_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `start_year` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `duration_unit` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_experience`
--

INSERT INTO `tbl_experience` (`id`, `user_id`, `position`, `company_name`, `start_year`, `duration`, `duration_unit`, `description`, `del_flag`, `status`) VALUES
(1, 1, 'jr. programmer', 'miracle interface', 2015, '3', 'month', 'Worked on Yii & CI framework developing various kind of hiqh quality easily scalable projects coordinating with a enthuastic team of highly skilled developers. Have a sound working experience of using front end scripting languages such as JavaScript, jQuery, AJAX, CSS, HTML5, along with various 3rd party tools & APIs.', 0, '1'),
(2, 1, 'Freelance Developer', '', 2014, '1', 'year', '', 0, '1'),
(3, 1, 'project coordinater', 'Verisk Information Technologies', 2016, '2', 'year', 'Managed a team of highly skilled developers to develop cross platform device independent applications which are highly scalable as well as backward compatible with devices running on old systems. Has a good experience of dealing with challenging needs of the client and leading a team to build a major project from scratch to finish.', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE IF NOT EXISTS `tbl_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `openings` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `qualification` text NOT NULL,
  `experience` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `job_description` longtext NOT NULL,
  `requirements` longtext NOT NULL,
  `facilities` longtext NOT NULL,
  `published_date` date NOT NULL,
  `deadline_date` datetime NOT NULL,
  `application_procedure` longtext NOT NULL,
  `del_flag` tinyint(11) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`id`, `employer_id`, `title`, `position`, `openings`, `city`, `qualification`, `experience`, `category`, `job_description`, `requirements`, `facilities`, `published_date`, `deadline_date`, `application_procedure`, `del_flag`, `status`) VALUES
(1, 3, 'PHP Developers', 'Jr. Programmer', 2, 'Kathmandu', 'BE Computer or related field', '1 Yr', 'Backend Programmer', 'Must be able to work in a team of 5-6 developers', 'Must Possess the following skills & knowledge.\r\n Knowledge of any MVC frameworks Laravel or Yii preferred. ', 'Annual Medical Insurance worth Rs.5000', '2015-11-06', '2015-11-12 00:00:00', 'mail your application with your recently updated resume to employer@employer.com', 0, '1'),
(2, 3, 'Javascript Developer', 'Sr. Programmer', 1, 'Lalitpur', 'Your skills matter more to us than ur qualification', '2', 'Front End Programmer', 'Must be able to develop highly interactive webpages using js, jquery or other front end scripting tools.', 'Sound knowledge of using front end scripting tools such as js, css etc', '', '2015-11-03', '2015-11-10 00:00:00', 'Apply online from the jobportal site.', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_category`
--

CREATE TABLE IF NOT EXISTS `tbl_job_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_job_category`
--

INSERT INTO `tbl_job_category` (`id`, `name`, `del_flag`, `status`) VALUES
(1, 'php1', 0, 'active'),
(2, 'csv', 0, 'inactive'),
(3, 'sdfdfsg', 1, '1'),
(4, 'dsaf', 1, '1'),
(5, 'sdf', 1, '1'),
(6, 'sdfgsfdg', 1, '1'),
(7, 'sdfhgfd', 1, '1'),
(8, 'dsafasd', 1, '1'),
(9, 'dsfds', 1, '1'),
(10, 'cat1', 1, '1'),
(11, 'PHP Programmer', 0, 'active'),
(12, 'Front End JavaScript Programmer', 0, 'active'),
(13, 'Java Programmer', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE IF NOT EXISTS `tbl_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `del_flag` tinyint(11) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_newsletter`
--

INSERT INTO `tbl_newsletter` (`id`, `subject`, `content`, `del_flag`, `status`) VALUES
(8, 'Test Letter', '<p>\r\n	Test Letter</p>\r\n', 1, '1'),
(7, 'Test Newsletter', '<p>\r\n	This is a <strong>Test </strong>newsletter from the <strong><em><u>JobPortal </u></em></strong>site.</p>\r\n<p>\r\n	Thanks.</p>\r\n', 1, '1'),
(6, 'Test Newsletter', '<p>\r\n	This is a <strong>Test </strong>newsletter from the <strong><em><u>JobPortal </u></em></strong>site.</p>\r\n<p>\r\n	Thanks.</p>\r\n', 0, '0'),
(9, 'Test 4', '<p>\r\n	gsh</p>\r\n', 1, '1'),
(10, 'Test 4', '<p>\r\n	gfxjs</p>\r\n', 1, '1'),
(11, 'dsaf', '', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qualification`
--

CREATE TABLE IF NOT EXISTS `tbl_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `completion_date` year(4) NOT NULL,
  `gpa_pct` float NOT NULL,
  `remarks` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `del_flag` tinyint(11) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_qualification`
--

INSERT INTO `tbl_qualification` (`id`, `degree`, `institution`, `completion_date`, `gpa_pct`, `remarks`, `user_id`, `del_flag`, `status`) VALUES
(1, 'SLC', 'abc', 2009, 75, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.', 1, 0, '1'),
(2, '+2 Mgmt', 'def', 2011, 70, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.', 1, 0, '0'),
(3, 'SLC', 'xyz', 2009, 72, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.', 2, 0, '0'),
(4, '+2 Mgmt', 'pqr', 2011, 69, '', 2, 0, '1'),
(5, 'bit', 'pu', 2012, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.', 2, 0, '1'),
(6, 'bim', 'nccs', 2013, 3.7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.', 1, 0, '1'),
(7, 'me', 'tu', 2013, 65, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.', 2, 0, '1'),
(8, 'msc', 'ku', 2014, 70, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.', 1, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_site_settings` (
  `site_id` int(2) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_title` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `site_slogan` text COLLATE utf8_unicode_ci,
  `meta_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `site_authors` text COLLATE utf8_unicode_ci NOT NULL,
  `site_offline_msg` text COLLATE utf8_unicode_ci,
  `site_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_status` tinyint(4) DEFAULT '1',
  `encoder` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'blackevi',
  `google_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eblogger` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slider` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '£',
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `per_page` int(11) NOT NULL,
  `map` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zoom` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `default_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'demo@uno.com',
  `default_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '654321',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_site_settings`
--

INSERT INTO `tbl_site_settings` (`site_id`, `site_name`, `site_title`, `logo`, `site_slogan`, `meta_description`, `meta_keywords`, `site_authors`, `site_offline_msg`, `site_email`, `site_status`, `encoder`, `google_code`, `facebook`, `twitter`, `youtube`, `eblogger`, `googleplus`, `linkedin`, `slider`, `currency`, `paypal_email`, `currency_code`, `phone`, `per_page`, `map`, `zoom`, `default_email`, `default_password`) VALUES
(1, 'Job Portal', 'Job Portal - Hire or Get Hired', 'fd1225410e87f31aaad72a59d7e4446e.JPG', 'The Coolest & the Hottest Jobs for You', 'Job Portal, the leading job listing site.', 'Job Portal is an online job listing site where employees and employers find the best for each other.', 'Job Portal - Team', '<p>\r\n The Site is Currently Offline and Under Maintenance.</p>\r\n<p>\r\n Please visit back later.</p>\r\n<p>\r\n Thank You.</p>\r\n<p>\r\n - Job Portal</p>\r\n', 'jobportal@jobportal.com', 1, 'tuesdaystore', '', 'http://facebook.com/jobportal', 'http://twitter.com/jobportal', 'http://www.youtube.com/jobportal', 'http://www.youtube.com', 'http://www.youtube.com', 'http://www.youtube.com', '3', '£', '0', '0', '1111111111111', 12, '27.701806,85.311906', '15', 'demo@uno.com', '654321');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`id`, `name`, `category_id`, `del_flag`, `status`) VALUES
(1, 'php', 11, 1, '1'),
(2, 'csv1', 2, 1, '1'),
(3, '.net', 10, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag_map_experience`
--

CREATE TABLE IF NOT EXISTS `tbl_tag_map_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `experience_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag_map_job`
--

CREATE TABLE IF NOT EXISTS `tbl_tag_map_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob_estd` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_type` varchar(255) NOT NULL,
  `profile` longtext NOT NULL,
  `benefits` longtext NOT NULL,
  `website` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `newsletter_subscription` tinyint(4) NOT NULL,
  `pw_reset_key` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `password`, `f_name`, `l_name`, `gender`, `dob_estd`, `address`, `company_type`, `profile`, `benefits`, `website`, `marital_status`, `phone`, `user_type`, `newsletter_subscription`, `pw_reset_key`, `image`, `del_flag`, `status`) VALUES
(1, 'neetupradhan96@gmail.com', '12345', 'Neetu', 'Pradhan', 'F', '2000-12-06', 'Sanepa', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'qaz', 'aa', '0', '9800000000', '0', 1, 'aa', 'test2.jpg', 0, '1'),
(2, 'acharya.rajanpkr@gmail.com', '111111', 'Rajan', 'Acharya', 'M', '2000-12-12', 'Kathmandu', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'asd', 'asd', '0', '9800000000', '0', 1, 'aa', 'test.jpg', 0, '1'),
(3, 'neetupradhan96@hotmail.com', '111111', 'Neetu', 'Pradhan', 'f', '2003-12-06', 'Lalitpur', '', '', '', '', '0', '1111111', '2', 0, '', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_jobs`
--

CREATE TABLE IF NOT EXISTS `tbl_user_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applied_date` date NOT NULL,
  `del_flag` tinyint(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
