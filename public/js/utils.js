var Browser=new Object();Browser.isMozilla=(typeof document.implementation!="undefined")&&(typeof document.implementation.createDocument!="undefined")&&(typeof HTMLDocument!="undefined");Browser.isIE=window.ActiveXObject?true:false;Browser.isFirefox=(navigator.userAgent.toLowerCase().indexOf("firefox")!=-1);Browser.isSafari=(navigator.userAgent.toLowerCase().indexOf("safari")!=-1);Browser.isOpera=(navigator.userAgent.toLowerCase().indexOf("opera")!=-1);var Utils=new Object();Utils.htmlEncode=function(A){return A.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/</g,"&lt;").replace(/>/g,"&gt;")};Utils.trim=function(A){if(typeof(A)=="string"){return A.replace(/^\s*|\s*$/g,"")}else{return A}};Utils.isEmpty=function(A){switch(typeof(A)){case"string":return Utils.trim(A).length==0?true:false;break;case"number":return A==0;break;case"object":return A==null;break;case"array":return A.length==0;break;default:return true}};Utils.isNumber=function(B){var A=/^[\d|\.|,]+$/;return A.test(B)};Utils.isInt=function(B){if(B==""){return false}var A=/\D+/;return !A.test(B)};Utils.isEmail=function(A){var B=/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/;return B.test(A)};Utils.isTel=function(A){var B=/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\d{8}$/;return B.test(A)};Utils.fixEvent=function(A){var B=(typeof A=="undefined")?window.event:A;return B};Utils.srcElement=function(A){if(typeof A=="undefined"){A=window.event}var B=document.all?A.srcElement:A.target;return B};Utils.isTime=function(B){var A=/^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}$/;return A.test(B)};Utils.x=function(A){return Browser.isIE?event.x+document.documentElement.scrollLeft-2:A.pageX};Utils.y=function(A){return Browser.isIE?event.y+document.documentElement.scrollTop-2:A.pageY};Utils.request=function(A,C){var B=A.match(new RegExp("[?&]"+C+"=([^&]*)(&?)","i"));return B?B[1]:B};Utils.$=function(A){return document.getElementById(A)};function rowindex(A){if(Browser.isIE){return A.rowIndex}else{table=A.parentNode.parentNode;for(i=0;i<table.rows.length;i++){if(table.rows[i]==A){return i}}}}document.getCookie=function(D){var A=document.cookie.split("; ");for(var B=0;B<A.length;B++){var C=A[B].split("=");if(D==C[0]){return decodeURIComponent(C[1])}}return null};document.setCookie=function(B,A,D){var C=B+"="+encodeURIComponent(A);if(D!=null){C+="; expires="+D}document.cookie=C};document.removeCookie=function(B,A){document.cookie=B+"=; expires=Fri, 31 Dec 1999 23:59:59 GMT;"};function getPosition(A){var C=A.offsetTop;var B=A.offsetLeft;while(A=A.offsetParent){C+=A.offsetTop;B+=A.offsetLeft}var D={top:C,left:B};return D}function cleanWhitespace(C){var C=C;for(var A=0;A<C.childNodes.length;A++){var B=C.childNodes[A];if(B.nodeType==3&&!/\S/.test(B.nodeValue)){C.removeChild(B)}}};