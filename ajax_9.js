var myreq = getXHTTPRequest();

function getXHTTPRequest()
{
var request = new XMLHttpRequest();
return myreq;
}

//Is this even needed?
function theHTTPResponse(strHTML)
{
alert('inside theResponse');
	if(myreq.readyState==4)
	{
	if(myreq.status==200)
	{
		var respstring=myreq.responseXML.getElementsByTagName('respstring')[0];
		document.getElementById(strHTML+"_div").innerHTML=respstring.childNodes[0].nodevalue;
	}
	else
	{
		document.getElementById(strHTML+"_div").innerHTML='waiting...';
	}
	}
}

function input_verify()
{
	alert('In input_verify() Javascript version');
	var elements = document.getElementsByClassName('uni_add_field').value;
	
	for(i=0; i < elements.length; i++)
	{
		alert('In control loop');
		if (elements[i]==NULL || elements[i]=='')
		{
			exit();
		}
	}
if (window.XMLHttpRequest)
  {   // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
  }
else
  {   // code for IE6, IE5; create an activeX object
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  { // if we get a good response from the webpage, display the output
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
  	{
      document.getElementById("form_div").innerHTML=xmlhttp.responseText;
  	}
  } // use our XML HTTP Request object to send a get to our content php. 
thePage="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=verify_input";
xmlhttp.open("GET", thePage, true);
xmlhttp.send();
}

//removes previous form and puts in a new one
function getForm()
{
//alert('getForm()');
gEID('form_div').value='';

var lvl=gEID('lvl_hide').value;
//alert(lvl);
var chosen_item;
/*
switch(lvl)
{
	case 2:
		chosen_item=gEID('university_select').value;
		break;
	case 3:
		chosen_item=gEID('college_select').value;
		break;
	case 4:
		chosen_item=gEID('department_select').value;
		break;
}
*/
if (window.XMLHttpRequest)
  {   // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
  }
else
  {   // code for IE6, IE5; create an activeX object
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  { // if we get a good response from the webpage, display the output
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
  	{
      document.getElementById("form_div").innerHTML=xmlhttp.responseText;
  	}
  } // use our XML HTTP Request object to send a get to our content php. 
thePage="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form&lvl=2&mode=add";
xmlhttp.open("GET", thePage, true);
xmlhttp.send();
}

function getState()
{
//set_row('state');
if (window.XMLHttpRequest)
  {   // code for IE7+, Firefox, Chrome, Opera, Safari
      // XML http Request will go to our generator webpage.
      xmlhttp=new XMLHttpRequest();
  }
else
  {   // code for IE6, IE5; create an activeX object
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  { // if we get a good response from the webpage, display the output
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
  	{
      document.getElementById("state_div").innerHTML=xmlhttp.responseText;
  	}
  } // use our XML HTTP Request object to send a get to our content php. 
thePage="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=choose_state&lvl=1";
xmlhttp.open("GET", thePage, true);
xmlhttp.send();
}


function getUniv()
{
state=gEID('state_select').value;

if (state=="")
{
  document.getElementById("university_div").innerHTML="No state specified.";
  return;
}
//set_row('university');
if (window.XMLHttpRequest)
  {   // code for IE7+, Firefox, Chrome, Opera, Safari
      // XML http Request will go to our generator webpage.
      xmlhttp=new XMLHttpRequest();
  }
else
  {   // code for IE6, IE5; create an activeX object
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  	// if we get a good response from the webpage, display the output
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
  	{
      document.getElementById("university_div").innerHTML=xmlhttp.responseText;
  	}
  }
 // use our XML HTTP Request object to send a get to our content php. 
thePage="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=choose_university&lvl=2&state="+state;
xmlhttp.open("GET", thePage, true);
xmlhttp.send();
}

function getCollege()
{
//Grabs the university's ID, not its name
university=document.getElementById('university_select').value;

if (university=="")
{
  document.getElementById("college_div").innerHTML="No university specified.";
  return;
}

//TODO: fxn call for button removal here.
//set_row('college');


if (window.XMLHttpRequest)
  {   // code for IE7+, Firefox, Chrome, Opera, Safari
      // XML http Request will go to our generator webpage.
      xmlhttp=new XMLHttpRequest();
  }
else
  {   // code for IE6, IE5; create an activeX object
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  	// if we get a good response from the webpage, display the output
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
  	{
      document.getElementById("college_div").innerHTML=xmlhttp.responseText;
  	}
  }
 // use our XML HTTP Request object to send a get to our content php. 
thePage="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=choose_college&lvl=3&university="+university;
xmlhttp.open("GET", thePage, true);
xmlhttp.send();
}


//For departments
function getDepartment()
{
//Grabs the university's ID, not its name
desired=document.getElementById('college_select').value;

if (desired=="")
{
  document.getElementById("department_div").innerHTML="No college specified.";
  return;
}

//set_row('department');

if (window.XMLHttpRequest)
  {   // code for IE7+, Firefox, Chrome, Opera, Safari
      // XML http Request will go to our generator webpage.
      xmlhttp=new XMLHttpRequest();
  }
else
  {   // code for IE6, IE5; create an activeX object
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  	// if we get a good response from the webpage, display the output
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
  	{
      document.getElementById("department_div").innerHTML=xmlhttp.responseText;
  	}
  }
 // use our XML HTTP Request object to send a get to our content php. 
thePage="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=choose_department&lvl=4&department="+desired;
xmlhttp.open("GET", thePage, true);
xmlhttp.send();
}

//Gets the current selected state dropdown element and prints its value in the next box
function mystate(elem_id)
{
selval=document.getElementById('state').value;

//Prints selected value in next box's area
document.getElementById('statevalue').innerHTML='<p>Selected state was '+selval+'</p>';
}

//empties all button divs except for the row to be rendered.
//Will also empty all button divs if about to change database stuff.
function set_row(current)
{
	switch(current)
	{
		case 'state':
			if(gEID('university_div')) { gEID('university_div').innerHTML=''; }
			if(gEID('college_div')) { gEID('college_div').innerHTML=''; }
			if(gEID('department_div')) { gEID('department_div').innerHTML=''; }
			break;
		case 'university':
		//Clean out all but university and state stuff.
			if(gEID('dept_mod')) { gEID('dept_mod').innerHTML=''; }
			if(gEID('col_mod')) { gEID('col_mod').innerHTML=''; }
			if(gEID('college_div')) { gEID('college_div').innerHTML=''; } 
			if(gEID('department_div')) { gEID('department_div').innerHTML=''; }
			break;
		case 'college':
			//Clean out buttons for all other rows & department drop down
			//if(gEID('uni_mod')) { gEID('uni_mod').innerHTML=''; }
			if(gEID('dept_mod')) { gEID('dept_mod').innerHTML=''; }
			if(gEID('department_div')) { gEID('department_div').innerHTML=''; }
			break;
		case 'department':	
			//gEID('col_mod').innerHTML='';
			gEID('uni_mod').innerHTML=''; 
			break;
		case 'form':
		//TODO: eliminate all buttons when in form mode
		break;
	}
}


//shortens keystrokes for getelementbyid fxn calls
function gEID(element) { return document.getElementById(element); }