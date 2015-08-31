var app = angular.module('app', []);
var RectangleDim=30;

app.controller('MainCtrl', function($rootScope, $http) {

        $rootScope.graph = {'width': '100%', 'height': 500};
        $rootScope.rectangles = [
            //     {'x':220,  'y':220,  'width' : 300, 'height' : 100},
            // {'x':520,  'y':220,  'width' : 10, 'height' : 10},
            //valid JSON:  {"rect":{"x":220,  "y":220,  "width" : 300, "height" : 100}, "info":""}
        ];

        $rootScope.DrawRect=function(xpos,ypos) {
            // return JSON.parse('{\"rect\":'+'{\"x\":'+220+',  \"y\":'+220+',  \"width\" :'+ 300+', \"height\" :'+ 100+'}, \"info\":'+'\"\"'+'}');
            return JSON.parse('{\"rect\":'+ '{\"x\":' + xpos + ', \"y\":' + ypos + ', \"width\":' + RectangleDim + ', \"height\":' + RectangleDim+ ', \"style\":\"fill:rgb(0,0,255);stroke-width:3;stroke:rgb(0,0,0)\"'+ '}, \"info\":'+'\"\"'+'}');
        };

        $rootScope.DrawRectDel=function(xpos,ypos) {
            return JSON.parse('{\"rect\":'+ '{\"x\":' + xpos + ', \"y\":' + ypos + ', \"width\":' + 0 + ', \"height\":' + 0+ ', \"style\":\"fill:rgb(0,0,255);stroke-width:3;stroke:rgb(0,0,0)\"'+ '}, \"info\":'+'\"\"'+'}');
        };

        $rootScope.DrawLineOdd=function(desiredNo,lineNo,pozY){
            var pozX = lineNo*RectangleDim;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-1-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $rootScope.rectangles.push($rootScope.DrawRect(pozX, pozY));//$rootScope.DrawRect(pozX, pozY);
                pozX += RectangleDim;
            }
            //return aux;
        };

        $rootScope.DrawLineOddDel=function(desiredNo,lineNo,pozY){
            $rootScope.rectangles.length=0;
            var pozX = lineNo*RectangleDim;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-1-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $rootScope.rectangles.push($rootScope.DrawRectDel(pozX, pozY));//$rootScope.DrawRect(pozX, pozY);
                pozX += RectangleDim;
            }
            //return aux;
        };

        $rootScope.DrawMatrixPerfectProgression=function(desiredNo) {

            desiredNo=document.getElementById("NumQuest").value;


            var line=0;
            var pozy=0;
            while(line<Math.floor(Math.sqrt(desiredNo))) {
                $rootScope.DrawLineOdd(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $rootScope.DrawMatrixPerfectProgressionDel=function(desiredNo) {
            $rootScope.rectangles.length=0;
            desiredNo=document.getElementById("NumQuest").value;


            var line=0;
            var pozy=0;
            while(line<Math.floor(Math.sqrt(desiredNo))) {
                $rootScope.DrawLineOddDel(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $rootScope.DrawLineEven=function(desiredNo, lineNo, pozY){
            var pozX = lineNo*RectangleDim;
            //var pozY = lineno*20;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $rootScope.rectangles.push($rootScope.DrawRect(pozX, pozY));
                pozX += RectangleDim;
            }
            //return aux;
        };

        $rootScope.DrawLineEvenDel=function(desiredNo, lineNo, pozY){
            $rootScope.rectangles.length=0;
            var pozX = lineNo*RectangleDim;
            //var pozY = lineno*20;
            var aux = 2*Math.floor(Math.sqrt(desiredNo))-2*lineNo;
            for (var j = 0; j < aux; j++) {
                $rootScope.rectangles.push($rootScope.DrawRectDel(pozX, pozY));
                pozX += RectangleDim;
            }
            //return aux;
        };

        $rootScope.DrawMatrixEvenProgression=function(desiredNo) {

            desiredNo=document.getElementById("NumQuest").value;

            var line=0;
            var pozy=0;
            while(line<Math.floor((Math.sqrt(4*desiredNo+1)-1)/2)) {
                $rootScope.DrawLineEven(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $rootScope.DrawMatrixEvenProgressionDel=function(desiredNo) {
            $rootScope.rectangles.length=0;
            desiredNo=document.getElementById("NumQuest").value;

            var line=0;
            var pozy=0;
            while(line<Math.floor((Math.sqrt(4*desiredNo+1)-1)/2)) {
                $rootScope.DrawLineEvenDel(desiredNo, line, pozy);
                //document.getElementById("val").innerHTML = teste;
                line += 1;
                pozy+=RectangleDim;
            }
            //document.getElementById('tablePrint').innerHTML = finalTable;
        };

        $rootScope.AddExtraRectangles=function(desiredNo) {
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
                    $rootScope.rectangles.push($rootScope.DrawRect(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $rootScope.rectangles.push($rootScope.DrawRect(pozx2, pozy));
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
                    $rootScope.rectangles.push($rootScope.DrawRect(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $rootScope.rectangles.push($rootScope.DrawRect(pozx2, pozy));
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

        $rootScope.DelExtraRectangles=function(desiredNo) {
            $rootScope.rectangles.length=0;
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
                    $rootScope.rectangles.push($rootScope.DrawRectDel(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $rootScope.rectangles.push($rootScope.DrawRectDel(pozx2, pozy));
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
                    $rootScope.rectangles.push($rootScope.DrawRectDel(pozx1,pozy));
                    OptimalLeftOver-=1;
                    if(OptimalLeftOver>0) {
                        $rootScope.rectangles.push($rootScope.DrawRectDel(pozx2, pozy));
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


        $rootScope.DrawMatrix=function(desiredNo)
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

                $rootScope.DrawMatrixPerfectProgression(desiredNo);
                $rootScope.AddExtraRectangles(desiredNo);
            }
            else {
                // desiredNo = document.getElementById("NumQuest").value;

                $rootScope.DrawMatrixEvenProgression(desiredNo);
                $rootScope.AddExtraRectangles(desiredNo);
            }

            document.getElementById('NumQuest').disabled = true;
            //ADDED FOR TESTING PURPOSES
            return $rootScope.rectangles;
        };

        $rootScope.DelMatrix=function(desiredNo) {
            $rootScope.rectangles.length=0;
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

                $rootScope.DrawMatrixPerfectProgressionDel(desiredNo);
                $rootScope.DelExtraRectangles(desiredNo);
            }
            else {
                //desiredNo = document.getElementById("NumQuest").value;

                $rootScope.DrawMatrixEvenProgressionDel(desiredNo);
                $rootScope.DelExtraRectangles(desiredNo);
            }

            document.getElementById('NumQuest').disabled = false;
        };

        $rootScope.Teste=function(desiredNo){
            desiredNo = document.getElementById("NumQuest").value;
            // alert($rootScope.rectangles);
            $rootScope.DelMatrix(desiredNo);
            $rootScope.DrawMatrix(desiredNo);
        };

        $rootScope.SendToServer=function(){
            $http.post("http://localhost:3000/savetodb", {rects: $rootScope.rectangles}).success(function(){
                alert("Sent!");
            });
        }
    }
);

angular.bootstrap(document.getElementById('body'), ["app"]);
