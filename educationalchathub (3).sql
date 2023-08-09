-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 06:13 PM
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
-- Database: `educationalchathub`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `content`, `file_path`, `publish_date`, `author_id`, `category_id`) VALUES
(9, 'The Future of Artificial Intelligence: Transforming Industries and Society', 'Artificial Intelligence (AI) has rapidly evolved in recent years, revolutionizing industries and impacting various aspects of society. From self-driving cars to virtual assistants, AI is transforming the way we live and work. This article explores the current state of AI and its potential future implications.\r\n\r\nAI encompasses the development of intelligent machines that can perform tasks that typically require human intelligence. Machine learning algorithms enable these systems to learn from data and improve their performance over time. As a result, AI has found applications in diverse fields such as healthcare, finance, manufacturing, and entertainment.\r\n\r\nOne of the most significant impacts of AI can be seen in healthcare. AI-powered diagnostic tools can analyze medical images with remarkable accuracy, aiding doctors in early detection of diseases like cancer. Intelligent algorithms can also process vast amounts of patient data to identify patterns and predict disease outcomes, leading to more personalized and effective treatment plans.\r\n\r\nIn the finance industry, AI algorithms are transforming trading and investment strategies. High-frequency trading systems use AI to analyze market data and make split-second decisions, optimizing trading outcomes. AI-powered chatbots are also enhancing customer service by providing personalized recommendations and assisting with financial planning.\r\n\r\nManufacturing is another sector benefiting from AI advancements. Smart factories leverage AI to optimize production processes, reduce downtime, and improve overall efficiency. AI-powered robots and cobots (collaborative robots) are capable of performing complex tasks with precision, increasing productivity and quality control.\r\n\r\nAI is also shaping the entertainment industry. Streaming platforms like Netflix and Amazon Prime use AI algorithms to recommend personalized content based on user preferences and viewing history. Virtual reality (VR) and augmented reality (AR) experiences are enhanced through AI, creating immersive and interactive environments.\r\n\r\nLooking ahead, the future of AI holds immense potential. Advancements in AI research and technology will likely lead to breakthroughs in areas such as natural language processing, computer vision, and robotics. AI-driven autonomous vehicles are poised to transform transportation, reducing accidents and traffic congestion. The integration of AI and Internet of Things (IoT) devices will further enhance the concept of a connected and intelligent world.\r\n\r\nHowever, along with the promises, there are challenges and ethical considerations associated with AI. Issues such as data privacy, algorithmic bias, and the impact on the job market need careful attention. As AI becomes more prevalent, it is crucial to ensure responsible development and usage, prioritizing transparency and fairness.\r\n\r\nIn conclusion, AI is rapidly transforming industries and society as a whole. From healthcare to finance, manufacturing to entertainment, its impact is undeniable. As AI continues to advance, it is essential to address the challenges and foster responsible AI development to harness its full potential for the betterment of humanity.', 'uploads/robot-g5e0ff7256_1920.jpg', '2023-07-06', 5, 4),
(10, 'Unveiling the Fight Against Cancer: Progress, Challenges, and Hope', 'Introduction:\r\n\r\nCancer, an intricate and formidable disease, continues to be one of the most significant health challenges of our time. Its impact is felt worldwide, affecting millions of lives and causing immeasurable suffering. However, amidst the shadows cast by this formidable adversary, there is a glimmer of hope. Over the years, remarkable strides have been made in cancer research, treatment, and prevention. In this article, we delve into the current landscape of cancer, discussing both the progress made and the challenges that lie ahead.\r\n\r\nUnderstanding Cancer:\r\n\r\nCancer is a complex collection of diseases characterized by the uncontrolled growth and spread of abnormal cells. It can affect virtually any part of the body and has the potential to invade surrounding tissues and organs. Causes of cancer are multifactorial, including genetic predisposition, exposure to carcinogens, unhealthy lifestyles, and certain infections.\r\n\r\nProgress in Cancer Research and Treatment:\r\n\r\nThe realm of cancer research has witnessed remarkable breakthroughs in recent years, offering hope for improved treatments and outcomes. Precision medicine, fueled by advancements in genomics and molecular biology, has paved the way for personalized cancer therapies. Tailoring treatments based on an individual\'s unique genetic profile has shown promising results in optimizing treatment efficacy and minimizing side effects.\r\n\r\nImmunotherapy, a groundbreaking approach that harnesses the body\'s immune system to fight cancer, has revolutionized cancer treatment. Checkpoint inhibitors, chimeric antigen receptor T-cell (CAR-T) therapy, and therapeutic vaccines are just a few examples of the diverse immunotherapeutic strategies being developed and refined.\r\n\r\nFurthermore, targeted therapies have emerged as a powerful weapon against specific cancer types. These therapies aim to inhibit the growth and spread of cancer cells by targeting specific molecules or pathways crucial for their survival. They have demonstrated remarkable success in several cancers, including breast, lung, and melanoma.\r\n\r\nEarly detection and screening programs have also played a crucial role in reducing cancer mortality rates. Techniques such as mammography, colonoscopy, and Pap smears have allowed for the identification of precancerous and early-stage tumors when they are more treatable.\r\n\r\nChallenges and Unmet Needs:\r\n\r\nDespite the significant progress, cancer research and treatment face numerous challenges. One major hurdle is the inherent complexity and heterogeneity of cancer itself. Each cancer type exhibits unique characteristics, making it challenging to find universal solutions. Developing effective therapies for rare cancers remains a particularly arduous task due to limited data and resources.\r\n\r\nAdditionally, resistance to treatments poses a significant obstacle. Cancer cells can develop mechanisms to evade therapies, leading to relapse or treatment failure. Overcoming drug resistance requires a deeper understanding of the underlying molecular mechanisms and the development of novel therapeutic approaches.\r\n\r\nFurthermore, access to quality cancer care and treatments remains a pressing concern, especially in low- and middle-income countries. Disparities in healthcare infrastructure, affordability, and education hinder effective cancer control efforts, leading to higher mortality rates in underserved populations.\r\n\r\nHope for the Future:\r\n\r\nAmidst the challenges, there is an abundance of hope for the future. Advances in technology, such as artificial intelligence and machine learning, are revolutionizing cancer research and diagnosis. These technologies can analyze vast amounts of data, identify patterns, and provide personalized treatment recommendations.\r\n\r\nThe emerging field of liquid biopsies shows promise in cancer detection and monitoring. By analyzing circulating tumor cells and DNA fragments in blood samples, liquid biopsies offer a non-invasive alternative to traditional tissue biopsies and provide real-time information on treatment response and disease progression.\r\n\r\nCollaborative efforts and data sharing among researchers, institutions, and countries are crucial in accelerating progress. Global initiatives, such as the World Health Organization\'s Cancer Control Program, aim to address the growing burden of cancer worldwide through prevention, early detection, and access to treatmentConclusion:\r\n\r\nCancer remains a formidable foe, but the landscape of cancer research and treatment is evolving at an unprecedented pace. Significant progress has been made in understanding the molecular basis of cancer, developing targeted therapies, harnessing the immune system, and improving early detection and screening programs. Challenges persist, including the complexity of cancer, treatment resistance, and disparities in healthcare access. However, the future holds great promise with advancements in precision medicine, immunotherapy, technology-driven diagnostics, and collaborative global efforts.\r\n\r\nAs we move forward, it is crucial to prioritize cancer prevention through education and lifestyle modifications, enhance early detection strategies, and ensure equitable access to high-quality cancer care for all. By combining scientific innovation, compassion, and a united global effort, we can continue to unveil new weapons in the fight against cancer, offering hope to millions of individuals and their families affected by this devastating disease.', 'uploads/R.png', '2023-07-06', 7, 4),
(14, 'Honeycomb', 'A honeycomb is a mass of hexagonal prismatic cells built from wax by honey bees in their nests to contain their brood (eggs, larvae, and pupae) and stores of honey and pollen.\r\n\r\nBeekeepers may remove the entire honeycomb to harvest honey. Honey bees consume about 8.4 lb (3.8 kg) of honey to secrete 1 lb (450 g) of wax,[1] and so beekeepers may return the wax to the hive after harvesting the honey to improve honey outputs. The structure of the comb may be left basically intact when honey is extracted from it by uncapping and spinning in a centrifugal machine, more specifically a honey extractor. If the honeycomb is too worn out, the wax can be reused in a number of ways, including making sheets of comb foundation with hexagonal pattern. Such foundation sheets allow the bees to build the comb with less effort, and the hexagonal pattern of worker-sized cell bases discourages the bees from building the larger drone cells. Fresh, new comb is sometimes sold and used intact as comb honey, especially if the honey is being spread on bread rather than used in cooking or as a sweetener.\r\n\r\nBroodcomb becomes dark over time, due to empty cocoons and shed larval skins embedded in the cells, alongside being walked over constantly by other bees, resulting in what is referred to as a \'travel stain\'[2] by beekeepers when seen on frames of comb honey. Honeycomb in the \"supers\" that are not used for brood (e.g. by the placement of a queen excluder) stays light-colored.\r\n\r\nNumerous wasps, especially Polistinae and Vespinae, construct hexagonal prism-packed combs made of paper instead of wax; in some species (such as Brachygastra mellifica), honey is stored in the nest, thus technically forming a paper honeycomb. However, the term \"honeycomb\" is not often used for such structures.', 'uploads/R (2).jpeg', '2023-07-21', 7, 4),
(15, 'Rabies', 'Rabies is a viral disease that causes encephalitis in humans and other mammals.[1] It was historically referred to as hydrophobia (\"fear of water\") due to the symptom of panic when presented with liquids to drink. Early symptoms can include fever and tingling at the site of exposure.[1] These symptoms are followed by one or more of the following symptoms: nausea, vomiting, violent movements, uncontrolled excitement, fear of water, an inability to move parts of the body, confusion, and loss of consciousness.[1][7][8][9] Once symptoms appear, the result is virtually always death, regardless of treatment.[1] The time period between contracting the disease and the start of symptoms is usually one to three months but can vary from less than one week to more than one year.[1] The time depends on the distance the virus must travel along peripheral nerves to reach the central nervous system.[10]\r\n\r\nRabies is caused by lyssaviruses, including the rabies virus and Australian bat lyssavirus.[4] It is spread when an infected animal bites or scratches a human or other animals.[1] Saliva from an infected animal can also transmit rabies if the saliva comes into contact with the eyes, mouth, or nose.[1] Globally, dogs are the most common animal involved.[1] In countries where dogs commonly have the disease, more than 99% of rabies cases are the direct result of dog bites.[11] In the Americas, bat bites are the most common source of rabies infections in humans, and less than 5% of cases are from dogs.[1][11] Rodents are very rarely infected with rabies.[11] The disease can be diagnosed only after the start of symptoms.[1]\r\n\r\nAnimal control and vaccination programs have decreased the risk of rabies from dogs in a number of regions of the world.[1] Immunizing people before they are exposed is recommended for those at high risk, including those who work with bats or who spend prolonged periods in areas of the world where rabies is common.[1] In people who have been exposed to rabies, the rabies vaccine and sometimes rabies immunoglobulin are effective in preventing the disease if the person receives the treatment before the start of rabies symptoms.[1] Washing bites and scratches for 15 minutes with soap and water, povidone-iodine, or detergent may reduce the number of viral particles and may be somewhat effective at preventing transmission.[1][12] As of 2016, only fourteen people were documented to have survived a rabies infection after showing symptoms.[13][14] However, research conducted in 2010 among a population of people in Peru with a self-reported history of one or more bites from vampire bats (commonly infected with rabies), found that out of 73 individuals reporting previous bat bites, seven people had rabies virus-neutralizing antibodies (rVNA).[15] Since only one member of this group reported prior vaccination for rabies, the findings of the research suggest previously undocumented cases of infection and viral replication followed by an abortive infection. This could indicate that in rare cases people may have an exposure to the virus without treatment and develop natural antibodies as a result.\r\n\r\nRabies causes about 59,000 deaths worldwide per year,[6] about 40% of which are in children under the age of 15.[16] More than 95% of human deaths from rabies occur in Africa and Asia.[1]\r\n\r\nRabies is present in more than 150 countries and on all continents but Antarctica.[1] More than 3 billion people live in regions of the world where rabies occurs.[1] A number of countries, including Australia and Japan, as well as much of Western Europe, do not have rabies among dogs.[17][18] Many Pacific islands do not have rabies at all.[18] It is classified as a neglected tropical disease.[19]', 'uploads/R (3).jpeg', '2023-07-21', 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `type`) VALUES
(4, 'Discover'),
(5, 'Black lives'),
(6, 'wew'),
(7, 'Aging'),
(8, 'School'),
(9, 'sports'),
(10, 'health'),
(11, 'News'),
(12, 'Current affairs'),
(13, 'social'),
(14, 'hjunui'),
(15, 'dsdas'),
(16, 'dsdqsa');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `content`, `file_path`, `publish_date`, `author_id`, `category_id`) VALUES
(1, 'Black Lives Matter Protests', 'the killing of George Floyd, an African American man, by a police officer in Minneapolis, Minnesota, sparked widespread outrage and led to a global movement against racial injustice and police brutality. The incident ignited protests across the United States and in many countries around the world, with demonstrators demanding an end to systemic racism and calling for police reform. The Black Lives Matter movement gained significant momentum and prompted conversations about racial inequality and social justice.', '', '2020-03-20', 7, 5),
(4, 'Age', 'Many countries around the world are experiencing demographic shifts, with the proportion of older adults increasing. This trend is driven by factors such as declining birth rates and improved healthcare, resulting in longer life expectancy. The aging population poses various challenges and opportunities, including healthcare and social support systems, pension schemes, and intergenerational dynamics.', '', '2023-06-07', 5, 7),
(5, 'BRIGHTSTAR PRIMARY', 'Brightstar is a nursery school found in soche east blantyre, it has been a fundament building block for students in blantyre going for primary education, for a while parents of kindergarteners have requested for a primary school under brightstar, now the director has unveiled that in September of 2023 standard 1 will be opening', '', '2023-06-07', 5, 8),
(6, 'Malawi beat Zambia in Cosafa opener', 'A youthful Flames side yesterday gave  Malawians an Independence Day gift after overcoming Hollywoodbets Cosafa Cup defending champions Zambia 1-0 at King Zwelithini Stadium in Umlazi Township in Durban, South Africa.\r\n\r\nAn own-goal from Zambia defender Aaron Katebe gave Malawi a precious victory that might prove decisive in the team’s quest for the first knockout stage qualification since 2019.\r\n\r\nInterim coach Patrick Mabedi said losing on Malawian’s Independence Day was not an option.\r\n\r\nThe former Kaizer Chiefs coach started first choice goalkeeper Brighton Munthali, right back Stanley Sanudi, Nickson Mwase and Dennis Chembezi in central defence while  Alick Lungu played on the leftback position.\r\n\r\nLloyd Aaron partnered Chimwemwe Idana in midfield while Robert Saizi was on the right wing  and Chawanangwa Kaonga played wide on the left.\r\n\r\nLanjesi Nkhoma and Christopher Kumwembe led the attack.\r\n\r\nJoint TNM Super League current joint top scorer Lanjesi Nkhoma played behind  Zambia-based Chawanangwa Kaonga and  Christopher Kumwembe.\r\n\r\nThe team played a 3-5-2 formation, a system that gives more room for adjustments to 4-4-2 or 4-5-1, both when attacking and defending.\r\n\r\nThat is the formation that gave the Zambians a tough time as the Flames tormented Chipolopolo at will.\r\n\r\nNo wonder Zambia ended up conceding an own goal after two consecutive corners from Saizi.\r\n\r\nHowever, Comoros are on top of Group B following their 3-0 victory over Seychelles.\r\n\r\nThey top the pool with three points followed by Malawi on second and Zambia on third while Seychelles are fourth.\r\n\r\nIn a post-match interview, Mabedi saluted his charges for breaking the jinx.\r\n\r\n“You can’t believe this that we had one training session. It’s amazing these guys put up a good effort and worked so hard as there was a lot at stake as Malawi was celebrating Independence Day today. We had to stop the losing curse to Zambia.  I told the players to go out and play,” he said.\r\n\r\nZambia’s assistant coach Moses Sichone, who has taken charge of the team, said: “Malawi deserved to win. They played better than us. We made a lot of mistakes and we were punished.”\r\n\r\nOn Sunday, Malawi face Seychelles and wraup their group matches on Tuesday.', '', '2023-07-06', 5, 9),
(9, 'World Bank warns Malawi on barter', 'The World Bank has said Malawi is unlikely to benefit from barter arrangements with private firms and other countries.\r\n\r\nThe caution by the World Bank follows recent revelations that, on May 18 2023, Malawi signed a fertiliser deal with Romanian firm East Bridge Estate SRL, which could see the country shipping out produce worth nearly K500 billion.\r\n\r\nIt also follows reports that Malawi is working on a similar arrangement with the government of Egypt.\r\n\r\nRecently, the Public Procurement and Disposal of Assets Authority said Malawi does not have a legal framework for barter.\r\n\r\nAnd, in its 17th Malawi Economic Monitor (Mem) released on Wednesday, the bank says barter arrangements are unlikely to address the fact that Malawi’s exports are of little value, such that they cannot support its imports.\r\n\r\nThe Mem says, typically, countries resort to bartering when they are restricted from the international financial system or when they are highly indebted and commodities have superior credit enforcement properties.\r\n\r\nAccording to the bank, it is unlikely that Malawi would gain from barter relative to currency-based exchange, as money, “as an easily comprehensible unit of account”, introduces advantages of transparency.\r\n\r\nThe bank says money removes the requirement of coincidence of wants— that is, trading parties have something on offer of value for the other party.\r\n\r\n“[Money] removes some of the incentive[s] to deliver low-quality goods (a common problem in barter arrangements) and tends to be a better store of value (money can easily be transferred and invested while goods often lose value when not needed immediately),” the bank says.\r\n\r\nInitially, East Bridge was expected to supply 600,000 metric tonnes (mt) of fertiliser to Malawi.\r\n\r\nBut Finance Minister Sosten Gwengwe recently said Cabinet recommended the halving of the quantities.\r\n\r\nIn that case, East Bridge will supply 300,000mt of fertiliser in two batches of 150,000mt each valued at $124.5 million.\r\n\r\n“Cabinet reduced the quantities to half and directed that two SGs [sovereign guarantees] of $124.5 million be issued,” he said.\r\n\r\nA section of the commodity exchange agreement reads: “The contract between the parties, being a Commodity Exchange based arrangement, the parties have agreed that the seller will accept the below commodities at the below agreed prices as payment in respect of the fertilisers. Further, the purchaser will aggregate for the seller the commodities in the quantities.”\r\n\r\nUnder the agreement, Malawi will pay are as follows: 250,000mt of soya beans at $528 per mt, which translates into $132,000,000 (K132 billion); 250,000mt of groundnuts at $725 per mt, costing $181,250,000 (K181.25 billion); 200,000mt of pigeon peas at $365 per tonne making $73 million (K73 billion).\r\n\r\nIt will also deliver 50,000mt of rice at $370 per tonne, making $18.5 million (K18.5 billion); 25,000mt of sugar at $483 per tonne making $12.075 million (K12 billion); 50,000mt of sorghum at $295 per tonne making $14.750 million (K14.7 billion) and 25,000mt of cotton at $785 per tonne translating into $19.625 million (K19.6 billion), among other crops.\r\n\r\nHowever, agriculture policy expert Leonard Chimwaza said barter is practical in the country.\r\n\r\n“In trade, barter system is often established as a means of maintaining the trading of goods and services as well as a means of helping a country function. This usually occurs if physical money is not available or if a country sees hyperinflation or a deflationary spiral as is the case in Malawi currently.\r\n\r\n“However, we, as a country, need to be careful on risk management, which is an integral part of honouring this contractual agreement. The country needs to be very cautious of the market forces, inflation and natural disasters,” Chimwaza said.\r\n\r\n', 'upload/sosten-gwengwe-1-860x741.jpg', '2023-07-21', 7, 12),
(10, 'Regular Extra Polio Vaccines Key to Ending the Disease-Expert', 'Professor Adamson Muula’s advice comes after the ministry of health said it had vaccinated 9.2 million children against polio during the first phase of the 2023 supplementary polio immunization campaign.\r\n\r\nHe told Zodiak that provision of supplementary polio vaccines has shown to be effective in dealing with the disease.\r\n\r\n“This experience has shown us that these campaigns need to be regular. This year it’s been rolled out, we may have to count maybe three or four years from now then we have another campaign and go on and on to the extent that in the end polio is eliminated,” said Professor Muula.\r\n\r\nThe ministry of health carried out a four days supplementary polio immunization campaign first phase from 12 to 15 July targeting 8, 863,785 children under the age of fifteen across the country.', 'upload/fcade637289b660479a7120e9cf412b6_L.jpg', '2023-07-23', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(5, 'administrator'),
(7, 'administrator'),
(8, 'user'),
(9, 'user'),
(10, 'user'),
(11, 'administrator'),
(12, 'moderator'),
(13, 'moderator'),
(14, 'moderator'),
(15, 'administrator'),
(16, 'user'),
(17, 'moderator'),
(19, 'moderator'),
(20, 'user'),
(21, 'superadministrator'),
(23, 'user'),
(24, 'administrator'),
(25, 'administrator'),
(26, 'administrator'),
(27, 'user'),
(28, 'user'),
(29, 'moderator'),
(30, 'user'),
(31, 'user'),
(32, 'user'),
(33, 'user'),
(34, 'user'),
(35, 'moderator'),
(36, 'user'),
(37, 'moderator'),
(38, 'user'),
(39, 'user'),
(40, 'administrator'),
(41, 'administrator'),
(42, 'administrator'),
(43, 'administrator'),
(44, 'administrator'),
(45, 'moderator'),
(46, 'user'),
(47, 'user'),
(48, 'moderator'),
(49, 'moderator'),
(50, 'moderator'),
(51, 'user'),
(52, 'superadministrator'),
(53, 'superadministrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `fullname`, `phone_number`, `gender`, `role_id`, `created_at`) VALUES
(5, 'madalo', '$2y$10$HMPNWVRPLecjdUOHrQ.GxepdaeWfA1MpZu.q7hPJv505/iKreRc7i', 'stanfordperenje@gmail.com', 'Stan jacobs', '+265993616223', 'male', 5, '2023-07-06'),
(7, 'jacq', '$2y$10$yuNSivTy4tjo.q83kcpjOO80DjTi37c2D1I9amBoZ/0ZTS8AcR/j2', 'herokutester@gmail.com', 'heroku', '+265993616223', 'female', 7, '2023-07-06'),
(38, 'regular', '$2y$10$C7/iR.mlJOUh7ufzVa4K.ep40kGvKyCxK8FmckILV0Yp8M3cdMmC2', 'regular@gmail.com', 'suhdasudnaks', '121312321323', 'male', 5, '2023-07-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `articles_ibfk_1` (`author_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `comments_ibfk_2` (`user_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `news_ibfk_1` (`author_id`),
  ADD KEY `news_ibfk_2` (`category_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
