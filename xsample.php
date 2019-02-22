<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="result"></div>
        
        <hr />
        <h4>Calculator</h4>
        <form id="calcForm">
            <label>Enter First #</label>
            <input type="number" />
            <label>Enter Second #</label>
            <input type="number" />
            <select>
                <option value=""><--Select Opt--></option>
                <option value="add">Addition</option>
                <option value="multi">Mulitplication</option>
                <option value="div">Division</option>
                <option value="sub">Substraction</option>
            </select>
            <button type="button" onclick="Js_Calculator();">Answers</button>
            <br />
            Answer: <span style="background-color: #000; color: #00ffffff;" id="answer"></span>
        </form>
        
        
    </body>
    <script src="modules/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        $(function (){
           "use strict";
           var result, ans;
           
           $(document).ready(function (){
              
              //Variables
              result = $('#result');
              ans = $('#answer');
             
              //Init
              
              //FUNCTIONS
              UI_Sample();
           });
           
           var UI_Sample = function (){
                var x = 10;
                var ele = [];
                for(var i=1; i < x; i++ ){
                    var div = document.createElement('div');
                    div.id = 'sample'+i;
                    div.style = 'border : solid 1px black; height : 100px; padding : 10px; margin-top : '+ i + 'px;';
                    div.textContent = 'Sample Text Content'+i;
                    ele.push(div); 
                }
                console.log(div);
                //result.html(div);
           };
           
           
           window.Js_Calculator = function (){
               var elem = document.getElementById('calcForm').elements;
               if(elem[2].value == 'add'){
                   ans.html(Number(elem[0].value) + Number(elem[1].value));
               }else if(elem[2].value === 'multi'){
                    ans.html(Number(elem[0].value) * Number(elem[1].value));
               }else if(elem[2].value === 'div'){
                    ans.html(Number(elem[0].value) / Number(elem[1].value));
               }else if(elem[2].value === 'sub'){
                   ans.html(Number(elem[0].value) - Number(elem[1].value));
               }
           };
           
        });
    </script>
</html>
