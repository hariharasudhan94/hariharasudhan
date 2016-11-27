window.fbAsyncInit = function() {
   FB.init({
     appId      : '140880869720900',
     xfbml      : true, //parse social plugins on this page
     version    : 'v2.8' //graph version
   });
 };

// Load the SDK asynchronously
(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));