
$(function(){

	var navbar = document.getElementsByClassName("menu-coode-menu-container");
	var sticky = navbar[0].offsetTop;

	function myFunction() {
	  if (document.documentElement.scrollTop >= sticky) {
		 navbar[0].classList.add("sticky")
	  } else {
		 navbar[0].classList.remove("sticky");
	  }
	}

	window.onscroll = function() {
		myFunction()
	};

});
