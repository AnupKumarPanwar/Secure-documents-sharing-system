<?php

	require('db.php');
	session_start();


	$getUsersofADoc="SELECT * FROM sharedfiles, users WHERE fileid='8' and user_id=receiver";
	$result=mysqli_query($conn, $getUsersofADoc);

	$row=array();

	$tempSender=array();
	$tempSender['id']='Anup Kumar Panwar';
	$tempSender['group']=1;
	$row[]=$tempSender;

	while ($r=mysqli_fetch_assoc($result)) {
		$temp=array();
		$temp['id']=$r['full_name'];
		$temp['group']=2;
		$row[]=$temp;
	}

	$getLinksofADoc="SELECT * FROM sharedfiles, users WHERE sender='1' and fileid='8' and receiver=user_id";
	$result2=mysqli_query($conn, $getLinksofADoc);

	$row2=array();

	while ($r2=mysqli_fetch_assoc($result2)) {
		$temp2=array();
		$temp2['source']='Anup Kumar Panwar';
		$temp2['target']=$r2['full_name'];
		$temp2['value']=5;
		$temp2['weight']=100;
		$row2[]=$temp2;
	}

	$response['nodes']=$row;

	$response['links']=$row2;

	echo(json_encode($response));
?>