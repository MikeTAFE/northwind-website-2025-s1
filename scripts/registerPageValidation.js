
/**
 * Return true if the field value matches the given format RegExp
 */
$.validator.addMethod( "pattern", function( value, element, param ) {
  if ( this.optional( element ) ) {
    return true;
  }
  if ( typeof param === "string" ) {
    param = new RegExp( "^(?:" + param + ")$" );
  }
  return param.test( value );
}, "Invalid format." );

// 1. Activate validation for the form - automatically use HTML attributes, e.g. "required", "minlength"
// $("#register-form").validate()

// 2. Activate validation for the form - manually defining rules & messages
$("#register-form").validate({
  rules: {
    "firstName": {
      required: true,
      minlength: 2,
      pattern: /^[A-Z].+$/,
    },
    "lastName": {
      required: true,
      minlength: 2,
    },
    "email": {
      required: true,
      email: true,
    },
    "password1": {
      required: true,
      minlength: 10,
    },
    "password2": {
      equalTo: "#password1",
    },
    "enrolmentMode": {
      required: true,
    },
    "terms": {
      required: true,
    },
    "comments": {
      minlength: 20,
    },
    "postcode": {
      digits: true,
      // minlength: 3,
      // maxlength: 4,
      rangelength: [3, 4],
    },
  },
  messages: {
    "firstName": {
      required: "Don't you have a first name?!",
      minlength: "At least 2, Buddy!",
      pattern: "Must start with a capital letter.",
    },
    "lastName": "Must be at least 2 characters",
    "email": "I need a REAL email address!",
    "password1": "Must be 10+ characters",
    "password2": "Passwords do not match",
    "enrolmentMode": "Please select an enrolment mode",
    "terms": "Accept ALL the terms...",
    "comments": "If you're going to comment, make it at least 20 chars!",
  },
})