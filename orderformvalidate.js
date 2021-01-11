/*
 SIT104 Introduction to Web Development
 Assignment 2 Part 1
 Aaron Pethybridge #217561644
*/

/*
 Main validation function.
 Calls functions to validate form elements
 Returns true if all entered data is valid, false otherwise
*/
function validateForm(theForm) {
	if (!ordersTitleValid(theForm.orderstitle.value))
		return false;
	if (!ordersAuthorValid(theForm.ordersauthor.value))
		return false;
	if (!ordersIsbnValid(theForm.ordersisbn.value))
		return false;
	if (!ordersCustNameValid(theForm.orderscustname.value))
		return false;
	if (!ordersCustPhoneValid(theForm.orderscustphone.value, theForm.orderscustmobile.value))
		return false;
	if (!ordersCustEmailValid(theForm.orderscustemail.value))
		return false;
	if (!ordersDeliveryNoValid(theForm.ordersdeliveryno.value))
		return false;
	if (!ordersDeliveryStreetValid(theForm.ordersdeliverystreet.value))
		return false;
	if (!ordersDeliveryCityValid(theForm.ordersdeliverycity.value))
		return false;
	if (!ordersDeliveryStateValid(theForm.ordersdeliverystate.value))
		return false;
	if (!ordersDeliveryPostcodeValid(theForm.ordersdeliverypost.value))
		return false;
	if (!ordersDeliveryCountryValid(theForm.ordersdeliverycountry.value))
		return false;
	if (!ordersPayNameValid(theForm.orderspayname.value))
		return false;
	if (!ordersPayCardValid(theForm.orderspaycard.value, theForm.orderspaytype.value))
		return false;
	if (!ordersPayCcvValid(theForm.orderspayccv.value))
		return false;
	return true;
}

/*
 Clears all text within specified Text Area
*/
function clearTextArea(theArea)
{
	document.getElementById(theArea.name).innerHTML = "";
}

/*
 Checks if parameter is a numeric value
*/
function isNumeric(num_str) {
	// Following code based on SIT104 prac6 exercise code
	var result = true;
	var range = "1234567890";
	var temp;

	for (i = 0; i < num_str.length; i++)
	{
		temp = num_str.substring(i, i+1);
		if (range.indexOf(temp) == -1)
			result = false;
	}
	return result;
}

/*
 Checks if parameter is a alphabetic value
*/
function isAlpha(alpha_str) {
	// Following code based on SIT104 prac6 exercise code
	var result = true;
	var range = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var temp;

	for (i = 0; i < alpha_str.length; i++)
	{
		temp = alpha_str.substring(i, i+1);
		if (range.indexOf(temp) == -1)
			result = false;
	}
	return result;
}

/*
 Checks if parameter is a alphabetic value
 allowing for extra characters that might be in a name
*/
function isAlphaName(alphan_str) {
	// Following code based on SIT104 prac6 exercise code
	var result = true;
	var range = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ- .";
	var temp;

	for (i = 0; i < alphan_str.length; i++)
	{
		temp = alphan_str.substring(i, i+1);
		if (range.indexOf(temp) == -1)
			result = false;
	}
	return result;
}

/*
 Checks if parameter is a alphanumeric value
 allowing for extra characters that might be in a title
*/
function isAlphaNumTitle(alphan_str) {
	// Following code based on SIT104 prac6 exercise code
	var result = true;
	var range = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ- .";
	var temp;

	for (i = 0; i < alphan_str.length; i++)
	{
		temp = alphan_str.substring(i, i+1);
		if (range.indexOf(temp) == -1)
			result = false;
	}
	return result;
}

/*
 Checks if parameter is a numeric value
 allowing for extra characters for a unit/street or street no.
*/
function isNumericStreetNum(num_str) {
	// Following code based on SIT104 prac6 exercise code
	var result = true;
	var range = "1234567890 /";
	var temp;

	for (i = 0; i < num_str.length; i++)
	{
		temp = num_str.substring(i, i+1);
		if (range.indexOf(temp) == -1) 
			result = false;
	}
	return result;
}

/*
 Checks if parameter has an empty value
 Calls isBlank & isNull functions as part of validation
*/
function isEmpty(the_str) {
	var result = false;
	if (isBlank(the_str) || isNull(the_str))
		result = true;
	return result;
}

/*
 Checks if parameter has a blank value
*/
function isBlank(str) {
	// Following code based on SIT104 prac6 exercise code
	var result = false;
	if ((str.length == 0) || (str+"" == ""))
		result = true;
	return result;
}

/*
 Checks if parameter has a null value
*/
function isNull(str) {
  	var result = false;
  	if (str+"" == "null")
   		result = true;
 	return result;
}

/*
 Validate orders info text box

function ordersInfoValid(oi_str) {
	// Following code based on SIT104 prac6 exercise code
	var result = true;
	var init_val = "Book title, author, ISBN (if known), order quantity ...";
	if (isEmpty(oi_str) || (oi_str == init_val))
	{
		alert("Please enter information for the item(s) you wish to order.");
		return false;
	}
	return result;
}*/

/*
 Validate orders title field
*/
function ordersTitleValid(ot_str) {
	var result = true;
	if (isEmpty(ot_str))
	{
		alert("Please enter a book title for the order.");
		return false;
	}
	else if (!isAlphaNumTitle(ot_str)) // Book Title could have letters & numbers
	{
		alert("Please enter valid alphanumerics for book title. You entered " + ot_str);
		return false;
	}
	return result;
}

/*
 Validate orders author field
*/
function ordersAuthorValid(oa_str) {
	var result = true;
	if (isEmpty(oa_str))
	{
		alert("Please enter a book author for the order.");
		return false;
	}
	else if (!isAlphaName(oa_str))
	{
		alert("Please enter valid alphabetics for book author. You entered " + oa_str);
		return false;
	}
	return result;
}

/*
 Validate orders ISBN field
*/
function ordersIsbnValid(oi_str) {
	var result = true;
	if (isEmpty(oi_str))
	{
		alert("Please enter a book ISBN for the order.");
		return false;
	}
	if (!isNumeric(oi_str))
	{
		alert("Please enter 13 digits for book ISBN. You entered " + oi_str);
		return false;
	}
	else if (!isLengthOkay(oi_str, 13))
	{
		alert("Please enter 13 digits for book ISBN. You entered " + oi_str);
		return false;
	}
	return result;
}

/*
 Validate orders Customer name field
*/
function ordersCustNameValid(cn_str) {
	var result = true;
	if (isEmpty(cn_str))
	{
		alert("Please enter a customer name for the order.");
		return false;
	}
	else if (!isAlphaName(cn_str))
	{
		alert("Please enter valid alphabetics for customer name. You entered " + cn_str);
		return false;
	}
	return result;
}

/*
 Validate orders Customer phone & mobile no. field
*/
function ordersCustPhoneValid(cp_str, cm_str) {
	var result = true;
	if (isEmpty(cp_str) && isEmpty(cm_str))
	{
		alert("Please enter either a customer phone number or a customer mobile number for the order.");
		return false;
	}
	else
	{
		if (!isEmpty(cp_str))
		{
			if (!isLengthOkay(cp_str, 10) || !isNumeric(cp_str))
			{
				alert("Please enter a 10 digit value for customer phone number. You entered " + cp_str);
				return false;	
			}
		}
		if (!isEmpty(cm_str))
		{
			if (!isLengthOkay(cm_str, 10) || !isNumeric(cm_str))
			{
				alert("Please enter a 10 digit value for customer mobile number.. You entered " + cm_str);
				return false;	
			}
		}
	}
	return result;
}

/*
 Validate orders Customer email field
*/
function ordersCustEmailValid(cp_str) {
	var result = true;
	//alert(cp_str);
	if (isEmpty(cp_str))
	{
		alert("Please enter a customer email for the order.");
		return false;
	}
	else
	{
		// Following code based on SIT104 prac6 exercise code
		// Locate @ in customer email field
		at=cp_str.indexOf("@")

		// if @ not in customer email field
		if (at == -1)
		{
			alert("Please enter a valid e-mail address, missing @. You entered " + cp_str )
			return false
		}

		// if @ is the first character in customer email field
		if (at == 0)
		{
			alert("Please enter a valid e-mail address, @ can't be first character.")
			return false
		}

		//if @ is the last character in customer email field
		if (at == (cp_str.length))
		{
			alert("Please enter a valid e-mail address, @ can't be last character.")
			return false
		}
		
		// Locate . in customer email field
		dot=cp_str.indexOf(".")

		// if . not in customer email field
		if (dot == -1)
		{
			alert("Please enter a valid e-mail address, missing '.'. You entered " + cp_str )
			return false
		}

		// if . is the first character in customer email field
		if (dot == 0)
		{
			alert("Please enter a valid e-mail address, '.' can't be first character.")
			return false
		}

		//if . is the last character in customer email field
		if (dot == (cp_str.length1))
		{
			alert("Please enter a valid e-mail address, '.' can't be last character.")
			return false
		}
	}
	return result;
}

/*
 Validate orders Delivery street no field
*/
function ordersDeliveryNoValid(dn_str) {
	var result = true;
	if (isEmpty(dn_str))
	{
		alert("Please enter a delivery address number for the order.");
		return false;
	}
	if (!isNumericStreetNum(dn_str) || dn_str == "/")
	{
		alert("Please enter either 'unit / street number', or 'street number' for the order.");
		return false;
	}
	return result;
}

/*
 Validate orders Delivery street field
*/
function ordersDeliveryStreetValid(ds_str) {
	//alert("ds: " + ds_str);
	var result = true;
	var init = "eg. Main Road";
	if (isEmpty(ds_str))
	{
		alert("Please enter a delivery street name for the order.");
		return false;
	}
	if (!isAlphaName(ds_str))
	{
		alert("Please enter valid alphabetics for street name. You entered " + ds_str);
		return false;
	}
	if (ds_str == init)
	{
		alert("Please enter a valid street name. You entered " + ds_str);
		return false;
	}
	return result;
}

/*
 Validate orders Delivery city field
*/
function ordersDeliveryCityValid(dc_str) {
	var result = true;
	if (isEmpty(dc_str))
	{
		alert("Please enter a delivery city for the order.");
		return false;
	}
	if (!isAlphaName(dc_str))
	{
		alert("Please enter valid alphabetics for city name. You entered " + dc_str);
		return false;
	}
	return result;
}

/*
 Validate orders Delivery state field
*/
function ordersDeliveryStateValid(dst_str) {
	var result = true;
	if (isEmpty(dst_str))
	{
		alert("Please enter a delivery state for the order.");
		return false;
	}
	if (!isAlphaName(dst_str))
	{
		alert("Please enter valid alphabetics for state name. You entered " + dst_str);
		return false;
	}
	return result;
}

/*
 Validate orders Delivery postcode field
*/
function ordersDeliveryPostcodeValid(pc_str) {
	
	var result = true;
	if (!isEmpty(pc_str))
	{
		if (!isNumeric(pc_str)) // Don't check postcode length in case overseas order
		/*{
			if (!isLengthOkay(pc_str, 4))
			{
				alert("Postcode needs to be 4 digits. You entered " + pc_str);
				result = false;
			}
		}
		else*/
		{
			alert("Delivery postcode must be all digits. You entered " + pc_str);
			result = false;
		}
	}
	else
	{
		alert("Delivery postcode is empty. Please enter a value.");
		result = false;
	}
	return result;
}

/*
 Validate orders Delivery country field
*/
function ordersDeliveryCountryValid(dco_str) {
	var result = true;
	if (isEmpty(dco_str))
	{
		alert("Please enter a delivery country for the order.");
		return false
	}
	if (!isAlphaName(dco_str))
	{
		alert("Please enter valid alphabetics for country name. You entered " + dco_str);
		return false;
	}
	return result;
}

/*
 Validate cardholder name field
*/
function ordersPayNameValid(opn_str) {
	var result = true;
	if (isEmpty(opn_str))
	{
		alert("Please enter cardholder name to make payment.");
		return false;
	}
	if (!isAlphaName(opn_str))
	{
		alert("Please enter valid alphabetics for cardholder name. You entered " + opn_str);
		return false;
	}
	return result;
}

/*
 Validates entered credit card no matches card type
*/
function validCardDetails(cardno_str, card_type_str)
{
	var result = true;
	if (card_type_str=="visa")
	{ // Check card no format matches Visa pattern
		if (cardno_str.charAt(0) != "4")
			result = false;
	}
	if (card_type_str=="mastercard")
	{ // Check card no format matches Mastercard pattern
		if (cardno_str.charAt(0) != "5")
			result = false;
	}
	if (card_type_str=="amex")
	{ // Check card no format matches AMEX pattern
		if (cardno_str.charAt(0) != "3")
			result = false;
		else if (cardno_str.charAt(0) == "3")
		{
			if (cardno_str.charAt(1) != "7")
			{
				if (cardno_str.charAt(1) != "4")
					result = false;
			}
		}
	}
	return result;
}

/*
 Validate credit card no field
 Checks card number matches card type
*/
function ordersPayCardValid(opc_str, ct_str) {
	var result = true;
	if (isEmpty(opc_str))
	{
		alert("Please enter credit card number to make payment.");
		return false;
	}
	if (!isNumeric(opc_str))
	{
		alert("Please enter all digits, with no spaces, for credit card number.");
		return false;
	}
	if (ct_str == "visa")
	{
		if (!isLengthOkay(opc_str, 16))
		{
			alert("You selected Visa. Please enter 16 digits for this card type.");
			return false;
		}
		else
		{
			if (!validCardDetails(opc_str, ct_str))
			{
				alert("Card number entered does not match Visa card type. You entered " + opc_str);
				return false;
			}
		}
	}
	else if (ct_str == "mastercard")
	{
		if (!isLengthOkay(opc_str, 16))
		{
			alert("You selected Mastercard. Please enter 16 digits for this card type.");
			return false;
		}
		else
		{
			if (!validCardDetails(opc_str, ct_str))
			{
				alert("Card number entered does not match Mastercard card type. You entered " + opc_str);
				return false;
			}
		}
	}
	else if (ct_str == "amex")
	{
		if (!isLengthOkay(opc_str, 15))
		{
			alert("You selected AMEX. Please enter 15 digits for this card type.");
			return false;
		}
		else
		{
			if (!validCardDetails(opc_str, ct_str))
			{
				alert("Card number entered does not match AMEX card type. You entered " + opc_str);
				return false;
			}
		}
	}
	return result;
}

/*
 Validate credit card ccv no field
*/
function ordersPayCcvValid(opccv_str) {
	var result = true;
	if (isEmpty(opccv_str))
	{
		alert("Please enter CCV number to make payment.");
		return false
	}
	else
	{
		if (!isLengthOkay(opccv_str, 3))
		{
			alert("Please enter 3 digits for CCV number. You entered " + opccv_str);
			return false
		}
	}
	return result;
}

/*
 Checks length of input string parameter is same as specified length parameter
*/
function isLengthOkay(len_str, check_len) {
	var result = true;
	//alert("S " + len_str + "- len " + len_str.length);
	if (len_str.length != check_len)
		result = false;
	return result;
}

/*
 Populates credit card expiry month drop dpwn list
*/
function fillMonthDate() {
	for (i=1; i < 13; i++)
	{
		var day_str = "<option value=\"" + i + "\">" + i + "</option>";
		document.write(day_str);
	}
}

/*
 Populates credit card expiry year drop dpwn list
*/
function fillYearDate() {
	var today = new Date();
	var year = today.getFullYear();
	for (i=year+1; i < year+11; i++)
	{
		var day_str = "<option value=\"" + i + "\">" + i + "</option>";
		document.write(day_str);
	}
}

/*
 Populates credit card expiry year drop dpwn list
*/
function fillOrderQuantity() {
	for (i=1; i < 11; i++)
	{
		var day_str = "<option value=\"" + i + "\">" + i + "</option>";
		document.write(day_str);
	}
}
