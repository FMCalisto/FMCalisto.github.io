/* 
 Text fields
 */

//FIX FOR LOOP THINGY
var totalNumOfQuestions = 2;

$(document).ready('div.form-group-options div.input-group-option:last-child input', function(){
    alert("DOC READY!!!");
        var desiredNo = document.getElementById("NumQuest").value;
        var sInputGroupHtml = $(this).parent().html();
        var sInputGroupClasses = $(this).parent().attr('class');

        for(var i = 0; i < desiredNo; i++)
        {
            $(this).parent().parent().append('<div class="' + sInputGroupClasses + '">' + sInputGroupHtml + '</div>');
        }
});

//Actualizar NumQuest de acordo com a variavel indicada acima!!
$(function(){

    $(document).on('focus', 'div.form-group-options div.input-group-option:last-child input', function(){

        var sInputGroupHtml = $(this).parent().html();
        var sInputGroupClasses = $(this).parent().attr('class');
        $(this).parent().parent().append('<div class="'+sInputGroupClasses+'">'+sInputGroupHtml+'</div>');

        //Testes
        // alert( totalNumOfQuestions);
        var NumQuest=document.getElementById("NumQuest").value;
        //alert(NumQuest);

        var elem = angular.element(document.querySelector('[ng-app]'));
        var injector = elem.injector();
        var $rootScope = injector.get('$rootScope');
        $rootScope.$apply(function() {
            $rootScope.Teste(totalNumOfQuestions);
        });
        //   alert(totalNumOfQuestions);

        document.getElementById("NumQuest").value = totalNumOfQuestions;
        totalNumOfQuestions+=1;
        //fim
    });

    $(document).on('click', 'div.form-group-options .input-group-addon-remove', function(){
        $(this).parent().remove();
        //Testes
        totalNumOfQuestions-=1;
        document.getElementById("NumQuest").value = totalNumOfQuestions;
        var elem2 = angular.element(document.querySelector('[ng-app]'));
        var injector2 = elem2.injector();
        var $rootScope2 = injector2.get('$rootScope');
        $rootScope2.$apply(function() {
            $rootScope2.Teste(totalNumOfQuestions);
        });
        // alert( totalNumOfQuestions);
        //fim
    });
});