var app= angular.module('chatburn', []);

app.controller('mailBox', function($scope, $http){
	
	$scope.is_expanded=false;
	$scope.emailContent='';


	$scope.getEmails=function(json_of_emails){
		$scope.inboxEmails=json_of_emails;
		console.log($scope.inboxEmails);
	}

	$scope.expandEmail=function(Email){
		console.log('Email Clicked');
		$scope.is_expanded=true;
		$scope.emailContent=Email;
	}

	$scope.decryptMessage=function(decryptionPassword){
		console.log('Decrypt function called');

		var encrypted_Data='message_id='+$scope.emailContent.message_id+'&password='+decryptionPassword;
		console.log($scope.emailContent.content);

		$http({
			method: 'POST',
			url: 'http://localhost/html/API/decrypted.php',
			data: encrypted_Data,
			headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(res){
			console.log(res);
			$scope.emailContent.content=res.data;
			var temp=res.data;
			// $scope.emailContent.content=res.data;
			console.log(res.data.length);
		})
	}
})