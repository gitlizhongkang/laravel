function Form(A){this.init=function(B){for(var C in B){this.setValue(C,B[C])}};this.getItems=function(){var C=new Object();var D=(A==undefined)?document.forms[0].elements:document.forms[A].elements;var E=D.length;for(var B=0;B<E;B++){if(C[D[B].name]==undefined){C[D[B].name]=this.getValue(D[B].name)}}return C};this.formatRequest=function(){var B=this.getItems();var C="";for(i in B){if(i!=""){C+="&"+i+"="+B[i]}}return C.substr(1)};this.setValue=function(E,G){var D=(A==undefined)?document.forms[0].elements[E]:document.forms[A].elements[E];if(D==undefined){if(E.indexOf("[")==-1){this.setValue(E+"[]",G)}return}switch(D.type){case"text":case"hidden":case"textarea":if(G){G=G.replace(/&gt;/g,">").replace(/&amp;/g,"&").replace(/&lt;/g,"<")}D.value=G;break;case"radio":case"checkbox":var F=D.length;if(F>1){var B=(";"+G+";");for(var C=0;C<F;C++){if(D[C]!=undefined){if(G==D[C].value||B.indexOf(";"+D[C].value+";")!=-1){D[C].checked=true}else{D[C].checked=false}}}}else{if(D.value==G){D.checked=true}else{D.checked=false}}break;case"select-one":this.setSelected(D,G);break;case"select-multiple":var F=D.length;if(F>0){var B=(";"+G+";");for(var H=0;H<F;H++){if(D[H]!=undefined){if(G==D[H].value||B.indexOf(";"+D[H].value+";")!=-1||G.indexOf(";"+D[H].innerHTML+";")!=-1){D[H].selected=true}}}}break;default:var F=D.length;if(F>0){var B=(";"+G+";");for(var H=0;H<F;H++){if(D[H]!=undefined){if(G==D[H].value||B.indexOf(";"+D[H].value+";")!=-1){D[H].checked=true}}}}break}};this.getValue=function(D){var C=(A==undefined)?document.forms[0].elements[D]:document.forms[A].elements[D];if(C==undefined){if(D.indexOf("[")==-1){return this.getValue(D+"[]")}return null}switch(C.type){case"text":case"hidden":case"textarea":return C.value;break;case"radio":case"checkbox":if(C.checked){return C.value}break;case undefined:var E=C.length;var B="";if(E>0){for(var F=0;F<E;F++){if(C[F]!=undefined){if(C[F].checked){if(C[F].value!=""){B+=C[F].value+";"}else{B+=C[F].innerText+";"}}}}}if(B.length>0){B=B.substring(0,(B.length-1))}if(B!=""){return B}else{return null}break;case"select-one":return C.value;break;case"select-multiple":var E=C.length;if(E>0){var B="";for(var F=0;F<E;F++){if(C[F]!=undefined){if(C[F].checked){if(C[F].value!=""){tem+=C[F].value+";"}else{tem+=C[F].innerText+";"}}}}}if(B.length>0){B=B.substring(0,(B.length-1))}if(B!=""){return B}else{return null}break}};this.setSelected=function(C,D){objSelect=C;for(var B=0;B<objSelect.options.length;B++){if(objSelect.options[B].value==D||objSelect.options[B].text==D){objSelect.options[B].selected=true;break}}}};