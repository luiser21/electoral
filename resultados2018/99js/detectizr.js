window.Detectizr=function(e,n,i,o){var t,r,a={},s=e.Modernizr,d=["tv","tablet","mobile","desktop"],l={addAllFeaturesAsClass:!1,detectDevice:!0,detectDeviceModel:!0,detectScreen:!0,detectOS:!0,detectBrowser:!0,detectPlugins:!0},m=[{name:"adobereader",substrs:["Adobe","Acrobat"],progIds:["AcroPDF.PDF","PDF.PDFCtrl.5"]},{name:"flash",substrs:["Shockwave Flash"],progIds:["ShockwaveFlash.ShockwaveFlash.1"]},{name:"wmplayer",substrs:["Windows Media"],progIds:["wmplayer.ocx"]},{name:"silverlight",substrs:["Silverlight"],progIds:["AgControl.AgControl"]},{name:"quicktime",substrs:["QuickTime"],progIds:["QuickTime.QuickTime"]}],c=/[\t\r\n]/g,p=i.documentElement;function g(e){return a.browser.userAgent.indexOf(e)>-1}function u(e){return e.test(a.browser.userAgent)}function w(e){return e.exec(a.browser.userAgent)}function v(e){return null===e||e===o?"":String(e).replace(/((\s|\-|\.)+[a-z0-9])/g,function(e){return e.toUpperCase().replace(/(\s|\-|\.)/g,"")})}function b(e,n,i){e&&(e=v(e),n&&(h(e+(n=v(n)),!0),i&&h(e+n+"_"+i,!0)))}function h(e,n){e&&s&&(l.addAllFeaturesAsClass?s.addTest(e,n):(n="function"==typeof n?n():n)?s.addTest(e,!0):(delete s[e],function(e,n){var i=n||"",o=1===e.nodeType&&(e.className?(" "+e.className+" ").replace(c," "):"");if(o){for(;o.indexOf(" "+i+" ")>=0;)o=o.replace(" "+i+" "," ");e.className=n?function(e){return e.replace(/^\s+|\s+$/g,"")}(o):""}}(p,e)))}function f(e,n){e.version=n;var i=n.split(".");i.length>0?(i=i.reverse(),e.major=i.pop(),i.length>0?(e.minor=i.pop(),i.length>0?(i=i.reverse(),e.patch=i.join(".")):e.patch="0"):e.minor="0"):e.major="0"}function x(){e.clearTimeout(t),t=e.setTimeout(function(){r=a.device.orientation,e.innerHeight>e.innerWidth?a.device.orientation="portrait":a.device.orientation="landscape",h(a.device.orientation,!0),r!==a.device.orientation&&h(r,!1)},10)}function y(e){var i,o,t,r,a,s=n.plugins;for(r=s.length-1;r>=0;r--){for(o=(i=s[r]).name+i.description,t=0,a=e.length;a>=0;a--)-1!==o.indexOf(e[a])&&(t+=1);if(t===e.length)return!0}return!1}function k(e){var n;for(n=e.length-1;n>=0;n--)try{new ActiveXObject(e[n])}catch(e){}return!1}function S(o){var t,r,c,p,S,E,R;if((l=function e(n,i){var o,t,r;if(arguments.length>2)for(o=1,t=arguments.length;o<t;o+=1)e(n,arguments[o]);else for(r in i)i.hasOwnProperty(r)&&(n[r]=i[r]);return n}({},l,o||{})).detectDevice){for(a.device={type:"",model:"",orientation:""},c=a.device,u(/googletv|smarttv|smart-tv|internet.tv|netcast|nettv|appletv|boxee|kylo|roku|dlnadoc|roku|pov_tv|hbbtv|ce\-html/)?(c.type=d[0],c.model="smartTv"):u(/xbox|playstation.3|wii/)?(c.type=d[0],c.model="gameConsole"):u(/ip(a|ro)d/)?(c.type=d[1],c.model="ipad"):u(/tablet/)&&!u(/rx-34/)&&!u(/shield/)||u(/folio/)?(c.type=d[1],c.model=String(w(/playbook/)||"")):u(/linux/)&&u(/android/)&&!u(/fennec|mobi|htc.magic|htcX06ht|nexus.one|sc-02b|fone.945/)?(c.type=d[1],c.model="android"):u(/kindle/)||u(/mac.os/)&&u(/silk/)?(c.type=d[1],c.model="kindle"):u(/gt-p10|sc-01c|shw-m180s|sgh-t849|sch-i800|shw-m180l|sph-p100|sgh-i987|zt180|htc(.flyer|\_flyer)|sprint.atp51|viewpad7|pandigital(sprnova|nova)|ideos.s7|dell.streak.7|advent.vega|a101it|a70bht|mid7015|next2|nook/)||u(/mb511/)&&u(/rutem/)?(c.type=d[1],c.model="android"):u(/bb10/)?(c.type=d[2],c.model="blackberry"):(c.model=w(/iphone|ipod|android|blackberry|opera mini|opera mobi|skyfire|maemo|windows phone|palm|iemobile|symbian|symbianos|fennec|j2me/),null!==c.model?(c.type=d[2],c.model=String(c.model)):(c.model="",u(/bolt|fennec|iris|maemo|minimo|mobi|mowser|netfront|novarra|prism|rx-34|skyfire|tear|xv6875|xv6975|google.wireless.transcoder/)?c.type=d[2]:u(/opera/)&&u(/windows.nt.5/)&&u(/htc|xda|mini|vario|samsung\-gt\-i8000|samsung\-sgh\-i9/)?c.type=d[2]:u(/windows.(nt|xp|me|9)/)&&!u(/phone/)||u(/win(9|.9|nt)/)||u(/\(windows 8\)/)?c.type=d[3]:u(/macintosh|powerpc/)&&!u(/silk/)?(c.type=d[3],c.model="mac"):u(/linux/)&&u(/x11/)?c.type=d[3]:u(/solaris|sunos|bsd/)?c.type=d[3]:u(/cros/)?c.type=d[3]:u(/bot|crawler|spider|yahoo|ia_archiver|covario-ids|findlinks|dataparksearch|larbin|mediapartners-google|ng-search|snappy|teoma|jeeves|tineye/)&&!u(/mobile/)?(c.type=d[3],c.model="crawler"):c.type=d[2])),t=0,r=d.length;t<r;t+=1)h(d[t],c.type===d[t]);l.detectDeviceModel&&h(v(c.model),!0)}if(l.detectScreen&&(c.screen={},s&&s.mq&&(s.mq("only screen and (max-width: 240px)")?(c.screen.size="veryVerySmall",h("veryVerySmallScreen",!0)):s.mq("only screen and (max-width: 320px)")?(c.screen.size="verySmall",h("verySmallScreen",!0)):s.mq("only screen and (max-width: 480px)")&&(c.screen.size="small",h("smallScreen",!0)),c.type!==d[1]&&c.type!==d[2]||s.mq("only screen and (-moz-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen  and (min-device-pixel-ratio: 1.3), only screen and (min-resolution: 1.3dppx)")&&(c.screen.resolution="high",h("highresolution",!0))),c.type===d[1]||c.type===d[2]?(e.onresize=function(e){x()},x()):(c.orientation="landscape",h(c.orientation,!0))),l.detectOS&&(a.os={},p=a.os,""!==c.model&&("ipad"===c.model||"iphone"===c.model||"ipod"===c.model?(p.name="ios",f(p,(u(/os\s([\d_]+)/)?RegExp.$1:"").replace(/_/g,"."))):"android"===c.model?(p.name="android",f(p,u(/android\s([\d\.]+)/)?RegExp.$1:"")):"blackberry"===c.model?(p.name="blackberry",f(p,u(/version\/([^\s]+)/)?RegExp.$1:"")):"playbook"===c.model&&(p.name="blackberry",f(p,u(/os ([^\s]+)/)?RegExp.$1.replace(";",""):""))),p.name||(g("win")||g("16bit")?(p.name="windows",g("windows nt 10")?f(p,"10"):g("windows nt 6.3")?f(p,"8.1"):g("windows nt 6.2")||u(/\(windows 8\)/)?f(p,"8"):g("windows nt 6.1")?f(p,"7"):g("windows nt 6.0")?f(p,"vista"):g("windows nt 5.2")||g("windows nt 5.1")||g("windows xp")?f(p,"xp"):g("windows nt 5.0")||g("windows 2000")?f(p,"2k"):g("winnt")||g("windows nt")?f(p,"nt"):g("win98")||g("windows 98")?f(p,"98"):(g("win95")||g("windows 95"))&&f(p,"95")):g("mac")||g("darwin")?(p.name="mac os",g("68k")||g("68000")?f(p,"68k"):g("ppc")||g("powerpc")?f(p,"ppc"):g("os x")&&f(p,(u(/os\sx\s([\d_]+)/)?RegExp.$1:"os x").replace(/_/g,"."))):g("webtv")?p.name="webtv":g("x11")||g("inux")?p.name="linux":g("sunos")?p.name="sun":g("irix")?p.name="irix":g("freebsd")?p.name="freebsd":g("bsd")&&(p.name="bsd")),p.name&&(h(p.name,!0),p.major&&(b(p.name,p.major),p.minor&&b(p.name,p.major,p.minor))),u(/\sx64|\sx86|\swin64|\swow64|\samd64/)?p.addressRegisterSize="64bit":p.addressRegisterSize="32bit",h(p.addressRegisterSize,!0)),l.detectBrowser&&(S=a.browser,u(/opera|webtv/)||!u(/msie\s([\d\w\.]+)/)&&!g("trident")?g("firefox")?(S.engine="gecko",S.name="firefox",f(S,u(/firefox\/([\d\w\.]+)/)?RegExp.$1:"")):g("gecko/")?S.engine="gecko":g("opera")?(S.name="opera",S.engine="presto",f(S,u(/version\/([\d\.]+)/)?RegExp.$1:u(/opera(\s|\/)([\d\.]+)/)?RegExp.$2:"")):g("konqueror")?S.name="konqueror":g("edge")?(S.engine="webkit",S.name="edge",f(S,u(/edge\/([\d\.]+)/)?RegExp.$1:"")):g("chrome")?(S.engine="webkit",S.name="chrome",f(S,u(/chrome\/([\d\.]+)/)?RegExp.$1:"")):g("iron")?(S.engine="webkit",S.name="iron"):g("crios")?(S.name="chrome",S.engine="webkit",f(S,u(/crios\/([\d\.]+)/)?RegExp.$1:"")):g("fxios")?(S.name="firefox",S.engine="webkit",f(S,u(/fxios\/([\d\.]+)/)?RegExp.$1:"")):g("applewebkit/")?(S.name="safari",S.engine="webkit",f(S,u(/version\/([\d\.]+)/)?RegExp.$1:"")):g("mozilla/")&&(S.engine="gecko"):(S.engine="trident",S.name="ie",!e.addEventListener&&i.documentMode&&7===i.documentMode?f(S,"8.compat"):u(/trident.*rv[ :](\d+)\./)?f(S,RegExp.$1):f(S,u(/trident\/4\.0/)?"8":RegExp.$1)),S.name&&(h(S.name,!0),S.major&&(b(S.name,S.major),S.minor&&b(S.name,S.major,S.minor))),h(S.engine,!0),S.language=n.userLanguage||n.language,h(S.language,!0)),l.detectPlugins){for(S.plugins=[],t=m.length-1;t>=0;t--)E=m[t],R=!1,e.ActiveXObject?R=k(E.progIds):n.plugins&&(R=y(E.substrs)),R&&(S.plugins.push(E.name),h(E.name,!0));"function"==typeof n.javaEnabled&&n.javaEnabled()&&(S.plugins.push("java"),h("java",!0))}}return a.detect=function(e){return S(e)},a.init=function(){a!==o&&(a.browser={userAgent:(n.userAgent||n.vendor||e.opera||"").toLowerCase()},a.detect())},a.init(),a}(this,this.navigator,this.document);