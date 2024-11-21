<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!-- ResumeMASTER
	 Lewis Green
	 CPSC 4910
	 XLL755
	 Version: 2
	 Date: 11/13/2024
-->

<!-- This segment of code will create the user page which
	 the user will be directed to after they successfully
	 login. This will serve as their "main" page which gives
	 them access to ResumeMASTER features. This page will utilize 
	 CSS and HTML. The tabs created will be Home, Resume Upload,
	 and logout. Others may be added along development
	 
	 Any additions (except corrections) to code modifies version 
	 and needs to be commented along with editors name.
	 
	 Resources used:
	 Coding For Webpages
	 w3schools
	 
	Nice to do if time permits:
		Fill white space of Page so it isn't empty
		Implement interactive assistant to fill whitespace
-->

<html>
<head> 
    <title>User Page</title>
    <style>
    .bar {									   		/* Section defines the bar */
        background-color: rgb(255, 0, 255);  		/* Setting color of background for bar */
        width: 100%;
        height: 40px;
        display: flex;
        list-style-type: none;  
        padding: 0;  
        margin: 0;   
    }
    
    .bar li {										/* This section is for listed items (li) */
        flex-grow: 1;								/* makes even spacing for tabs in bar */					
        border-right: 1px solid rgb(0, 0, 0);		/* Separators color (black vertical line) */
        list-style-type: none; 
    }
    
    .bar li a {						/* This section and below defines anchored listed items */
        color: black;				/* Color of the letters */
        width: 100%;  
        height: 100%; 
        display: flex;
        align-items: center;  		/* centering vertically */
        justify-content: center;  	/* centering horizontally */
        text-decoration: none;  	/* Stops from generating underlines */
    }
    
    .bar li a:hover {						  /* Section defines "hovering" */
        background-color: rgb(180, 175, 255);  /* Setting color for "hovering" over tabs */
    }
    
    .bar li a.active {  					  /* Section defines the active page */
        background-color: rgb(255, 150, 255);  /* Color of the active page's tab */
        color: blue;  						  /* Color of the letters of active page */
    }
	
	body{
		background-color: purple;
	}
	
	.background-container {
            max-width: 800px; /*Setting the width */
            margin: 0 auto; /*Centering the container */
            padding: 20px; /*Spacing inside the container */
            border: 1px solid #ddd; /*border for the container */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); /*Coloring to ie shadow casting */
        }
		
		p {
			text-align: justify;
			margin: 10;
			font-size: 200%;
		}
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <ul class="bar">  											<!-- Creating a tab layout on the bar --> 
                <li><a href="uHome.php" class="active">Home</a></li>   <!-- Active tab and "web location" -->		
                <li><a href="resumePage.html">Resume Upload</a></li>	<!-- # are dummy links, replace w/ actual links --> 
		<li><a href="resume_example.php">Resume Example</a></li>
                <li><a href="comparisonF.php">Qualification Comparison</a></li>
		<li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
	<br>
	<div class= "background-container">
	<center><h1>Welcome To Your User Page!</h1></center>
	<p>Thank you for taking the time to download this repository and getting started! Congratulations, you made it here!
		This is probably a very, very important time in your life and we want to make this transition as seamless as possible.
		One thing you should know about Resumes is that they don't necessarily get you the job, they get you a chance to interview for a job.
		Remember to have references; you may need people to vouche for your character and work ethic! Practice for interviews by getting familiar with your profession.
		Always remember there is someone who may be a better candidate working hard to get the same job; you need tenacity, experience, and to reflect on yourself and accomplishments.</p>
	<p>Now, this web-based app is here to help you get started with your Resume. At the time of writing this, our interactive assistant isn't up yet. Don't fret! We're still working though!</p>
	</div>
</body>
</html>
