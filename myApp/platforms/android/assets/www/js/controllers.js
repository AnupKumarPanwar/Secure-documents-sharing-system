angular.module('starter.controllers', [])

.controller('DashCtrl', function($scope, $http) {
	// alert('hello');

	var deviceID='';

	document.addEventListener("deviceready", onDeviceReady, false);
	function onDeviceReady() {
	    deviceID=device.uuid;

	    alert(deviceID);


	}

	$scope.login=function($token, $authtoken)
	{
	
		// alert('hey'+ $token);
		var apiGetComments = "http://"+$token+".ngrok.io/chatburn/Crypten/API/startSession.php";
		var param = 'deviceid=' + deviceID + '&token=' + $authtoken;
		$http({
		    method: 'POST',
		    url: apiGetComments,
		    data: param,
		    headers: {
		        'Content-Type': 'application/x-www-form-urlencoded'
		    }
		}).then(function(res) {
		    $scope.comments = res.data.result;
		    alert('Session started');
		})
	};




})

.controller('ChatsCtrl', function($scope, Chats) {
  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //
  //$scope.$on('$ionicView.enter', function(e) {
  //});

  $scope.chats = Chats.all();
  $scope.remove = function(chat) {
    Chats.remove(chat);
  };
})

.controller('ChatDetailCtrl', function($scope, $stateParams, Chats) {
  $scope.chat = Chats.get($stateParams.chatId);
})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
