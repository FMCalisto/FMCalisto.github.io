// grab the things we need
var mongoose = require("mongoose");
mongoose.connect("mongodb://localhost/dbteste");
var Answer = mongoose.model('Answer',{ans:Array}); //can be array


// make this available to our users in our Node applications
module.exports = Answer;
