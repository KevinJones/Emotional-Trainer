/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: caregiver.js
Description: Contains functions for the Caregiver side of Emotional Trainer.

*/

var realName = "Jimmy"; //TODO: How do I fetch this from the current session?

function DisplayCurrentUsername()
{
	//real name variable
	
	//add this real name variable to elements with the ID "currentUserame"
	//document.getElementById("currentUsername").innerHTML=realName
}

function LogOut()
{
	//TODO: Add functionality to actually log the current user out and close the session.
	alert("You have logged out.");
	window.location.href = 'index.html';
}

//TODO: Username should be converted into lowercase before being submitted to the database.