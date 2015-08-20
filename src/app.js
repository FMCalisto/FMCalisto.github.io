var app = angular.module('app', []);
var RectangleDim=30;

app.controller('MainCtrl', function($scope, $http) {

       // var Answer = require("mongoose");

        $scope.graph = {'width': 5000, 'height': 5000};

        $scope.circles = [

            /*  JSON.parse("{\"x\": 85, \"y\": 20, \"r\":15}"),

             {"x": 20, "y": 60, "r":20},

             {"x": 18, "y": 10, "r":40} */
        ];

        $scope.draw=function(val)
        {
            // val = document.getElementById("NumQuest").value;
            return JSON.parse('{\"cx\":'+val+', "cy": 20, "r":30}');
            // $scope.circles.push(JSON.parse('{\"x\":'+val+', "y": 220, "r":30}'));
        };

        $scope.rectangles = [

            //     {'x':220,  'y':220,  'width' : 300, 'height' : 100},
            // {'x':520,  'y':220,  'width' : 10, 'height' : 10},
        ];

        $scope.DrawRect=function(xpos,ypos) {
            return JSON.parse('{\"x\":' + xpos + ', \"y\":' + ypos + ', \"width\":' + RectangleDim + ', \"height\":' + RectangleDim+ ', \"style\":\"fill:rgb(0,0,255);stroke-width:3;stroke:rgb(0,0,0)\"'+ '}');
        };

        $scope.DrawRectDel=function(xpos,ypos) {
            return JSON.parse('{\"x\":' + xpos + ', \"y\":' + ypos + ', \"width\":' + 0 + ', \"height\":' + 0+ ', \"style\":\"fill:rgb(0,0,255);stroke-width:3;stroke:rgb(0,0,0)\"'+ '}');
        };

        $scope.Debug=function(desiredNo){
            desiredNo=document.getElementById("NumQuest").value;
            for(var i = 0;i < RectangleDim*desiredNo+desiredNo;i++){
                $scope.rectangles.push($scope.DrawRect(i+RectangleDim+1,40));
            }
        };

        $scope.DebugDel=function(desiredNo){
            $scope.rectangles.length=0;
            desiredNo=document.getElementById("NumQuest").value;
            for(var i = 0;i < RectangleDim*desiredNo+desiredNo;i++){
                $scope.rectangles.push(JSON.parse('{\"x\":' + xpos + ', \"y\":' + ypos + ', \"width\":' +0 + ', \"height\":' + 0+ ', \"style\":\"fill:rgb(0,0,255);stroke-width:3;stroke:rgb(0,0,0)\"}'));//+', \"info\":+\"\"}'));
            }
        };

        $scope.DrawLineOdd=function(desiredNo,lineNo,pozY){
            var pozX = lineNo*RectangleDim;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-1-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $scope.rectangles.push($scope.DrawRect(pozX, pozY));//$scope.DrawRect(pozX, pozY);
                pozX += RectangleDim;
            }
            //return aux;
        };

        $scope.DrawLineOddDel=function(desiredNo,lineNo,pozY){
            $scope.rectangles.length=0;
            var pozX = lineNo*RectangleDim;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-1-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $scope.rectangles.push($scope.DrawRectDel(pozX, pozY));//$scope.DrawRect(pozX, pozY);
                pozX += RectangleDim;
            }
            //return aux;
        };

        $scope.DrawMatrixPerfectProgression=function(desiredNo) {

            desiredNo=document.getElementById("NumQuest").value;


            var line=0;
            var pozy=0;
            while(line<Math.floor(Math.sqrt(desiredNo))) {
                $scope.DrawLineOdd(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $scope.DrawMatrixPerfectProgressionDel=function(desiredNo) {
            $scope.rectangles.length=0;
            desiredNo=document.getElementById("NumQuest").value;


            var line=0;
            var pozy=0;
            while(line<Math.floor(Math.sqrt(desiredNo))) {
                $scope.DrawLineOddDel(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $scope.DrawLineEven=function(desiredNo, lineNo, pozY){
            var pozX = lineNo*RectangleDim;
            //var pozY = lineno*20;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $scope.rectangles.push($scope.DrawRect(pozX, pozY));
                pozX += RectangleDim;
            }
            //return aux;
        };

        $scope.DrawLineEvenDel=function(desiredNo, lineNo, pozY){
            $scope.rectangles.length=0;
            var pozX = lineNo*RectangleDim;
            //var pozY = lineno*20;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $scope.rectangles.push($scope.DrawRectDel(pozX, pozY));
                pozX += RectangleDim;
            }
            //return aux;
        };

        $scope.DrawMatrixEvenProgression=function(desiredNo) {

            desiredNo=document.getElementById("NumQuest").value;

            var line=0;
            var pozy=0;
            while(line<Math.floor((Math.sqrt(4*desiredNo+1)-1)/2)) {
                $scope.DrawLineEven(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $scope.DrawMatrixEvenProgressionDel=function(desiredNo) {
            $scope.rectangles.length=0;
            desiredNo=document.getElementById("NumQuest").value;

            var line=0;
            var pozy=0;
            while(line<Math.floor((Math.sqrt(4*desiredNo+1)-1)/2)) {
                $scope.DrawLineEvenDel(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $scope.AddExtraRectangles=function(desiredNo) {
            desiredNo = document.getElementById("NumQuest").value;

            var arg1 = desiredNo - (  Math.floor(Math.sqrt(desiredNo))*Math.floor(Math.sqrt(desiredNo)));
            var arg2 = desiredNo-(Math.floor((Math.sqrt(4*desiredNo+1)-1)/2)*Math.floor((Math.sqrt(4*desiredNo+1)-1)/2))-Math.floor((Math.sqrt(4*desiredNo+1)-1)/2);
            var OptimalLeftOver = Math.min( arg1  ,arg2 );
            //We add two rectangles per row: one at the beginning one at the end
            //we start with the row below the first one

            var line;
            var pozy;
            var pozx1, pozx2;
            var nRectLine_i;

            if(OptimalLeftOver===arg1){
                line=1;//1st line is skipped
                pozy=RectangleDim;
                pozx1 = 0;
                while(OptimalLeftOver>0) {
                    nRectLine_i = 2* Math.floor(Math.sqrt(desiredNo))-1-2*line;
                    pozx2 = (line-1)*RectangleDim+RectangleDim*(nRectLine_i+1);//pozx1+nRectLine_i+2*RectangleDim;
                    $scope.rectangles.push($scope.DrawRect(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $scope.rectangles.push($scope.DrawRect(pozx2, pozy));
                        OptimalLeftOver -= 1;
                    }
                    //document.getElementById("val").innerHTML = teste;
                    line += 1;
                    pozy+=RectangleDim;
                    pozx1=RectangleDim*line - RectangleDim;
                }
                //document.getElementById('tablePrint').innerHTML = finalTable;
            }
            else {
                line=1;//1st line is skipped
                pozy=RectangleDim;
                pozx1 = 0;
                while(OptimalLeftOver>0) {
                    nRectLine_i = 2* Math.floor(Math.sqrt(desiredNo))-2*line;
                    pozx2 = RectangleDim*(line-1)+RectangleDim*(nRectLine_i+1);//pozx1+nRectLine_i+2*RectangleDim;
                    $scope.rectangles.push($scope.DrawRect(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $scope.rectangles.push($scope.DrawRect(pozx2, pozy));
                        OptimalLeftOver -= 1;
                    }
                    //document.getElementById("val").innerHTML = teste;
                    line += 1;
                    pozy+=RectangleDim;
                    pozx1=RectangleDim*line - RectangleDim;
                }
                //document.getElementById('tablePrint').innerHTML = finalTable;
            }
        };

        $scope.DelExtraRectangles=function(desiredNo) {
            $scope.rectangles.length=0;
            desiredNo = document.getElementById("NumQuest").value;

            var arg1 = desiredNo - (  Math.floor(Math.sqrt(desiredNo))*Math.floor(Math.sqrt(desiredNo)));
            var arg2 = desiredNo-(Math.floor((Math.sqrt(4*desiredNo+1)-1)/2)*Math.floor((Math.sqrt(4*desiredNo+1)-1)/2))-Math.floor((Math.sqrt(4*desiredNo+1)-1)/2);
            var OptimalLeftOver = Math.min( arg1  ,arg2 );
            //We add two rectangles per row: one at the beginning one at the end
            //we start with the row below the first one

            var line;
            var pozy;
            var pozx1, pozx2;
            var nRectLine_i;

            if(OptimalLeftOver===arg1){
                line=1;//1st line is skipped
                pozy=RectangleDim;
                pozx1 = 0;
                while(OptimalLeftOver>0) {
                    nRectLine_i = 2* Math.floor(Math.sqrt(desiredNo))-1-2*line;
                    pozx2 = (line-1)*RectangleDim+RectangleDim*(nRectLine_i+1);//pozx1+nRectLine_i+2*RectangleDim;
                    $scope.rectangles.push($scope.DrawRectDel(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $scope.rectangles.push($scope.DrawRectDel(pozx2, pozy));
                        OptimalLeftOver -= 1;
                    }
                    //document.getElementById("val").innerHTML = teste;
                    line += 1;
                    pozy+=RectangleDim;
                    pozx1=RectangleDim*line - RectangleDim;
                }
                //document.getElementById('tablePrint').innerHTML = finalTable;
            }
            else {
                line=1;//1st line is skipped
                pozy=RectangleDim;
                pozx1 = 0;
                while(OptimalLeftOver>0) {
                    nRectLine_i = 2* Math.floor(Math.sqrt(desiredNo))-2*line;
                    pozx2 = RectangleDim*(line-1)+RectangleDim*(nRectLine_i+1);//pozx1+nRectLine_i+2*RectangleDim;
                    $scope.rectangles.push($scope.DrawRectDel(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $scope.rectangles.push($scope.DrawRectDel(pozx2, pozy));
                        OptimalLeftOver -= 1;
                    }
                    //document.getElementById("val").innerHTML = teste;
                    line += 1;
                    pozy+=RectangleDim;
                    pozx1=RectangleDim*line - RectangleDim;
                }
                //document.getElementById('tablePrint').innerHTML = finalTable;
            }
        };


        $scope.DrawMatrix=function(desiredNo)
        {
            /* Chooses optimal leftover number based on the progression formulas.
             Attempts to minimize the work of the designer of the response form without
             making too much assumptions */
            desiredNo = document.getElementById("NumQuest").value;
            //document.getElementById("val").innerHTML = 'There are '+OptimalLeftOver+' questions missing!'+ arg1+ '___'+arg2;
            // document.getElementById("val").innerHTML=desiredNo;
            var arg1 = desiredNo - (  Math.floor(Math.sqrt(desiredNo))*Math.floor(Math.sqrt(desiredNo)));
            var arg2 = desiredNo - (Math.floor((Math.sqrt(4*desiredNo+1)-1)/2)*Math.floor((Math.sqrt(4*desiredNo+1)-1)/2))-Math.floor((Math.sqrt(4*desiredNo+1)-1)/2);
            var OptimalLeftOver = Math.min( arg1  ,arg2 );
            //document.getElementById("val").innerHTML = 'There are '+OptimalLeftOver+' questions missing!'+ arg1+ '___'+arg2;
            //console.log(arg1);
            if(OptimalLeftOver===arg1){
                //desiredNo = document.getElementById("NumQuest").value;

                $scope.DrawMatrixPerfectProgression(desiredNo);
                $scope.AddExtraRectangles(desiredNo);
            }
            else {
                // desiredNo = document.getElementById("NumQuest").value;

                $scope.DrawMatrixEvenProgression(desiredNo);
                $scope.AddExtraRectangles(desiredNo);
            }
        };

        $scope.DelMatrix=function(desiredNo) {
            $scope.rectangles.length=0;
            /* Chooses optimal leftover number based on the progression formulas.
             Attempts to minimize the work of the designer of the response form without
             making too much assumptions */
            desiredNo = document.getElementById("NumQuest").value;
            //document.getElementById("val").innerHTML = 'There are '+OptimalLeftOver+' questions missing!'+ arg1+ '___'+arg2;
            //document.getElementById("val").innerHTML = desiredNo;
            var arg1 = desiredNo - (  Math.floor(Math.sqrt(desiredNo)) * Math.floor(Math.sqrt(desiredNo)));
            var arg2 = desiredNo - (Math.floor((Math.sqrt(4 * desiredNo + 1) - 1) / 2) * Math.floor((Math.sqrt(4 * desiredNo + 1) - 1) / 2)) - Math.floor((Math.sqrt(4 * desiredNo + 1) - 1) / 2);
            var OptimalLeftOver = Math.min(arg1, arg2);
            //document.getElementById("val").innerHTML = 'There are '+OptimalLeftOver+' questions missing!'+ arg1+ '___'+arg2;
            //console.log(arg1);
            if (OptimalLeftOver === arg1) {
                //desiredNo = document.getElementById("NumQuest").value;

                $scope.DrawMatrixPerfectProgressionDel(desiredNo);
                $scope.DelExtraRectangles(desiredNo);
            }
            else {
                //desiredNo = document.getElementById("NumQuest").value;

                $scope.DrawMatrixEvenProgressionDel(desiredNo);
                $scope.DelExtraRectangles(desiredNo);
            }
        };

        $scope.SendToServer=function(){
            $http.post("http://localhost:3000/savetodb", {rects: $scope.rectangles}).success(function(){
               alert("Sent!");
            });
        }
    }
);

angular.bootstrap(document.getElementById('body'), ["app"]);
