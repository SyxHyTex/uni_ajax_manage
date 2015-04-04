<?php

#TODO: Move fxns dealing with dropdowns and forms onto separate PHP pages
#TODO: Include files with fxns mentioned above.

$action=$_GET['action'];
$lvl=$_GET['lvl'];

switch($action)
{
	case '':
		echo '<span id="error_msg">Error: no action specified.</span>';	
		include '../includes/nav_bar.php';
		break;
	case 'first':
		create_page();			#provides page structure
		break;
	case 'choose_state':
		choose_state($lvl);
		break;	
	case 'choose_university':
		choose_university($lvl);
		break;
	case 'choose_college':
		choose_college($lvl);
		break;
	case 'choose_department':
		choose_department($lvl);
		break;
	case 'pop_form':
		$mode=$_GET['mode'];
		#$value=$_GET['value'];
		populate_form($lvl, $mode);
		break;
	case 'input_verify':
		input_verify();
		break;
}

#Displays form based on which button as picked.
#Value only needed in modify or remove
function populate_form($lvl, $mode)
{	
	include '../includes/db_connect.php';
	#echo $lvl, $mode;
	
	#Error case here.
	if(!isset($lvl) || !isset($mode))
	{
		echo 'Error: Missing required information.';
		return;
	}
	
	#Administration form starts here.
	echo 'Add to database: <form id="admin_form" method="POST" action="assignment_9.php?action=input_verify">' . "\n";

	if($mode='add')
	{	#get column information (currently only for university)
		#tbluniversities: land_grant, public, carnegie, NCAdoc, med_school, university, url, state, image_address, 
		#image_original_url
		echo 'Land Grant? (yes/no): <input class="add_uni_field" name="land_grant" type="text" maxlength="3" /> <br />' . "\n" .
			 'Public? (yes/no): <input class="add_uni_field" name="public" type="text" maxlength="3"/> <br />' . "\n" .
			 'Carnegie? (RU/H or RU/VH): <input class="add_uni_field" name="carnegie" type="text" maxlength="8" /> <br />' . "\n" .
			 'NCADoc? (yes/no): <input class="add_uni_field" name="ncadoc" type="text" maxlength="3" /> <br />' . "\n" .
			 'Medical School? (yes/no): <input class="add_uni_field" name="med_school" type="text" maxlength="3" /> <br />' . "\n" .
			 'University Name: <input class="add_uni_field" name="uni_name" type="text" maxlength="75" /> <br />' . "\n" .
			 'URL: <input class="add_uni_field" name="uni_url" type="text" maxlength="150" /> <br />' . "\n" .
			 'State: <select class="add_uni_field" name="state">
        		<option value="AL" selected>AL</option>
            	<option value="A">AK</option>
        	    <option value="AZ">AZ</option>
           	 	<option value="AR">AR</option>
           	 	<option value="CA">CA</option>
           	 	<option value="CO">CO</option>
           	 	<option value="CT">CT</option>
           	 	<option value="DE">DE</option>
           	 	<option value="DC">DC</option>
           	 	<option value="FL">FL</option>
            	<option value="GA">GA</option>
            	<option value="HI">HI</option>
            	<option value="IL">IL</option>
            	<option value="ID">ID</option>
            	<option value="IN">IN</option>
            	<option value="IA">IA</option>
            	<option value="KS">KS</option>
            	<option value="KY">KY</option>
            	<option value="LA">LA</option>
            	<option value="ME">ME</option>
            	<option value="MD">MD</option>
            	<option value="MA">MA</option>
            	<option value="MI">MI</option>
            	<option value="MN">MN</option>
        		<option value="MS">MS</option>
            	<option value="MO">MO</option>
        		<option value="MT">MT</option>
            	<option value="NE">NE</option>
        		<option value="NV">NV</option>
        		<option value="NH">NH</option>
            	<option value="NJ">NJ</option>
            	<option value="NM">NM</option>
            	<option value="NY">NY</option>
            	<option value="NC">NC</option>
        		<option value="ND">ND</option>
            	<option value="OH">OH</option>
        		<option value="OK">OK</option>
        		<option value="OR">OR</option>
        		<option value="PA">PA</option>
        		<option value="RI">RI</option>
        		<option value="SC">SC</option>
            	<option value="SD">SD</option>
            	<option value="TN">TN</option>
        		<option value="TX">TX</option>
            	<option value="UT">UT</option>
        		<option value="VT">VT</option>
            	<option value="VA">VA</option>
        		<option value="WA">WA</option>
        		<option value="WV">WV</option>
        		<option value="WI">WI</option>
            	<option value="WY">WY</option>
        		</select> <br />' . "\n" .
			 'Image Address: <input class="add_uni_field" name="img_address" type="text" maxlength="100" /> <br />' . "\n" .
			 'Image URL: <input class="add_uni_field" name="img_url" type="text" maxlength="150" /> <br />' . "\n" . 
			 '<input class="add_uni_data" type="hidden" name="mode" value="add" />' . "\n" . 
			 '<input class="add_uni_data" type="hidden" name="type" value="university"/>' . "\n" . 
			 '<input name="add_submit" type="submit" value="Submit" />';
	}
	
	echo '</form>';
	
	#TODO: Rows for each table:
	/*	All are VARCHAR unless otherwise specified.
		tblcollegesandschools: universityID (int(11)), name(250), url(100), school(5), description(3000)
		tbldepartments: corsID, NCAdoc, name, url, courselist, description
	*/
} 


function input_verify()
{	
include '../includes/db_connect.php';
if($_POST['type']=="university")
{
	if($_POST['mode']=="add")
	{	# Getting form data for validation
		$public=trim($_POST['public']);
		$land_grant=trim($_POST['land_grant']);
		$carnegie=trim($_POST['carnegie']);
		$ncadoc=trim($_POST['ncadoc']);
		$med_school=trim($_POST['med_school']);
		$uni_name=trim($_POST['uni_name']);
		$uni_url=trim($_POST['uni_url']);
		$state=trim($_POST['state']);
		$img_address=trim($_POST['img_address']);
		$img_url=trim($_POST['img_url']);
	
		#Validation section
		if(!isset($land_grant,$public,$carnegie,$ncadoc,$med_school,$uni_name,$uni_url,$img_address,$img_url)) 
		{ 
			echo 'ERROR; Missing input.' . "<br />\n"; 
			return -1;
		}
		#Make sure shorter strings are proper length
		if(strlen($carnegie)>5 || strlen($ncadoc)>3 || strlen($public)>3 || strlen($ncadoc)>3 || strlen($ncadoc)>3) #land_grant, ncadoc, public, med_school
		{
			echo 'ERROR; One or more invalid inputs.' . "<br /> \n";
			return -1;
		}
		
		/* if( ($carnegie!='RU/H' && $carnegie!='RU/VH')|| ($med_school!="yes" && $med_school!="no") || ($ncadoc!="yes" && $ncadoc!="no") || ($public!="yes" && $public!="no") || ($land_grant!="yes" && $land_grant!="no") )
		{
			echo 'ERROR; One or more invalid inputs based on string.' . "<br /> \n";
			return -1;
		}
		*/
		$query='INSERT INTO `tbluniversities` (land_grant,public,carnegie,NCAdoc,med_school,university,url,state,image_address,image_original_url)
		VALUES("'.$land_grant.'","'.$public.'","'.$carnegie.'","'.$ncadoc.'","'.$med_school.'","'.$uni_name.'","'.$uni_url.'","'.$state.'","'.$img_address.'","'.$img_url.'")';
	
		#Query failure handler / verification script
		if (!($db->query($query)))
		{
			# Put failure HTML on page and finish execution
			echo '<span style="color:#C00;">Query unsuccessful: entry not added to database.</span><br />';
			echo 'Result has value of:' . $result;	#For testing purposes
			$db->close();
		}
	}
	header('Location: assignment_9.php?action=choose_university?lvl=2');
	exit();
}
}

#Creates: drop down menu div, form div, container div, navigation bar. Should only run once.
function create_page()
{
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../includes/generic.css" />
	<link rel="stylesheet" type="text/css" href="form.css" />
    <script type="text/javascript" src="ajax_9.js"></script>
<title>Assignment 9 - AJAX Alteration</title>
</head>

<body style="background-image:url(University_of_Otago.jpg);">'; 

echo '<div id="header" style="left:40%;">AJAX - Project 9</div>' . "\n";

echo '<div id="container">' . "\n";	#Main content div

echo '<div name="state" id="state_div"></div>' . "\n" . 
	 '<div id="university_div"></div>' . "\n" . 
	 '<div id="college_div"></div>' . "\n" . 
	 '<div id="department_div"></div>' . "\n" . 
	 '<hr />' . "\n";
	 
echo '<div id="form_div"></div>' . "\n";
echo '</div><br />' . "\n";

include '../includes/nav_bar.php';

echo '<script type="text/javascript">getState();</script>' . "\n";
}

#drop down fxns from Assignment 8 here.
#figures out which value is needed based on level
function target_attr($lvl)
{
switch ($lvl)
{
	case 1:
		return 'state';
	break;	
	case 2:
		return 'university';
	break;
	case 3:
		return 'college';
	break;
	case 4:
		return 'department';
	break;
	default:
		#errors default to pulling states
		return 'state';
	break;
}
}

#uses target_attr to determine which table to pull from
function wanted_attr($attr)
{
switch ($attr)
{
	case 'state':
		return 'tblUniversities';
	break;	
	case 'university':
		return 'tblUniversities';
	break;
	case 'college':
		return 'tblcollegesandschools';
	break;
	case 'department':
		return 'tblDepartments';
	break;
	default:
		#errors default to pulling states
		return 'tblUniversities';
	break;
}
}

#lvl=1. Called to generate first dropdown and alter button
function choose_state($lvl)
{
include '../includes/db_connect.php';

$query_attr = target_attr($lvl);
$query_loc = wanted_attr(target_attr($lvl));

#set query based on desired attr
$query = 'SELECT DISTINCT ' . $query_attr .
' FROM ' . $query_loc;

$query.=' ORDER BY ' . $query_attr;

#echo $query;	#For debugging purposes.

$value_list = $db->query($query);
$num_values = $value_list->num_rows;

#Drop down menu here
echo 'Select State: <select name="'.$query_attr.'" id="'.$query_attr.'_select" onchange="getUniv()">';
echo '<option value="">Choose '.$query_attr.'</option>';
	#iterate across query results and add to the drop down
	for ($i=0; $i < $num_values; $i++)
	{
		$row = $value_list->fetch_assoc();
		$value = $row["$query_attr"];
		echo '<option value="'.$value.'">'.$value.'</option>'."\n";
	}
echo '</select></div>' . "\n";
}

function choose_university($lvl)
{
include '../includes/db_connect.php';
$query_attr = target_attr($lvl);
$query_loc = wanted_attr(target_attr($lvl));

#set query based on desired attr
$query = 'SELECT * ' .
' FROM ' . $query_loc . 
' WHERE state= "' . $_GET['state'] . '"' .   
 ' ORDER BY ' . $query_attr;

#echo $query;	#For debugging purposes.

$value_list = $db->query($query);
$num_values = $value_list->num_rows;

echo 'Select University: <select name="'.$query_attr.'" id="'.$query_attr.'_select" onchange="getCollege()">';
echo '<option value="">Choose '.$query_attr.'</option>';
	#iterate across query results and add to the drop down
	for ($i=0; $i < $num_values; $i++)
	{
		$row = $value_list->fetch_assoc();
		$value = $row["$query_attr"];
		$univID = $row['ID'];
		echo '<option value="'.$univID.'">'.$value.'</option>'."\n";
	}
echo '</select><br />';

echo '<input id="lvl_hide" type="hidden" value="'.$lvl.'"/>' . "\n";

echo '<div id="uni_mod">
<input type="button" value="Add" onclick="getForm()" />
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=2?mode=modify"><img style="width:20px; height:20px;" src="edit.png"></a>
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=2?mode=delete"><img style="width:20px; height:20px;" src="red_minus.png"></a></div>';
}

function choose_college($lvl)
{
include '../includes/db_connect.php';
$query_attr = target_attr($lvl);
$query_loc = wanted_attr(target_attr($lvl));

#set query based on desired attr
$query = 'SELECT * ' . 
' FROM ' . $query_loc . 
' WHERE universityID= "' . $_GET['university'] . '"' . 
' ORDER BY name ';

#echo $query;	#For debugging purposes.

$value_list = $db->query($query);
$num_values = $value_list->num_rows;

if($num_values > 0)
{
	echo 'Select College: <select name="'.$query_attr.'" id="'.$query_attr.'_select" onchange="getDepartment()">';
	echo '<option value="">Choose '.$query_attr.'</option>';
	#iterate across query results and add to the drop down
	for ($i=0; $i < $num_values; $i++)
	{
		$row = $value_list->fetch_assoc();
		$value = $row['ID'];
		$name = $row['name'];
		echo '<option value="'.$value.'">'.$name.'</option>'."\n";
	}
	echo '</select><br />';
}
echo '<div id="col_mod">
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=3?mode=add"><img style="width:20px; height:20px;" src="green_plus.png"></a>
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=3?mode=modify"><img style="width:20px; height:20px;" src="edit.png"></a>
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=3?mode=delete"><img style="width:20px; height:20px;" src="red_minus.png"></a></div>';
}

#lvl=4 here
function choose_department($lvl)
{
include '../includes/db_connect.php';
$query_attr = target_attr($lvl);
$query_loc = wanted_attr(target_attr($lvl));

#set query based on desired attr
$query = 'SELECT * ' . 
' FROM ' . $query_loc . 
' WHERE corsID= "' . $_GET['department'] . '"';

#echo $query;	#For debugging purposes.

$value_list = $db->query($query);
$num_values = $value_list->num_rows;

echo 'Select Department: <select name="'.$query_attr.'" id="'.$query_attr.'_select" onchange="getSubmit()">';
echo '<option value="">Choose '.$query_attr.'</option>';
	#iterate across query results and add to the drop down
	for ($i=0; $i < $num_values; $i++)
	{
		$row = $value_list->fetch_assoc();
		$name = $row['name'];
		$value = $row['corsID'];
		echo '<option value="'.$value.'">'.$name.'</option>'."\n";
	}
echo '</select><br />';

echo '<div id="dept_mod">
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=4?mode=add"><img style="width:20px; height:20px;" src="green_plus.png"></a>
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=4?mode=modify"><img style="width:20px; height:20px;" src="edit.png"></a>
<a href="http://www.com.uri.edu/com372/asch/Project 9/assignment_9.php?action=pop_form?lvl=4?mode=delete"><img style="width:20px; height:20px;" src="red_minus.png"></a></div>';
}
?>
</body>
</html>