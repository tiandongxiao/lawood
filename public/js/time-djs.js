//时间限购  
			var addTimer = function () {   
				var list = [],   
					interval;   
		  
				return function (id, time) {   
					if (!interval)   
						interval = setInterval(go, 1000);   
					list.push({ele: document.getElementById(id), time: time});   
				}   
		  
				function go() {   
					for (var i = 0; i < list.length; i++) {   
						list[i].ele.innerHTML = getTimerString(list[i].time ? list[i].time -= 1 : 0);   
						if (!list[i].time)   
							list.splice(i--, 1);   
					}   
				}   
		  
				function getTimerString(time) {     
						m = Math.floor(((time % 86400) % 3600) / 60),   
						s = Math.floor(((time % 86400) % 3600) % 60);   
						
						if(	m	<10){
							m = '0'+m;
							}
						if(	s	<10){
							s = '0'+s;
							}
						
					if (time>0) {     
						return	'<b>倒计时:</b><b class="m">'+m+'</b>:'+'<b class="m">'+s+'</b>'
						
						
					}else{ return "时间到";   
					}
				}   
			} ();   