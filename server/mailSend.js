var express=require('express');
var nodemailer = require("nodemailer");
var app=express();
/*
 Here we are configuring our SMTP Server details.
 STMP is mail server which is responsible for sending and recieving email.
 */
var smtpTransport = nodemailer.createTransport("SMTP",{
    service: "gmail",
    auth: {
        user: "ssds.idss@gmail.com",
        pass: "wlKfqDCqeVJiEK"
    }
});
/*------------------SMTP Over-----------------------------*/

/*------------------Routing Started ------------------------*/

app.get('/',function(req,res){
    res.sendfile('index.html');
});
app.get('/send',function(req,res){
    var mailOptions={
        to : req.query.to,
        subject : "Inquérito DELPHI",
        text : "Queira seguir o link para responder ao inquérito: http://fmcalisto.github.io/public/expert-intro.html"
    };
    console.log(mailOptions);
    smtpTransport.sendMail(mailOptions, function(error, response){
        if(error){
            console.log(error);
            res.end("error");
        }else{
            console.log("Message sent: " + response.message);
            res.end("sent");
        }
    });
    console.log(res);
});

/*--------------------Routing Over----------------------------*/

app.listen(3000||process.env.PORT,function(){
    console.log("Express Started on Port 3000");
});