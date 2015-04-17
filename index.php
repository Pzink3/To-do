<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <style>
.clockStyle {
	background-color:#000;
	border:#999 2px inset;
	padding:6px;
	color:#0FF;
	font-family:"Arial Black", Gadget, sans-serif;
    font-size:16px;
    font-weight:bold;
	letter-spacing: 2px;
	display:inline;
}
</style>
</head>
<body>
<div id="clockDisplay" class="clockStyle"></div>
<script>
function renderTime() {
	var currentTime = new Date();
	var diem = "AM";
	var h = currentTime.getHours();
	var m = currentTime.getMinutes();
    var s = currentTime.getSeconds();
	setTimeout('renderTime()',1000);
    if (h == 0) {
		h = 12;
	} else if (h > 12) { 
		h = h - 12;
		diem="PM";
	}
	if (h < 10) {
		h = "0" + h;
	}
	if (m < 10) {
		m = "0" + m;
	}
	if (s < 10) {
		s = "0" + s;
	}
    var myClock = document.getElementById('clockDisplay');
	myClock.textContent = h + ":" + m + ":" + s + " " + diem;
	myClock.innerText = h + ":" + m + ":" + s + " " + diem;
}
renderTime();
</script>
</body>
</html>
        <meta charset="UTF-8">
        <title>Parky's Simple To-Do List</title>
        <link rel='stylesheet' type="text/css" href='css/main.css'>
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
    </head>
    <body>
        <div class='wrap'>
            <div class='task-list'>
                <ul>
            
        <?php require("includes/connect.php");
        $mysqli = new mysqli('localhost', 'root', 'root', 'to-do');
        $query = "SELECT * FROM tasks ORDER BY date ASC, time ASC";
        echo 'Welcome!';
        if($result = $mysqli->query($query)){
            $numrows = $result->num_rows;
            if($numrows>0){
                while($row = $result->fetch_assoc()){
                    $task_id = $row["id"];
                    $task_name = $row["task"];
                    echo '<li>
                    <span>'.$task_name .'</span>
                    <img id = "' .$task_id . '" class="delete-button" width="10px" src="images/close.svg"/>
                    </li>';
                }
            }
        }
        ?>
                </ul>
                </div>
        
        <form class='add-new-task' autocomplete='off'>
            <input type='text' name='new-task' placeholder="Add new task..."/>
        </form>
            </div>
    </body>
    <script src='https://code.jquery.com/jquery-latest.min.js'>
    </script>
    <script>
    add_task();
    
    function add_task(){
        $('.add-new-task').submit(function() {
            var new_task = $('.add-new-task input [name=new-task').val();
            
            if (new_task != ''){
                $.post('includes/add-task.php', {task: new_task}, function(data) {
                    $('add-new-task input[name=new-task]').val();
                            $(data).appendTo('task-list ul').hide().fadeIn();
                });
            };
        return false;
    });
    }
    
    $('.delete-button').click(function(){
       var current_element = $(this);
       var task_id = $(this).attr('id');
       $.post('includes/delete-task.php', {id: task_id}, function(){
          current_element.parent().fadeOut ("fast", function(){
             $(this).remove(); 
          });
       });
    });
    </script>
    
</html>
