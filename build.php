<?php
require_once("MySQLDB.php");

$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'sudoku';

$db = new MySQL($host, $dbUser, $dbPass, $dbName );
$db->dropDatabase();
$db->createDatabase();
$db->selectDatabase();

// table creation

// AccountDetails table creation
$Table = "AccountDetails";
$sql = "CREATE TABLE AccountDetails (
		accountID INTEGER AUTO_INCREMENT,
		firstName CHAR(40) NOT NULL,
		lastName CHAR(40) NOT NULL,
		userName VARCHAR(50) UNIQUE NOT NULL,
		hash VARCHAR(255) UNIQUE NOT NULL,
		emailAddress VARCHAR(30) UNIQUE,
		dateOfBirth DATE NOT NULL,
		phoneNo VARCHAR(20) NOT NULL,
		address1 VARCHAR(50) NOT NULL,
		address2 VARCHAR(50) NOT NULL,
		PRIMARY KEY (accountID)
		)ENGINE INNODB;";
$db->createTable($Table, $sql);
// OldDetails table creation
$Table = "OldDetails";
$sql = "CREATE TABLE OldDetails (
		accountID INTEGER,
		dateModified date,
		firstName CHAR(40) NOT NULL,
		lastName CHAR(40) NOT NULL,
		userName VARCHAR(50),
		hash VARCHAR(255),
		emailAddress VARCHAR(30),
		dateOfBirth DATE NOT NULL,
		phoneNo VARCHAR(20) NOT NULL,
		address1 VARCHAR(50) NOT NULL,
		address2 VARCHAR(50) NOT NULL,
		FOREIGN KEY (accountID) REFERENCES AccountDetails (accountID)
		)engine innodb;";
$db->createTable($Table, $sql);		
// Login Table Creation
$Table = "Login";
$sql = "CREATE TABLE Login (
		userName VARCHAR(50) UNIQUE NOT NULL,
		hash VARCHAR(255) UNIQUE NOT NULL,
		accountID INTEGER NOT NULL,
		PRIMARY KEY (userName),
		FOREIGN KEY (accountID)
			REFERENCES AccountDetails (accountID),
		FOREIGN KEY (userName)
			REFERENCES AccountDetails (userName),
		FOREIGN KEY (hash)
			REFERENCES AccountDetails (hash)
		)ENGINE INNODB;";
$db->createTable($Table, $sql);
// Blog Post table creation
$Table = "BlogPost";
$sql = "CREATE TABLE BlogPost (
		postID INTEGER AUTO_INCREMENT,
		postTitle VARCHAR(50) NOT NULL UNIQUE,
		postContent VARCHAR(500) NOT NULL,
		postDate DATE NOT NULL,
		userName VARCHAR(50) NOT NULL,
		PRIMARY KEY (postID),
		FOREIGN KEY (userName)
			REFERENCES Login (userName)
		)ENGINE INNODB;";
$db->createTable($Table, $sql);
// Blog Comment table creation
$Table = "BlogComment";
$sql = "CREATE TABLE BlogComment (
		commentID INTEGER AUTO_INCREMENT,
		postID INTEGER NOT NULL,
		commentContent VARCHAR(300) NOT NULL,
		commentDate DATE NOT NULL,
		userName VARCHAR(25) NOT NULL,
		PRIMARY KEY (commentID),
		FOREIGN KEY (postID)
			REFERENCES BlogPost (postID),
		FOREIGN KEY (userName)
			REFERENCES Login (userName)
		)ENGINE INNODB;";
$db->createTable($Table, $sql);

// trigger creation

// create user login trigger
$Trigger = "CreateUserLogin";
$sql = "create trigger CreateUserLogin after insert on AccountDetails
		for each row
		insert into Login values (new.userName, new.hash, new.AccountID);";
$db->createTrigger($Trigger, $sql);
// create store old details trigger
$Trigger = "StoreOldDetails";
$sql = "create trigger StoreOldDetails after update on AccountDetails
		for each row
		insert into OldDetails values (old.accountID,current_timestamp(),old.firstName,old.lastName,old.userName,old.hash,old.emailAddress,old.dateOfBirth,old.phoneNo,old.address1,old.address2);";
$db->createTrigger($Trigger, $sql);

// existing data insertion

// Account Details insertion
$userName = 'AmitTheSlayer6969';
$password = 'password3';
$login = $userName . $password;
$hash = password_hash($login, PASSWORD_DEFAULT);
$sql = "insert into AccountDetails values (null,'Amit','Sarkar','$userName','$hash','AmitLordOfTheSun@NZGardner.com','0000-12-25',033352456,'34 Kingly Street, Calimara','PO Box Fishman');";
$db->insertRow($sql);
$userName = 'SnickerMan';
$password = 'ImBald';
$login = $userName . $password;
$hash = password_hash($login, PASSWORD_DEFAULT);
$sql = "insert into AccountDetails values (null,'Nick','Leslie','$userName','$hash','Glenda12@NZGardner.com','2004-01-11',033453623,'University of Canterbury','PO Box UC');";
$db->insertRow($sql);
$userName = 'WheresMySuperSuit';
$password = 'Fibbonacci';
$login = $userName . $password;
$hash = password_hash($login, PASSWORD_DEFAULT);
$sql = "insert into AccountDetails values (null,'Emily','Chuck Cheese','$userName','$hash','erangleMan@gmail.com','1997-05-22',034968394,'8 Newsons Road','RD3 Cheviot');";
$db->insertRow($sql);
$userName = 'MrKansas';
$password = 'flubber';
$login = $userName . $password;
$hash = password_hash($login, PASSWORD_DEFAULT);
$sql = "insert into AccountDetails values (null,'Spup','Malarky','$userName','$hash','FlatEarthSociety@FESAdmin.com','1990-05-04',035903456,'NASA','Miami, FL'); ";
$db->insertRow($sql);

// blog post insertion
$sql = 'insert into BlogPost values (null,"I love all the sirens","this is a great text box! I sure do love it! Man, ice creams are great.","2019-05-22","AmitTheSlayer6969");';
$db->insertRow($sql);
$sql = 'insert into BlogPost values (null,"Wizard","Morbi eu pharetra eros, et consequat sem. Nam commodo purus ut mauris tempor, vestibulum congue leo laoreet. Aenean congue est at sem placerat, varius fringilla quam ullamcorper. Curabitur leo magna, venenatis vitae libero eu, molestie auctor eros. In laoreet euismod libero sed efficitur. Suspendisse rutrum mi sed consequat finibus. Etiam sollicitudin est eget mauris venenatis, eget cursus nisl vulputate. Mauris ac mi consectetur, rutrum augue non, imperdiet sem. Nunc ac lectus cursus, tincidunt sapien sit amet, ultricies ipsum. Aenean fringilla faucibus ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam hendrerit tortor quis porta venenatis. Integer sed pharetra magna.","2019-05-22","AmitTheSlayer6969");';
$db->insertRow($sql);
$sql = 'insert into BlogPost values (null,"Pulp Fiction: Worst movie ever!","Praesent fermentum enim vitae tortor molestie interdum. Vivamus commodo gravida neque sit amet facilisis. Etiam nec rutrum est. Nunc vestibulum condimentum vehicula. Vivamus ornare tempus elit, eget sagittis lectus ornare in. Cras volutpat, est quis consequat rutrum, purus libero ultrices orci, in sodales orci nisl dignissim augue. Donec scelerisque efficitur leo, eu lobortis lorem congue ac. Aenean eu odio a justo semper ultrices vitae at felis. Pellentesque maximus finibus sem, vitae porta velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean congue varius ante nec malesuada. Curabitur congue commodo erat, in laoreet ipsum vehicula non. Mauris non nisl aliquam, pharetra sem efficitur, viverra libero. Fusce viverra dui et sem malesuada fringilla.","2019-08-11","WheresMySuperSuit");';
$db->insertRow($sql);
$sql = 'insert into BlogPost values (null,"Please dont send me back to Kindy","Morbi maximus quis augue vel egestas. Donec efficitur pulvinar dapibus. Donec quis mauris vitae nisl consectetur tristique. Curabitur sit amet massa sodales, auctor libero nec, tempus orci. Pellentesque id euismod enim. Duis venenatis nunc sed eros facilisis, sit amet finibus nibh pharetra. Vivamus placerat nisi sit amet luctus cursus.","2019-02-09","AmitTheSlayer6969");';
$db->insertRow($sql);
$sql = 'insert into BlogPost values (null,"Amit is the best","Auckland has too many people. Ive almost had enough!","2018-05-22","MrKansas");';
$db->insertRow($sql);
$sql = 'insert into BlogPost values (null,"Please help; my teacher is trying to kill me","I genuinely think I am in extreme danger. send help","2019-06-04","WheresMySuperSuit");';
$db->insertRow($sql);
$sql = 'insert into BlogPost values (null,"I lost my dog somewhere in the park","A group of angry cousins came at me with knives. Big troubles lie ahead.","2019-05-22","WheresMySuperSuit");';
$db->insertRow($sql);
$sql = 'insert into BlogPost values (null,"Good lord, this website!","This is by far the greatest website I have EVER seen. Keep up the A+ work! I am so happy whenever I visit this website.","2018-05-08","MrKansas");';
$db->insertRow($sql);

// blog comment insertion
$sql = 'insert into BlogComment values (null,2,"I agree with this post!","2018-05-22","AmitTheSlayer6969");';
$db->insertRow($sql);
$sql = 'insert into BlogComment values (null,3,"I am feeling ok with this post!","2018-05-22","Snickerman");';
$db->insertRow($sql);
$sql = 'insert into BlogComment values (null,3,"I am angry with this post!","2018-05-22","WheresMySuperSuit");';
$db->insertRow($sql);
$sql = 'insert into BlogComment values (null,1,"I am providing feedback to this post!","2018-05-22","AmitTheSlayer6969");';
$db->insertRow($sql);
$sql = 'insert into BlogComment values (null,1,"Lost my dog?","2018-05-22","AmitTheSlayer6969");';
$db->insertRow($sql);
$sql = 'insert into BlogComment values (null,1,"I disagree with this post!","2018-05-22","AmitTheSlayer6969");';
$db->insertRow($sql);

require_once('displayTables.php');
?>