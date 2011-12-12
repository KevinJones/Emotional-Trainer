/*

Project Emotional Trainer
Created by Chameleon Designs
Moinak Bandyopadhyay, Jessica Blair, Kevin Jones, Mudit Manu Paliwal and Jacob Solomon.

Filename: validation.js
Description: This file contains the code to validate user input

*/

var MINIMUM_AGE = 13; //minimum age for caregiver registration
var MINIMUM_USERNAME_LENGTH = 4;
var MINIMUM_PASSWORD_LENGTH = 6;

var validateAlert = "";
function ValidateChildProfile()
{
	//returns true if the form is valid,
	//and false otherwise.
	var form = document.forms["newChild"];
	
	//Username:
	if(ValidateUsername(form["username"].value) == false){
		alert(validateAlert);
		return false;
	}
	
	//Password inputs:
	if (ValidatePassword(form["password"].value, form["confirmPass"].value) == false){
		alert(validateAlert);
		return false;
	}
	
	//Name:
	//TODO: Basically just make sure it doesn't crash the DB
	
	//Date of Birth:
	//Date of birth is optional, but we want a complete date of birth if possible.
	var day = form["birthDay"].value;
	var month = form["birthMonth"].value;
	var year = form["birthYear"].value;

	if(ValidateDateOfBirth(day, month, year, 0) == false){
		alert(validateAlert);
		return false;
	}
	
	//Everything is valid!
	return true;

	
}
//TODO: Child username should be unique
//TODO: Provide a means for testing addChild.php against SQL injections

function ValidateRegistration() 
{
	//Checks every field in the form on register.php.
	//If everything is valid, return true.
	//Otherwise, show a message explaining why and return false.

	var form = document.forms["registerForm"];
	
	if(ValidateEmail(form["email"].value) == false){
		alert(validateAlert);
		return false;
	}
	if (ValidatePassword(form["password"].value, form["confirmPass"].value, MIN_PASS_LENGTH) == false){
		alert(validateAlert);
		return false;
	}



	if(ValidateDateOfBirth(form["element_6_2"].value, form["element_6_1"].value, form["element_6_3"].value, MINIMUM_AGE) == false){
		alert(validateAlert);
		return false;
	}

	if(form["termsConsent"].checked == false){
		alert("You must agree to our Terms of Consent to use this website. Please review them before completing registration.");
		return false;
	}

	return true;
}

function ValidateLogin()
{
	//Make sure the email and password have been entered.
	//Otherwise we'd just be wasting time sending it to server.
	
	//called from index.html

	var form = document.forms["loginForm"];
	
	if(ValidateEmail(form["email"].value) == false){
		alert(validateAlert);
		return false;
	}
	
	//Sending the entered password as both the normal and the confirmed pass, since there's only one field on the login form.
	if(ValidatePassword(form["password"].value, form["password"].value) == false){
		alert(validateAlert);
		return false;
	}
	
	return true;
}

function ValidateEditCaregiverProfile()
{
	//Checks every field in the form on editCaregiverProfile.php
	//If everything is valid, return true.
	//Otherwise, show a message explaining why and return false.
	//accepts empty fields as valid.
	
	var form = document.forms["registerForm"];
	
	//email
	if((form["email"].value != "") && (ValidateEmail(form["email"].value) == false))
	{
		alert(validateAlert);
		return false;
	}
	
	//password
	if((form["password"].value != "") && (ValidatePassword(form["password"].value, form["confirmPass"].value) == false))
	{
		alert(validateAlert);
		return false;
	}
	
	//date of birth
	if( (form["element_6_1"].value != "") && (form["element_6_2"].value != "") && (form["element_6_3"].value != "")){
		if(ValidateDateOfBirth(form["element_6_2"].value, form["element_6_1"].value, form["element_6_3"].value, MINIMUM_AGE) == false){
			alert(validateAlert);
			return false;
		}
	}
	
	return true;
}


function ValidateUsername(username){
	/*
	Returns true if the username:
		exists
		and is at least 4 characters long
		and contains only letters, numbers, and underscores.
	Otherwise, sets the validateAlert and returns false.
	*/

	var illegalUsernameCharacters = /[^A-Za-z0-9_]/; 

	if(username == null || username == "")
	{
		validateAlert = "Please enter a username." 
		return false;
	}

	else if (username.length < MINIMUM_USERNAME_LENGTH)

	{
		validateAlert = "Your username is too short. Please enter a username at least 4 characters long.";
		return false;
	}
	//TODO: max length 45
	else if (username.match(illegalUsernameCharacters))
	{
		validateAlert = "Usernames can only contain letters, numbers, and underscores. Please double-check your username.";
		return false;
	} else {
		validateAlert = "";
		return true;
	}
}

function ValidatePassword(pass, confirmPass){
	return ValidatePassword(pass, confirmPass, 0); // while logging in password length check should not matter
}

function ValidatePassword(pass, confirmPass, minPassLength){
	/*
	Returns true if the password:
		exists
		is at least 6 characters long
		TODO: does not contain any illegal characters (letters, numbers, and special characters only)
		has a confirmPass that exists
		and matches its confirmPass
	Otherwise, sets the validateAlert and returns false.
	*/

	//var legalPasswordChars = ??? TODO: must consist of letters, numbers, and ~`!@#$%^&*()-=_+[]{};':"
	
	if(pass == null || pass == "")
	{
		validateAlert = "Please enter a password.";
		return false;
	} 

	else if (pass.length < MINIMUM_PASSWORD_LENGTH)

	{
		validateAlert = "Your password is too short.";
		return false;	
	}
	
	
	if(confirmPass == null || confirmPass == "")
	{
		validateAlert = "Please confirm your password.";	
		return false;
	} 
	else if (confirmPass != pass)
	{
		validateAlert = "Your passwords don't match.";
		return false;
	} else {
		validateAlert = "";
		return true;
	}
}

function ValidateEmail(email){

	var legalEmailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	//alphanumeric@alphanumeric.alpha
	
	if(email.match(legalEmailPattern)){
		return true;
	} else {
		validateAlert = "Please enter a valid email address.";
		return false;
	}

}

function ValidateDateOfBirth(day, month, year, minimumAge){
	/*
	Returns true in two conditions:
		1) day, month, and year all equal 0. In other words, the user has not supplied a date of birth.
		2) None of day, month, and year equal 0. In other words, the date supplied includes all the needed information.
	Otherwise, sets the validateAlert and returns false.
	*/

	//If it's required, return false when nothing has been entered.
	var required = (minimumAge != 0);
	if(required && (day == 0 && month == 0 && year == 0))
	{
		validateAlert = ("Please enter a birth date.");
		return false;
	}
	
	//Make sure this is a complete date if some information has been entered.
	if(day != 0 || month != 0 || year != 0)
	{
		if(day == 0 || month == 0 || year == 0){
			validateAlert = "Please enter a complete birth date.";
			return false;
		}
	}
	
	//Make sure the birthdate meets the minimum age required.
	var enteredDate = new Date(year, month, day); //TODO: this isn't getting parsed correctly
	var currentDate = new Date();
	var difference = new Date(currentDate.valueOf() - enteredDate.valueOf());
	var oneYear = 1000*60*60*24*365; //number of ms in one year
	var age = difference.valueOf()/oneYear; //BUG: returns NaN
	
	if(age < minimumAge){
		validateAlert = "You must be " + MINIMUM_AGE + " years or older to register an account. Please double-check your birth date."
		return false;
	}

	validateAlert = "";
	return true;
}