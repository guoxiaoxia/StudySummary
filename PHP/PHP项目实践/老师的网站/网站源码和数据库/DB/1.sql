-- MySQL dump 10.13  Distrib 5.5.28, for Win32 (x86)
--
-- Host: localhost    Database: a04242151525
-- ------------------------------------------------------
-- Server version	5.5.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cms_admin`
--

DROP TABLE IF EXISTS `cms_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(255) DEFAULT NULL,
  `a_tname` varchar(255) DEFAULT NULL,
  `a_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_admin`
--

LOCK TABLES `cms_admin` WRITE;
/*!40000 ALTER TABLE `cms_admin` DISABLE KEYS */;
INSERT INTO `cms_admin` VALUES (1,'admin','管理员','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `cms_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_channel`
--

DROP TABLE IF EXISTS `cms_channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_channel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(255) DEFAULT NULL,
  `c_parent` int(11) DEFAULT NULL,
  `c_level` int(11) DEFAULT NULL,
  `c_main` int(11) DEFAULT NULL,
  `c_ifsub` int(11) DEFAULT NULL,
  `c_sub` longtext,
  `c_cmodel` varchar(255) DEFAULT NULL,
  `c_mcmodel` varchar(255) DEFAULT NULL,
  `c_dmodel` varchar(255) DEFAULT NULL,
  `c_mdmodel` varchar(255) DEFAULT NULL,
  `c_content` longtext,
  `c_scontent` longtext,
  `c_mcontent` longtext,
  `c_mscontent` longtext,
  `c_page` int(11) DEFAULT NULL,
  `c_seoname` varchar(255) DEFAULT NULL,
  `c_keywords` varchar(255) DEFAULT NULL,
  `c_description` varchar(255) DEFAULT NULL,
  `c_nav` int(11) DEFAULT NULL,
  `c_nname` varchar(255) DEFAULT NULL,
  `c_link` varchar(255) DEFAULT NULL,
  `c_sname` varchar(255) DEFAULT NULL,
  `c_aname` varchar(255) DEFAULT NULL,
  `c_cover` varchar(255) DEFAULT NULL,
  `c_target` varchar(255) DEFAULT NULL,
  `c_safe` int(11) DEFAULT NULL,
  `c_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_channel`
--

LOCK TABLES `cms_channel` WRITE;
/*!40000 ALTER TABLE `cms_channel` DISABLE KEYS */;
INSERT INTO `cms_channel` VALUES (1,'关于简美',0,1,1,1,'1,23,24,25','c_spage.php','c_mspage.php','d_simple.php','d_msimple.php','','<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','<p>\r\n <span style=\"white-space:normal;\">凡诺企业网站管理系统1.0（PHP版）</span> \r\n</p>\r\n<p>\r\n  <span style=\"white-space:normal;\">功能介绍：</span> \r\n</p>\r\n<p>\r\n  <span style=\"white-space:normal;\">一、电脑手机无缝访问，自动识别。</span> \r\n</p>\r\n<p>\r\n <span style=\"white-space:normal;\">二、无限级频道设计，自由扩展。</span> \r\n</p>\r\n<p>\r\n  <span style=\"white-space:normal;\">三、多种频道类型、详情类型自由绑定并支持自行扩展。</span> \r\n</p>\r\n<p>\r\n  <span style=\"white-space:normal;\">四、宽屏扁平化设计，符合现代趋势。</span>\r\n</p>\r\n<p>\r\n <span style=\"white-space:normal;\">五、支持伪静态。<br />\r\n</span> \r\n</p>\r\n<br />','<p style=\"text-indent:2em;\">\r\n  <p>\r\n   <span style=\"white-space:normal;\">凡诺企业网站管理系统1.0（PHP版）</span> \r\n </p>\r\n  <p>\r\n   <span style=\"white-space:normal;\">功能介绍：</span> \r\n </p>\r\n  <p>\r\n   <span style=\"white-space:normal;\">一、电脑手机无缝访问，自动识别。</span> \r\n  </p>\r\n  <p>\r\n   <span style=\"white-space:normal;\">二、无限级频道设计，自由扩展。</span> \r\n </p>\r\n  <p>\r\n   <span style=\"white-space:normal;\">三、多种频道类型、详情类型自由绑定并支持自行扩展。</span> \r\n </p>\r\n  <p>\r\n   <span style=\"white-space:normal;\">四、宽屏扁平化设计，符合现代趋势。</span>\r\n  </p>\r\n  <p>\r\n   <span style=\"white-space:normal;\">五、支持伪静态。<br />\r\n</span> \r\n  </p>\r\n</p>',20,'','','',1,'关于简美','','文章','About','','_self',1,1),(2,'简美品牌',0,1,2,0,'2','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','        <div class=\"box4\">\r\n            <div class=\"titles\">\r\n                <div style=\"display: inline-block;margin-left: 20px;color: rgb(31,137,62);width:500px;\">\r\n                    <h1 style=\"font-weight: normal;font-size: 25px;margin-bottom: 8px;\">关于品牌</h1>\r\n                    <h2 style=\"font-weight: normal;font-size: 16px\">——我不是干妈，我是简妹</h2>\r\n                    <p style=\"font-size: 14px;margin-top: 8px;\">简妹敢于在传统辣椒领域中独树一帜，建立清纯、年轻、时尚、健康的品牌形象简妹已成为辣椒界的新锐力量</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"content\" style=\"margin: 50px 0 40px 0;\">\r\n                <div class=\"left\" style=\"width: 65%;display: inline-block;\">\r\n                    <p style=\"line-height: 22px;margin-bottom: 25px\"><strong>简妹</strong>，代表人们内心一处最纯美的印记。她远离尘嚣，宛若林间氧气，山涧清泉，蕴含“大美至简，真水无香”之美韵。在添加剂横行的时代，简妹选择拒绝繁杂工艺和过度添加，保留食材中天地精华，让食材“简璞归真，美味天成”。</p>\r\n                    <h2 style=\"font-size: 20px;padding: 5px 8px;background: rgb(41,123,41);border-radius: 5px;display:inline-block;color:#fff;margin-bottom: 15px;\">简妹初心</h2>\r\n                    <p style=\"margin-bottom: 30px;line-height: 22px;\">简妹关怀现代人健康，尤其是嗜辣族，可她发现人们能选择的，只有一片重油、重添加、火红红的辣。所以，简妹希望给这浓烈的辣椒界带来美好的清新之风——<span>鲜制辣椒</span>。</p>\r\n                    <h2 style=\"font-size: 20px;padding: 5px 8px;background: rgb(41,123,41);border-radius: 5px;display:inline-block;color:#fff;margin-bottom: 15px;\">品牌绽放</h2>\r\n                    <p style=\"line-height: 22px;\">简妹在传统辣椒领域中独树一帜，一路走来，几经沉淀，历经考验，向世人绽放多角度的魅力，并日益绚烂。</p>\r\n                    <p style=\"line-height: 22px;\">简妹年轻且拥有一颗慧心，能感知现代人返璞归真的内心呼唤，让现代人重拾久违的简单与纯粹，令无数有缘人感慨，与她相遇，不是擦肩而过，而是内心重逢。</p>\r\n                </div>\r\n                <div class=\"right\" style=\"width: 33%;display: inline-block;text-align: center;vertical-align: top\">\r\n                    <img src=\"./images/about3.png\" width=\"225px;\" style=\"margin-top: -30px;\">\r\n                    <img src=\"./images/about4.png\" width=\"225px;\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n','','','',20,'及时发布一些新闻','频道关键字','频道关键描述',1,'简美品牌','','品牌','brand','','_self',1,2),(3,'简妹系列',0,1,3,0,'3','c_spage.php','c_mpicture.php','d_simple.php','d_msimple.php','<div class=\"box5\">\r\n	<div class=\"title\">\r\n		<h1>\r\n			简妹系列\r\n		</h1>\r\n	</div>\r\n	<div class=\"content\" style=\"margin:50px 0 40px 0;\">\r\n		<div style=\"overflow:hidden;margin-bottom:30px;\">\r\n			<img src=\"./images/sort1.jpg\" style=\"float:left;margin-right:30px;\" width=\"225px;\" /> \r\n			<div style=\"margin-top:10px;\">\r\n				<h2 style=\"font-size:20px;padding:5px 8px;background:#297B29;border-radius:5px;display:inline-block;color:#fff;margin-bottom:15px;\">\r\n					简妹墨椒\r\n				</h2>\r\n				<p style=\"line-height:22px;\">\r\n					选自墨西哥哈雷派尼奥辣椒，与中国风味豆豉相遇，中西合璧，浑然天成，鲜香满溢，带来齿间碰撞的回味。有粉丝感叹，品味过无数毫无个性的辣椒后，舌尖已索然无味，唯有简妹墨椒让舌尖苏醒，恍若经历一场奇妙“艳遇”。\r\n				</p>\r\n			</div>\r\n		</div>\r\n		<div style=\"overflow:hidden;margin-bottom:30px;\">\r\n			<img src=\"./images/sort2.jpg\" style=\"float:left;margin-right:30px;\" width=\"225px;\" /> \r\n			<div style=\"margin-top:10px;\">\r\n				<h2 style=\"font-size:20px;padding:5px 8px;background:#297B29;border-radius:5px;display:inline-block;color:#fff;margin-bottom:15px;\">\r\n					简妹裸椒\r\n				</h2>\r\n				<p style=\"line-height:22px;\">\r\n					又叫剥皮辣椒，拥有台湾血统，被剥去外衣而留细腻美肉，再以健康秘制酱汤泡浴而得，体色如麦，入口清脆滑嫩，连马英九都对其痴迷不已。简妹拥有中国大陆唯一发明专利。\r\n				</p>\r\n			</div>\r\n		</div>\r\n		<div style=\"overflow:hidden;margin-bottom:30px;\">\r\n			<img src=\"./images/sort3.jpg\" style=\"float:left;margin-right:30px;\" width=\"225px;\" /> \r\n			<div style=\"margin-top:10px;\">\r\n				<h2 style=\"font-size:20px;padding:5px 8px;background:#297B29;border-radius:5px;display:inline-block;color:#fff;margin-bottom:15px;\">\r\n					简妹萌椒\r\n				</h2>\r\n				<p style=\"line-height:22px;\">\r\n					用”谦谦君子，温润如玉”形容简妹的萌椒一点都不为过，爽口，后劲的辣味在口里不断徘徊，蘸酱提味，口感再一次升华，让血脉再次扩张，让喜欢尝鲜，喜欢品辣的您绝对不可错过的美食，没有之一\r\n				</p>\r\n			</div>\r\n		</div>\r\n		<div style=\"overflow:hidden;margin-bottom:30px;\">\r\n			<img src=\"./images/sort4.jpg\" style=\"float:left;margin-right:30px;\" width=\"225px;\" /> \r\n			<div style=\"margin-top:10px;\">\r\n				<h2 style=\"font-size:20px;padding:5px 8px;background:#297B29;border-radius:5px;display:inline-block;color:#fff;margin-bottom:15px;\">\r\n					简妹脆笋\r\n				</h2>\r\n				<p style=\"line-height:22px;\">\r\n					金黄的肌理，丝丝纤维清晰可见，婀娜身段百般妩媚，入口细嫩爽脆，顿觉惊艳了时光，惊艳了胃。\r\n				</p>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>','','','',20,'','','',1,'产品展示','','产品','Products','','_self',1,3),(4,'美食体验',0,1,4,0,'4','c_spage.php','c_mpicture.php','d_simple.php','d_msimple.php','        <div class=\"box7\">\r\n            <div class=\"title\">\r\n                <h1>美食体验</h1>\r\n            </div>\r\n            <div class=\"content\" style=\"margin: 50px 0 40px 0;\">\r\n                <h2 style=\"font-size: 20px;padding: 5px 8px;background: rgb(41,123,41);border-radius: 5px;display:inline-block;color:#fff;margin-bottom: 15px;\">简美餐饮</h2>\r\n                <p style=\"line-height: 22px;margin-bottom: 30px;\">小隐合苑、小隐围屋、四季渔歌、简妹小厨，是简美餐饮线下体验阵营，围绕简妹主题，打造多样化的时尚、经典、极致菜品，满足简妹家族不同口味。</p>\r\n                <h2 style=\"font-size: 20px;padding: 5px 8px;background: rgb(41,123,41);border-radius: 5px;display:inline-block;color:#fff;margin-bottom: 15px;\">简美食谱</h2>\r\n                <div>\r\n                    <img src=\"./images/IMG_5748.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5765.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5782.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5816.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5845.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5857.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5879.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5895.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5917.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_6010.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_6051.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                    <img src=\"./images/IMG_5795.JPG\" width=\"24.5%\" style=\"float:left;\">\r\n                </div>\r\n			</div>\r\n		</div>	','','','',20,'','','',1,'美食体验','','荣誉','Honor','','_self',1,4),(5,'大美至简',0,1,5,1,'5,28,29,30,31','c_spage.php','c_mpicture.php','d_simple.php','d_msimple.php','<div class=\"box7\">\r\n	<div class=\"title\">\r\n		<h1>\r\n			大美至简\r\n		</h1>\r\n	</div>\r\n	<div class=\"content\" style=\"margin:50px 0 40px 0;\">\r\n		<h2 style=\"font-size:20px;padding:5px 8px;background:#297B29;border-radius:5px;display:inline-block;color:#fff;margin-bottom:15px;\">\r\n			简美农业\r\n		</h2>\r\n		<p style=\"margin-bottom:15px;\">\r\n			简美作为一家农业全产业链的公司，在供应链上做好全面布局和保障，目前分别已开辟惠州、河源、清远、湛江等种植基地。\r\n		</p>\r\n		<p style=\"margin-bottom:15px;line-height:24px;\">\r\n			<strong>简美生活超市:</strong> 提供净菜果蔬、肉蛋奶禽、米面粮油、副食调料等，以企业餐饮和超市渠道优势，对接生产基地，完成产品从田间基地到城市厨房的统一加工。目前作为简妹厨房O2O体验中心旗舰店，在惠州首家运行。\r\n		</p>\r\n<br />\r\n		<h2 style=\"font-size:20px;padding:5px 8px;background:#297B29;border-radius:5px;display:inline-block;color:#fff;margin-bottom:15px;clear:right;\">\r\n			以辣椒友\r\n		</h2>\r\n<br />\r\n<img src=\"./images/friend1.jpg\" style=\"float:left;\" width=\"49%\" /> <img src=\"./images/friend2.jpg\" style=\"float:left;\" width=\"49%\" /><br /> <img src=\"./images/friend3.jpg\" style=\"float:left;\" width=\"49%\" /> <img src=\"./images/friend4.jpg\" style=\"float:left;\" width=\"49%\" /><br /><img src=\"./images/friend5.jpg\" style=\"float:left;\" width=\"49%\" /> <img src=\"./images/friend6.jpg\" style=\"float:left;\" width=\"49%\" /> <br /> <img src=\"./images/friend7.jpg\" style=\"float:left;\" width=\"49%\" /> <img src=\"./images/friend8.jpg\" style=\"float:left;\" width=\"49%\" /> <br />\r\n<br />\r\n		<h2 style=\"font-size:20px;padding:5px 8px;background:#297B29;border-radius:5px;display:inline-block;color:#fff;margin-bottom:15px;\">\r\n			简美热点\r\n		</h2>\r\n<br />\r\n		<div class=\"left\" style=\"width:65%;display:inline-block;\">\r\n			<ul style=\"list-style:none;\">\r\n				<li style=\"margin-bottom:10px;\">\r\n					<a href=\"#\">简妹惊艳亮相深圳农业资本论坛</a>\r\n				</li>\r\n				<li style=\"margin-bottom:10px;\">\r\n					<a href=\"#\">“温柔乡里叹激情”——杭州千人餐饮品鉴会</a>\r\n				</li>\r\n				<li style=\"margin-bottom:10px;\">\r\n					<a href=\"#\">因缘际会——吴晓波遇见简妹妹</a>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n		<div class=\"right\" style=\"width:33%;display:inline-block;text-align:center;vertical-align:top;\">\r\n			<img src=\"./images/friend4.jpg\" style=\"margin-top:-30px;\" width=\"240px;\" /> <img src=\"./images/friend5.jpg\" width=\"240px;\" /> <img src=\"./images/friend8.jpg\" width=\"240px;\" /> \r\n		</div>\r\n	</div>\r\n</div>','','','',20,'','','',1,'大美至简','','案例','Case','','_self',1,5),(6,'联系方式',0,1,6,1,'6,26,27,36','c_spage.php','c_mspage.php','d_simple.php','d_msimple.php','<p>\r\n 联系人：\r\n</p>\r\n<p>\r\n 电话：\r\n</p>\r\n<p>\r\n  手机：\r\n</p>\r\n<p>\r\n  QQ：\r\n</p>\r\n<p>\r\n  微信：\r\n</p>\r\n<p>\r\n  地址：\r\n</p>','<p>\r\n  联系人：\r\n</p>\r\n<p>\r\n 电话：\r\n</p>\r\n<p>\r\n  手机：\r\n</p>\r\n<p>\r\n  QQ：\r\n</p>\r\n<p>\r\n  微信：\r\n</p>\r\n<p>\r\n  地址：\r\n</p>','<p>\r\n  联系人：\r\n</p>\r\n<p>\r\n 电话：\r\n</p>\r\n<p>\r\n  手机：\r\n</p>\r\n<p>\r\n  QQ：\r\n</p>\r\n<p>\r\n  微信：\r\n</p>\r\n<p>\r\n  地址：\r\n</p>','<p>\r\n  联系人：\r\n</p>\r\n<p>\r\n 电话：\r\n</p>\r\n<p>\r\n  手机：\r\n</p>\r\n<p>\r\n  QQ：\r\n</p>\r\n<p>\r\n  微信：\r\n</p>\r\n<p>\r\n  地址：\r\n</p>',20,'','','',1,'联系方式','','文章','Contact','','_self',1,6),(23,'简美愿景',1,2,1,0,'23','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','        <div class=\"box1\">\r\n            <div class=\"title\">\r\n                <h1>简美愿景</h1>\r\n            </div>\r\n            <div class=\"content\">\r\n                <ul>\r\n                    <li class=\"list1\">立足辣椒全产业链，打造<span class=\"yellow\">中国辣椒第一品牌</span></li>\r\n                    <li class=\"list2\"><span class=\"special\">以辣椒友</span>——构建有内容、有温度、有态度、有影响的千万级粉丝的简妹椒友社群，成为有高度互联网特质的全产业链生态大农业运营商和美好生活平台，与有缘人共同创享一份<span class=\"yellow\">心生美好</span>的事业!</li>\r\n                </ul>\r\n                <img src=\"./images/box1.png\" width=\"330px\" class=\"content-img\">\r\n            </div>\r\n        </div>\r\n','','','',20,'','','',1,'简美愿景','','愿景','wish','','_self',0,23),(24,'简美创始人',1,2,1,0,'24','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','        <div class=\"box2\">\r\n            <div class=\"title\">\r\n                <h1>创始人简介</h1>\r\n            </div>\r\n            <div class=\"content\">\r\n                <img src=\"./images/boss.png\" width=\"180px\" class=\"boss-img\">\r\n                <div>\r\n                    <h4>董事长、首席执行官（CEO）饶亮先生</h4>\r\n                    <p>兰州大学毕业后，曾先后任职<strong>德赛及TCL全国营销总监，2002年开始自主创业</strong>，成功创立并运营3家惠州<strong>知名餐饮企业</strong>。目前担任惠州市江西商会常务副会长、兰州大学校惠州校友会会长等社会团体职务。</p>\r\n                    <p>饶亮离开德赛和TCL后，因为坚守一份承诺，所以创业方向放弃了自己经历和资源丰富的电子通讯领域，而选择餐饮和农业。因为对辣椒情有独钟，饶亮倾注多年心血在以辣椒为主的农业事业，尽管一路经历千辛万苦，挫败辗转，但始终乐此不疲，用饶亮的话解释，“选择了大农业，就是选择情怀和善良。”</p>\r\n                    <p>早前前多年餐饮业的经历，令饶亮深刻体会到“食材为天”，他不断探寻各种美食美味，在一次餐桌上偶然发现了台湾剥皮辣椒，随后收购台商的剥皮辣椒工厂和发明专利；后来又发现了墨椒、引种墨椒、开发墨椒，面对市场上清一色红油干辣椒、腌剁椒、泡米椒，同质化的传统辣椒，饶亮开始探索，可否做到鲜制而不失美味；可否健康而不失独特；可否简单而摒弃复杂的加工和添加？于是，饶亮率先提出鲜制辣椒理念，并催生了今天已悄然引领辣椒产业革命的 “简妹妹”。</p>\r\n                    <p>21载职场与创业的耕耘历练，让饶亮深刻领悟到“大美至简”的真谛，所以把这份他倾注所有智慧与心力的辣椒事业，命名为简美，希望以辣椒友，与天下有缘人共同经营和畅享一份心生美好的事业。</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n','','','',20,'','','',1,'简美创始人','','创始人','leader','','_self',0,24),(25,'企业简介',1,2,1,0,'25','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','<div class=\"box3\">\r\n	<div class=\"title\">\r\n		<h1>\r\n			关于简美\r\n		</h1>\r\n	</div>\r\n	<div class=\"content\" style=\"margin:50px 0 40px 0;\">\r\n		<div class=\"left\" style=\"width:65%;display:inline-block;\">\r\n			<p style=\"text-indent:2em;line-height:25px;\">\r\n				简美是一家集合种植、研发、生产加工、体验、销售全产业链，实现农业产业一体化的企业。简美崇尚“越简单，越真实；越简单，越美味”，摒弃复杂，坚持简单的哲理，引领顾客感受并发现简单食材中的美味和惊艳。\r\n			</p>\r\n			<ul style=\"margin-top:30px;line-height:25px;margin-left:40px;margin-bottom:30px;\">\r\n				<li>\r\n					简美率先在清一色红油干辣椒、腌剁椒、泡米椒，同质化的传统辣椒领域中，进行品类创新，首家提出并倡导鲜制辣椒的理念，推出简妹墨椒和简妹裸椒产品。独树一帜，打破格局，给辣椒界吹来一股清风。\r\n				</li>\r\n				<li>\r\n					简美是第一家大规模成功引种墨西哥辣椒，并实现一年四季鲜采墨椒的企业；\r\n				</li>\r\n				<li>\r\n					简美是第一家用鲜制工艺生产脆口鲜剁椒，并倡导鲜食文化的企业；\r\n				</li>\r\n				<li>\r\n					简美在辣椒产业首家提出中央厨房化的工厂以及工厂化的中央厨房，实现工业化的厨房品质。\r\n				</li>\r\n			</ul>\r\n			<p>\r\n				简美目前旗下包括简美食品、简美生态农业、简美餐饮及电子商务四大事业板块。\r\n			</p>\r\n		</div>\r\n		<div class=\"right\" style=\"width:33%;display:inline-block;text-align:center;vertical-align:top;\">\r\n			<img src=\"./images/about1.png\" width=\"225px;\" /> <img src=\"./images/about2.png\" width=\"225px;\" /> \r\n		</div>\r\n	</div>\r\n</div>','','','',20,'','','',1,'企业简介','','企业简介','intro','','_self',0,25),(26,'公司地址',6,2,6,0,'26','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','<p>\r\n	<iframe style=\"width:560px;height:362px;\" src=\"http://localhost:8080/editor/plugins/baidumap/index.html?center=114.421336%2C23.109362&zoom=14&width=558&height=360&markers=114.421336%2C23.109362&markerStyles=l%2CA\" frameborder=\"0\">\r\n	</iframe>\r\n公司地址：惠州市\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>','公司地址：惠州市','<p>\r\n	<iframe style=\"width:560px;height:362px;\" src=\"http://localhost:8080/editor/plugins/baidumap/index.html?center=114.421336%2C23.109362&zoom=14&width=558&height=360&markers=114.421336%2C23.109362&markerStyles=l%2CA\" frameborder=\"0\">\r\n	</iframe>\r\n公司地址：惠州市\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>','公司地址：惠州市',20,'','','',1,'公司地址','','公司地址','address','','_self',0,26),(27,'人力资源',6,2,6,0,'27','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','        <div class=\"box11\">\r\n            <div class=\"title\">\r\n                <h1>人力资源</h1>\r\n            </div>\r\n            <div class=\"content\" style=\"margin: 50px 0 40px 0;\">\r\n            	<h2 style=\"font-size: 20px;padding: 5px 8px;background: rgb(41,123,41);border-radius: 5px;display:inline-block;color:#fff;margin-bottom: 15px;\">简美文化</h2>\r\n            	<p style=\"line-height: 23px;\">简美是一家集合种植、研发、生产加工、体验、销售全产业链，实现农业产业一体化的企业，我们的愿景是立足辣椒全产业链，整合优质社会资源，打造中国鲜制辣椒品牌，以辣椒友——与有缘人共同经营和分享一份心生美好的事业。</p>\r\n            	<p style=\"line-height: 23px;\">简美崇尚“大美至简”，并一直以“越简单，越真实；越简单，越美味”为追求；摒弃复杂，坚持简单的逻辑，为顾客带来食物的真正原味，让顾客发现简单食材中的惊艳。我们是一家能够在国内实现大规模引种墨西哥辣椒并全年鲜采墨椒、采用鲜制工艺生产脆口鲜剁椒，倡导鲜食文化的企业，是鲜制辣椒的开创者，并提出中央厨房化的工厂、工厂化的中央厨房之理念。</p>\r\n            	<p style=\"line-height: 23px;\">品牌\"简妹\"，象征着质朴而纯真，如山涧清泉，明澈无暇，蕴含“简璞归真，美味天成”之理念。简妹以简妹裸椒和简妹墨椒为主打，在传统重添加、重红油的辣椒制品领域中独树一帜，全新定义“鲜制辣椒”新理念，建立清纯、年轻、时尚且健康的品牌形象，“我不是干妈，我是简妹！”，是最好的诠释，意在给辣椒界带来清新脱俗之风。目前，简美拥有剥皮辣椒中国大陆发明专利权。</p>\r\n            	<p style=\"line-height: 23px;\"> 简美倡导人文关怀、以奋斗者为本的企业文化，拒绝喧嚣浮躁，奉行“真诚、专注、分享、创新”的价值理念，简美集团目前旗下包括简美食品、简美餐饮、简美生态农业及简美电子商务四大核心业务板块（其中简美生态农业业务范畴包含简美生活超市（简妹厨房O2O体验中心）、简妹厨房专柜，简妹厨房B2B业务及简妹厨房垂直电商，目前火热招聘中）。</p>\r\n            	<p style=\"line-height: 23px;\">简美为员工提供广阔的职业发展平台和机会，真诚欢迎天下有缘人，和我们一同携手畅享这份心生美好的事业！</p>\r\n            	<p style=\"margin-bottom: 20px;margin-top: 30px;\"><strong style=\"font-size: 20px;font-weight: bold;\">联系方式：</strong>惠城演达二路8号简美大厦（美地花园城斜对面）</p>\r\n            	<div style=\"margin-top: 30px;\">\r\n            		<h2 style=\"font-size: 20px;padding: 5px 8px;background: rgb(41,123,41);border-radius: 5px;display:inline-block;color:#fff;margin-bottom: 15px;\">招聘人才</h2>\r\n            		<h3 style=\"margin-bottom: 15px;\">城市主管</h3>\r\n            		<h4 style=\"margin-bottom: 10px;\">职位描述：</h4>\r\n            		<ol style=\"margin-left: 30px;line-height: 23px;\">\r\n            			<li>策划与执行公司在东莞地区的各项产品促销活动推广计划；</li>\r\n            			<li>开发、拓展及维护东莞的KA系统或流通餐饮等渠道；</li>\r\n            			<li>拓展及维护经销商网络，确保顺畅合作；</li>\r\n            			<li>完成公司下达的年度销售目标和公司要求的其他相关工作指标；</li>\r\n            		</ol>\r\n            		<h4 style=\"margin-bottom: 10px;margin-top: 15px;\">岗位要求：</h4>\r\n            		<ol style=\"margin-left: 30px;line-height: 23px;\">\r\n            			<li>3年以上食品快消品工作经验，有调味品或农副产品销售经验优先；</li>\r\n            			<li>有丰富的KA或流通，餐饮等渠道经销商资源者优先； </li>\r\n            			<li>坚韧、能吃苦，良好的个人价值观，持续保持工作激情，善于自我激励；</li>\r\n            		</ol>\r\n            	</div>\r\n            </div>\r\n        </div>\r\n','','','',20,'','','',1,'人力资源','','人力资源','recruit','','_self',0,27),(28,'简美农业',5,2,5,0,'28','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','','','','',20,'','','',0,'简美农业','','简美农业','argr','','_self',0,28),(29,'以辣椒友',5,2,5,0,'29','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','','','','',20,'','','',0,'以辣椒友','','以辣椒友','friends','','_self',0,29),(30,'简美热点',5,2,5,0,'30','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','','','','',20,'','','',0,'简美热点','','简美热点','hots','','_self',0,30),(31,'辣味相投',5,2,5,0,'31','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','','','','',20,'','','',0,'辣味相投','','辣味相投','lwxt','','_self',0,31),(36,'天罗地网',6,2,6,0,'36','c_spage.php','c_marticle.php','d_simple.php','d_msimple.php','<div class=\"box6\">\r\n	<div class=\"title\">\r\n		<h1>\r\n			天罗地网\r\n		</h1>\r\n	</div>\r\n	<div class=\"content\" style=\"margin:50px 0 40px 0;\">\r\n		<div>\r\n			<p style=\"color:#fff;background-color:#297B29;border-radius:5px;padding:5px 9px;font-weight:bold;display:inline-block;margin-bottom:15px;margin-top:15px;\">\r\n				地网——全国各大知名连锁渠道、传统批发渠道、餐饮渠道、航空高铁等特殊渠道、高校渠道及海外市场。\r\n			</p>\r\n<img src=\"./images/map.png\" width=\"95%\" /> \r\n		</div>\r\n		<div>\r\n			<p style=\"color:#fff;background-color:#297B29;border-radius:5px;padding:5px 9px;font-weight:bold;display:inline-block;margin-bottom:15px;margin-top:15px;\">\r\n				天网——天猫、京东、阿里巴巴、微商城\r\n			</p>\r\n<img src=\"./images/shop1.png\" width=\"95%\" /> \r\n		</div>\r\n	</div>\r\n</div>','','        <div class=\"box6\">\r\n            <div class=\"title\">\r\n                <h1>天罗地网</h1>\r\n            </div>\r\n            <div class=\"content\" style=\"margin: 50px 0 40px 0;\">\r\n                <div>\r\n                    <p style=\"color:#fff;background-color: rgb(41,123,41);border-radius: 5px;padding: 5px 9px;font-weight: bold;display:inline-block;margin-bottom: 15px;margin-top: 15px;\">地网——全国各大知名连锁渠道、传统批发渠道、餐饮渠道、航空高铁等特殊渠道、高校渠道及海外市场。</p>\r\n                    <img src=\"./images/map.png\" width=\"100%\">\r\n                </div>\r\n                <div>\r\n                    <p style=\"color:#fff;background-color: rgb(41,123,41);border-radius: 5px;padding: 5px 9px;font-weight: bold;display:inline-block;margin-bottom: 15px;margin-top: 15px;\">天网——天猫、京东、阿里巴巴、微商城</p>\r\n                    <img src=\"./images/shop1.png\" width=\"100%\">\r\n                    <img src=\"./images/shop2.png\" width=\"100%\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n','',20,'','','',0,'天罗地网','','','','','_blank',1,36);
/*!40000 ALTER TABLE `cms_channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_chip`
--

DROP TABLE IF EXISTS `cms_chip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_chip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(255) DEFAULT NULL,
  `c_content` varchar(255) DEFAULT NULL,
  `c_safe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_chip`
--

LOCK TABLES `cms_chip` WRITE;
/*!40000 ALTER TABLE `cms_chip` DISABLE KEYS */;
INSERT INTO `cms_chip` VALUES (1,'全局浮动内容 - 不可删除','全局浮动内容',1),(2,'全局第三方代码 - 不可删除','全局第三方代码',1);
/*!40000 ALTER TABLE `cms_chip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_detail`
--

DROP TABLE IF EXISTS `cms_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(255) DEFAULT NULL,
  `d_picture` varchar(255) DEFAULT NULL,
  `d_parent` int(11) DEFAULT NULL,
  `d_rec` int(11) DEFAULT NULL,
  `d_hot` int(11) DEFAULT NULL,
  `d_slideshow` longtext,
  `d_content` longtext,
  `d_mcontent` longtext,
  `d_scontent` longtext,
  `d_mscontent` longtext,
  `d_seoname` varchar(255) DEFAULT NULL,
  `d_keywords` varchar(255) DEFAULT NULL,
  `d_description` varchar(255) DEFAULT NULL,
  `d_link` varchar(255) DEFAULT NULL,
  `d_order` int(11) DEFAULT NULL,
  `d_source` varchar(255) DEFAULT NULL,
  `d_author` varchar(255) DEFAULT NULL,
  `d_hits` int(11) DEFAULT '0',
  `d_video` longtext,
  `d_file` varchar(255) DEFAULT NULL,
  `d_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_detail`
--

LOCK TABLES `cms_detail` WRITE;
/*!40000 ALTER TABLE `cms_detail` DISABLE KEYS */;
INSERT INTO `cms_detail` VALUES (114,'简妹系列','/uploadfile/image/20160426/20160426173308_10255.jpg',3,1,1,'','','','','','','','','',114,'','',5,'','',1460542323),(115,'简妹系列','/uploadfile/image/20160426/20160426173241_56691.jpg',3,1,1,'','','','','','','','','',115,'','',2,'','',1460542335),(117,'简妹系列','/uploadfile/image/20160426/20160426173207_20934.jpg',3,1,1,'','','','','','','','','',117,'','',8,'','',1460542363),(118,'简妹系列','/uploadfile/image/20160426/20160426172704_27822.jpg',3,1,1,'','','','','','','','','',118,'','',5,'','',1460542374);
/*!40000 ALTER TABLE `cms_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_feedback`
--

DROP TABLE IF EXISTS `cms_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_ok` int(11) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `f_tel` varchar(255) DEFAULT NULL,
  `f_qq` varchar(255) DEFAULT NULL,
  `f_email` varchar(255) DEFAULT NULL,
  `f_cname` varchar(255) DEFAULT NULL,
  `f_address` varchar(255) DEFAULT NULL,
  `f_content` longtext,
  `f_answer` longtext,
  `f_date` int(11) DEFAULT NULL,
  `f_adate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_feedback`
--

LOCK TABLES `cms_feedback` WRITE;
/*!40000 ALTER TABLE `cms_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_link`
--

DROP TABLE IF EXISTS `cms_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `l_name` varchar(255) DEFAULT NULL,
  `l_order` int(11) DEFAULT NULL,
  `l_url` varchar(255) DEFAULT NULL,
  `l_picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_link`
--

LOCK TABLES `cms_link` WRITE;
/*!40000 ALTER TABLE `cms_link` DISABLE KEYS */;
INSERT INTO `cms_link` VALUES (1,'阿里巴巴',1,'http://www.1688.com','/uploadfile/demo/image/link/1688.png'),(2,'百度中国',2,'http://www.baidu.com','/uploadfile/demo/image/link/baidu.png'),(3,'腾讯网',3,'http://www.qq.com','/uploadfile/demo/image/link/qq.png'),(4,'新浪网',4,'http://www.sina.com','/uploadfile/demo/image/link/sina.png');
/*!40000 ALTER TABLE `cms_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_model`
--

DROP TABLE IF EXISTS `cms_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(255) DEFAULT NULL,
  `m_value` varchar(255) DEFAULT NULL,
  `m_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_model`
--

LOCK TABLES `cms_model` WRITE;
/*!40000 ALTER TABLE `cms_model` DISABLE KEYS */;
INSERT INTO `cms_model` VALUES (1,'单页','c_spage.php',1),(2,'单页-宽','c_spage_w.php',1),(3,'文章','c_article.php',1),(4,'文章-详','c_article_d.php',1),(5,'文章-宽','c_article_w.php',1),(6,'图片','c_picture.php',1),(7,'图片-详','c_picture_d.php',1),(8,'图片-宽','c_picture_w.php',1),(9,'简约','d_simple.php',2),(10,'详细','d_detail.php',2),(11,'宽屏','d_wide.php',2),(12,'单页','c_mspage.php',3),(13,'文章','c_marticle.php',3),(14,'图片','c_mpicture.php',3),(15,'简约','d_msimple.php',4),(16,'详细','d_mdetail.php',4);
/*!40000 ALTER TABLE `cms_model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_slideshow`
--

DROP TABLE IF EXISTS `cms_slideshow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(255) DEFAULT NULL,
  `s_parent` varchar(255) DEFAULT NULL,
  `s_order` int(11) DEFAULT NULL,
  `s_url` varchar(255) DEFAULT NULL,
  `s_picture` varchar(255) DEFAULT NULL,
  `s_content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_slideshow`
--

LOCK TABLES `cms_slideshow` WRITE;
/*!40000 ALTER TABLE `cms_slideshow` DISABLE KEYS */;
INSERT INTO `cms_slideshow` VALUES (1,'','1',3,'','/uploadfile/demo/image/banner/IMG_6557.jpg','我是内容'),(3,'','1',3,'','/uploadfile/demo/image/banner/IMG_6554.jpg',''),(5,'','1',1,'','/uploadfile/image/20160426/20160426172046_86135.jpg',NULL);
/*!40000 ALTER TABLE `cms_slideshow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_system`
--

DROP TABLE IF EXISTS `cms_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_template` varchar(255) DEFAULT NULL,
  `s_mode` int(11) DEFAULT NULL,
  `s_domain` varchar(255) DEFAULT NULL,
  `s_name` varchar(255) DEFAULT NULL,
  `s_seoname` varchar(255) DEFAULT NULL,
  `s_keywords` longtext,
  `s_description` longtext,
  `s_hotkeywords` longtext,
  `s_copyright` longtext,
  `s_mcopyright` longtext,
  `s_feedback` int(11) DEFAULT NULL,
  `s_phone` varchar(255) DEFAULT NULL,
  `s_qq` varchar(255) DEFAULT NULL,
  `s_qrcode` varchar(255) DEFAULT NULL,
  `s_mlogo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_system`
--

LOCK TABLES `cms_system` WRITE;
/*!40000 ALTER TABLE `cms_system` DISABLE KEYS */;
INSERT INTO `cms_system` VALUES (1,'1',1,'http://www.mukit.net','简美企业网站系统','环保食品','企业网站、企业网站管理系统','关键描述','简美|食品|辣椒','版权所有 2016 保留所有权利 -','版权所有 2008-2016 保留所有权利',1,'13123456789','987654321','/uploadfile/demo/image/qrcode.png','/uploadfile/demo/image/mlogo.png');
/*!40000 ALTER TABLE `cms_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_template`
--

DROP TABLE IF EXISTS `cms_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(255) DEFAULT NULL,
  `t_path` varchar(255) DEFAULT NULL,
  `t_logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_template`
--

LOCK TABLES `cms_template` WRITE;
/*!40000 ALTER TABLE `cms_template` DISABLE KEYS */;
INSERT INTO `cms_template` VALUES (1,'金智科技网站管理系统Web3.6-默认模板','1','/uploadfile/demo/image/logo.jpg');
/*!40000 ALTER TABLE `cms_template` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-27 19:45:01
