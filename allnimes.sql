-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2021 às 22:53
-- Versão do servidor: 8.0.26
-- versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `allnimes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` text NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `username`) VALUES
(1, 'joaopdante@gmail.com', '$2y$10$/93FZNhcYckio63GfXBN4O0.K7e5eqrMiDfqrQ5w5ZgqpMcp/f.yG', 'Ellisiumx');

-- --------------------------------------------------------

--
-- Estrutura da tabela `already_read`
--

CREATE TABLE `already_read` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `manga_id` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `already_watched`
--

CREATE TABLE `already_watched` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `anime_id` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `already_watched`
--

INSERT INTO `already_watched` (`id`, `account_id`, `anime_id`, `creation_date`) VALUES
(12, 1, 42, '2021-11-30 21:14:10'),
(13, 1, 41, '2021-11-30 21:14:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `anime`
--

CREATE TABLE `anime` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` text NOT NULL,
  `kitsu_id` int NOT NULL,
  `type` int NOT NULL,
  `age_group` int NOT NULL,
  `release_date` date NOT NULL,
  `score` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `anime`
--

INSERT INTO `anime` (`id`, `name`, `full_name`, `description`, `picture`, `kitsu_id`, `type`, `age_group`, `release_date`, `score`) VALUES
(1, 'Re:ZERO -Starting Life in Another World-', 'Re:Zero kara Hajimeru Isekai Seikatsu', 'When Subaru Natsuki leaves the convenience store, the last thing he expects is to be wrenched from his everyday life and dropped into a fantasy world. Things aren\'t looking good for the bewildered teenager; however, not long after his arrival, he is attacked by some thugs. Armed with only a bag of groceries and a now useless cell phone, he is quickly beaten to a pulp. Fortunately, a mysterious beauty named Satella, in hot pursuit after the one who stole her insignia, happens upon Subaru and saves him. In order to thank the honest and kindhearted girl, Subaru offers to help in her search, and later that night, he even finds the whereabouts of that which she seeks. But unbeknownst to them, a much darker force stalks the pair from the shadows, and just minutes after locating the insignia, Subaru and Satella are brutally murdered.\n\nHowever, Subaru immediately reawakens to a familiar scene—confronted by the same group of thugs, meeting Satella all over again—the enigma deepens as history inexplicably repeats itself.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/11209/original.jpg', 11209, 0, 2, '2016-04-04', 0),
(2, 'That Time I Got Reincarnated as a Slime', 'Tensei shitara Slime Datta Ken', 'Corporate worker Mikami Satoru is stabbed by a random killer, and is reborn to an alternate world. But he turns out to be reborn a slime! Thrown into this new world with the name Rimuru, he begins his quest to create a world that’s welcoming to all races.\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/41024/original.jpg', 41024, 0, 1, '2018-10-02', 0),
(3, 'Fullmetal Alchemist: Brotherhood', 'Fullmetal Alchemist: Brotherhood', '\"In order for something to be obtained, something of equal value must be lost.\"\n\nAlchemy is bound by this Law of Equivalent Exchange—something the young brothers Edward and Alphonse Elric only realize after attempting human transmutation: the one forbidden act of alchemy. They pay a terrible price for their transgression—Edward loses his left leg, Alphonse his physical body. It is only by the desperate sacrifice of Edward\'s right arm that he is able to affix Alphonse\'s soul to a suit of armor. Devastated and alone, it is the hope that they would both eventually return to their original bodies that gives Edward the inspiration to obtain metal limbs called \"automail\" and become a state alchemist, the Fullmetal Alchemist.\n\nThree years of searching later, the brothers seek the Philosopher\'s Stone, a mythical relic that allows an alchemist to overcome the Law of Equivalent Exchange. Even with military allies Colonel Roy Mustang, Lieutenant Riza Hawkeye, and Lieutenant Colonel Maes Hughes on their side, the brothers find themselves caught up in a nationwide conspiracy that leads them not only to the true nature of the elusive Philosopher\'s Stone, but their country\'s murky history as well. In between finding a serial killer and racing against time, Edward and Alphonse must ask themselves if what they are doing will make them human again... or take away their humanity.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/3936/original.png', 3936, 0, 2, '2009-04-05', 0),
(4, 'Death Note', 'Death Note', 'A shinigami, as a god of death, can kill any person—provided they see their victim\'s face and write their victim\'s name in a notebook called a Death Note. One day, Ryuk, bored by the shinigami lifestyle and interested in seeing how a human would use a Death Note, drops one into the human realm.\n\nHigh school student and prodigy Light Yagami stumbles upon the Death Note and—since he deplores the state of the world—tests the deadly notebook by writing a criminal\'s name in it. When the criminal dies immediately following his experiment with the Death Note, Light is greatly surprised and quickly recognizes how devastating the power that has fallen into his hands could be.\n\nWith this divine capability, Light decides to extinguish all criminals in order to build a new world where crime does not exist and people worship him as a god. Police, however, quickly discover that a serial killer is targeting criminals and, consequently, try to apprehend the culprit. To do this, the Japanese investigators count on the assistance of the best detective in the world: a young and eccentric man known only by the name of L.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/1376/original.png', 1376, 0, 2, '2006-10-04', 0),
(5, 'The Rising of the Shield Hero', 'Tate no Yuusha no Nariagari', 'Iwatani Naofumi, a run-of-the-mill otaku, finds a book in the library that summons him to another world. He is tasked with joining the sword, spear, and bow as one of the Four Cardinal Heroes and fighting the Waves of Catastrophe as the Shield Hero. \n\nExcited by the prospect of a grand adventure, Naofumi sets off with his party. However, merely a few days later, he is betrayed and loses all his money, dignity, and respect. Unable to trust anyone anymore, he employs a slave named Raphtalia and takes on the Waves and the world. But will he really find a way to overturn this desperate situation?\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/13593/original.jpg', 13593, 0, 1, '2019-01-09', 0),
(6, 'Yu Yu Hakusho: Ghost Files', 'Yuu☆Yuu☆Hakusho', 'One fateful day, Yuusuke Urameshi, a 14-year-old delinquent with a dim future, gets a miraculous chance to turn it all around when he throws himself in front of a moving car to save a young boy. His ultimate sacrifice is so out of character that the authorities of the spirit realm are not yet prepared to let him pass on. Koenma, heir to the throne of the spirit realm, offers Yuusuke an opportunity to regain his life through completion of a series of tasks. With the guidance of the death god Botan, he is to thwart evil presences on Earth as a Spirit Detective.\n\nTo help him on his venture, Yuusuke enlists ex-rival Kazuma Kuwabara, and two demons, Hiei and Kurama, who have criminal pasts. Together, they train and battle against enemies who would threaten humanity\'s very existence.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/359/original.jpg', 359, 0, 1, '1992-10-10', 0),
(7, 'Parasyte -the maxim-', 'Kiseijuu: Sei no Kakuritsu', 'All of a sudden, they arrived: parasitic aliens that descended upon Earth and quickly infiltrated humanity by burrowing into the brains of vulnerable targets. These insatiable beings acquire full control of their host and are able to morph into a variety of forms in order to feed on unsuspecting prey.\n\nSixteen-year-old high school student Shinichi Izumi falls victim to one of these parasites, but it fails to take over his brain, ending up in his right hand instead. Unable to relocate, the parasite, now named Migi, has no choice but to rely on Shinichi in order to stay alive. Thus, the pair is forced into an uneasy coexistence and must defend themselves from hostile parasites that hope to eradicate this new threat to their species.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/8147/original.jpg', 8147, 0, 2, '2014-10-09', 0),
(8, 'The Promised Neverland', 'Yakusoku no Neverland', 'The orphans at Grace Field House have only ever known peace. Their home is nice, their bellies stay full, and their caretaker, Mom, loves them very much. But their world turns upside down when the smartest children of the bunch—Emma, Ray, and Norman—learn what horror awaits them on adoption day. Now, their cultivated wit may be their only chance of survival.\n\n(Source: Funimation)', 'https://media.kitsu.io/anime/poster_images/41312/original.jpg', 41312, 0, 2, '2019-01-11', 0),
(9, 'Attack on Titan', 'Attack on Titan', 'Centuries ago, mankind was slaughtered to near extinction by monstrous humanoid creatures called titans, forcing humans to hide in fear behind enormous concentric walls. What makes these giants truly terrifying is that their taste for human flesh is not born out of hunger but what appears to be out of pleasure. To ensure their survival, the remnants of humanity began living within defensive barriers, resulting in one hundred years without a single titan encounter. However, that fragile calm is soon shattered when a colossal titan manages to breach the supposedly impregnable outer wall, reigniting the fight for survival against the man-eating abominations.\n\nAfter witnessing a horrific personal loss at the hands of the invading creatures, Eren Yeager dedicates his life to their eradication by enlisting into the Survey Corps, an elite military unit that combats the merciless humanoids outside the protection of the walls. Based on Hajime Isayama\'s award-winning manga, Shingeki no Kyojin follows Eren, along with his adopted sister Mikasa Ackerman and his childhood friend Armin Arlert, as they join the brutal war against the titans and race to discover a way of defeating them before the last walls are breached.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/7442/original.jpg', 7442, 0, 2, '2013-04-07', 0),
(10, 'The Legend of the Legendary Heroes', 'Densetsu no Yuusha no Densetsu', '\"Alpha Stigma\" are known to be eyes that can analyze all types of magic. However, they are more infamously known as cursed eyes that can only bring destruction and death to others.\nRyner Lute, a talented mage and also an Alpha Stigma bearer, was once a student of the Roland Empire\'s Magician Academy, an elite school dedicated to training magicians for military purposes. However, after many of his classmates died in a war, he makes an oath to make the nation a more orderly and peaceful place, with fellow survivor and best friend, Sion Astal.\nNow that Sion is the the king of Roland, he orders Ryner to search for useful relics that will aid the nation. Together with Ferris Eris, a beautiful and highly skilled swordswoman, Ryner goes on a journey to search for relics of legendary heroes from the past, and also uncover the secrets behind his cursed eyes.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/5191/original.jpg', 5191, 0, 2, '2010-07-02', 0),
(11, 'My Hero Academia', 'Boku no Hero Academia', 'What would the world be like if 80 percent of the population manifested extraordinary superpowers called “Quirks” at age four? Heroes and villains would be battling it out everywhere! Becoming a hero would mean learning to use your power, but where would you go to study? U.A. High\'s Hero Program of course! But what would you do if you were one of the 20 percent who were born Quirkless?\n\nMiddle school student Izuku Midoriya wants to be a hero more than anything, but he hasn\'t got an ounce of power in him. With no chance of ever getting into the prestigious U.A. High School for budding heroes, his life is looking more and more like a dead end. Then an encounter with All Might, the greatest hero of them all gives him a chance to change his destiny…\n\n(Source: Viz Media)', 'https://media.kitsu.io/anime/poster_images/11469/original.png', 11469, 0, 1, '2016-04-03', 0),
(12, 'Black Clover', 'Black Clover', 'In a world where magic is everything, Asta and Yuno are both found abandoned at a church on the same day. While Yuno is gifted with exceptional magical powers, Asta is the only one in this world without any. At the age of fifteen, both receive grimoires, magic books that amplify their holder\'s magic. Asta\'s is a rare Grimoire of Anti-Magic that negates and repels his opponent\'s spells. Being opposite but good rivals, Yuno and Asta are ready for the hardest of challenges to achieve their common dream: to be the Wizard King. Giving up is never an option!\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/13209/original.png', 13209, 0, 1, '2017-10-03', 0),
(13, 'Bleach', 'Bleach', 'Ichigo Kurosaki is an ordinary high schooler—until his family is attacked by a Hollow, a corrupt spirit that seeks to devour human souls. It is then that he meets a Soul Reaper named Rukia Kuchiki, who gets injured while protecting Ichigo\'s family from the assailant. To save his family, Ichigo accepts Rukia\'s offer of taking her powers and becomes a Soul Reaper as a result.\nHowever, as Rukia is unable to regain her powers, Ichigo is given the daunting task of hunting down the Hollows that plague their town. However, he is not alone in his fight, as he is later joined by his friends—classmates Orihime Inoue, Yasutora Sado, and Uryuu Ishida—who each have their own unique abilities. As Ichigo and his comrades get used to their new duties and support each other on and off the battlefield, the young Soul Reaper soon learns that the Hollows are not the only real threat to the human world.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/244/original.jpg', 244, 0, 1, '2004-10-05', 0),
(14, 'InuYasha: The Final Act', 'InuYasha: Kanketsu-hen', 'Inuyasha, Kagome, Miroku, Sango, Shippou and their neko-mata friend Kirara, are now in the final leg of their quest to put an end to the elusive demon, Naraku and all of the chaos and evil he has caused, and to ultimately undo the unfortunate karma of the Jewel of Four Souls. Their journey, however, will not be easy as their remaining enemies put out all the stops to make sure that they do not accomplish their goal.\n\nThis TV Anime depicts Volumes 36-56 (end) of the Inuyasha manga. The story continues from the last moment seen in Inuyasha\'s original anime. Inuyasha, Kagome, Sango, Miroku and Shippou are now in the definitive quest to beat Naraku and the evil he has created and absorbed, they don\'t lose hope since their future depends on it, but the path isn\'t easy nor short so they will go through life threatening situations and must put their friendship and love on the line with wisdom to know who their friends and foes are to succeed. \n\n(Source: ANN) ', 'https://media.kitsu.io/anime/poster_images/4726/original.jpg', 4726, 0, 1, '2009-10-04', 0),
(15, 'Brand New Animal', 'Brand New Animal', 'In the 21st century, the existence of animal-humans came to light after being hidden in the darkness of history. Michiru lived life as a normal human, until one day she suddenly turns into a tanuki-human. She runs away and takes refuge in a special city area called \"Anima City\" that was set up 10 years ago for animal-humans to be able to live as themselves. There Michiru meets Shirou, a wolf-human who hates humans. Through Shirou, Michiru starts to learn about the worries, lifestyle, and joys of the animal-humans. As Michiru and Shirou try to learn why Michiru suddenly turned into an animal-human, they unexpectedly get wrapped up in a large incident.\n\n(Source: Anime News Network)', 'https://media.kitsu.io/anime/poster_images/42434/original.jpg', 42434, 0, 1, '2020-04-09', 0),
(16, 'The Ancient Magus\' Bride', 'Mahoutsukai no Yome', 'Hatori Chise has lived a life full of neglect and abuse, devoid of anything resembling love. Far from the warmth of family, she has had her share of troubles and pitfalls. Just when all hope seems lost, a fateful encounter awaits her. When a man with the head of a beast, wielding strange powers, obtains her through a slave auction, Chise\'s life will never be the same again. The man is a \"magus,\"a sorcerer of great power, who decides to free Chise from the bonds of captivity. The magus then makes a bold statement: Chise will become his apprentice--and his bride! \n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/13228/original.jpg', 13228, 0, 1, '2017-10-08', 0),
(17, 'Himouto! Umaru-chan', 'Himouto! Umaru-chan', 'People are not always who they appear to be, as is the case with Umaru Doma, the perfect high school girl—that is, until she gets home! Once the front door closes, the real fun begins. When she dons her hamster hoodie, she transforms from a refined, over-achieving student into a lazy, junk food-eating otaku, leaving all the housework to her responsible older brother Taihei. Whether she\'s hanging out with her friends Nana Ebina and Kirie Motoba, or competing with her self-proclaimed \"rival\" Sylphinford Tachibana, Umaru knows how to kick back and have some fun!Himouto! Umaru-chan is a cute story that follows the daily adventures of Umaru and Taihei, as they take care of—and put up with—each other the best they can, as well as the unbreakable bonds between friends and siblings.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/10067/original.jpg', 10067, 0, 1, '2015-07-09', 0),
(18, 'Death Parade', 'Death Parade', 'After death, there is no heaven or hell, only a bar that stands between reincarnation and oblivion. There the attendant will, one after another, challenge pairs of the recently deceased to a random game in which their fate of either ascending into reincarnation or falling into the void will be wagered. Whether it\'s bowling, darts, air hockey, or anything in between, each person\'s true nature will be revealed in a ghastly parade of death and memories, dancing to the whims of the bar\'s master. Welcome to Quindecim, where Decim, arbiter of the afterlife, awaits!\n\nDeath Parade expands upon the original one-shot intended to train young animators. It follows yet more people receiving judgment—until a strange, black-haired guest causes Decim to begin questioning his own rulings.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/9969/original.png', 9969, 0, 2, '2015-01-10', 0),
(19, 'Blue Exorcist', 'Ao no Exorcist', 'Humans and demons are two sides of the same coin, as are Assiah and Gehenna, their respective worlds. The only way to travel between the realms is by the means of possession, like in ghost stories. However, Satan, the ruler of Gehenna, cannot find a suitable host to possess and therefore, remains imprisoned in his world. In a desperate attempt to conquer Assiah, he sends his son instead, intending for him to eventually grow into a vessel capable of possession by the demon king.Ao no Exorcist follows Rin Okumura who appears to be an ordinary, somewhat troublesome teenager—that is until one day he is ambushed by demons. His world turns upside down when he discovers that he is in fact the very son of Satan and that his demon father wishes for him to return so they can conquer Assiah together. Not wanting to join the king of Gehenna, Rin decides to begin training to become an exorcist so that he can fight to defend Assiah alongside his brother Yukio.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/5940/original.jpg', 5940, 0, 1, '2011-04-17', 0),
(20, 'Mob Psycho 100', 'Mob Psycho 100', 'Kageyama Shigeo, a.k.a. \"Mob,\" is a boy who has trouble expressing himself, but who happens to be a powerful esper. Mob is determined to live a normal life and keeps his ESP suppressed, but when his emotions surge to a level of 100%, something terrible happens to him! As he\'s surrounded by false espers, evil spirits, and mysterious organizations, what will Mob think? What choices will he make?\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/11578/original.jpg', 11578, 0, 1, '2016-07-12', 0),
(21, 'Young Black Jack', 'Young Black Jack', 'The year is 1968, and the world is swept up in the Vietnam War and student protests. In this time of turmoil, a mysterious young man with white and black hair and a scar on his face is enrolled in medical school. His genius skills with a surgical knife achieve many a medical miracle and are getting noticed. This hero origin story reveals how this young man earned his medical degree and the name of Black Jack.\n(Source: TBS)', 'https://media.kitsu.io/anime/poster_images/10914/original.png', 10914, 0, 1, '2015-10-02', 0),
(22, 'Hunter x Hunter (2011)', 'Hunter x Hunter (2011)', 'Hunter x Hunter is set in a world where Hunters exist to perform all manner of dangerous tasks like capturing criminals and bravely searching for lost treasures in uncharted territories. Twelve-year-old Gon Freecss is determined to become the best Hunter possible in hopes of finding his father, who was a Hunter himself and had long ago abandoned his young son. However, Gon soon realizes the path to achieving his goals is far more challenging than he could have ever imagined.\n\nAlong the way to becoming an official Hunter, Gon befriends the lively doctor-in-training Leorio, vengeful Kurapika, and rebellious ex-assassin Killua. To attain their own goals and desires, together the four of them take the Hunter Exam, notorious for its low success rate and high probability of death. Throughout their journey, Gon and his friends embark on an adventure that puts them through many hardships and struggles. They will meet a plethora of monsters, creatures, and characters—all while learning what being a Hunter truly means.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/6448/original.png', 6448, 0, 1, '2011-10-02', 0),
(23, 'Violet Evergarden', 'Violet Evergarden', 'There are words Violet heard on the battlefield, which she cannot forget. These words were given to her by someone she holds dear, more than anyone else. She does not yet know their meaning.\nA certain point in time, in the continent of Telesis. The great war which divided the continent into North and South has ended after four years, and the people are welcoming a new generation.\n\nViolet Evergarden, a young girl formerly known as “the weapon”, has left the battlefield to start a new life at CH Postal Service. There, she is deeply moved by the work of “Auto Memories Dolls”, who carry people\'s thoughts and convert them into words.\n\nViolet begins her journey as an Auto Memories Doll, and comes face to face with various people\'s emotions and differing shapes of love. All the while searching for the meaning of those words.\n\n(Source: Anime Expo)', 'https://media.kitsu.io/anime/poster_images/12230/original.jpg', 12230, 1, 1, '2018-01-11', 0),
(25, 'Demon Slayer: Kimetsu no Yaiba', 'Kimetsu no Yaiba', 'It is the Taisho Period in Japan. Tanjiro, a kindhearted boy who sells charcoal for a living, finds his family slaughtered by a demon. To make matters worse, his younger sister Nezuko, the sole survivor, has been transformed into a demon herself. Though devastated by this grim reality, Tanjiro resolves to become a “demon slayer” so that he can turn his sister back into a human, and kill the demon that massacred his family.\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/41370/original.jpg', 41370, 0, 2, '2019-04-06', 0),
(26, 'Naruto', 'Naruto', 'Moments prior to Naruto Uzumaki\'s birth, a huge demon known as the Kyuubi, the Nine-Tailed Fox, attacked Konohagakure, the Hidden Leaf Village, and wreaked havoc. In order to put an end to the Kyuubi\'s rampage, the leader of the village, the Fourth Hokage, sacrificed his life and sealed the monstrous beast inside the newborn Naruto.\nNow, Naruto is a hyperactive and knuckle-headed ninja still living in Konohagakure. Shunned because of the Kyuubi inside him, Naruto struggles to find his place in the village, while his burning desire to become the Hokage of Konohagakure leads him not only to some great new friends, but also some deadly foes.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/11/original.jpg', 11, 0, 1, '2002-10-03', 0),
(27, 'Akame ga Kill!', 'Akame ga Kill!', 'Under the rule of a tyrannical empire, Tatsumi, a young swordsman, leaves his home to save his poverty stricken village. He meets a girl named Akame, an assassin who was bought, brainwashed and trained to kill by the Empire. Akame is a member of the secret assassin group called “Night Raid” who use special weapons called Teigu. Together, Tatsumi and the members of Night Raid confront the corrupt empire.\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/8270/original.png', 8270, 0, 2, '2014-07-07', 0),
(28, 'The Seven Deadly Sins', 'Nanatsu no Taizai', 'In a world similar to the European Middle Ages, the feared yet revered Holy Knights of Britannia use immensely powerful magic to protect the region of Britannia and its kingdoms. However, a small subset of the Knights supposedly betrayed their homeland and turned their blades against their comrades in an attempt to overthrow the ruler of Liones. They were defeated by the Holy Knights, but rumors continued to persist that these legendary knights, called the \"Seven Deadly Sins,\" were still alive. Ten years later, the Holy Knights themselves staged a coup d’état, and thus became the new, tyrannical rulers of the Kingdom of Liones.\n\nBased on the best-selling manga series of the same name, Nanatsu no Taizai follows the adventures of Elizabeth, the third princess of the Kingdom of Liones, and her search for the Seven Deadly Sins. With their help, she endeavors to not only take back her kingdom from the Holy Knights, but to also seek justice in an unjust world.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/8699/original.jpg', 8699, 0, 1, '2014-10-05', 0),
(31, 'KonoSuba: God\'s Blessing on This Wonderful World!', 'Kono Subarashii Sekai ni Shukufuku wo!', 'After dying a laughable and pathetic death on his way back from buying a game, high school student and recluse Kazuma Satou finds himself sitting before a beautiful but obnoxious goddess named Aqua. She provides the NEET with two options: continue on to heaven or reincarnate in every gamer\'s dream—a real fantasy world! Choosing to start a new life, Kazuma is quickly tasked with defeating a Demon King who is terrorizing villages. But before he goes, he can choose one item of any kind to aid him in his quest, and the future hero selects Aqua. But Kazuma has made a grave mistake—Aqua is completely useless!\n\nUnfortunately, their troubles don\'t end here; it turns out that living in such a world is far different from how it plays out in a game. Instead of going on a thrilling adventure, the duo must first work to pay for their living expenses. Indeed, their misfortunes have only just begun!\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/10941/original.jpg', 10941, 0, 1, '2016-01-14', 0),
(32, 'Sword Art Online', 'Sword Art Online', 'In the year 2022, virtual reality has progressed by leaps and bounds, and a massive online role-playing game called Sword Art Online (SAO) is launched. With the aid of \"NerveGear\" technology, players can control their avatars within the game using nothing but their own thoughts.\nKazuto Kirigaya, nicknamed \"Kirito,\" is among the lucky few enthusiasts who get their hands on the first shipment of the game. He logs in to find himself, with ten-thousand others, in the scenic and elaborate world of Aincrad, one full of fantastic medieval weapons and gruesome monsters. However, in a cruel turn of events, the players soon realize they cannot log out; the game\'s creator has trapped them in his new world until they complete all one hundred levels of the game.\nIn order to escape Aincrad, Kirito will now have to interact and cooperate with his fellow players. Some are allies, while others are foes, like Asuna Yuuki, who commands the leading group attempting to escape from the ruthless game. To make matters worse, Sword Art Online is not all fun and games: if they die in Aincrad, they die in real life. Kirito must adapt to his new reality, fight for his survival, and hopefully break free from his virtual hell.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/6589/original.png', 6589, 0, 1, '2012-07-08', 0),
(33, 'DARLING in the FRANXX', 'Darling in the FranXX', 'The distant future: Humanity established the mobile fort city, Plantation, upon the ruined wasteland. Within the city were pilot quarters, Mistilteinn, otherwise known as the “Birdcage.” That is where the children live... Their only mission in life was the fight. Their enemies are the mysterious giant organisms known as Kyoryu. The children operate robots known as FRANXX in order to face these still unseen enemies. Among them was a boy who was once called a child prodigy: Code number 016, Hiro. One day, a mysterious girl called Zero Two appears in front of Hiro. “I’ve found you, my Darling.”\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/13600/original.jpg', 13600, 0, 1, '2018-01-13', 0),
(34, 'Angel Beats!', 'Angel Beats!', 'Otonashi awakens only to learn he is dead. A rifle-toting girl named Yuri explains that they are in the afterlife, and Otonashi realizes the only thing he can remember about himself is his name. Yuri tells him that she leads the Shinda Sekai Sensen (Afterlife Battlefront) and wages war against a girl named Tenshi. Unable to believe Yuri\'s claims that Tenshi is evil, Otonashi attempts to speak with her, but the encounter doesn\'t go as he intended.\nOtonashi decides to join the SSS and battle Tenshi, but he finds himself oddly drawn to her. While trying to regain his memories and understand Tenshi, he gradually unravels the mysteries of the afterlife.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/4604/original.jpg', 4604, 0, 1, '2010-04-03', 0),
(35, 'Charlotte', 'Charlotte', 'Very few adolescent boys and girls have an onset of special abilities. Yu Otosaka is one such man who uses his ability unbeknownst to others in order to lead a satisfying school life. Then one day, a girl named Nao Tomori suddenly appears before him. Their encounter reveals the destiny for wielders of special abilities.\n\n(Source: Aniplex USA)', 'https://media.kitsu.io/anime/poster_images/10103/original.jpg', 10103, 0, 1, '2015-07-05', 0),
(36, 'Neon Genesis Evangelion', 'Neon Genesis Evangelion', 'In the year 2015, the world stands on the brink of destruction. Humanity\'s last hope lies in the hands of Nerv, a special agency under the United Nations, and their Evangelions, giant machines capable of defeating the Angels who herald Earth\'s ruin. Gendou Ikari, head of the organization, seeks compatible pilots who can synchronize with the Evangelions and realize their true potential. Aiding in this defensive endeavor are talented personnel Misato Katsuragi, Head of Tactical Operations, and Ritsuko Akagi, Chief Scientist.\n\nFace to face with his father for the first time in years, 14-year-old Shinji Ikari\'s average life is irreversibly changed when he is whisked away into the depths of Nerv, and into a harrowing new destiny—he must become the pilot of Evangelion Unit-01 with the fate of mankind on his shoulders.\nWritten by Hideaki Anno, Neon Genesis Evangelion is a heroic tale of a young boy who will become a legend. But as this psychological drama unfolds, ancient secrets beneath the big picture begin to bubble to the surface...\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/21/original.jpg', 21, 0, 1, '1995-10-04', 0),
(37, 'Dr. STONE', 'Dr. Stone', 'Several thousand years after a mysterious phenomenon that turns all of humanity to stone, the extraordinarily intelligent, science-driven boy, Senku Ishigami, awakens.\n\nFacing a world of stone and the total collapse of civilization, Senku makes up his mind to use science to rebuild the world. Starting with his super strong childhood friend Taiju Oki, who awakened at the same time, they will begin to rebuild civilization from nothing...\n\nDepicting two million years of scientific history from the Stone Age to present day, the unprecedented crafting adventure story is about to begin!\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/42080/original.jpg', 42080, 0, 1, '2019-07-05', 0),
(38, 'Noragami', 'Noragami', 'In times of need, if you look in the right place, you just may see a strange telephone number scrawled in red. If you call this number, you will hear a young man introduce himself as the Yato God.\nYato is a minor deity and a self-proclaimed \"Delivery God,\" who dreams of having millions of worshippers. Without a single shrine dedicated to his name, however, his goals are far from being realized. He spends his days doing odd jobs for five yen apiece, until his weapon partner becomes fed up with her useless master and deserts him.\nJust as things seem to be looking grim for the god, his fortune changes when a middle school girl, Hiyori Iki, supposedly saves Yato from a car accident, taking the hit for him. Remarkably, she survives, but the event has caused her soul to become loose and hence able to leave her body. Hiyori demands that Yato return her to normal, but upon learning that he needs a new partner to do so, reluctantly agrees to help him find one. And with Hiyori\'s help, Yato\'s luck may finally be turning around.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/7881/original.jpg', 7881, 0, 1, '2014-01-05', 0),
(39, 'No Game, No Life', 'No Game No Life', 'No Game No Life is a surreal comedy that follows Sora and Shiro, shut-in NEET siblings and the online gamer duo behind the legendary username \"Kuuhaku.\" They view the real world as just another lousy game; however, a strange e-mail challenging them to a chess match changes everything—the brother and sister are plunged into an otherworldly realm where they meet Tet, the God of Games.\n\nThe mysterious god welcomes Sora and Shiro to Disboard, a world where all forms of conflict—from petty squabbles to the fate of whole countries—are settled not through war, but by way of high-stake games. This system works thanks to a fundamental rule wherein each party must wager something they deem to be of equal value to the other party\'s wager. In this strange land where the very idea of humanity is reduced to child’s play, the indifferent genius gamer duo of Sora and Shiro have finally found a real reason to keep playing games: to unite the sixteen races of Disboard, defeat Tet, and become the gods of this new, gaming-is-everything world.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/7880/original.jpg', 7880, 0, 1, '2014-04-09', 0),
(40, 'Rokka -Braves of the Six Flowers-', 'Rokka no Yuusha', 'Legend says, when the Evil God awakens from the deepest of darkness, the god of fate will summon Six Braves and grant them with the power to save the world. Adlet, who claims to be the strongest on the face of this earth, is chosen as one of the “Brave Six Flowers,” and sets out on a battle to prevent the resurrection of the Evil God. However, it turns out that there are Seven Braves who gathered at the promised land…\n\n(Source: Ponycan USA)', 'https://media.kitsu.io/anime/poster_images/10029/original.jpg', 10029, 0, 1, '2015-07-05', 0),
(41, 'Your Lie in April', 'Shigatsu wa Kimi no Uso', 'Music accompanies the path of the human metronome, the prodigious pianist Kousei Arima. But after the passing of his mother, Saki Arima, Kousei falls into a downward spiral, rendering him unable to hear the sound of his own piano.\nTwo years later, Kousei still avoids the piano, leaving behind his admirers and rivals, and lives a colorless life alongside his friends Tsubaki Sawabe and Ryouta Watari. However, everything changes when he meets a beautiful violinist, Kaori Miyazono, who stirs up his world and sets him on a journey to face music again.\nBased on the manga series of the same name, Shigatsu wa Kimi no Uso approaches the story of Kousei\'s recovery as he discovers that music is more than playing each note perfectly, and a single melody can bring in the fresh spring air of April.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/8403/original.jpg', 8403, 0, 1, '2014-10-10', 1),
(42, 'Another', 'Another', 'In 1972, a popular student in Yomiyama North Middle School\'s class 3-3 named Misaki passed away during the school year. Since then, the town of Yomiyama has been shrouded by a fearful atmosphere, from the dark secrets hidden deep within.\nTwenty-six years later, 15-year-old Kouichi Sakakibara transfers into class 3-3 of Yomiyama North and soon after discovers that a strange, gloomy mood seems to hang over all the students. He also finds himself drawn to the mysterious, eyepatch-wearing student Mei Misaki; however, the rest of the class and the teachers seem to treat her like she doesn\'t exist. Paying no heed to warnings from everyone including Mei herself, Kouichi begins to get closer not only to her, but also to the truth behind the gruesome phenomenon plaguing class 3-3 of Yomiyama North.Another follows Kouichi, Mei, and their classmates as they are pulled into the enigma surrounding a series of inevitable, tragic events—but unraveling the horror of Yomiyama may just cost them the ultimate price.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/6462/original.png', 6462, 0, 2, '2012-01-10', 1),
(43, 'Mushoku Tensei: Jobless Reincarnation Part 2', 'Mushoku Tensei: Isekai Ittara Honki Dasu Part 2', 'The second cour of Mushoku Tensei: Isekai Ittara Honki Dasu.\n\nRudy, Eris, and Rujierd head for the Asura Kingdom in search of answers. Meanwhile, Roxy sets out across the Demon Continent to find Rudy.\n\n(Source: Funimation)', 'https://media.kitsu.io/anime/43907/poster_image/d0acde74af3334d0aec097f905ada1aa.jpg', 43907, 0, 2, '2021-10-03', 0),
(44, 'Blue Period', 'Blue Period', 'Bored with life, popular high schooler Yatora Yaguchi jumps into the beautiful yet unrelenting world of art after finding inspiration in a painting.\n\n(Source: Netflix)', 'https://media.kitsu.io/anime/43888/poster_image/ab5dc3393d9cfe8b4277459c6e89a358.jpg', 43888, 0, 1, '2021-09-25', 0),
(45, '86 Part 2', '86 Part 2', 'The second cour of 86: Eighty-Six.', 'https://media.kitsu.io/anime/poster_images/44398/original.png', 44398, 0, 0, '2021-10-02', 0),
(46, 'The World\'s Finest Assassin Gets Reincarnated in Another World as an Aristocrat', 'Sekai Saikou no Ansatsusha, Isekai Kizoku ni Tensei suru', '\"I\'m going to live for myself!\"\n\nThe greatest assassin on Earth knew only how to live as a tool for his employers—until they stopped letting him live. Reborn by the grace of a goddess into a world of swords and sorcery, he\'s offered a chance to do things differently this time around, but there\'s a catch...He has to eliminate a super-powerful hero who will bring about the end of the world unless he is stopped.\n\nNow known as Lugh Tuatha Dé, the master assassin certainly has his hands full, particularly because of all the beautiful girls who constantly surround him. Lugh may have been an incomparable killer, but how will he fare against foes with powerful magic?\n\n(Source: Yen Press)', 'https://media.kitsu.io/anime/poster_images/44393/original.jpg', 44393, 0, 2, '2021-10-06', 0),
(47, 'The Faraway Paladin', 'Saihate no Paladin', 'In a city of the dead, long since ruined and far from human civilization, lives a single human child. His name is Will, and he\'s being raised by three undead: the hearty skeletal warrior, Blood; the graceful mummified priestess, Mary; and the crotchety spectral sorcerer, Gus. The three pour love into the boy, and teach him all they know.\n\nBut one day, Will starts to wonder: \"Who am I?\" Will must unravel the mysteries of this faraway dead man\'s land, and unearth the secret pasts of the undead. He must learn the love and mercy of the good gods, and the bigotry and madness of the bad. And when he knows it all, the boy will take his first step on the path to becoming a Paladin.\n\n(Source: J-Novel Club)', 'https://media.kitsu.io/anime/44432/poster_image/29ca67a836df84e9e5ac23dd56e19466.jpg', 44432, 0, 1, '2021-10-09', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anime_genre`
--

CREATE TABLE `anime_genre` (
  `id` int NOT NULL,
  `anime_id` int NOT NULL,
  `genre_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `anime_genre`
--

INSERT INTO `anime_genre` (`id`, `anime_id`, `genre_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(6, 2, 1),
(7, 2, 3),
(5, 2, 5),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(14, 3, 1),
(13, 3, 3),
(17, 3, 5),
(11, 3, 8),
(12, 3, 9),
(15, 3, 15),
(16, 3, 16),
(21, 4, 2),
(22, 4, 4),
(18, 4, 18),
(19, 4, 19),
(20, 4, 20),
(24, 5, 1),
(25, 5, 3),
(23, 5, 5),
(27, 5, 8),
(28, 5, 9),
(26, 5, 26),
(32, 6, 1),
(30, 6, 5),
(29, 6, 8),
(31, 6, 31),
(33, 6, 33),
(34, 6, 34),
(37, 7, 2),
(38, 7, 3),
(39, 7, 8),
(35, 7, 35),
(36, 7, 36),
(41, 8, 18),
(42, 8, 35),
(40, 8, 36),
(45, 9, 1),
(44, 9, 3),
(43, 9, 8),
(48, 9, 16),
(47, 9, 18),
(46, 9, 46),
(51, 10, 1),
(49, 10, 8),
(50, 10, 9),
(52, 10, 15),
(55, 11, 5),
(56, 11, 8),
(53, 11, 34),
(54, 11, 46),
(59, 12, 1),
(57, 12, 5),
(60, 12, 8),
(58, 12, 15),
(62, 13, 5),
(61, 13, 8),
(65, 13, 9),
(64, 13, 19),
(63, 13, 46),
(66, 13, 74),
(71, 14, 1),
(69, 14, 5),
(67, 14, 8),
(68, 14, 9),
(72, 14, 15),
(74, 14, 19),
(73, 14, 26),
(70, 14, 31),
(75, 14, 83),
(77, 16, 1),
(78, 16, 15),
(76, 16, 84),
(79, 17, 5),
(80, 17, 34),
(81, 17, 84),
(83, 18, 2),
(86, 18, 3),
(85, 18, 4),
(84, 18, 18),
(82, 18, 90),
(88, 19, 1),
(87, 19, 8),
(89, 19, 19),
(90, 19, 31),
(91, 20, 5),
(94, 20, 8),
(93, 20, 19),
(92, 20, 84),
(95, 21, 3),
(96, 21, 83),
(97, 21, 105),
(101, 22, 1),
(98, 22, 8),
(99, 22, 9),
(100, 22, 46),
(104, 23, 1),
(103, 23, 3),
(102, 23, 84),
(106, 26, 5),
(105, 26, 8),
(107, 26, 33),
(108, 26, 46),
(109, 27, 1),
(112, 27, 3),
(110, 27, 8),
(111, 27, 9),
(115, 28, 1),
(113, 28, 8),
(114, 28, 9),
(117, 28, 15),
(116, 28, 19),
(118, 28, 126),
(121, 31, 1),
(120, 31, 5),
(119, 31, 9),
(123, 31, 15),
(122, 31, 19),
(124, 31, 132),
(127, 32, 1),
(125, 32, 8),
(126, 32, 9),
(129, 32, 26),
(128, 32, 90),
(132, 33, 3),
(134, 33, 8),
(133, 33, 26),
(130, 33, 36),
(131, 33, 139),
(138, 34, 3),
(136, 34, 5),
(135, 34, 8),
(137, 34, 19),
(139, 34, 34),
(140, 34, 74),
(143, 35, 3),
(141, 35, 34),
(142, 35, 46),
(149, 36, 2),
(146, 36, 3),
(144, 36, 8),
(148, 36, 36),
(147, 36, 139),
(145, 36, 153),
(153, 38, 5),
(151, 38, 8),
(150, 38, 9),
(152, 38, 19),
(157, 39, 1),
(155, 39, 5),
(154, 39, 9),
(158, 39, 19),
(159, 39, 90),
(156, 39, 126),
(163, 40, 1),
(160, 40, 8),
(161, 40, 9),
(164, 40, 15),
(162, 40, 18),
(168, 41, 3),
(167, 41, 26),
(166, 41, 34),
(169, 41, 74),
(165, 41, 173),
(173, 42, 4),
(170, 42, 18),
(174, 42, 19),
(172, 42, 34),
(171, 42, 35);

-- --------------------------------------------------------

--
-- Estrutura da tabela `genre`
--

CREATE TABLE `genre` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `full_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `genre`
--

INSERT INTO `genre` (`id`, `name`, `full_name`) VALUES
(1, 'fantasy', 'Fantasy'),
(2, 'psychological', 'Psychological'),
(3, 'drama', 'Drama'),
(4, 'thriller', 'Thriller'),
(5, 'comedy', 'Comedy'),
(8, 'action', 'Action'),
(9, 'adventure', 'Adventure'),
(10, 'isekai', 'Isekai'),
(15, 'magic', 'Magic'),
(16, 'military', 'Military'),
(18, 'mystery', 'Mystery'),
(19, 'supernatural', 'Supernatural'),
(20, 'police', 'Police'),
(26, 'romance', 'Romance'),
(31, 'demons', 'Demons'),
(33, 'martial-arts', 'Martial Arts'),
(34, 'school', 'School'),
(35, 'horror', 'Horror'),
(36, 'sci-fi', 'Sci-Fi'),
(46, 'super-power', 'Super Power'),
(74, 'friendship', 'Friendship'),
(83, 'historical', 'Historical'),
(84, 'slice-of-life', 'Slice of Life'),
(90, 'game', 'Game'),
(105, 'medical', 'Medical'),
(126, 'ecchi', 'Ecchi'),
(132, 'parody', 'Parody'),
(139, 'mecha', 'Mecha'),
(153, 'dementia', 'Dementia'),
(173, 'music', 'Music');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manga`
--

CREATE TABLE `manga` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` text NOT NULL,
  `kitsu_id` int NOT NULL,
  `type` int NOT NULL,
  `age_group` int NOT NULL,
  `release_date` date NOT NULL,
  `score` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `manga`
--

INSERT INTO `manga` (`id`, `name`, `full_name`, `description`, `picture`, `kitsu_id`, `type`, `age_group`, `release_date`, `score`) VALUES
(1, 'Sign', 'Sign', 'There are a few unusual things about Cafe Goyo. Number one, their coffee sucks. Number two, their customers never order off the menu. And number three, Yohan, the cafe manager, is deaf. So when Soohwa joins as a part-timer, though he is not expected to learn how to make good coffee, he is asked to expand his sign language vocabulary beyond the words, \"higher,\" \"pay,\" and \"please.\" But when Yohan offers to give him private lessons, Soohwa is reluctant. Not because he doesn\'t want to study, but because he has a \"hard\" time around Yohan. Like, literally. He gets hard. Whenever he hears Yohan\'s deep, sexy voice. (Source: Lezhin)', 'https://media.kitsu.io/manga/poster_images/41222/original.jpg', 41222, 0, 3, '2017-09-13', 0),
(2, 'My Hero Academia', 'Boku no Hero Academia', 'What would the world be like if 80 percent of the population manifested superpowers called “Quirks” at age four? Heroes and villains would be battling it out everywhere! Being a hero would mean learning to use your power, but where would you go to study? The Hero Academy of course! But what would you do if you were one of the 20 percent who were born Quirkless?\n\nMiddle school student Izuku Midoriya wants to be a hero more than anything, but he hasn’t got an ounce of power in him. With no chance of ever getting into the prestigious U.A. High School for budding heroes, his life is looking more and more like a dead end. Then an encounter with All Might, the greatest hero of them all, gives him a chance to change his destiny…\n\n(Source: Viz Media)', 'https://media.kitsu.io/manga/poster_images/26004/original.png', 26004, 0, 0, '2014-07-07', 0),
(3, 'Jujutsu Kaisen', 'Jujutsu Kaisen', 'Although Yuji Itadori looks like your average teenager, his immense physical strength is something to behold! Every sports club wants him to join, but Itadori would rather hang out with the school outcasts in the Occult Research Club. One day, the club manages to get their hands on a sealed cursed object. Little do they know the terror they’ll unleash when they break the seal…\n\n(Source: Viz Media)', 'https://media.kitsu.io/manga/poster_images/40815/original.jpg', 40815, 0, 0, '2018-03-05', 0),
(4, 'Pop Team Epic', 'Pop Team Epic', 'Popuko and Pipimi are a pair of foul-mouthed girls ready to take on every pop culture reference ever made. Pop Team Epic follows the pair through a series of surreal skits and short stories full of internet, movie, video game, and self-referential based comedy.\n\n(Source: Anime News Network)', 'https://media.kitsu.io/manga/poster_images/37822/original.jpg', 37822, 0, 0, '2014-08-29', 0),
(5, 'Black Clover', 'Black Clover', 'Asta is a young boy who dreams of becoming the greatest mage in the kingdom. Only one problem—he can’t use any magic! Luckily for Asta, he receives the incredibly rare five-leaf clover grimoire that gives him the power of anti-magic. Can someone who can’t use magic really become the Wizard King? One thing’s for sure—Asta will never give up!\n\n(Source: Viz)', 'https://media.kitsu.io/manga/poster_images/27527/original.jpg', 27527, 0, 0, '2015-02-16', 0),
(6, 'Demon Slayer: Kimetsu no Yaiba', 'Kimetsu no Yaiba', 'Since ancient times, rumors have abounded of man-eating demons lurking in the woods. Because of this, the local townsfolk never venture outside at night. Legend has it that a demon slayer also roams the night, hunting down these bloodthirsty demons. For young Tanjirou, these rumors will soon to become his harsh reality...\n\nEver since the death of his father, Tanjirou has taken it upon himself to support his family. Although their lives may be hardened by tragedy, they\'ve found happiness. But that ephemeral warmth is shattered one day when Tanjirou finds his family slaughtered and the lone survivor, his sister Nezuko, turned into a demon. To his surprise, however, Nezuko still shows signs of human emotion and thought...\n\nThus begins Tanjirou\'s quest to fight demons and turn his sister human again.\n\n(Source: VIZ Media)\n\nVolume 7 contains a bonus chapter about Kanao Tsuyuri.\nVolume 10 contains a bonus chapter about Inosuke Hashibira.', 'https://media.kitsu.io/manga/poster_images/37280/original.jpg', 37280, 0, 1, '2016-02-15', 0),
(7, 'One Piece', 'One Piece', 'Gol D. Roger was known as the Pirate King, the strongest and most infamous being to have sailed the Grand Line. The capture and death of Roger by the World Government brought a change throughout the world. His last words before his death revealed the location of the greatest treasure in the world, One Piece. It was this revelation that brought about the Grand Age of Pirates, men who dreamed of finding One Piece (which promises an unlimited amount of riches and fame), and quite possibly the most coveted of titles for the person who found it, the title of the Pirate King.\n\nEnter Monkey D. Luffy, a 17-year-old boy that defies your standard definition of a pirate. Rather than the popular persona of a wicked, hardened, toothless pirate who ransacks villages for fun, Luffy’s reason for being a pirate is one of pure wonder; the thought of an exciting adventure and meeting new and intriguing people, along with finding One Piece, are his reasons of becoming a pirate. Following in the footsteps of his childhood hero, Luffy and his crew travel across the Grand Line, experiencing crazy adventures, unveiling dark mysteries and battling strong enemies, all in order to reach One Piece.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/manga/poster_images/38/original.jpg', 38, 0, 0, '1997-07-22', 0),
(8, 'Attack on Titan', 'Attack on Titan', 'A century ago, the grotesque giants known as Titans appeared and consumed all but a few thousand humans. The survivors took refuge behind giant walls. Today, the threat of the Titans is a distant memory, and a boy named Eren yearns to explore the world beyond Wall Maria. But what began as a childish dream will become an all-too-real nightmare when the Titans return and humanity is once again on the brink of extinction … Attack on Titan is the award-winning and New York Times-bestselling series that is the manga hit of the decade! Spawning the monster hit anime TV series of the same name, Attack on Titan has become a pop culture sensation. \n\n(Source: Kodansha Comics)\n\nVolume 3 contains the special story \"Rivai Heishichou\" (リヴァイ兵士長, Captain Levi).\nVolume 5 contains the side story \"Ilse no Techou\" (イルゼの手帳, Ilse\'s Notebook).', 'https://media.kitsu.io/manga/poster_images/14916/original.jpg', 14916, 0, 2, '2009-09-09', 0),
(9, 'Tokyo Ghoul', 'Tokyo Ghoul', 'Kaneki Ken is an unassuming university student living in Tokyo. However, his comfortable life is turned on its head after a string of violent murders pulls him unwillingly into the city\'s ghoul inhabited underbelly; a place that lives by the rule of eat or be eaten. Now, every day is a struggle to protect his life, his loved ones, and his humanity.', 'https://media.kitsu.io/manga/poster_images/7176/original.jpg', 7176, 0, 2, '2011-09-08', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manga_genre`
--

CREATE TABLE `manga_genre` (
  `id` int NOT NULL,
  `manga_id` int NOT NULL,
  `genre_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `read_later`
--

CREATE TABLE `read_later` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `manga_id` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `watch_later`
--

CREATE TABLE `watch_later` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `anime_id` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `watch_later`
--

INSERT INTO `watch_later` (`id`, `account_id`, `anime_id`, `creation_date`) VALUES
(10, 1, 36, '2021-11-30 22:25:46');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `already_read`
--
ALTER TABLE `already_read`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_id` (`account_id`,`manga_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Índices para tabela `already_watched`
--
ALTER TABLE `already_watched`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_id` (`account_id`,`anime_id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Índices para tabela `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kitsu_id` (`kitsu_id`),
  ADD KEY `name` (`name`),
  ADD KEY `score` (`score`);

--
-- Índices para tabela `anime_genre`
--
ALTER TABLE `anime_genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anime_id` (`anime_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Índices para tabela `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices para tabela `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `kitsu_id` (`kitsu_id`),
  ADD KEY `score` (`score`);

--
-- Índices para tabela `manga_genre`
--
ALTER TABLE `manga_genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manga_id` (`manga_id`,`genre_id`) USING BTREE,
  ADD KEY `genre_id` (`genre_id`);

--
-- Índices para tabela `read_later`
--
ALTER TABLE `read_later`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_id` (`account_id`,`manga_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Índices para tabela `watch_later`
--
ALTER TABLE `watch_later`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_id` (`account_id`,`anime_id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `already_read`
--
ALTER TABLE `already_read`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `already_watched`
--
ALTER TABLE `already_watched`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `anime_genre`
--
ALTER TABLE `anime_genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT de tabela `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de tabela `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `manga_genre`
--
ALTER TABLE `manga_genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `read_later`
--
ALTER TABLE `read_later`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `watch_later`
--
ALTER TABLE `watch_later`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `already_read`
--
ALTER TABLE `already_read`
  ADD CONSTRAINT `already_read_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `already_read_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `already_watched`
--
ALTER TABLE `already_watched`
  ADD CONSTRAINT `already_watched_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `already_watched_ibfk_2` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `anime_genre`
--
ALTER TABLE `anime_genre`
  ADD CONSTRAINT `anime_genre_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anime_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `manga_genre`
--
ALTER TABLE `manga_genre`
  ADD CONSTRAINT `manga_genre_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manga_genre_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `read_later`
--
ALTER TABLE `read_later`
  ADD CONSTRAINT `read_later_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `read_later_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `watch_later`
--
ALTER TABLE `watch_later`
  ADD CONSTRAINT `watch_later_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `watch_later_ibfk_2` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
