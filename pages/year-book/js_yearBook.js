/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function (){
    "use strict";
    var url = "pages/year-book/yearbook.class.php";
    
    
    $(document).ready(function (){
        
        GetYearList();
    });
    
    
    
    
    //GET STUDENT PER YEAR
    window.GetYearlyStudents = function (yr){
        var data = {
           gyealystudents  : 'getyearlystudents',
           year : yr
        };
        app.ajaxRequest(url,'json',data,function (e){
            //console.log(e);
            setTimeout(function(){
                $('body').removeClass('smsload');
                 app.yearBookTable(e);
            },timeOut);
        },true);
    };
    
    
    //GET YEAR LIST
    var GetYearList = function (){
        var data = {
            gyrlist : 'getyearlist'
        };
        app.ajaxRequest(url,'',data,function (e){
           //console.log(e); 
           $('#b_year').html(e);
        });
    };
    
    
});

