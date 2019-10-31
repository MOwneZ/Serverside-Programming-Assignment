<?php

//*********************************************************

function getAccountDetails($db)
 {
	$sql = "select * from AccountDetails order by accountID" ;
    $result = $db->query($sql);  
    return $result ;
}

//*********************************************************
function getLogins($db)
{
	$sql = "select * from Login order by userName" ;
    $result = $db->query($sql);  
    return $result ;
}

//*********************************************************
function getBlogPosts($db)
{
    
    $sql = "select * from BlogPost" ;
    $result = $db->query($sql);  
    return $result;
}

//*********************************************************
function AddBlogPost($db, $newPostTitle, $newPostContent, $newUserName) 
{
	$sql = "insert into BlogPost values (null,'$newPostTitle','$newPostContent',CURDATE(),'$newUserName')";
	$db->insertRow($sql);
	echo "the record was inserted";
}
//*********************************************************
function getBlogCommentCount($db, $thePostID)
{
	$sql = "SELECT COUNT(commentID) AS total FROM BlogComment WHERE postID = '$thePostID'";
	$commentCount = $db->query($sql);  
	$n = $commentCount->fetch();
	$result = (int)$n['total'];
    return $result;
}
//*********************************************************
function getAccountId($db, $userName, $password)
{
	$sql = "select * from Login where userName = '$userName' and hash = '$password'";
	$account = $db->query($sql);
	$row = $account->fetch();
	$result = $row['accountID'];
	return $result;
	
}
//*********************************************************
function retrieveLogin($db, $userName)
{
	$sql = "select * from Login where userName = '$userName'";
	$hash = $db->query($sql);
	$row = $hash->fetch();
	$result = $row['hash'];
	return $result;
}
//*********************************************************
function retrieveUserName($db, $theAccountID)
{
	$sql = "select * from Login where accountID = '$theAccountID'";
	$theUserName = $db->query($sql);
	$row = $theUserName->fetch();
	$result = $row['userName'];
	return $result;
}
//*********************************************************
function usernameExists($db, $theUserName)
{
	$sql = "select count(userName) as total from Login where userName = '$theUserName'";
	$theUserName = $db->query($sql);
	$n = $theUserName->fetch();
	$count = (int)$n['total'];
	if ($count == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>
