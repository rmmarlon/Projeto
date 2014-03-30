<!doctype html>
<html>
<head>
        <meta charset="utf-8">
        <title>
        	Asyncronous javascript and XML
        </title>
        <script>
			//All modern browsers support the XMLHttpRequest object (IE5 and IE6 use an ActiveXObject).
			function loadXMLDoc(){
				var xmlhttp;
				if(window.XMLHttpRequest){
					//code for IE8, firefox, chrome, safari, opera
					xmlhttp = new XMLHttpRequest();
				} else{
					//code for IE5 e 6
					xmlhttp = new ActiveXObject("Micrisoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","ajax_info.txt",true);
				xmlhttp.send();
			}
			//syntax for create a object XMLHttpRequest
			//variable=new XMLHttpRequest();
			//Old versions of Internet Explorer (IE5 and IE6) uses an ActiveX Object:
			//variable=new ActiveXObject("Microsoft.XMLHTTP");
			//To send a request to a server, we use the open() and send() methods of the XMLHttpRequest object:
			//xmlhttp.open("GET","ajax_info.txt",true);
			//xmlhttp.send();
			/*
				open(method,url,async):
				Specifies the type of request, the URL, and if the request should be handled asynchronously or not.

				method: the type of request: GET or POST
				url: the location of the file on the server
				async: true (asynchronous) or false (synchronous)
				
				send(string)
				Sends the request off to the server.

				string: Only used for POST requests
				
				onreadystatechange	
				Stores a function (or the name of a function) to be called automatically each time the readyState property changes
				
				readyState	Holds the status of the XMLHttpRequest. Changes from 0 to 4: 
					0: request not initialized 
					1: server connection established
					2: request received 
					3: processing request 
					4: request finished and response is ready
				
				status	200: "OK"
					404: Page not found
			*/
		</script>
    </head>    
    <body>
    	<div id="myDiv">
        	<h2>
            	Let ajax change this text
            </h2>
        </div>
        <input type="button" onClick="loadXMLDoc();" value="Change Content">
    </body>
</html>