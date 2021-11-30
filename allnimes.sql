-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2021 às 01:37
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
  `release_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `anime`
--

INSERT INTO `anime` (`id`, `name`, `full_name`, `description`, `picture`, `kitsu_id`, `type`, `age_group`, `release_date`) VALUES
(1, 'Re:ZERO -Starting Life in Another World-', 'Re:Zero kara Hajimeru Isekai Seikatsu', 'When Subaru Natsuki leaves the convenience store, the last thing he expects is to be wrenched from his everyday life and dropped into a fantasy world. Things aren\'t looking good for the bewildered teenager; however, not long after his arrival, he is attacked by some thugs. Armed with only a bag of groceries and a now useless cell phone, he is quickly beaten to a pulp. Fortunately, a mysterious beauty named Satella, in hot pursuit after the one who stole her insignia, happens upon Subaru and saves him. In order to thank the honest and kindhearted girl, Subaru offers to help in her search, and later that night, he even finds the whereabouts of that which she seeks. But unbeknownst to them, a much darker force stalks the pair from the shadows, and just minutes after locating the insignia, Subaru and Satella are brutally murdered.\n\nHowever, Subaru immediately reawakens to a familiar scene—confronted by the same group of thugs, meeting Satella all over again—the enigma deepens as history inexplicably repeats itself.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/11209/original.jpg', 11209, 0, 2, '2016-04-04'),
(2, 'That Time I Got Reincarnated as a Slime', 'Tensei shitara Slime Datta Ken', 'Corporate worker Mikami Satoru is stabbed by a random killer, and is reborn to an alternate world. But he turns out to be reborn a slime! Thrown into this new world with the name Rimuru, he begins his quest to create a world that’s welcoming to all races.\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/41024/original.jpg', 41024, 0, 1, '2018-10-02'),
(3, 'Fullmetal Alchemist: Brotherhood', 'Fullmetal Alchemist: Brotherhood', '\"In order for something to be obtained, something of equal value must be lost.\"\n\nAlchemy is bound by this Law of Equivalent Exchange—something the young brothers Edward and Alphonse Elric only realize after attempting human transmutation: the one forbidden act of alchemy. They pay a terrible price for their transgression—Edward loses his left leg, Alphonse his physical body. It is only by the desperate sacrifice of Edward\'s right arm that he is able to affix Alphonse\'s soul to a suit of armor. Devastated and alone, it is the hope that they would both eventually return to their original bodies that gives Edward the inspiration to obtain metal limbs called \"automail\" and become a state alchemist, the Fullmetal Alchemist.\n\nThree years of searching later, the brothers seek the Philosopher\'s Stone, a mythical relic that allows an alchemist to overcome the Law of Equivalent Exchange. Even with military allies Colonel Roy Mustang, Lieutenant Riza Hawkeye, and Lieutenant Colonel Maes Hughes on their side, the brothers find themselves caught up in a nationwide conspiracy that leads them not only to the true nature of the elusive Philosopher\'s Stone, but their country\'s murky history as well. In between finding a serial killer and racing against time, Edward and Alphonse must ask themselves if what they are doing will make them human again... or take away their humanity.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/3936/original.png', 3936, 0, 2, '2009-04-05'),
(4, 'Death Note', 'Death Note', 'A shinigami, as a god of death, can kill any person—provided they see their victim\'s face and write their victim\'s name in a notebook called a Death Note. One day, Ryuk, bored by the shinigami lifestyle and interested in seeing how a human would use a Death Note, drops one into the human realm.\n\nHigh school student and prodigy Light Yagami stumbles upon the Death Note and—since he deplores the state of the world—tests the deadly notebook by writing a criminal\'s name in it. When the criminal dies immediately following his experiment with the Death Note, Light is greatly surprised and quickly recognizes how devastating the power that has fallen into his hands could be.\n\nWith this divine capability, Light decides to extinguish all criminals in order to build a new world where crime does not exist and people worship him as a god. Police, however, quickly discover that a serial killer is targeting criminals and, consequently, try to apprehend the culprit. To do this, the Japanese investigators count on the assistance of the best detective in the world: a young and eccentric man known only by the name of L.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/1376/original.png', 1376, 0, 2, '2006-10-04'),
(5, 'The Rising of the Shield Hero', 'Tate no Yuusha no Nariagari', 'Iwatani Naofumi, a run-of-the-mill otaku, finds a book in the library that summons him to another world. He is tasked with joining the sword, spear, and bow as one of the Four Cardinal Heroes and fighting the Waves of Catastrophe as the Shield Hero. \n\nExcited by the prospect of a grand adventure, Naofumi sets off with his party. However, merely a few days later, he is betrayed and loses all his money, dignity, and respect. Unable to trust anyone anymore, he employs a slave named Raphtalia and takes on the Waves and the world. But will he really find a way to overturn this desperate situation?\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/13593/original.jpg', 13593, 0, 1, '2019-01-09'),
(6, 'Yu Yu Hakusho: Ghost Files', 'Yuu☆Yuu☆Hakusho', 'One fateful day, Yuusuke Urameshi, a 14-year-old delinquent with a dim future, gets a miraculous chance to turn it all around when he throws himself in front of a moving car to save a young boy. His ultimate sacrifice is so out of character that the authorities of the spirit realm are not yet prepared to let him pass on. Koenma, heir to the throne of the spirit realm, offers Yuusuke an opportunity to regain his life through completion of a series of tasks. With the guidance of the death god Botan, he is to thwart evil presences on Earth as a Spirit Detective.\n\nTo help him on his venture, Yuusuke enlists ex-rival Kazuma Kuwabara, and two demons, Hiei and Kurama, who have criminal pasts. Together, they train and battle against enemies who would threaten humanity\'s very existence.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/359/original.jpg', 359, 0, 1, '1992-10-10'),
(7, 'Parasyte -the maxim-', 'Kiseijuu: Sei no Kakuritsu', 'All of a sudden, they arrived: parasitic aliens that descended upon Earth and quickly infiltrated humanity by burrowing into the brains of vulnerable targets. These insatiable beings acquire full control of their host and are able to morph into a variety of forms in order to feed on unsuspecting prey.\n\nSixteen-year-old high school student Shinichi Izumi falls victim to one of these parasites, but it fails to take over his brain, ending up in his right hand instead. Unable to relocate, the parasite, now named Migi, has no choice but to rely on Shinichi in order to stay alive. Thus, the pair is forced into an uneasy coexistence and must defend themselves from hostile parasites that hope to eradicate this new threat to their species.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/8147/original.jpg', 8147, 0, 2, '2014-10-09'),
(8, 'The Promised Neverland', 'Yakusoku no Neverland', 'The orphans at Grace Field House have only ever known peace. Their home is nice, their bellies stay full, and their caretaker, Mom, loves them very much. But their world turns upside down when the smartest children of the bunch—Emma, Ray, and Norman—learn what horror awaits them on adoption day. Now, their cultivated wit may be their only chance of survival.\n\n(Source: Funimation)', 'https://media.kitsu.io/anime/poster_images/41312/original.jpg', 41312, 0, 2, '2019-01-11'),
(9, 'Attack on Titan', 'Attack on Titan', 'Centuries ago, mankind was slaughtered to near extinction by monstrous humanoid creatures called titans, forcing humans to hide in fear behind enormous concentric walls. What makes these giants truly terrifying is that their taste for human flesh is not born out of hunger but what appears to be out of pleasure. To ensure their survival, the remnants of humanity began living within defensive barriers, resulting in one hundred years without a single titan encounter. However, that fragile calm is soon shattered when a colossal titan manages to breach the supposedly impregnable outer wall, reigniting the fight for survival against the man-eating abominations.\n\nAfter witnessing a horrific personal loss at the hands of the invading creatures, Eren Yeager dedicates his life to their eradication by enlisting into the Survey Corps, an elite military unit that combats the merciless humanoids outside the protection of the walls. Based on Hajime Isayama\'s award-winning manga, Shingeki no Kyojin follows Eren, along with his adopted sister Mikasa Ackerman and his childhood friend Armin Arlert, as they join the brutal war against the titans and race to discover a way of defeating them before the last walls are breached.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/7442/original.jpg', 7442, 0, 2, '2013-04-07'),
(10, 'The Legend of the Legendary Heroes', 'Densetsu no Yuusha no Densetsu', '\"Alpha Stigma\" are known to be eyes that can analyze all types of magic. However, they are more infamously known as cursed eyes that can only bring destruction and death to others.\nRyner Lute, a talented mage and also an Alpha Stigma bearer, was once a student of the Roland Empire\'s Magician Academy, an elite school dedicated to training magicians for military purposes. However, after many of his classmates died in a war, he makes an oath to make the nation a more orderly and peaceful place, with fellow survivor and best friend, Sion Astal.\nNow that Sion is the the king of Roland, he orders Ryner to search for useful relics that will aid the nation. Together with Ferris Eris, a beautiful and highly skilled swordswoman, Ryner goes on a journey to search for relics of legendary heroes from the past, and also uncover the secrets behind his cursed eyes.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/5191/original.jpg', 5191, 0, 2, '2010-07-02'),
(11, 'My Hero Academia', 'Boku no Hero Academia', 'What would the world be like if 80 percent of the population manifested extraordinary superpowers called “Quirks” at age four? Heroes and villains would be battling it out everywhere! Becoming a hero would mean learning to use your power, but where would you go to study? U.A. High\'s Hero Program of course! But what would you do if you were one of the 20 percent who were born Quirkless?\n\nMiddle school student Izuku Midoriya wants to be a hero more than anything, but he hasn\'t got an ounce of power in him. With no chance of ever getting into the prestigious U.A. High School for budding heroes, his life is looking more and more like a dead end. Then an encounter with All Might, the greatest hero of them all gives him a chance to change his destiny…\n\n(Source: Viz Media)', 'https://media.kitsu.io/anime/poster_images/11469/original.png', 11469, 0, 1, '2016-04-03'),
(12, 'Black Clover', 'Black Clover', 'In a world where magic is everything, Asta and Yuno are both found abandoned at a church on the same day. While Yuno is gifted with exceptional magical powers, Asta is the only one in this world without any. At the age of fifteen, both receive grimoires, magic books that amplify their holder\'s magic. Asta\'s is a rare Grimoire of Anti-Magic that negates and repels his opponent\'s spells. Being opposite but good rivals, Yuno and Asta are ready for the hardest of challenges to achieve their common dream: to be the Wizard King. Giving up is never an option!\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/13209/original.png', 13209, 0, 1, '2017-10-03'),
(13, 'Bleach', 'Bleach', 'Ichigo Kurosaki is an ordinary high schooler—until his family is attacked by a Hollow, a corrupt spirit that seeks to devour human souls. It is then that he meets a Soul Reaper named Rukia Kuchiki, who gets injured while protecting Ichigo\'s family from the assailant. To save his family, Ichigo accepts Rukia\'s offer of taking her powers and becomes a Soul Reaper as a result.\nHowever, as Rukia is unable to regain her powers, Ichigo is given the daunting task of hunting down the Hollows that plague their town. However, he is not alone in his fight, as he is later joined by his friends—classmates Orihime Inoue, Yasutora Sado, and Uryuu Ishida—who each have their own unique abilities. As Ichigo and his comrades get used to their new duties and support each other on and off the battlefield, the young Soul Reaper soon learns that the Hollows are not the only real threat to the human world.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/244/original.jpg', 244, 0, 1, '2004-10-05'),
(14, 'InuYasha: The Final Act', 'InuYasha: Kanketsu-hen', 'Inuyasha, Kagome, Miroku, Sango, Shippou and their neko-mata friend Kirara, are now in the final leg of their quest to put an end to the elusive demon, Naraku and all of the chaos and evil he has caused, and to ultimately undo the unfortunate karma of the Jewel of Four Souls. Their journey, however, will not be easy as their remaining enemies put out all the stops to make sure that they do not accomplish their goal.\n\nThis TV Anime depicts Volumes 36-56 (end) of the Inuyasha manga. The story continues from the last moment seen in Inuyasha\'s original anime. Inuyasha, Kagome, Sango, Miroku and Shippou are now in the definitive quest to beat Naraku and the evil he has created and absorbed, they don\'t lose hope since their future depends on it, but the path isn\'t easy nor short so they will go through life threatening situations and must put their friendship and love on the line with wisdom to know who their friends and foes are to succeed. \n\n(Source: ANN) ', 'https://media.kitsu.io/anime/poster_images/4726/original.jpg', 4726, 0, 1, '2009-10-04'),
(15, 'Brand New Animal', 'Brand New Animal', 'In the 21st century, the existence of animal-humans came to light after being hidden in the darkness of history. Michiru lived life as a normal human, until one day she suddenly turns into a tanuki-human. She runs away and takes refuge in a special city area called \"Anima City\" that was set up 10 years ago for animal-humans to be able to live as themselves. There Michiru meets Shirou, a wolf-human who hates humans. Through Shirou, Michiru starts to learn about the worries, lifestyle, and joys of the animal-humans. As Michiru and Shirou try to learn why Michiru suddenly turned into an animal-human, they unexpectedly get wrapped up in a large incident.\n\n(Source: Anime News Network)', 'https://media.kitsu.io/anime/poster_images/42434/original.jpg', 42434, 0, 1, '2020-04-09'),
(16, 'The Ancient Magus\' Bride', 'Mahoutsukai no Yome', 'Hatori Chise has lived a life full of neglect and abuse, devoid of anything resembling love. Far from the warmth of family, she has had her share of troubles and pitfalls. Just when all hope seems lost, a fateful encounter awaits her. When a man with the head of a beast, wielding strange powers, obtains her through a slave auction, Chise\'s life will never be the same again. The man is a \"magus,\"a sorcerer of great power, who decides to free Chise from the bonds of captivity. The magus then makes a bold statement: Chise will become his apprentice--and his bride! \n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/13228/original.jpg', 13228, 0, 1, '2017-10-08'),
(17, 'Himouto! Umaru-chan', 'Himouto! Umaru-chan', 'People are not always who they appear to be, as is the case with Umaru Doma, the perfect high school girl—that is, until she gets home! Once the front door closes, the real fun begins. When she dons her hamster hoodie, she transforms from a refined, over-achieving student into a lazy, junk food-eating otaku, leaving all the housework to her responsible older brother Taihei. Whether she\'s hanging out with her friends Nana Ebina and Kirie Motoba, or competing with her self-proclaimed \"rival\" Sylphinford Tachibana, Umaru knows how to kick back and have some fun!Himouto! Umaru-chan is a cute story that follows the daily adventures of Umaru and Taihei, as they take care of—and put up with—each other the best they can, as well as the unbreakable bonds between friends and siblings.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/10067/original.jpg', 10067, 0, 1, '2015-07-09'),
(18, 'Death Parade', 'Death Parade', 'After death, there is no heaven or hell, only a bar that stands between reincarnation and oblivion. There the attendant will, one after another, challenge pairs of the recently deceased to a random game in which their fate of either ascending into reincarnation or falling into the void will be wagered. Whether it\'s bowling, darts, air hockey, or anything in between, each person\'s true nature will be revealed in a ghastly parade of death and memories, dancing to the whims of the bar\'s master. Welcome to Quindecim, where Decim, arbiter of the afterlife, awaits!\n\nDeath Parade expands upon the original one-shot intended to train young animators. It follows yet more people receiving judgment—until a strange, black-haired guest causes Decim to begin questioning his own rulings.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/9969/original.png', 9969, 0, 2, '2015-01-10'),
(19, 'Blue Exorcist', 'Ao no Exorcist', 'Humans and demons are two sides of the same coin, as are Assiah and Gehenna, their respective worlds. The only way to travel between the realms is by the means of possession, like in ghost stories. However, Satan, the ruler of Gehenna, cannot find a suitable host to possess and therefore, remains imprisoned in his world. In a desperate attempt to conquer Assiah, he sends his son instead, intending for him to eventually grow into a vessel capable of possession by the demon king.Ao no Exorcist follows Rin Okumura who appears to be an ordinary, somewhat troublesome teenager—that is until one day he is ambushed by demons. His world turns upside down when he discovers that he is in fact the very son of Satan and that his demon father wishes for him to return so they can conquer Assiah together. Not wanting to join the king of Gehenna, Rin decides to begin training to become an exorcist so that he can fight to defend Assiah alongside his brother Yukio.\n[Written by MAL Rewrite]', 'https://media.kitsu.io/anime/poster_images/5940/original.jpg', 5940, 0, 1, '2011-04-17'),
(20, 'Mob Psycho 100', 'Mob Psycho 100', 'Kageyama Shigeo, a.k.a. \"Mob,\" is a boy who has trouble expressing himself, but who happens to be a powerful esper. Mob is determined to live a normal life and keeps his ESP suppressed, but when his emotions surge to a level of 100%, something terrible happens to him! As he\'s surrounded by false espers, evil spirits, and mysterious organizations, what will Mob think? What choices will he make?\n\n(Source: Crunchyroll)', 'https://media.kitsu.io/anime/poster_images/11578/original.jpg', 11578, 0, 1, '2016-07-12'),
(21, 'Young Black Jack', 'Young Black Jack', 'The year is 1968, and the world is swept up in the Vietnam War and student protests. In this time of turmoil, a mysterious young man with white and black hair and a scar on his face is enrolled in medical school. His genius skills with a surgical knife achieve many a medical miracle and are getting noticed. This hero origin story reveals how this young man earned his medical degree and the name of Black Jack.\n(Source: TBS)', 'https://media.kitsu.io/anime/poster_images/10914/original.png', 10914, 0, 1, '2015-10-02'),
(22, 'Hunter x Hunter (2011)', 'Hunter x Hunter (2011)', 'Hunter x Hunter is set in a world where Hunters exist to perform all manner of dangerous tasks like capturing criminals and bravely searching for lost treasures in uncharted territories. Twelve-year-old Gon Freecss is determined to become the best Hunter possible in hopes of finding his father, who was a Hunter himself and had long ago abandoned his young son. However, Gon soon realizes the path to achieving his goals is far more challenging than he could have ever imagined.\n\nAlong the way to becoming an official Hunter, Gon befriends the lively doctor-in-training Leorio, vengeful Kurapika, and rebellious ex-assassin Killua. To attain their own goals and desires, together the four of them take the Hunter Exam, notorious for its low success rate and high probability of death. Throughout their journey, Gon and his friends embark on an adventure that puts them through many hardships and struggles. They will meet a plethora of monsters, creatures, and characters—all while learning what being a Hunter truly means.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/anime/poster_images/6448/original.png', 6448, 0, 1, '2011-10-02'),
(23, 'Violet Evergarden', 'Violet Evergarden', 'There are words Violet heard on the battlefield, which she cannot forget. These words were given to her by someone she holds dear, more than anyone else. She does not yet know their meaning.\nA certain point in time, in the continent of Telesis. The great war which divided the continent into North and South has ended after four years, and the people are welcoming a new generation.\n\nViolet Evergarden, a young girl formerly known as “the weapon”, has left the battlefield to start a new life at CH Postal Service. There, she is deeply moved by the work of “Auto Memories Dolls”, who carry people\'s thoughts and convert them into words.\n\nViolet begins her journey as an Auto Memories Doll, and comes face to face with various people\'s emotions and differing shapes of love. All the while searching for the meaning of those words.\n\n(Source: Anime Expo)', 'https://media.kitsu.io/anime/poster_images/12230/original.jpg', 12230, 1, 1, '2018-01-11');

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
  `release_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `manga`
--

INSERT INTO `manga` (`id`, `name`, `full_name`, `description`, `picture`, `kitsu_id`, `type`, `age_group`, `release_date`) VALUES
(1, 'Sign', 'Sign', 'There are a few unusual things about Cafe Goyo. Number one, their coffee sucks. Number two, their customers never order off the menu. And number three, Yohan, the cafe manager, is deaf. So when Soohwa joins as a part-timer, though he is not expected to learn how to make good coffee, he is asked to expand his sign language vocabulary beyond the words, \"higher,\" \"pay,\" and \"please.\" But when Yohan offers to give him private lessons, Soohwa is reluctant. Not because he doesn\'t want to study, but because he has a \"hard\" time around Yohan. Like, literally. He gets hard. Whenever he hears Yohan\'s deep, sexy voice. (Source: Lezhin)', 'https://media.kitsu.io/manga/poster_images/41222/original.jpg', 41222, 0, 3, '2017-09-13'),
(2, 'My Hero Academia', 'Boku no Hero Academia', 'What would the world be like if 80 percent of the population manifested superpowers called “Quirks” at age four? Heroes and villains would be battling it out everywhere! Being a hero would mean learning to use your power, but where would you go to study? The Hero Academy of course! But what would you do if you were one of the 20 percent who were born Quirkless?\n\nMiddle school student Izuku Midoriya wants to be a hero more than anything, but he hasn’t got an ounce of power in him. With no chance of ever getting into the prestigious U.A. High School for budding heroes, his life is looking more and more like a dead end. Then an encounter with All Might, the greatest hero of them all, gives him a chance to change his destiny…\n\n(Source: Viz Media)', 'https://media.kitsu.io/manga/poster_images/26004/original.png', 26004, 0, 0, '2014-07-07'),
(3, 'Jujutsu Kaisen', 'Jujutsu Kaisen', 'Although Yuji Itadori looks like your average teenager, his immense physical strength is something to behold! Every sports club wants him to join, but Itadori would rather hang out with the school outcasts in the Occult Research Club. One day, the club manages to get their hands on a sealed cursed object. Little do they know the terror they’ll unleash when they break the seal…\n\n(Source: Viz Media)', 'https://media.kitsu.io/manga/poster_images/40815/original.jpg', 40815, 0, 0, '2018-03-05'),
(4, 'Pop Team Epic', 'Pop Team Epic', 'Popuko and Pipimi are a pair of foul-mouthed girls ready to take on every pop culture reference ever made. Pop Team Epic follows the pair through a series of surreal skits and short stories full of internet, movie, video game, and self-referential based comedy.\n\n(Source: Anime News Network)', 'https://media.kitsu.io/manga/poster_images/37822/original.jpg', 37822, 0, 0, '2014-08-29'),
(5, 'Black Clover', 'Black Clover', 'Asta is a young boy who dreams of becoming the greatest mage in the kingdom. Only one problem—he can’t use any magic! Luckily for Asta, he receives the incredibly rare five-leaf clover grimoire that gives him the power of anti-magic. Can someone who can’t use magic really become the Wizard King? One thing’s for sure—Asta will never give up!\n\n(Source: Viz)', 'https://media.kitsu.io/manga/poster_images/27527/original.jpg', 27527, 0, 0, '2015-02-16'),
(6, 'Demon Slayer: Kimetsu no Yaiba', 'Kimetsu no Yaiba', 'Since ancient times, rumors have abounded of man-eating demons lurking in the woods. Because of this, the local townsfolk never venture outside at night. Legend has it that a demon slayer also roams the night, hunting down these bloodthirsty demons. For young Tanjirou, these rumors will soon to become his harsh reality...\n\nEver since the death of his father, Tanjirou has taken it upon himself to support his family. Although their lives may be hardened by tragedy, they\'ve found happiness. But that ephemeral warmth is shattered one day when Tanjirou finds his family slaughtered and the lone survivor, his sister Nezuko, turned into a demon. To his surprise, however, Nezuko still shows signs of human emotion and thought...\n\nThus begins Tanjirou\'s quest to fight demons and turn his sister human again.\n\n(Source: VIZ Media)\n\nVolume 7 contains a bonus chapter about Kanao Tsuyuri.\nVolume 10 contains a bonus chapter about Inosuke Hashibira.', 'https://media.kitsu.io/manga/poster_images/37280/original.jpg', 37280, 0, 1, '2016-02-15'),
(7, 'One Piece', 'One Piece', 'Gol D. Roger was known as the Pirate King, the strongest and most infamous being to have sailed the Grand Line. The capture and death of Roger by the World Government brought a change throughout the world. His last words before his death revealed the location of the greatest treasure in the world, One Piece. It was this revelation that brought about the Grand Age of Pirates, men who dreamed of finding One Piece (which promises an unlimited amount of riches and fame), and quite possibly the most coveted of titles for the person who found it, the title of the Pirate King.\n\nEnter Monkey D. Luffy, a 17-year-old boy that defies your standard definition of a pirate. Rather than the popular persona of a wicked, hardened, toothless pirate who ransacks villages for fun, Luffy’s reason for being a pirate is one of pure wonder; the thought of an exciting adventure and meeting new and intriguing people, along with finding One Piece, are his reasons of becoming a pirate. Following in the footsteps of his childhood hero, Luffy and his crew travel across the Grand Line, experiencing crazy adventures, unveiling dark mysteries and battling strong enemies, all in order to reach One Piece.\n\n(Source: MAL Rewrite)', 'https://media.kitsu.io/manga/poster_images/38/original.jpg', 38, 0, 0, '1997-07-22'),
(8, 'Attack on Titan', 'Attack on Titan', 'A century ago, the grotesque giants known as Titans appeared and consumed all but a few thousand humans. The survivors took refuge behind giant walls. Today, the threat of the Titans is a distant memory, and a boy named Eren yearns to explore the world beyond Wall Maria. But what began as a childish dream will become an all-too-real nightmare when the Titans return and humanity is once again on the brink of extinction … Attack on Titan is the award-winning and New York Times-bestselling series that is the manga hit of the decade! Spawning the monster hit anime TV series of the same name, Attack on Titan has become a pop culture sensation. \n\n(Source: Kodansha Comics)\n\nVolume 3 contains the special story \"Rivai Heishichou\" (リヴァイ兵士長, Captain Levi).\nVolume 5 contains the side story \"Ilse no Techou\" (イルゼの手帳, Ilse\'s Notebook).', 'https://media.kitsu.io/manga/poster_images/14916/original.jpg', 14916, 0, 2, '2009-09-09'),
(9, 'Tokyo Ghoul', 'Tokyo Ghoul', 'Kaneki Ken is an unassuming university student living in Tokyo. However, his comfortable life is turned on its head after a string of violent murders pulls him unwillingly into the city\'s ghoul inhabited underbelly; a place that lives by the rule of eat or be eaten. Now, every day is a struggle to protect his life, his loved ones, and his humanity.', 'https://media.kitsu.io/manga/poster_images/7176/original.jpg', 7176, 0, 2, '2011-09-08');

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
-- Índices para tabela `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kitsu_id` (`kitsu_id`),
  ADD KEY `name` (`name`);

--
-- Índices para tabela `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `kitsu_id` (`kitsu_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
