
$(function(){

	var navbar = document.getElementById("main_menu");
	var sticky = navbar.offsetTop;

	function myFunction() {
		console.log('scrollTop '+document.documentElement.scrollTop);
		console.log('sticky '+sticky);
	  if (document.documentElement.scrollTop >= sticky -10) {
		 navbar.classList.add("sticky")
	  } else {
		 navbar.classList.remove("sticky");
	  }
	}

	window.onscroll = function() {
		myFunction()
	};

});
