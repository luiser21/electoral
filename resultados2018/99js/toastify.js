/*!
 * Toastify js 1.1.0
 * https://github.com/apvarun/toastify-js
 * @license MIT licensed
 *
 * Copyright (C) 2018 Varun A P
 */
!function(t,i){"object"==typeof module&&module.exports?(require("./toastify.css"),module.exports=i()):t.Toastify=i()}(this,function(t){var i=function(t){return new i.lib.init(t)};function o(t,i){return!(!t||"string"!=typeof i)&&!!(t.className&&t.className.trim().split(/\s+/gi).indexOf(i)>-1)}return i.lib=i.prototype={toastify:"1.1.0",constructor:i,init:function(t){return t||(t={}),this.options={},this.options.text=t.text||"Hi there!",this.options.duration=t.duration||3e3,this.options.selector=t.selector,this.options.callback=t.callback||function(){},this.options.destination=t.destination,this.options.newWindow=t.newWindow||!1,this.options.close=t.close||!1,this.options.gravity="bottom"==t.gravity?"bottom":"top",this.options.positionLeft=t.positionLeft||!1,this.options.avatar=t.avatar||"",this},buildToast:function(){if(!this.options)throw"Toastify is not initialized";var t=document.createElement("div");if(t.className="toastify on",t.id="notif",!0===this.options.positionLeft?t.className+=" left":t.className+=" right",t.className+=" "+this.options.gravity,t.style.background=this.options.backgroundColor,t.innerHTML=this.options.text,""!==this.options.avatar){var i=document.createElement("img");i.src=this.options.avatar,i.className="avatar",!0===this.options.positionLeft?t.appendChild(i):t.insertAdjacentElement("beforeend",i)}if(!0===this.options.close){var o=document.createElement("span");o.innerHTML="&#10006;",o.className="toast-close",o.addEventListener("click",function(t){this.removeElement(t.target.parentElement),window.clearTimeout(t.target.parentElement.timeOutValue)}.bind(this));var e=window.innerWidth>0?window.innerWidth:screen.width;!0===this.options.positionLeft&&e>360?t.insertAdjacentElement("afterbegin",o):t.appendChild(o)}if(void 0!==this.options.destination){var n=document.createElement("a");return n.setAttribute("href",this.options.destination),!0===this.options.newWindow&&n.setAttribute("target","_blank"),t.className="",n.className="toastify on",!0===this.options.positionLeft?n.className+=" left":n.className+=" right",n.className+=" "+this.options.gravity,t.style.background="",n.style.background=this.options.backgroundColor,n.appendChild(t),n}return t},showToast:function(){var t,o=this.buildToast();if(!(t=void 0===this.options.selector?document.body:document.getElementById(this.options.selector)))throw"Root element is not defined";return t.insertBefore(o,t.firstChild),i.reposition(),o.timeOutValue=window.setTimeout(function(){this.removeElement(o)}.bind(this),this.options.duration),this},removeElement:function(t){t.className=t.className.replace(" on",""),window.setTimeout(function(){t.parentNode.removeChild(t),this.options.callback.call(t),i.reposition()}.bind(this),400)}},i.reposition=function(){for(var t,i={top:15,bottom:15},e={top:15,bottom:15},n={top:15,bottom:15},s=document.getElementsByClassName("toastify"),a=0;a<s.length;a++){t=!0===o(s[a],"top")?"top":"bottom";var r=s[a].offsetHeight;(window.innerWidth>0?window.innerWidth:screen.width)<=360?(s[a].style[t]=n[t]+"px",n[t]+=r+15):!0===o(s[a],"left")?(s[a].style[t]=i[t]+"px",i[t]+=r+15):(s[a].style[t]=e[t]+"px",e[t]+=r+15)}return this},i.lib.init.prototype=i.lib,i});