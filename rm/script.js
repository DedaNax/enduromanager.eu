
function cpACC(box){
	if (document.getElementById(box).value == "V"){
		document.getElementById(box).value = "X";
		document.getElementById(box).style.color = "red";
	} else {
		document.getElementById(box).value = "V";
		document.getElementById(box).style.color = "green";		
	}
}

function swBox(box) {
	
	if (document.getElementById(box).value == "OK"){
		document.getElementById(box).value = "X";
		document.getElementById(box).style.color = "red";
	} else {
		if (document.getElementById(box).value == "???") {
			document.getElementById(box).value = "OK";
			document.getElementById(box).style.color = "green";
		} else {
			if (document.getElementById(box).value == "X") {
				document.getElementById(box).value = "???";
				document.getElementById(box).style.color = "orange";
			}
		}
	}
}

function confDel(form,msg){
	if (window.confirm(msg)){
		document.getElementById(form).submit();					
	}
}

function confDelGet(msg,url){
	if (window.confirm(msg)){
		window.location = url;
	}
}

function SubmitHidden(form,hidden){
	frm = document.getElementById(form);
	if(frm){
		frm.elements['rm_subf'].value = hidden;
		frm.submit();
	}
}

function submitForm(id){

	frm = document.getElementById(id);
	if(frm){
		frm.submit();
	}
}

function changeLink(ida,idsel){
	a = document.getElementById(ida);
	sel = document.getElementById(idsel);
	if(a && sel){
		a.href =  sel.options[sel.selectedIndex].value ;
	}
}

function modifyEnduroRegLinks(id){
	var patt=/&c=[0-9]*#clas[0-9]*/i;
	sel = document.getElementById("class"+id);
	cid = sel.options[sel.selectedIndex].value;
	
	elt = document.getElementById("apl".concat(id));
	var result=patt.exec(elt.href);	
	elt.href = elt.href.replace(result,"&c=".concat(cid).concat("#clas").concat(cid));
	
	elt = document.getElementById("add".concat(id));
	var result=patt.exec(elt.href);	
	elt.href = elt.href.replace(result,"&c=".concat(cid).concat("#clas").concat(cid));
}

function modifyPEnduroRegLinks(id){
	var patt=/&class=[0-9]*#c[0-9]*/i;
	
	sel = document.getElementById("class"+id);
	cid = sel.options[sel.selectedIndex].value;
	
	elt = document.getElementById("acc".concat(id));
	var result=patt.exec(elt.href);	
	elt.href = elt.href.replace(result,"&class=".concat(cid).concat("#c").concat(cid));
	
	elt = document.getElementById("add".concat(id));
	var result=patt.exec(elt.href);	
	elt.href = elt.href.replace(result,"&class=".concat(cid).concat("#c").concat(cid));
	
}

function setLink(from, to){
	efrom = document.getElementById(from);
	eto = document.getElementById(to);
	
	eto.href =  efrom.options[efrom.selectedIndex].value;
}

function focusOnLoad(id){
	elt = document.getElementById(id);
	elt.focus();
}

function goToSelectURL(id){
	sel = document.getElementById(id);
	window.location = sel.options[sel.selectedIndex].value;
}

function changeOffset(dir){	 
	x = document.getElementsByName("offset");
	if (Number(x[0].value) == 1 && dir!="up" ){
		return;
	}
	oldofs = x[0].value;
	x[0].value = (dir=='up' ? Number(x[0].value) + 1 : (x[0].value - 1 < 1 ? 1 : x[0].value - 1));
	ofs = Number(x[0].value);
	y = document.getElementsByName("erd");
	
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","?no_gui=1&script_gui=1&rm_func=enduro&rm_subf=erd_offset_change&erd=".concat(y[0].value,"&val=",x[0].value),false);
	xmlhttp.send();
	
	if (xmlhttp.responseText != "1") {		
		alert("KĻŪDA!".concat("\n",xmlhttp.responseText));
		return;
	}
	
	x = document.getElementsByName("fullname");
	names = x[0].value.split(";");
	names = names.sort();
	first = 1;
	var start;
	cntr =0;
	for(i=0;i<names.length;i++){		
		if(names[i]){
			y = document.getElementsByName(names[i]);
			val = y[0].value.split(":");
			name1 = names[i].split('x');
					
			if (!first){		
				min = cntr*ofs + Number(start[1]);
				hr = (min - (min%60))/60 + Number(start[0]);
				hr = hr >= 24 ? 0 : hr;
				min = min%60;
				y[0].value = "".concat(hr>9?hr:"0".concat(hr),":",min>9 ? min : "0".concat(min));
			} else {			
				start = val;
			}
			cntr++;
			first = 0;			
		}
	}
}

function editoffset(elt){
	x = document.getElementsByName("fullname");
	names = x[0].value.split(";");
	names = names.sort();
	x1 = document.getElementsByName("offset");
	ofs = x1[0].value;
	
	y = document.getElementsByName(elt);
	
	val = y[0].value.split(':');	
	val[0] = Number(val[0]);
	val[1] = Number(val[1]);
	
	go = 0;
	name1 = elt.split('x');
	xmlhttp=new XMLHttpRequest();	
	xmlhttp.open("GET","?no_gui=1&script_gui=1&rm_func=enduro&rm_subf=rcer_offset_change&c=".concat(name1[3],"&p=",name1[2],"&d=",name1[4],"&val=",y[0].value),false);
	xmlhttp.send();
	
	if (xmlhttp.responseText != "1") {
		//alert("KĻŪDA!".concat("\n",xmlhttp.responseText));
		return;
	}
				
	for(i=0;i<names.length;i++){		
		if(names[i]){
			y = document.getElementsByName(names[i]);
			name1 = names[i].split('x');
			if (go){
				val[1] += Number(ofs);
				val[0] += val[1] >= 60 ? 1 : 0;
				val[0] = val[0] >= 24 ? 0: val[0];
				val[1] = val[1]%60 >= 0 ? val[1]%60 : val[1];
				
				y[0].value = "".concat(val[0] > 9 ? val[0] : "0".concat(val[0]),":",val[1] > 9 ? val[1] : "0".concat(val[1]));
			}
			if (names[i] == elt){
				go =1;
			}
		}
	}
}

	var elt1;
	var elt2;

function glow(n){
	
	if(!elt1 && !elt2){
		elt1 = n;
		x = document.getElementById(n);				
		x.style.backgroundColor = "#99FF99";
	} else if (elt1 == n) {
		elt1 = elt2;
		elt2 = null;
		x = document.getElementById(n);		
		x.style.backgroundColor = "#FFFFFF";
	} else if (elt2 == n) {
		elt2 = null;
		x = document.getElementById(n);		
		x.style.backgroundColor = "#FFFFFF";
	} else if (elt1 && !elt2){
		tmp = n.split('x');
		e1 = elt1.split('x'); 
		if(e1[2] == tmp[2] && elt1 != n){
			elt2 = n;
			x = document.getElementById(n);		
			x.style.backgroundColor = "#99FF99";			
		} else {
			x = document.getElementById(elt1);		
			x.style.backgroundColor = "#FFFFFF";			
			elt1 = n;
			x = document.getElementById(n);		
			x.style.backgroundColor = "#99FF99";			
		}
	} else if (elt1 && elt2){
		tmp = n.split('x');
		e1 = elt1.split('x'); 
		if(e1[2] != tmp[2]){
			x = document.getElementById(elt1);		
			x.style.backgroundColor = "#FFFFFF";	
			x = document.getElementById(elt2);		
			x.style.backgroundColor = "#FFFFFF";			
			elt1 = n;
			elt2 = null;
			x = document.getElementById(n);		
			x.style.backgroundColor = "#99FF99";
		}		
	}
	
}

function changeGlowing(){
	x = document.getElementById(elt1);
	y = document.getElementById(elt2);
	
	z = x.innerHTML;
	x.innerHTML = y.innerHTML;
	y.innerHTML = z;
	
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","?no_gui=1&script_gui=1&rm_func=enduro&rm_subf=erd_racer_change&e1=".concat(elt1,"&e2=",elt2),false);	
	xmlhttp.send();
	
	if (xmlhttp.responseText != "1") {
		//alert("KĻŪDA!");
		return;
	}
	
	x.style.backgroundColor = "#FFFFFF";
	y.style.backgroundColor = "#FFFFFF";
	
	elt1 = "";
	elt2 = "";
	
}

function putSeparator(n){
	x = document.getElementsByName(n);
	z = n.split("x");
	
	xmlhttp=new XMLHttpRequest();	
	xmlhttp.open("GET","?no_gui=1&script_gui=1&rm_func=enduro&rm_subf=put_separator&id=".concat(z[1],"&val=",x[0].checked ? 1 : 0),false);		
	xmlhttp.send();
	
	if (xmlhttp.responseText != "1") {
		//alert("KĻŪDA!");
		return;
	}
}

function changeTeamName(id,name,a){
	name = prompt("Ievadiet komandas nosaukumu:",name);
	if  (!name){
		return;
	}	
	if (name.replace(/ /g,"").length == 0){		
		alert("Nosaukums nevar būt tukšs!");
		return;
	}
	xmlhttp=new XMLHttpRequest();	
	req = "?no_gui=1&script_gui=1&rm_func=racer&rm_subf=renTeam&id=".concat(id,"&name=",name);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	if (xmlhttp.responseText == "1"){
		window.location="?rm_func=racer&rm_subf=raceapplist&tm=".concat(id,a?"&act=1":"","#tm",id);
	} else {
		alert (xmlhttp.responseText);
	};
}

function addteam(){
	var name = prompt("Ievadiet komandas nosaukumu:","");
	if  (!name){
		return;
	}	
	if (name.replace(/ /g,"").length == 0){		
		alert("Nosaukums nevar būt tukšs!");
		return;
	}
	xmlhttp=new XMLHttpRequest();	
	req = "?no_gui=1&script_gui=1&rm_func=racer&rm_subf=renTeam&id=".concat(-1,"&name=",name);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	
	if (xmlhttp.responseText.match(/OK[0-9]*/g)){		
		window.location="?rm_func=racer&rm_subf=raceapplist&tm=".concat(xmlhttp.responseText.replace(/OK/g,""),"#tm",xmlhttp.responseText.replace(/OK/g,""));
	} else {
		alert (xmlhttp.responseText);
	};
}

function addETeamMember(ea,et,r){	
	xmlhttp=new XMLHttpRequest();
	req = "?rm_func=enduro&rm_subf=saveEteamMember&no_gui=1&script_gui=1&opt=".concat(r,"&et=",et,"&ea=",ea);
	xmlhttp.open("GET",req,false);
	xmlhttp.send();
		
	if (xmlhttp.responseText.match(/OK/g)){
		window.location = "?rm_func=enduro&rm_subf=teams&opt=".concat(r);
	} else {
		alert(xmlhttp.responseText);
	}
}

function addETeam(r,id){	
	x = document.getElementById(id);
	xmlhttp=new XMLHttpRequest();
	req = "?rm_func=enduro&rm_subf=saveEteam&no_gui=1&script_gui=1&opt=".concat(r,"&club=", x.options[x.selectedIndex].value);
	xmlhttp.open("GET",req,false);
	xmlhttp.send();
		
	if (xmlhttp.responseText.match(/OK/g)){
		window.location = "?rm_func=enduro&rm_subf=teams&opt=".concat(r);
	} else {
		alert(xmlhttp.responseText);
	}
}

function showAddTMate(tid,a,pos,obj,hs){
	xmlhttp=new XMLHttpRequest();	
	req = "?rm_func=racer&rm_subf=prntaddracer&no_gui=1&script_gui=1&opt=".concat(tid,a ? "&act=1": "");	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	
	x = document.getElementById("div".concat(tid,"x",pos));
	x.innerHTML = xmlhttp.responseText;
	hs.htmlExpand(obj, { headingText: 'Sportista izvēle' });
}

function showRacerList(obj,hs){
	xmlhttp=new XMLHttpRequest();	
	req = "?rm_func=racer&rm_subf=prntracerList&no_gui=1&script_gui=1";	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	
	x = document.getElementById("divx");
	x.innerHTML = xmlhttp.responseText;
	hs.htmlExpand(obj, { headingText: 'Sportista izvēle' });
}

function addLicData(rid,name,hs){
	x = document.getElementById("NAME");
	x.value = name;
	
	x = document.getElementById("RACER_ID");
	x.value = rid;
	
	hs.close();
}

function editLIC(ID,LIC_NR,TYPE,RACER_ID,RNAME,CLUB,COUNTRY,START_DATE,END_DATE,NR){
	x = document.getElementById("NAME");
	x.value = RNAME;
	
	x = document.getElementById("RACER_ID");
	x.value = RACER_ID;
	
	//x = document.getElementById("LIC_TO");
	//x.value = END_DATE;
	
	x = document.getElementById("LIC_FROM");
	x.value = START_DATE;
	
	x = document.getElementById("LIC_NR");
	x.value = LIC_NR;
	
	x = document.getElementById("LIC_TYPE");
	x.value = TYPE;
	
	x = document.getElementById("LIC_CLUB");
	x.value = CLUB;
	
	x = document.getElementById("LIC_COUNTRY");
	x.value = COUNTRY;
	
	x = document.getElementById("ID");
	x.value = ID;
	
	xmlhttp=new XMLHttpRequest();	
	req = "?rm_func=lic&rm_subf=getNR&no_gui=1&script_gui=1&opt=".concat(NR);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	
	x = document.getElementById("SNR");
	x.innerHTML = xmlhttp.responseText;
	x.value = NR;
	
	
}

function editNR(ID,NR,RACER_ID,RNAME,CLUB,YR,COMMENT,COUNTRY){
	x = document.getElementById("RACER_ID");
	x.value = RACER_ID;

	x = document.getElementById("NAME");
	x.value = RNAME;
	
	x = document.getElementById("NR_YR");
	x.value = YR;
	
	x = document.getElementById("NR_COMMENT");
	x.value = COMMENT;
	
	x = document.getElementById("NR_NR");
	x.value = NR;
	
	//x = document.getElementById("NR_COUNTRY");
	//x.value = COUNTRY;
	
	//x = document.getElementById("NR_CLUB");
	//x.value = CLUB;
	
	x = document.getElementById("ID");
	x.value = ID;
}

function editClub(ID,name,c){
	x = document.getElementById("NAME");
	x.value = name;
	
	x = document.getElementById("cont");
	x.value = c;
	
	x = document.getElementById("ID");
	x.value = ID;
}

function showAddET(div,opt,obj){
	xmlhttp=new XMLHttpRequest();	
	req = "?rm_func=enduro&rm_subf=getClub&no_gui=1&script_gui=1&opt=".concat(opt);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	
	x = document.getElementById(div);
	x.innerHTML = xmlhttp.responseText;
	hs.htmlExpand(obj, { headingText: 'Kluba izvēle' });
}

function showAddETMemeber(div,et,opt,obj){
	xmlhttp=new XMLHttpRequest();	
	req = "?rm_func=enduro&rm_subf=getClubRacers&no_gui=1&script_gui=1&opt=".concat(opt,"&et=",et);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	
	x = document.getElementById(div.concat(et));
	x.innerHTML = xmlhttp.responseText;
	hs.htmlExpand(obj, { headingText: 'Sportistu izvēle' });
}

function sendToGal(me,id){
	state = me.src.match(/thumb_up_green/g);
	
	document.body.style.cursor = "wait";
	xmlhttp=new XMLHttpRequest();	
	req = "?rm_func=teamrace&rm_subf=sendtogal&no_gui=1&script_gui=1&opt=".concat(id,"&state=",state ? 1 : 0);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	document.body.style.cursor = "default";
	
	if (xmlhttp.responseText.match(/OK/g)){
		me.src = state ? me.src.replace(/thumb_up_green/g,"thumb_dn_red") : me.src= me.src.replace(/thumb_dn_red/g,"thumb_up_green");	
		me.title = state ? "Nav ielikts galerijā" : "Ir ielikts galerijā";
	} else 	if (xmlhttp.responseText.match(/NAK/g)){
		alert("Bilde nav ievadīta");
	} else {
		alert(xmlhttp.responseText);
	}
	
}

function resultGlow(me){
	if (me.value == "00:00:00.00"){
		me.style.backgroundColor = "#ff99ff";
	} else {
		me.style.backgroundColor = "#99ff99";
	}
}

function foc(me){
	me.select();
}

function kpressed(me){
	txt = me.value.replace(/(\D)/g,"");
	
	if(txt){
		me.value = 
		(txt.substring(0,2) ? txt.substring(0,2) : '') +
		(txt.substring(2,4) ? ':' + txt.substring(2,4) : '') +
		(txt.substring(4,6) ? ':' + txt.substring(4,6) : '') +
		(txt.substring(6,8) ? '.' + txt.substring(6,8) : '')
	} else {
		me.value = "00:00:00.00";
		me.select();
	}
}

function changeTeamState(me,mode,id){
	val = me.src.match(/Red/g) ? 1 : 0;
	
	document.body.style.cursor = "wait";
	xmlhttp=new XMLHttpRequest();	
	//document.write("?rm_func=enduro&rm_subf=changeTeam&no_gui=1&script_gui=1&id=".concat(id,"&val=",val,"&mode=",mode));
	req = "?rm_func=enduro&rm_subf=changeTeam&no_gui=1&script_gui=1&id=".concat(id,"&val=",val,"&modex=",mode);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	document.body.style.cursor = "default";
	
	if (xmlhttp.responseText.match(/OK/g)){
		if (val){
			me.src = me.src.replace(/Red/g,"Green");
			me.title = "Iekļauts";
			me.alt = "V";
		} else {
			me.src = me.src.replace(/Green/g,"Red");
			me.title = "Nav iekļauts";
			me.alt = "X";
		}
	} else 	if (xmlhttp.responseText.match(/NAK/g)){
		alert(val ? "Sportists nav pievienots komandai" : "Sportists nav atvienots no komandas");
	} else {
		alert(xmlhttp.responseText);
	}
}

function testIgnore(me,d,t,c,l){
	val = me.src.match(/Red/g) ? 1 : 0;
	document.body.style.cursor = "wait";
	xmlhttp=new XMLHttpRequest();
	//document.write("?rm_func=enduro&rm_subf=testIgnore&no_gui=1&script_gui=1&d=".concat(d,"&t=",t,"&c=",c,"&v=",val,"&l=",l));
	req = "?rm_func=enduro&rm_subf=testIgnore&no_gui=1&script_gui=1&d=".concat(d,"&t=",t,"&c=",c,"&v=",val,"&l=",l);
	xmlhttp.open("GET",req,false);
	xmlhttp.send();
	document.body.style.cursor = "default";
	
	if (xmlhttp.responseText.match(/OK/g)){
		if (val){
			me.src = me.src.replace(/Red/g,"Green");
			me.title = "Ieskaitē";
			me.alt = "O";
		} else {
			me.src = me.src.replace(/Green/g,"Red");
			me.title = "Nav ieskaitē";
			me.alt = "X";
		}
	} else if (xmlhttp.responseText.match(/NAK/g)){
		alert(val ? "Tests nav ieslēgts ieskaitē" : "Tests nav izņemts no ieskaites");
	} else {
		alert(xmlhttp.responseText);
	}
}

function setCountry(){
	x = document.getElementById("LIC_CLUB");
	c = x.value;
	
	x = document.getElementById("LIC_COUNTRY");
	x.value = clubs[c];
	
}

function fillTeh(v,nr){
	
	
	var teh = v.split("^");
	
	x = document.getElementById("teh_Marka"+nr);
	x.value = teh[0]?teh[0]:null;
	
	x = document.getElementById("teh_Model"+nr);
	x.value = teh[1]?teh[1]:null;
	
	x = document.getElementById("teh_V"+nr);
	x.value = teh[2]?teh[2]:null;
	
	x = document.getElementById("teh_T"+nr);
	x.value = teh[3]?teh[3]:null;
	
}

function openTeamApply(div,opt,obj,hs){	
	xmlhttp=new XMLHttpRequest();	
	req = "?rm_func=racer&rm_subf=raceAppl1&no_gui=1&script_gui=1&opt=".concat(opt);	
	xmlhttp.open("GET",req,false);			
	xmlhttp.send();
	
	x = document.getElementById(div);
	x.innerHTML = xmlhttp.responseText;
	hs.htmlExpand(obj, { headingText: 'Pievienot komandu' });
}