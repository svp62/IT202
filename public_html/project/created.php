<?php
include("header.php");

?>
<html>
<body onload="sendtoquestion()"> 

<br>
<br>
<center style="color: black; font-family:Roboto; font-size:40px;">Take survey</center> 
<br> 
<br> 
<br> 

 <div id="selection">
    <form>
     <center> <table id="review"></center>
      </table>
    </form>
  </div>
<br>
  <div id="examstarts">
    <h1 id="examheading" style="text-align:center; padding: 50px;"></h1>
    <form id="exam"></form>
  </div>
  
   
</body> 

<script>
  var question_ids = new Array();

function sendtoquestion() {
  
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
		console.log(response);
        display_list(response);
      }
    };
    xhr.open("POST", "survey.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

  }

function display_list(response) {
    var len = Object.keys(response).length;
    var html = "";

    html += '<thead> <tr>';
      html += '<th style = "text-align: center">' + 'Surveys Available' + '</th>';
    html += '</tr> </thead>';
    html += '<tbody >';
    for (var i = 0; i < len; i++) {
       survey_name = response[i]["name"];
      console.log(survey_name);
	
	html += '<td>' + '<a href="#" style="color: white;" ' + 'onclick=getquestion("' + survey_name + '") >' + survey_name   + ' </td>';
	html += '</tbody>';
    }
    document.getElementById("review").innerHTML = html;

  }


function getquestion(survey_name){
    window.survey = survey_name;
     document.getElementById("review").innerHTML = " ";
    document.getElementById("selection").innerHTML = " ";
   document.getElementById("examheading").innerHTML = "Survey Starts";
   document.getElementById("examheading").style.color = "white";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        console.log(response);
	if(response['response'] == 'reject'){
	var html="<div class='submitted'>";
                 html+='<h4><center><font size="+2">Survey was already Taken</font></center></h4>';
                 var ajaxDisplay = document.getElementById('exam');
		document.getElementById("examheading").innerHTML = " ";
                 ajaxDisplay.innerHTML=html;
	}
	else{
        display_question(response);
	}
      }
    };
    xhr.open("POST", "questions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
var sendd = {'name' : survey_name };
console.log(sendd);    
xhr.send(JSON.stringify(sendd));
  }
  
  
function display_question(response) {
    var counter = 5;
    var exam = "";
    var questionID = "";
	if(response['q4']=='-1')
		{ counter--; }
	if(response['q5']=='-1')
		{ counter--; }
	
		
	for (var index = 0; index < counter; index++) {
		
      var question_id = index;
      console.log(question_id);
      var question = response['q'+index];
	  console.log(question);
      
      window.question_ids.push(question_id);
      exam += '<h3 style="float:center;">' + (index + 1) + " " + question  + '</h3>';
      exam += '<textarea rows="10" style="width:80%" placeholder="Answer..." id=' + question_id + ' class="questions" >' + '</textarea>';
    }
    exam += '<br><br><button type="button" class="submitbutton" onclick="sendAnswers()">Submit</button>';
    document.getElementById("exam").innerHTML = exam;
	
}

 function sendAnswers() {
    var response = [];
	document.getElementById("examheading").innerHTML = "";

	response.push({"name":Survey_name , "username": "user_test"});

     for (var index = 1; index <= window.question_ids.length; index++) {
      	var qu_id = window.question_ids[index-1];
	var data = {};
      	data['ID'] = qu_id;
      	data['answer_body'] = document.getElementById(qu_id).value;
	response.push(data);
	//console.log(JSON.stringify(response));
	}
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            	 console.log(this.responseText);
	   	 var html="<div class='submitted'>";
	   	 html+='<h4><center><font size="+2">Exam Successfully Submitted</font></center></h4>';
   		 var ajaxDisplay = document.getElementById('exam');
    		ajaxDisplay.innerHTML=html;
        }
      };
      xhr.open("POST", "Answers.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(JSON.stringify(response));
	console.log(response);
  }



</script>

</html>






  
        