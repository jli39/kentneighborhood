var stratfordTab;
var cobblestoneTab;
var hamptonTab;
var wilshireTab;


var stratford;
var cobblestone;
var hampton;
var wilshire;


window.onload = function(){
	stratfordTab =  document.getElementById("stratford-tab");
	cobblestoneTab =  document.getElementById("cobblestone-tab");
	hamptonTab =  document.getElementById("hampton-tab");
	wilshireTab =  document.getElementById("wilshire-tab");

	stratford =  document.getElementById("stratford");
	cobblestone =  document.getElementById("cobblestone");
	hampton =  document.getElementById("hampton");
	wilshire =  document.getElementById("wilshire");
}

function changeTabs(whichTab){
	hiddenAll();
	switch(whichTab){
		case 1:
			stratfordTab.className = "selected-tab";
			stratford.style.display = "inline-block";
			break;
		case 2:
			cobblestoneTab.className = "selected-tab";
			cobblestone.style.display = "inline-block";
			break;
		case 3:
			hamptonTab.className = "selected-tab";
			hampton.style.display = "inline-block";
			break;
		case 4:
			wilshireTab.className = "selected-tab";
			wilshire.style.display = "inline-block";
			break;
	}
}

function hiddenAll(){
	stratfordTab.className = "other-tab";
	cobblestoneTab.className = "other-tab";
	hamptonTab.className = "other-tab";
	wilshireTab.className = "other-tab";

	stratford.style.display = "none";
	cobblestone.style.display = "none";
	hampton.style.display = "none";
	wilshire.style.display = "none";
}