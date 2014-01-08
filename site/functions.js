﻿
/****************************************************************************************
*					SUNARTHSEIS JAVASCRIPT GENIKOU SKOPOY
*
*****************************************************************************************/

function DIVoutput(message)
{
	document.write("<div>"+message+"</div>");
}
function SPANoutput(message)
{
	document.write("<span>"+message+"</span>");
}

//sunarthsh pou elegxei an ena pedio einai keno
function notEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return false;
	}
	return true;
}

//sunarthsh pou elegxei an ena pedio periexei mono ari8mous
function isNumeric(elem, helperMsg){
	var elem=document.getElementById(elem);
	var numericExpression = /^[0-9]+$/;
	if(elem.value.length!=0)
	{
		if(elem.value.match(numericExpression)){
			return true;
		}else{
			alert(helperMsg);
			elem.focus();
			return false;
		}
	}
}

//sunarthsh pou elegxei an ena pedio periexei mono xarakthres
function isAlphabet(elem, helperMsg){

	var elem=document.getElementById(elem);
	
	//var alphaExp = /^[a-zA-Z]+$/;
	var alphaExp = /^[ΑαάΒβΓγΔδΕεέΖζΗηήΘθΙιίϊΐΚκΛλΜμΝνΞξΟοόΠπΡρΣσςΤτΥυύϋΰΦφΧχΨψΩωώ ]+$/;
	if(elem.value.length!=0)
	{
		if(elem.value.match(alphaExp)){
			return true;
		}else{
			alert(helperMsg);
			elem.focus();
			return false;
		}
	}
}

//sunarthsh pou elegxei an ena pedio periexei kai xarakthres kai noumera
function isAlphanumeric(elem, helperMsg){
	var elem=document.getElementById(elem);
	var alphaExp = /^[0-9a-zA-Z]+$/;
	if(elem.value.length!=0)
	{
		if(elem.value.match(alphaExp)){
			return true;
		}else{
			alert(helperMsg);
			elem.focus();
			return false;
		}
	}
}

//sunarthsh pou elegxei an to mhkos tou pediou kumenaitai meta3u tou min kai tou max
function lengthRestriction(elem, min, max,helperMsg){
	var uInput = elem.value;
	if(uInput.length >= min && uInput.length <= max){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

//sunarthsh pou elegxei an exei epilextei kati se ena select box
function madeSelection(elem, helperMsg){
	if(elem.value == "Please Choose"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}

//sunarthsh pou elegxei an ena email exei thn swsth morfh (px a@a.a)
function emailValidator(elem, helperMsg){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}
/****************************************************************************************
*					SUNARTHSEIS ELEGXOU GIA TO LOGIN
*
*****************************************************************************************/
function loginCheck()
{
	var user = document.getElementById('username');
	var pwd = document.getElementById('pwd');

	notEmpty(user, 'Πρέπει να βάλετε το username σας');
	notEmpty(pwd, 'Πρέπει να βάλετε τον κωδικό σας');
}
/****************************************************************************************
*					SUNARTHSEIS ELEGXOU GIA TO REGISTRATION FORM
*
*****************************************************************************************/

//sunarthsh pou upologizei thn dunamikothta(?) tou kwdikou  REAL TIME
function RTpasswordChanged()
{
	var strength = document.getElementById('strength');
	var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).*$", "g");
	var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	var enoughRegex = new RegExp("(?=.{6,}).*", "g");
	var pwd = document.getElementById("pwd");
	if (pwd.value.length==0)
	{
		strength.innerHTML = '';
	}
	else if (false == enoughRegex.test(pwd.value))
	{
		strength.innerHTML = 'Πολύ μικρός!';
	}
	else if (strongRegex.test(pwd.value))
	{
		strength.innerHTML = '<span style="color:green">Δυνατός!</span>';
	}
	else if (mediumRegex.test(pwd.value))
	{
		strength.innerHTML = '<span style="color:orange">Μέτριος!</span>';
	}
	else
	{ 
		strength.innerHTML = '<span style="color:red">Αδύναμος!</span>';
	}
}

//sunarthsh pou epivlepei an oi 2 kwdikoi einai idioi  REAL TIME
function RTequalPasswords()
{
	var equal = document.getElementById('equal');
	var pwd = document.getElementById("pwd");
	var pwd2 = document.getElementById("pwd2");
	
	if(pwd2.value.length!=0)
	{
		if(pwd.value!=pwd2.value) equal.innerHTML = '<span style="color:red">Οι κωδικοί που έχετε βάλει δεν ταιριάζουν!</span>';
		else equal.innerHTML = '<span style="color:green">Oi κωδικοί ταιριάζουν!</span>';
	}
	else equal.innerHTML='';
}


//sunarthsh pou elegxei an ena email exei thn swsth morfh (px a@a.a) REAL TIME
function RTemailValidator()
{

	var email = document.getElementById('email');
	var mail = document.getElementById("mail");
	
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(mail.value.match(emailExp))
	{
		email.innerHTML = '<span style="color:green">Αποδεκτό email!</span>';
	}
	else
	{
		email.innerHTML = '<span style="color:red">To mail σας δεν έχει την σωστή μορφή!</span>';	
	}
}

//sunarthsh pou elegxei an ena pedio periexei mono ari8mous  REAL TIME
function RTisNumeric(elem,span){

	var smob1 = document.getElementById(elem);
	var shome = document.getElementById(span);

	var numericExpression = /^[0-9]+$/;
	if(smob1.value.length!=0)
	{
		if(smob1.value.match(numericExpression))
		{
			shome.innerHTML = '<span style="color:green">Αποδεκτό τηλέφωνο!</span>';
		}
		else
		{
			shome.innerHTML = '<span style="color:red">Μη αποδεκτό τηλέφωνο!</span>';
		}
	}
	else
	{
		shome.innerHTML = '';
	}
}

//sunarthsh pou elegxei pedia ari8mwn.An to who einai alh8es to pedio prepei na exei aparaithta 10 pshfia
//an to who einai false to pedio mporei na periexei 'h 0 pshfia(dld den exei eisax8ei tipota) 'h 10 pshfia.
function numberCheck(number,helpMsg,who)
{
	if(who==true)
	{
		var uInput=number.value;
		if(uInput.length==10)
		{
			if(isNumeric(number,helpMsg))
			{
				return true;
			}
		}
		else
		{
			alert(helpMsg);
			number.focus();
			return false;
		}
	}
	else
	{
		var uInput=number.value;
		if(uInput.length!=0)
		{
			if(uInput.length==10)
			{
				if(isNumeric(number,helpMsg))
				{
					return true;
				}
			}
			else
			{
				alert(helpMsg);
				number.focus();
				return false;
			}
		}
		else return true;
	}

}

//sunarthsh pou elegxei an oi ari8moi sto registration form einai swsta sumplhrwmenoi
function numbersCheck()
{
	var mob1phone=document.getElementById('mob1phone');
	var mob2phone=document.getElementById('mob2phone');
	var homephone=document.getElementById('homephone');
	var othrphone=document.getElementById('othrnumber');
	var msgPhone="Το ο αριθμός του τηλέφωνού σας θα πρέπει να έχει 10 ψηφία!";
	
	if(numberCheck(mob1phone,msgPhone,true))
	{
		if(numberCheck(mob2phone,msgPhone,false))
		{
			if(numberCheck(homephone,msgPhone,false))
			{
				if(numberCheck(othrphone,msgPhone,false))
				{
					return true;
				}
			}
		}
	}
	
	return false;
}

//sunarthsh pou elegxei an ola ta aparaithta pedia einai sumphrwmena sto registration form
function validEmptyRegForm()
{

	//alert("helooooooooo");

	// Make quick references to our fields
	var username = document.getElementById('username');
	var msgUsername="Δεν έχετε συμπληρώσει το username σας!";
	var pwd = document.getElementById('pwd');
	var msgPwd="Δεν έχετε συμπληρώσει τον κωδικό σας!";
	var pwd2 = document.getElementById('pwd2');
	var msgPwd2="Δεν έχετε συμπληρώσει τον δεύτερο κωδικό σας!";
	var mail=document.getElementById('mail');
	var msgMail="Δεν έχετε συμπληρώσει το email σας!";
	var mob1phone=document.getElementById('mob1phone');
	var msgmob1phone="Δεν έχετε συμπληρώσει το κινητό σας!";
	

	
	if(notEmpty(username,msgUsername))
	{
		if(notEmpty(pwd,msgPwd))
		{
			if(notEmpty(pwd2,msgPwd2))
			{
				if(notEmpty(mail,msgMail))
				{
					if(notEmpty(mob1phone,msgmob1phone))
					{
						return true;
					}
				}
			}
		}
	}
	
	
	return false;

}

//sunarthsh pou elegxei an ta pedia sto registration form einai swsta sumplhrwmena
function multiValidRegForm()
{


	// Make quick references to our fields
	var username = document.getElementById('username');
	var msgUsername="Το username σας θα πρέπει να αποτελείται μόνο από χαρακτήρες και αριθμούς!";
	var msgLenUsername="Το username σας θα πρέπει να αποτελείται από 4 εώς 16 χαρακτήρες!";
	
	var pwd = document.getElementById('pwd');
	var pwd2 = document.getElementById('pwd2');
	var msgLenPwd="Ο κωδικός θα πρέπει να έχει μήκος μεταξύ 4 και 16";
	
	var mail=document.getElementById('mail');
	var msgVMail="Δεν έχετε συμπληρώσει το email σας σωστά!";
	
	var mob1phone=document.getElementById('mob1phone');
	var mob2phone=document.getElementById('mob2phone');
	var homephone=document.getElementById('homephone');
	var othrphone=document.getElementById('othrnumber');
	var msgPhone="Το ο αριθμός του τηλέφωνού σας θα πρέπει να έχει 10 ψηφία!";


	//checking username
	if(isAlphanumeric(username,msgUsername))
	{
		if(lengthRestriction(username,4,16,msgLenUsername))
		{
			//checking password
			if((pwd.value) == (pwd2.value))
			{
				if(lengthRestriction(pwd,4,16,msgLenPwd))
				{
					//checking email
					if(emailValidator(mail,msgVMail))
					{
						//checking numbers
						if(numbersCheck())
						{
							return true;
						}
					}
				}
			}
			else alert("Οι κωδικοί σας είναι διαφορετικοί!");
		}
	}
	
	
	
	
	return false;
	

}

//sunarthsh pou elegxei to registration form
function validRegForm()
{

	if(validEmptyRegForm())
	{
		if(multiValidRegForm())
		{
			return true;
		}
	}
	return false;

}

/****************************************************************************************
*					SUNARTHSEIS ELEGXOU GIA THN APOSUNDESH
*
*****************************************************************************************/
function dispLogoutMsg()
{
	var logoutSpan = document.getElementById('logoutSpan');
	logoutSpan.innerHTML="Γίνεται η αποσύνδεσή σας..Σε λίγο θα μεταφερθείτε στην αρχική σελίδα.";

}
function dispNoLogoutMsg()
{
	var logoutSpan = document.getElementById('logoutSpan');
	logoutSpan.innerHTML="Θα μεταφερθείτε στην αρχική σελίδα.";

}
/****************************************************************************************
*					SUNARTHSEIS ELEGXOU GIA TO FORMA ANAZHTHSHS
*
*****************************************************************************************/
function searchForm()
{
	validSearch();
	get(document.getElementById('myform'));

}

function validSearch()
{

	var typos = document.getElementById('typos');
	var sell = document.getElementById("sell");
	var lent = document.getElementById("lent");

	if((sell.checked==true) || (lent.checked==true))
	{
		typos.innerHTML='<span style="color:green">&nbsp; &nbsp; &nbsp;  &#10003;</span>';
	}
	else
	{
		typos.innerHTML='<span">&nbsp; &nbsp; &nbsp; Καλό είναι να επιλέξετε να βρείτε αυτό που θέλετε πιο γρήγορα</span>';
	}
}

function checkType()
{
	var newSelectLowPrice = document.getElementById("low_price");
	var newSelectHighPrice = document.getElementById("high_price");
	var lent=document.getElementById("lent");
	if(lent.checked)
	{
		newSelectLowPrice.innerHTML="\
		<option value=\"nolimit\" >Χωρις Οριο</option>\
		<option value=\"100\">100</option>\
		<option value=\"150\">150</option>\
		<option value=\"180\">180</option>\
		<option value=\"200\">200</option>\
		<option value=\"225\">225</option>\
		<option value=\"250\">250</option>\
		<option value=\"275\">275</option>\
		<option value=\"300\">300</option>\
		<option value=\"350\">350</option>\
		<option value=\"400\">400</option>\
		<option value=\"450\">450</option>\
		<option value=\"500\">500</option>\
		<option value=\"550\">550</option>\
		<option value=\"600\">600</option>\
		<option value=\"800\">800</option>\
		<option value=\"1000\">1000</option>";
		
		newSelectHighPrice.innerHTML="\
		<option value=\"100\">100</option>\
		<option value=\"150\">150</option>\
		<option value=\"180\">180</option>\
		<option value=\"200\">200</option>\
		<option value=\"225\">225</option>\
		<option value=\"250\">250</option>\
		<option value=\"275\">275</option>\
		<option value=\"300\">300</option>\
		<option value=\"350\">350</option>\
		<option value=\"400\">400</option>\
		<option value=\"450\">450</option>\
		<option value=\"500\">500</option>\
		<option value=\"550\">550</option>\
		<option value=\"600\">600</option>\
		<option value=\"800\">800</option>\
		<option value=\"1000\">1000</option>\
		<option value=\"nolimit\" selected=\"selected\" >Χωρις Οριο</option>";
		

	}
	else
	{
		newSelectLowPrice.innerHTML="\
		<option value=\"nolimit\" >Χωρις Οριο</option>\
		<option value=\"30000\">30.000</option>\
		<option value=\"40000\">40.000</option>\
		<option value=\"50000\">50.000</option>\
		<option value=\"50000\">50.000</option>\
		<option value=\"60000\">60.000</option>\
		<option value=\"75000\">75.000</option>\
		<option value=\"100000\">100.000</option>\
		<option value=\"150000\">150.000</option>\
		<option value=\"200000\">200.000</option>\
		<option value=\"250000\">250.000</option>\
		<option value=\"300000\">300.000</option>\
		<option value=\"350000\">350.000</option>\
		<option value=\"400000\">400.000</option>\
		<option value=\"500000\">500.000</option>\
		<option value=\"750000\">750.000</option>\
		<option value=\"1000000\">1.000.000</option>";
		
		newSelectHighPrice.innerHTML="\
		<option value=\"30000\">30.000</option>\
		<option value=\"40000\">40.000</option>\
		<option value=\"50000\">50.000</option>\
		<option value=\"50000\">50.000</option>\
		<option value=\"60000\">60.000</option>\
		<option value=\"75000\">75.000</option>\
		<option value=\"100000\">100.000</option>\
		<option value=\"150000\">150.000</option>\
		<option value=\"200000\">200.000</option>\
		<option value=\"250000\">250.000</option>\
		<option value=\"300000\">300.000</option>\
		<option value=\"350000\">350.000</option>\
		<option value=\"400000\">400.000</option>\
		<option value=\"500000\">500.000</option>\
		<option value=\"750000\">750.000</option>\
		<option value=\"1000000\">1.000.000</option>\
		<option value=\"nolimit\" selected=\"selected\" >Χωρις Οριο</option>";
	}


}

/****************************************************************************************
*					SUNARTHSEIS GIA THN AJAX
*
*****************************************************************************************/

function get(obj)
{
	var ajaxDiv = document.getElementById('ajaxDiv');
	var getstr = "?";
	for (i=0; i<obj.childNodes.length; i++)
	{
		if (obj.childNodes[i].tagName == "INPUT")
		{
			if (obj.childNodes[i].type == "checkbox")
			{
					if (obj.childNodes[i].checked)
					{
						getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
					}
			}
		}  		
		if (obj.childNodes[i].tagName == "SELECT")
		{
			//alert("aleeert");
			var sel = obj.childNodes[i];
			getstr += sel.name + "=" + sel.options[sel.selectedIndex].value + "&";
		}
		//alert(obj.childNodes[i].tagName);
	}
	
	var numFac = document.getElementById('numberFac');
	for(i=1; i<=numFac.value; i++)
	{
		var fac = document.getElementById('fac'+i);
		if(fac.checked)
		{
			getstr+=fac.name + "=" + fac.value + "&";
		}
	}
	//ajaxDiv.innerHTML=getstr;
	loadXMLDoc(getstr);
	//document.getElementById("testDiv").innerHTML=getstr;

}

function loadXMLDoc(param)
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var rows=xmlhttp.responseText;
			document.getElementById("ajaxDiv").innerHTML='Βρέθηκαν:'+rows+'&nbsp Αγγελίες';
		}
	}
	xmlhttp.open("GET","ajax.php"+param,true);
	//http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//http.setRequestHeader("Content-length", params.length);
	//http.setRequestHeader("Connection", "close");
	xmlhttp.send();
}
/****************************************************************************************
* 				SUNARTHSEIS GIA TA MULTIPLE FILES UPLOAD
*
*****************************************************************************************/
//eisagei ena kainourgio field gia upload me description
function add_new_file(field)
{
    // Get the number of files previously uploaded.
    var count = parseInt(document.getElementById('file_count').value);
    
    // Get the name of the file that has just been uploaded.
    var file_name = document.getElementById("new_file["+count+"]").value;
	var descript = document.getElementById("description["+count+"]").value;
	//descript="perigrafh";
    
    // Hide the file upload control containing the information about the picture that was just uploaded.
    document.getElementById('new_file_row').style.display = "none";
    document.getElementById('new_file_row').id = "new_file_row["+count+"]";
    
    // Get a reference to the table containing the uploaded pictures.        
    var table = document.getElementById('files_table');
    
    // Insert a new row with the file name and a delete button.
    var row = table.insertRow(table.rows.length);
    row.id = "inserted_file["+count+"]";
    var cell0 = row.insertCell(0);
    cell0.innerHTML = '<input type="text" name="description['+count+']" id="description['+count+']" value="'+descript+'" disabled /><input type="text" disabled="disabled" name="inserted_file['+count+']" value="'+file_name+'" /><input type="button" name="delete['+count+']" value="Delete" onclick="delete_inserted(this)"';
    
    // Increment count of the number of files uploaded.
    ++count;
    
    // Insert a new file upload control in the table.
    var row = table.insertRow(table.rows.length);
    row.id = "new_file_row";
    var cell0 = row.insertCell(0);
    cell0.innerHTML = '<input type="text" value="Περιγραφή" name="description['+count+']" id="description['+count+']" /><input type="file" name="new_file['+count+']" id="new_file['+count+']" readonly="readonly" onchange="add_new_file(this)" />';    
    
    // Update the value of the file hidden input tag holding the count of files uploaded.
    document.getElementById('file_count').value = count;
}
//diagrafei ena hdh uparxon field gia anevasma arxeiou
function delete_inserted(field)
{

    // Get the field name.
    var name = field.name;
    
    // Extract the file id from the field name.
    var id = name.substr(name.indexOf('[') + 1, name.indexOf(']') - name.indexOf('[') - 1);
    
    // Hide the row displaying the uploaded file name.
    document.getElementById("inserted_file["+id+"]").style.display = "none";
        
    // Get a reference to the uploaded file control.
    var control1 = document.getElementById("new_file["+id+"]");
    // Get a reference to the uploaded file control.
    var control1 = document.getElementById("new_file["+id+"]");
    
    // Remove the new file control.
    control1.parentNode.removeChild(control1);

    // Get the number of files previously uploaded.
    //var count = parseInt(document.getElementById('file_count').value);
    //--count;
    // Update the value of the file hidden input tag holding the count of files uploaded.
    //document.getElementById('file_count').value = count;
}

/****************************************************************************************
*****************************************************************************************/
//auth h sunarthsh einai gia tis fwtografies kai ta description tous (kai gamw ta comments re pousth mou)
function mouseOver(source,description)
{
	document.getElementById("mainphoto").src=source;
	document.getElementById("switch").innerHTML='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;'+description;

}

/****************************************************************************************
*					SUNARTHSEIS GIA TO GOOGLE MAPS
*
*****************************************************************************************/

var markersArray = [];
var map;
var geocoder;

var beaches = [
  ['Bondi Beach', 38.243573, 21.735764, 4],
];

function initializeMain(zooom) {
	geocoder = new google.maps.Geocoder();
	var myLatLng = new google.maps.LatLng(38.243573, 21.735764);
	var mapOptions = {
		zoom: zooom,
		scrollwheel: false,
		center: myLatLng,
		mapTypeId: google.maps.MapTypeId.HYBRID
	};
	map = new google.maps.Map(document.getElementById("mainMap"), mapOptions);
	return map;
}
  
function addMarker(location) {
  marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markersArray.push(marker);
}

// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
  }
}

// Shows any overlays currently in the array
function showOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(map);
    }
  }
}

// Deletes all markers in the array by removing references to them
function deleteOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
    markersArray.length = 0;
  }
}

function codeAddress()
{
	var address = document.getElementById("address").value+' Πάτρα';
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK)
		{
			map.setCenter(results[0].geometry.location);
			locat=results[0].geometry.location;
			document.getElementById("submitForm").disabled=false;
			document.getElementById("latitude").value=results[0].geometry.location.lat();
			document.getElementById("longitude").value=results[0].geometry.location.lng();
			/*var marker = new google.maps.Marker({
			map: map, 
			position: results[0].geometry.location
			});*/
			addMarker(results[0].geometry.location);

			

		}
		else
		{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

function codeAddressEdit()
{
	var address = document.getElementById("newAddress").value+' Πάτρα';
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK)
		{
			map.setCenter(results[0].geometry.location);
			locat=results[0].geometry.location;
			document.getElementById("submitEdit").disabled=false;
			document.getElementById("latitude").value=results[0].geometry.location.lat();
			document.getElementById("longitude").value=results[0].geometry.location.lng();
			/*var marker = new google.maps.Marker({
			map: map, 
			position: results[0].geometry.location

			
			});*/
			addMarker(results[0].geometry.location);
		
			//marker.setMap(map);
		}
		else
		{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

