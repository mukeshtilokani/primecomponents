(function(b){var na=0,W=0,da=0,T=0,za="ontouchstart"in window,Ba="onorientationchange"in window,ea=!1,aa=!1,X=!1,oa=!1,ha=!1,ia="pointer",sa="pointer",ja=[],J=[],ta=[],$=[],z=[],ba=[],B=[],m=[],s=[],ua=[],fa=[],e={showScrollbar:function(a,e){a.scrollbarHide&&b("."+e).css({opacity:a.scrollbarOpacity,filter:"alpha(opacity:"+100*a.scrollbarOpacity+")"})},hideScrollbar:function(b,g,c,f,h,d,m,s,B,z){if(b.scrollbar&&b.scrollbarHide)for(var t=c;t<c+25;t++)g[g.length]=e.hideScrollbarIntervalTimer(10*t,f[c], (c+24-t)/24,h,d,m,s,B,z,b)},hideScrollbarInterval:function(a,g,c,f,h,d,m,B,z){T=-1*a/s[B]*(h-d-m-f);e.setSliderOffset("."+c,T);b("."+c).css({opacity:z.scrollbarOpacity*g,filter:"alpha(opacity:"+100*z.scrollbarOpacity*g+")"})},slowScrollHorizontalInterval:function(a,g,c,f,h,d,N,O,L,K,t,w,x,y,v,q,G,p,n){if(n.infiniteSlider){if(c<=-1*s[q]){var r=b(a).width();if(c<=-1*ua[q]){var u=-1*t[0];b(g).each(function(c){e.setSliderOffset(b(g)[c],u+G);c<w.length&&(w[c]=-1*u);u+=v[c]});c+=-1*w[0];m[q]=-1*w[0]+G; s[q]=m[q]+r-d;B[q]=0}else{var k=0,D=e.getSliderOffset(b(g[0]),"x");b(g).each(function(b){e.getSliderOffset(this,"x")<D&&(D=e.getSliderOffset(this,"x"),k=b)});x=m[q]+r;e.setSliderOffset(b(g)[k],x);m[q]=-1*w[1]+G;s[q]=m[q]+r-d;w.splice(0,1);w.splice(w.length,0,-1*x+G);B[q]++}}if(c>=-1*m[q]||0<=c){r=b(a).width();if(0<=c)for(u=-1*t[0],b(g).each(function(c){e.setSliderOffset(b(g)[c],u+G);c<w.length&&(w[c]=-1*u);u+=v[c]}),c-=-1*w[0],m[q]=-1*w[0]+G,s[q]=m[q]+r-d,B[q]=y;0<-1*w[0]-r+G;){var A=0,I=e.getSliderOffset(b(g[0]), "x");b(g).each(function(c){e.getSliderOffset(this,"x")>I&&(I=e.getSliderOffset(this,"x"),A=c)});x=m[q]-v[A];e.setSliderOffset(b(g)[A],x);w.splice(0,0,-1*x+G);w.splice(w.length-1,1);m[q]=-1*w[0]+G;s[q]=m[q]+r-d;B[q]--;z[q]++}0>c&&(A=0,I=e.getSliderOffset(b(g[0]),"x"),b(g).each(function(c){e.getSliderOffset(this,"x")>I&&(I=e.getSliderOffset(this,"x"),A=c)}),x=m[q]-v[A],e.setSliderOffset(b(g)[A],x),w.splice(0,0,-1*x+G),w.splice(w.length-1,1),m[q]=-1*w[0]+G,s[q]=m[q]+r-d,B[q]--)}}t=!1;d=e.calcActiveOffset(n, c,w,d,B[q],y,K,q);x=(d+B[q]+y)%y;n.infiniteSlider?x!=ba[q]&&(t=!0):d!=z[q]&&(t=!0);if(t&&(y=new e.args("change",n,a,b(a).children(":eq("+x+")"),x,p),b(a).parent().data("args",y),""!=n.onSlideChange))n.onSlideChange(y);z[q]=d;ba[q]=x;c=Math.floor(c);e.setSliderOffset(a,c);n.scrollbar&&(T=Math.floor((-1*c-m[q]+G)/(s[q]-m[q]+G)*(N-O-h)),a=h-L,c>=-1*m[q]+G?(a=h-L- -1*T,e.setSliderOffset(b("."+f),0)):(c<=-1*s[q]+1&&(a=N-O-L-T),e.setSliderOffset(b("."+f),T)),b("."+f).css({width:a+"px"}))},slowScrollHorizontal:function(a, g,c,f,h,d,N,O,L,K,t,w,x,y,v,q,G,p,n,r,u){var k=e.getSliderOffset(a,"x");d=[];var D=0,A=25/1024*O;frictionCoefficient=u.frictionCoefficient;elasticFrictionCoefficient=u.elasticFrictionCoefficient;snapFrictionCoefficient=u.snapFrictionCoefficient;h>u.snapVelocityThreshold&&u.snapToChildren&&!n?D=1:h<-1*u.snapVelocityThreshold&&u.snapToChildren&&!n&&(D=-1);h<-1*A?h=-1*A:h>A&&(h=A);b(a)[0]!==b(p)[0]&&(D*=-1,h*=-2);p=B[v];if(u.infiniteSlider)var I=m[v],l=s[v];n=[];for(var A=[],E=0;E<x.length;E++)n[E]= x[E],E<g.length&&(A[E]=e.getSliderOffset(b(g[E]),"x"));for(;1<h||-1>h;){h*=frictionCoefficient;k+=h;(k>-1*m[v]||k<-1*s[v])&&!u.infiniteSlider&&(h*=elasticFrictionCoefficient,k+=h);if(u.infiniteSlider){if(k<=-1*l){for(var l=b(a).width(),J=0,P=A[0],E=0;E<A.length;E++)A[E]<P&&(P=A[E],J=E);E=I+l;A[J]=E;I=-1*n[1]+r;l=I+l-O;n.splice(0,1);n.splice(n.length,0,-1*E+r);p++}if(k>=-1*I){l=b(a).width();J=0;P=A[0];for(E=0;E<A.length;E++)A[E]>P&&(P=A[E],J=E);E=I-y[J];A[J]=E;n.splice(0,0,-1*E+r);n.splice(n.length- 1,1);I=-1*n[0]+r;l=I+l-O;p--}}d[d.length]=k}A=!1;h=e.calcActiveOffset(u,k,n,O,p,G,z[v],v);I=(h+p+G)%G;u.snapToChildren&&(u.infiniteSlider?I!=ba[v]&&(A=!0):h!=z[v]&&(A=!0),0>D&&!A?(h++,h>=x.length&&!u.infiniteSlider&&(h=x.length-1)):0<D&&!A&&(h--,0>h&&!u.infiniteSlider&&(h=0)));if(u.snapToChildren||(k>-1*m[v]||k<-1*s[v])&&!u.infiniteSlider){(k>-1*m[v]||k<-1*s[v])&&!u.infiniteSlider?d.splice(0,d.length):(d.splice(0.1*d.length,d.length),k=0<d.length?d[d.length-1]:k);for(;k<n[h]-0.5||k>n[h]+0.5;)k=(k- n[h])*snapFrictionCoefficient+n[h],d[d.length]=k;d[d.length]=n[h]}D=1;0!=d.length%2&&(D=0);for(k=0;k<c.length;k++)clearTimeout(c[k]);p=(h+p+G)%G;I=0;for(k=D;k<d.length;k+=2)if(k==D||1<Math.abs(d[k]-I)||k>=d.length-2)I=d[k],c[c.length]=e.slowScrollHorizontalIntervalTimer(10*k,a,g,d[k],f,N,O,L,K,t,h,w,x,q,G,y,v,r,p,u);I=(h+B[v]+G)%G;""!=u.onSlideComplete&&1<d.length&&(c[c.length]=e.onSlideCompleteTimer(10*(k+1),u,a,b(a).children(":eq("+I+")"),p,v));$[v]=c;e.hideScrollbar(u,c,k,d,f,N,O,K,t,v)},onSlideComplete:function(a, g,c,f,h){c=new e.args("complete",a,b(g),c,f,f);b(g).parent().data("args",c);if(""!=a.onSlideComplete)a.onSlideComplete(c)},getSliderOffset:function(a,e){var c=0;e="x"==e?4:5;if(!ea||aa||X)c=parseInt(b(a).css("left"),10);else{for(var c=["-webkit-transform","-moz-transform","transform"],f,h=0;h<c.length;h++)if(void 0!=b(a).css(c[h])&&0<b(a).css(c[h]).length){f=b(a).css(c[h]).split(",");break}c=void 0==f[e]?0:parseInt(f[e],10)}return c},setSliderOffset:function(a,e){e=parseInt(e,10);!ea||aa||X?b(a).css({left:e+ "px"}):b(a).css({webkitTransform:"matrix(1,0,0,1,"+e+",0)",MozTransform:"matrix(1,0,0,1,"+e+",0)",transform:"matrix(1,0,0,1,"+e+",0)"})},setBrowserInfo:function(){null!=navigator.userAgent.match("WebKit")?(ia="-webkit-grab",sa="-webkit-grabbing"):null!=navigator.userAgent.match("Gecko")?(ha=!0,ia="move",sa="-moz-grabbing"):null!=navigator.userAgent.match("MSIE 7")?oa=aa=!0:null!=navigator.userAgent.match("MSIE 8")?oa=X=!0:null!=navigator.userAgent.match("MSIE 9")&&(oa=!0)},has3DTransform:function(){var a= !1,e=b("<div />").css({webkitTransform:"matrix(1,1,1,1,1,1)",MozTransform:"matrix(1,1,1,1,1,1)",transform:"matrix(1,1,1,1,1,1)"});""==e.attr("style")?a=!1:ha&&!za&&21<=parseInt(navigator.userAgent.split("/")[3],10)?a=!1:void 0!=e.attr("style")&&(a=!0);return a},getSlideNumber:function(b,e,c){return(b-B[e]+c)%c},calcActiveOffset:function(b,e,c,f,h,d,m,s){h=!1;b=[];var z;e>c[0]&&(z=0);e<c[c.length-1]&&(z=d-1);for(d=0;d<c.length;d++)c[d]<=e&&c[d]>e-f&&(h||c[d]==e||(b[b.length]=c[d-1]),b[b.length]=c[d], h=!0);0==b.length&&(b[0]=c[c.length-1]);for(d=h=0;d<b.length;d++)m=Math.abs(e-b[d]),m<f&&(h=b[d],f=m);for(d=0;d<c.length;d++)h==c[d]&&(z=d);return z},changeSlide:function(a,g,c,f,h,d,m,s,L,K,t,w,x,y,v,q,G,p){e.autoSlidePause(y);for(var n=0;n<f.length;n++)clearTimeout(f[n]);var r=Math.ceil(p.autoSlideTransTimer/10)+1,u=e.getSliderOffset(g,"x"),k=w[a],D=k-u;if(p.infiniteSlider)for(a=(a-B[y]+2*q)%q,n=!1,0==a&&2==q&&(a=q,w[a]=w[a-1]-b(c).eq(0).outerWidth(!0),n=!0),k=w[a],D=k-u,k=[w[a]-b(g).width(),w[a]+ b(g).width()],n&&w.splice(w.length-1,1),n=0;n<k.length;n++)Math.abs(k[n]-u)<Math.abs(D)&&(D=k[n]-u);var k=[],A;e.showScrollbar(p,h);for(n=0;n<=r;n++)A=n,A/=r,A--,A=u+D*(Math.pow(A,5)+1),k[k.length]=A;r=(a+B[y]+q)%q;for(n=u=0;n<k.length;n++){if(0==n||1<Math.abs(k[n]-u)||n>=k.length-2)u=k[n],f[n]=e.slowScrollHorizontalIntervalTimer(10*(n+1),g,c,k[n],h,d,m,s,L,K,a,t,w,v,q,x,y,G,r,p);0==n&&""!=p.onSlideStart&&(D=(z[y]+B[y]+q)%q,p.onSlideStart(new e.args("start",p,g,b(g).children(":eq("+D+")"),D,a)))}u= !1;p.infiniteSlider?r!=ba[y]&&(u=!0):a!=z[y]&&(u=!0);u&&""!=p.onSlideComplete&&(f[f.length]=e.onSlideCompleteTimer(10*(n+1),p,g,b(g).children(":eq("+r+")"),r,y));$[y]=f;e.hideScrollbar(p,f,n,k,h,d,m,L,K,y);e.autoSlide(g,c,f,h,d,m,s,L,K,t,w,x,y,v,q,G,p)},autoSlide:function(b,g,c,f,h,d,m,s,L,K,t,w,x,y,v,q,G){if(!J[x].autoSlide)return!1;e.autoSlidePause(x);ja[x]=setTimeout(function(){!G.infiniteSlider&&z[x]>t.length-1&&(z[x]-=v);e.changeSlide((z[x]+B[x]+t.length+1)%t.length,b,g,c,f,h,d,m,s,L,K,t,w,x, y,v,q,G);e.autoSlide(b,g,c,f,h,d,m,s,L,K,t,w,x,y,v,q,G)},G.autoSlideTimer+G.autoSlideTransTimer)},autoSlidePause:function(b){clearTimeout(ja[b])},isUnselectable:function(a,e){return""!=e.unselectableSelector&&1==b(a).closest(e.unselectableSelector).length?!0:!1},slowScrollHorizontalIntervalTimer:function(b,g,c,f,h,d,m,s,z,B,t,w,x,y,v,q,G,p,n,r){return setTimeout(function(){e.slowScrollHorizontalInterval(g,c,f,h,d,m,s,z,B,t,w,x,y,v,q,G,p,n,r)},b)},onSlideCompleteTimer:function(b,g,c,f,h,d){return setTimeout(function(){e.onSlideComplete(g, c,f,h,d)},b)},hideScrollbarIntervalTimer:function(b,g,c,f,h,d,m,s,z,B){return setTimeout(function(){e.hideScrollbarInterval(g,c,f,h,d,m,s,z,B)},b)},args:function(a,g,c,f,h,d){this.prevSlideNumber=void 0==b(c).parent().data("args")?void 0:b(c).parent().data("args").prevSlideNumber;this.prevSlideObject=void 0==b(c).parent().data("args")?void 0:b(c).parent().data("args").prevSlideObject;this.targetSlideNumber=d+1;this.targetSlideObject=b(c).children(":eq("+d+")");this.slideChanged=!1;"load"==a?this.targetSlideObject= this.targetSlideNumber=void 0:"start"==a?this.targetSlideObject=this.targetSlideNumber=void 0:"change"==a?(this.slideChanged=!0,this.prevSlideNumber=void 0==b(c).parent().data("args")?g.startAtSlide:b(c).parent().data("args").currentSlideNumber,this.prevSlideObject=b(c).children(":eq("+this.prevSlideNumber+")")):"complete"==a&&(this.slideChanged=b(c).parent().data("args").slideChanged);this.settings=g;this.data=b(c).parent().data("iosslider");this.sliderObject=c;this.sliderContainerObject=b(c).parent(); this.currentSlideObject=f;this.currentSlideNumber=h+1;this.currentSliderOffset=-1*e.getSliderOffset(c,"x")},preventDrag:function(b){b.preventDefault()},preventClick:function(b){b.stopImmediatePropagation();return!1},enableClick:function(){return!0}};e.setBrowserInfo();var V={init:function(a,g){ea=e.has3DTransform();var c=b.extend(!0,{elasticPullResistance:0.6,frictionCoefficient:0.92,elasticFrictionCoefficient:0.6,snapFrictionCoefficient:0.92,snapToChildren:!1,snapSlideCenter:!1,startAtSlide:1,scrollbar:!1, scrollbarDrag:!1,scrollbarHide:!0,scrollbarLocation:"top",scrollbarContainer:"",scrollbarOpacity:0.4,scrollbarHeight:"4px",scrollbarBorder:"0",scrollbarMargin:"5px",scrollbarBackground:"#000",scrollbarBorderRadius:"100px",scrollbarShadow:"0 0 0 #000",scrollbarElasticPullResistance:0.9,desktopClickDrag:!1,keyboardControls:!1,tabToAdvance:!1,responsiveSlideContainer:!0,responsiveSlides:!0,navSlideSelector:"",navPrevSelector:"",navNextSelector:"",autoSlideToggleSelector:"",autoSlide:!1,autoSlideTimer:5E3, autoSlideTransTimer:750,autoSlideHoverPause:!0,infiniteSlider:!1,snapVelocityThreshold:5,slideStartVelocityThreshold:0,horizontalSlideLockThreshold:5,verticalSlideLockThreshold:3,stageCSS:{position:"relative",top:"0",left:"0",overflow:"hidden",zIndex:1},unselectableSelector:"",onSliderLoaded:"",onSliderUpdate:"",onSliderResize:"",onSlideStart:"",onSlideChange:"",onSlideComplete:""},a);void 0==g&&(g=this);return b(g).each(function(a){function g(){e.autoSlidePause(d);va=b(F).find("a");ja=b(F).find("[onclick]"); pa=b(F).find("*");b(n).css("width","");b(n).css("height","");b(F).css("width","");C=b(F).children().not("script").get();ga=[];M=[];c.responsiveSlides&&b(C).css("width","");s[d]=0;l=[];q=b(n).parent().width();r=b(n).outerWidth(!0);c.responsiveSlideContainer&&(r=b(n).outerWidth(!0)>q?q:b(n).width());b(n).css({position:c.stageCSS.position,top:c.stageCSS.top,left:c.stageCSS.left,overflow:c.stageCSS.overflow,zIndex:c.stageCSS.zIndex,webkitPerspective:1E3,webkitBackfaceVisibility:"hidden",msTouchAction:"pan-y", width:r});b(c.unselectableSelector).css({cursor:"default"});for(var a=0;a<C.length;a++){ga[a]=b(C[a]).width();M[a]=b(C[a]).outerWidth(!0);var h=M[a];c.responsiveSlides&&(M[a]>r?(h=r+-1*(M[a]-ga[a]),ga[a]=h,M[a]=r):h=ga[a],b(C[a]).css({width:h}));b(C[a]).css({webkitBackfaceVisibility:"hidden",overflow:"hidden",position:"absolute"});l[a]=-1*s[d];s[d]=s[d]+h+(M[a]-ga[a])}c.snapSlideCenter&&(p=0.5*(r-M[0]),c.responsiveSlides&&M[0]>r&&(p=0));ua[d]=2*s[d];for(a=0;a<C.length;a++)e.setSliderOffset(b(C[a]), -1*l[a]+s[d]+p),l[a]-=s[d];if(!c.infiniteSlider&&!c.snapSlideCenter){for(a=0;a<l.length&&!(l[a]<=-1*(2*s[d]-r));a++)ha=a;l.splice(ha+1,l.length);l[l.length]=-1*(2*s[d]-r)}for(a=0;a<l.length;a++)E[a]=l[a];I&&(J[d].startAtSlide=J[d].startAtSlide>l.length?l.length:J[d].startAtSlide,c.infiniteSlider?(J[d].startAtSlide=(J[d].startAtSlide-1+H)%H,z[d]=J[d].startAtSlide):(J[d].startAtSlide=0>J[d].startAtSlide-1?l.length-1:J[d].startAtSlide,z[d]=J[d].startAtSlide-1),ba[d]=z[d]);m[d]=s[d]+p;b(F).css({position:"relative", cursor:ia,webkitPerspective:"0",webkitBackfaceVisibility:"hidden",width:s[d]+"px"});R=s[d];s[d]=2*s[d]-r+2*p;(Y=R<r||0==r?!0:!1)&&b(F).css({cursor:"default"});G=b(n).parent().outerHeight(!0);u=b(n).height();c.responsiveSlideContainer&&(u=u>G?G:u);b(n).css({height:u});e.setSliderOffset(F,l[z[d]]);if(c.infiniteSlider&&!Y){a=e.getSliderOffset(b(F),"x");for(h=-1*((B[d]+H)%H);0>h;){var f=0,A=e.getSliderOffset(b(C[0]),"x");b(C).each(function(b){e.getSliderOffset(this,"x")<A&&(A=e.getSliderOffset(this,"x"), f=b)});var L=m[d]+R;e.setSliderOffset(b(C)[f],L);m[d]=-1*l[1]+p;s[d]=m[d]+R-r;l.splice(0,1);l.splice(l.length,0,-1*L+p);h++}for(;0<-1*l[0]-R+p&&c.snapSlideCenter&&I;){var O=0,P=e.getSliderOffset(b(C[0]),"x");b(C).each(function(b){e.getSliderOffset(this,"x")>P&&(P=e.getSliderOffset(this,"x"),O=b)});L=m[d]-M[O];e.setSliderOffset(b(C)[O],L);l.splice(0,0,-1*L+p);l.splice(l.length-1,1);m[d]=-1*l[0]+p;s[d]=m[d]+R-r;B[d]--;z[d]++}for(;a<=-1*s[d];)f=0,A=e.getSliderOffset(b(C[0]),"x"),b(C).each(function(b){e.getSliderOffset(this, "x")<A&&(A=e.getSliderOffset(this,"x"),f=b)}),L=m[d]+R,e.setSliderOffset(b(C)[f],L),m[d]=-1*l[1]+p,s[d]=m[d]+R-r,l.splice(0,1),l.splice(l.length,0,-1*L+p),B[d]++,z[d]--}e.setSliderOffset(F,l[z[d]]);c.desktopClickDrag||b(F).css({cursor:"default"});c.scrollbar&&(b("."+K).css({margin:c.scrollbarMargin,overflow:"hidden",display:"none"}),b("."+K+" ."+t).css({border:c.scrollbarBorder}),k=parseInt(b("."+K).css("marginLeft"))+parseInt(b("."+K).css("marginRight")),D=parseInt(b("."+K+" ."+t).css("borderLeftWidth"), 10)+parseInt(b("."+K+" ."+t).css("borderRightWidth"),10),y=""!=c.scrollbarContainer?b(c.scrollbarContainer).width():r,v=r/R*(y-k),c.scrollbarHide||(V=c.scrollbarOpacity),b("."+K).css({position:"absolute",left:0,width:y-k+"px",margin:c.scrollbarMargin}),"top"==c.scrollbarLocation?b("."+K).css("top","0"):b("."+K).css("bottom","0"),b("."+K+" ."+t).css({borderRadius:c.scrollbarBorderRadius,background:c.scrollbarBackground,height:c.scrollbarHeight,width:v-D+"px",minWidth:c.scrollbarHeight,border:c.scrollbarBorder, webkitPerspective:1E3,webkitBackfaceVisibility:"hidden",position:"relative",opacity:V,filter:"alpha(opacity:"+100*V+")",boxShadow:c.scrollbarShadow}),e.setSliderOffset(b("."+K+" ."+t),Math.floor((-1*l[z[d]]-m[d]+p)/(s[d]-m[d]+p)*(y-k-v))),b("."+K).css({display:"block"}),w=b("."+K+" ."+t),x=b("."+K));c.scrollbarDrag&&!Y&&b("."+K+" ."+t).css({cursor:ia});c.infiniteSlider&&(S=(s[d]+r)/3);""!=c.navSlideSelector&&b(c.navSlideSelector).each(function(a){b(this).css({cursor:"pointer"});b(this).unbind(Q).bind(Q, function(g){"touchstart"==g.type?b(this).unbind("click.iosSliderEvent"):b(this).unbind("touchstart.iosSliderEvent");Q=g.type+".iosSliderEvent";e.changeSlide(a,F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c)})});""!=c.navPrevSelector&&(b(c.navPrevSelector).css({cursor:"pointer"}),b(c.navPrevSelector).unbind(Q).bind(Q,function(a){"touchstart"==a.type?b(this).unbind("click.iosSliderEvent"):b(this).unbind("touchstart.iosSliderEvent");Q=a.type+".iosSliderEvent";a=(z[d]+B[d]+H)%H;(0<a||c.infiniteSlider)&&e.changeSlide(a- 1,F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c)}));""!=c.navNextSelector&&(b(c.navNextSelector).css({cursor:"pointer"}),b(c.navNextSelector).unbind(Q).bind(Q,function(a){"touchstart"==a.type?b(this).unbind("click.iosSliderEvent"):b(this).unbind("touchstart.iosSliderEvent");Q=a.type+".iosSliderEvent";a=(z[d]+B[d]+H)%H;(a<l.length-1||c.infiniteSlider)&&e.changeSlide(a+1,F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c)}));c.autoSlide&&!Y&&""!=c.autoSlideToggleSelector&&(b(c.autoSlideToggleSelector).css({cursor:"pointer"}),b(c.autoSlideToggleSelector).unbind(Q).bind(Q, function(a){"touchstart"==a.type?b(this).unbind("click.iosSliderEvent"):b(this).unbind("touchstart.iosSliderEvent");Q=a.type+".iosSliderEvent";wa?(e.autoSlide(F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c),wa=!1,b(c.autoSlideToggleSelector).removeClass("on")):(e.autoSlidePause(d),wa=!0,b(c.autoSlideToggleSelector).addClass("on"))}));e.autoSlide(F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c);b(n).bind("mouseleave.iosSliderEvent",function(){e.autoSlide(F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c)});b(n).bind("touchend.iosSliderEvent", function(){e.autoSlide(F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c)});c.autoSlideHoverPause&&b(n).bind("mouseenter.iosSliderEvent",function(){e.autoSlidePause(d)});b(n).data("iosslider",{obj:Aa,settings:c,scrollerNode:F,slideNodes:C,numberOfSlides:H,centeredSlideOffset:p,sliderNumber:d,originalOffsets:E,childrenOffsets:l,sliderMax:s[d],scrollbarClass:t,scrollbarWidth:v,scrollbarStageWidth:y,stageWidth:r,scrollMargin:k,scrollBorder:D,infiniteSliderOffset:B[d],infiniteSliderWidth:S,slideNodeOuterWidths:M});I= !1;return!0}na++;var d=na,N=[];J[d]=b.extend({},c);m[d]=0;s[d]=0;var O=[0,0],L=[0,0],K="scrollbarBlock"+na,t="scrollbar"+na,w,x,y,v,q,G,p=0,n=b(this),r,u,k,D,A,I=!0;a=-1;var l,E=[],V=0,P=0,ea=0,F=b(this).children(":first-child"),C,ga,M,H=b(F).children().not("script").length,U=!1,ha=0,xa=!1,qa=void 0,S;B[d]=0;var Y=!1,wa=!1;ta[d]=!1;var Z,ra=!1,ka=!1,Q="touchstart.iosSliderEvent click.iosSliderEvent",R,va,ja,pa;fa[d]=!1;$[d]=[];c.scrollbarDrag&&(c.scrollbar=!0,c.scrollbarHide=!1);var Aa=b(this);if(void 0!= Aa.data("iosslider"))return!0;b(this).find("img").bind("dragstart.iosSliderEvent",function(b){b.preventDefault()});c.infiniteSlider&&(c.scrollbar=!1);c.infiniteSlider&&1==H&&(c.infiniteSlider=!1);c.scrollbar&&(""!=c.scrollbarContainer?b(c.scrollbarContainer).append("<div class = '"+K+"'><div class = '"+t+"'></div></div>"):b(F).parent().append("<div class = '"+K+"'><div class = '"+t+"'></div></div>"));if(!g())return!0;b(this).find("a").bind("mousedown",e.preventDrag);b(this).find("[onclick]").bind("click", e.preventDrag).each(function(){b(this).data("onclick",this.onclick)});a=e.calcActiveOffset(c,e.getSliderOffset(b(F),"x"),l,r,B[d],H,void 0,d);a=(a+B[d]+H)%H;a=new e.args("load",c,F,b(F).children(":eq("+a+")"),a,a);b(n).data("args",a);if(""!=c.onSliderLoaded)c.onSliderLoaded(a);if(J[d].responsiveSlides||J[d].responsiveSlideContainer)a=Ba?"orientationchange":"resize",b(window).bind(a+".iosSliderEvent-"+d,function(){if(!g())return!0;var a=b(n).data("args");if(""!=c.onSliderResize)c.onSliderResize(a)}); !c.keyboardControls&&!c.tabToAdvance||Y||b(document).bind("keydown.iosSliderEvent",function(b){aa||X||(b=b.originalEvent);if(37==b.keyCode&&c.keyboardControls)b.preventDefault(),b=(z[d]+B[d]+H)%H,(0<b||c.infiniteSlider)&&e.changeSlide(b-1,F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c);else if(39==b.keyCode&&c.keyboardControls||9==b.keyCode&&c.tabToAdvance)b.preventDefault(),b=(z[d]+B[d]+H)%H,(b<l.length-1||c.infiniteSlider)&&e.changeSlide(b+1,F,C,N,t,v,r,y,k,D,E,l,M,d,S,H,p,c)});if(za||c.desktopClickDrag){var ca= !1,la=b(F),ma=b(F),ya=!1;c.scrollbarDrag&&(la=la.add(w),ma=ma.add(x));b(la).bind("mousedown.iosSliderEvent touchstart.iosSliderEvent",function(a){if(ca)return!0;ca=!0;"touchstart"==a.type?b(ma).unbind("mousedown.iosSliderEvent"):b(ma).unbind("touchstart.iosSliderEvent");if(fa[d]||Y||(ya=e.isUnselectable(a.target,c)))return U=ca=!1,!0;Z=b(this)[0]===b(w)[0]?w:F;aa||X||(a=a.originalEvent);e.autoSlidePause(d);pa.unbind(".disableClick");if("touchstart"==a.type)eventX=a.touches[0].pageX,eventY=a.touches[0].pageY; else{if(window.getSelection)window.getSelection().empty?window.getSelection().empty():window.getSelection().removeAllRanges&&window.getSelection().removeAllRanges();else if(document.selection)if(X)try{document.selection.empty()}catch(g){}else document.selection.empty();eventX=a.pageX;eventY=a.pageY;xa=!0;qa=F;b(this).css({cursor:sa})}O=[0,0];L=[0,0];W=0;U=!1;for(a=0;a<N.length;a++)clearTimeout(N[a]);a=e.getSliderOffset(F,"x");a>-1*m[d]+p+R?(a=-1*m[d]+p+R,e.setSliderOffset(b("."+t),a),b("."+t).css({width:v- D+"px"})):a<-1*s[d]&&(e.setSliderOffset(b("."+t),y-k-v),b("."+t).css({width:v-D+"px"}));a=b(this)[0]===b(w)[0]?m[d]:0;P=-1*(e.getSliderOffset(this,"x")-eventX-a);e.getSliderOffset(this,"y");O[1]=eventX;L[1]=eventY;ka=!1});b(ma).bind("touchmove.iosSliderEvent mousemove.iosSliderEvent",function(a){aa||X||(a=a.originalEvent);if(fa[d]||Y||ya)return!0;var g=0;if("touchmove"==a.type)eventX=a.touches[0].pageX,eventY=a.touches[0].pageY;else{if(window.getSelection)window.getSelection().empty||window.getSelection().removeAllRanges&& window.getSelection().removeAllRanges();else if(document.selection)if(X)try{document.selection.empty()}catch(h){}else document.selection.empty();eventX=a.pageX;eventY=a.pageY;if(!xa||!oa&&("undefined"!=typeof a.webkitMovementX||"undefined"!=typeof a.webkitMovementY)&&0===a.webkitMovementY&&0===a.webkitMovementX)return!0}O[0]=O[1];O[1]=eventX;W=(O[1]-O[0])/2;L[0]=L[1];L[1]=eventY;da=(L[1]-L[0])/2;if(!U){var f=(z[d]+B[d]+H)%H,f=new e.args("start",c,F,b(F).children(":eq("+f+")"),f,void 0);b(n).data("args", f);if(""!=c.onSlideStart)c.onSlideStart(f)}(da>c.verticalSlideLockThreshold||da<-1*c.verticalSlideLockThreshold)&&"touchmove"==a.type&&!U&&(ra=!0);(W>c.horizontalSlideLockThreshold||W<-1*c.horizontalSlideLockThreshold)&&"touchmove"==a.type&&a.preventDefault();if(W>c.slideStartVelocityThreshold||W<-1*c.slideStartVelocityThreshold)U=!0;if(U&&!ra){var f=e.getSliderOffset(F,"x"),q=b(Z)[0]===b(w)[0]?m[d]:p,u=b(Z)[0]===b(w)[0]?(m[d]-s[d]-p)/(y-k-v):1,x=b(Z)[0]===b(w)[0]?c.scrollbarElasticPullResistance: c.elasticPullResistance,G=c.snapSlideCenter&&b(Z)[0]===b(w)[0]?0:p,K=c.snapSlideCenter&&b(Z)[0]===b(w)[0]?p:0;"touchmove"==a.type&&(ea!=a.touches.length&&(P=-1*f+eventX),ea=a.touches.length);if(c.infiniteSlider){if(f<=-1*s[d]){var I=b(F).width();if(f<=-1*ua[d]){var J=-1*E[0];b(C).each(function(a){e.setSliderOffset(b(C)[a],J+p);a<l.length&&(l[a]=-1*J);J+=M[a]});P-=-1*l[0];m[d]=-1*l[0]+p;s[d]=m[d]+I-r;B[d]=0}else{var N=0,S=e.getSliderOffset(b(C[0]),"x");b(C).each(function(b){e.getSliderOffset(this, "x")<S&&(S=e.getSliderOffset(this,"x"),N=b)});x=m[d]+I;e.setSliderOffset(b(C)[N],x);m[d]=-1*l[1]+p;s[d]=m[d]+I-r;l.splice(0,1);l.splice(l.length,0,-1*x+p);B[d]++}}if(f>=-1*m[d]||0<=f)if(I=b(F).width(),0<=f)for(J=-1*E[0],b(C).each(function(a){e.setSliderOffset(b(C)[a],J+p);a<l.length&&(l[a]=-1*J);J+=M[a]}),P+=-1*l[0],m[d]=-1*l[0]+p,s[d]=m[d]+I-r,B[d]=H;0<-1*l[0]-I+p;){var Q=0,R=e.getSliderOffset(b(C[0]),"x");b(C).each(function(b){e.getSliderOffset(this,"x")>R&&(R=e.getSliderOffset(this,"x"),Q=b)}); x=m[d]-M[Q];e.setSliderOffset(b(C)[Q],x);l.splice(0,0,-1*x+p);l.splice(l.length-1,1);m[d]=-1*l[0]+p;s[d]=m[d]+I-r;B[d]--;z[d]++}else Q=0,R=e.getSliderOffset(b(C[0]),"x"),b(C).each(function(b){e.getSliderOffset(this,"x")>R&&(R=e.getSliderOffset(this,"x"),Q=b)}),x=m[d]-M[Q],e.setSliderOffset(b(C)[Q],x),l.splice(0,0,-1*x+p),l.splice(l.length-1,1),m[d]=-1*l[0]+p,s[d]=m[d]+I-r,B[d]--}else I=b(F).width(),f>-1*m[d]+p&&(g=-1*(m[d]+-1*(P-q-eventX+G)*u-q)*x/u),f<-1*s[d]&&(g=-1*(s[d]+K+-1*(P-q-eventX)*u-q)* x/u);e.setSliderOffset(F,-1*(P-q-eventX-g)*u-q+K);c.scrollbar&&(e.showScrollbar(c,t),T=Math.floor((P-eventX-g-m[d]+G)/(s[d]-m[d]+p)*(y-k-v)*u),f=v,0>=T?(f=v-D- -1*T,e.setSliderOffset(b("."+t),0),b("."+t).css({width:f+"px"})):T>=y-k-D-v?(f=y-k-D-T,e.setSliderOffset(b("."+t),T),b("."+t).css({width:f+"px"})):e.setSliderOffset(b("."+t),T));"touchmove"==a.type&&(A=a.touches[0].pageX);a=!1;g=e.calcActiveOffset(c,-1*(P-eventX-g),l,r,B[d],H,void 0,d);f=(g+B[d]+H)%H;c.infiniteSlider?f!=ba[d]&&(a=!0):g!=z[d]&& (a=!0);if(a&&(z[d]=g,ba[d]=f,ka=!0,f=new e.args("change",c,F,b(F).children(":eq("+f+")"),f,f),b(n).data("args",f),""!=c.onSlideChange))c.onSlideChange(f)}ca=!1});a=b(window);if(X||aa)a=b(document);b(la).bind("touchend.iosSliderEvent",function(b){b=b.originalEvent;if(fa[d]||Y||ya)return!0;if(0!=b.touches.length)for(var a=0;a<b.touches.length;a++)b.touches[a].pageX==A&&e.slowScrollHorizontal(F,C,N,t,W,da,v,r,y,k,D,E,l,M,d,S,H,Z,ka,p,c);else e.slowScrollHorizontal(F,C,N,t,W,da,v,r,y,k,D,E,l,M,d,S,H, Z,ka,p,c);ca=ra=!1});b(a).bind("mouseup.iosSliderEvent-"+d,function(a){U?va.unbind("click.disableClick").bind("click.disableClick",e.preventClick):va.unbind("click.disableClick").bind("click.disableClick",e.enableClick);ja.each(function(){this.onclick=function(a){if(U)return!1;b(this).data("onclick").call(this,a||window.event)};this.onclick=b(this).data("onclick")});1.8<=parseFloat(b().jquery)?pa.each(function(){var a=b._data(this,"events");if(void 0!=a&&void 0!=a.click&&"iosSliderEvent"!=a.click[0].namespace){if(!U)return!1; b(this).one("click.disableClick",e.preventClick);var a=b._data(this,"events").click,c=a.pop();a.splice(0,0,c)}}):1.6<=parseFloat(b().jquery)&&pa.each(function(){var a=b(this).data("events");if(void 0!=a&&void 0!=a.click&&"iosSliderEvent"!=a.click[0].namespace){if(!U)return!1;b(this).one("click.disableClick",e.preventClick);var a=b(this).data("events").click,c=a.pop();a.splice(0,0,c)}});if(!ta[d]){if(Y)return!0;b(la).css({cursor:ia});xa=!1;if(void 0==qa)return!0;e.slowScrollHorizontal(qa,C,N,t,W,da, v,r,y,k,D,E,l,M,d,S,H,Z,ka,p,c);qa=void 0}ca=ra=!1})}})},destroy:function(a,g){void 0==g&&(g=this);return b(g).each(function(){var c=b(this),f=c.data("iosslider");if(void 0==f)return!1;void 0==a&&(a=!0);e.autoSlidePause(f.sliderNumber);ta[f.sliderNumber]=!0;b(window).unbind(".iosSliderEvent-"+f.sliderNumber);b(document).unbind(".iosSliderEvent-"+f.sliderNumber);b(document).unbind("keydown.iosSliderEvent");b(this).unbind(".iosSliderEvent");b(this).children(":first-child").unbind(".iosSliderEvent"); b(this).children(":first-child").children().unbind(".iosSliderEvent");a&&(b(this).attr("style",""),b(this).children(":first-child").attr("style",""),b(this).children(":first-child").children().attr("style",""),b(f.settings.navSlideSelector).attr("style",""),b(f.settings.navPrevSelector).attr("style",""),b(f.settings.navNextSelector).attr("style",""),b(f.settings.autoSlideToggleSelector).attr("style",""),b(f.settings.unselectableSelector).attr("style",""));f.settings.scrollbar&&b(".scrollbarBlock"+ f.sliderNumber).remove();for(var f=$[f.sliderNumber],g=0;g<f.length;g++)clearTimeout(f[g]);c.removeData("iosslider");c.removeData("args")})},update:function(a){void 0==a&&(a=this);return b(a).each(function(){var a=b(this),c=a.data("iosslider");if(void 0==c)return!1;c.settings.startAtSlide=a.data("args").currentSlideNumber;V.destroy(!1,this);1!=c.numberOfSlides&&c.settings.infiniteSlider&&(c.settings.startAtSlide=(z[c.sliderNumber]+1+B[c.sliderNumber]+c.numberOfSlides)%c.numberOfSlides);V.init(c.settings, this);a=new e.args("update",c.settings,c.scrollerNode,b(c.scrollerNode).children(":eq("+(c.settings.startAtSlide-1)+")"),c.settings.startAtSlide-1,c.settings.startAtSlide-1);b(c.stageNode).data("args",a);if(""!=c.settings.onSliderUpdate)c.settings.onSliderUpdate(a)})},addSlide:function(a,e){return this.each(function(){var c=b(this),f=c.data("iosslider");if(void 0==f)return!1;0==b(f.scrollerNode).children().length?(b(f.scrollerNode).append(a),c.data("args").currentSlideNumber=1):f.settings.infiniteSlider? (1==e?b(f.scrollerNode).children(":eq(0)").before(a):b(f.scrollerNode).children(":eq("+(e-2)+")").after(a),-1>B[f.sliderNumber]&&z[f.sliderNumber]--,c.data("args").currentSlideNumber>=e&&z[f.sliderNumber]++):(e<=f.numberOfSlides?b(f.scrollerNode).children(":eq("+(e-1)+")").before(a):b(f.scrollerNode).children(":eq("+(e-2)+")").after(a),c.data("args").currentSlideNumber>=e&&c.data("args").currentSlideNumber++);c.data("iosslider").numberOfSlides++;V.update(this)})},removeSlide:function(a){return this.each(function(){var e= b(this).data("iosslider");if(void 0==e)return!1;b(e.scrollerNode).children(":eq("+(a-1)+")").remove();z[e.sliderNumber]>a-1&&z[e.sliderNumber]--;V.update(this)})},goToSlide:function(a,g){void 0==g&&(g=this);return b(g).each(function(){var c=b(this).data("iosslider");if(void 0==c)return!1;a=a>c.childrenOffsets.length?c.childrenOffsets.length-1:a-1;e.changeSlide(a,b(c.scrollerNode),b(c.slideNodes),$[c.sliderNumber],c.scrollbarClass,c.scrollbarWidth,c.stageWidth,c.scrollbarStageWidth,c.scrollMargin, c.scrollBorder,c.originalOffsets,c.childrenOffsets,c.slideNodeOuterWidths,c.sliderNumber,c.infiniteSliderWidth,c.numberOfSlides,c.centeredSlideOffset,c.settings)})},prevSlide:function(){return this.each(function(){var a=b(this).data("iosslider");if(void 0==a)return!1;var g=(z[a.sliderNumber]+B[a.sliderNumber]+a.numberOfSlides)%a.numberOfSlides;(0<g||a.settings.infiniteSlider)&&e.changeSlide(g-1,b(a.scrollerNode),b(a.slideNodes),$[a.sliderNumber],a.scrollbarClass,a.scrollbarWidth,a.stageWidth,a.scrollbarStageWidth, a.scrollMargin,a.scrollBorder,a.originalOffsets,a.childrenOffsets,a.slideNodeOuterWidths,a.sliderNumber,a.infiniteSliderWidth,a.numberOfSlides,a.centeredSlideOffset,a.settings);z[a.sliderNumber]=g})},nextSlide:function(){return this.each(function(){var a=b(this).data("iosslider");if(void 0==a)return!1;var g=(z[a.sliderNumber]+B[a.sliderNumber]+a.numberOfSlides)%a.numberOfSlides;(g<a.childrenOffsets.length-1||a.settings.infiniteSlider)&&e.changeSlide(g+1,b(a.scrollerNode),b(a.slideNodes),$[a.sliderNumber], a.scrollbarClass,a.scrollbarWidth,a.stageWidth,a.scrollbarStageWidth,a.scrollMargin,a.scrollBorder,a.originalOffsets,a.childrenOffsets,a.slideNodeOuterWidths,a.sliderNumber,a.infiniteSliderWidth,a.numberOfSlides,a.centeredSlideOffset,a.settings);z[a.sliderNumber]=g})},lock:function(){return this.each(function(){var a=b(this).data("iosslider");if(void 0==a)return!1;fa[a.sliderNumber]=!0})},unlock:function(){return this.each(function(){var a=b(this).data("iosslider");if(void 0==a)return!1;fa[a.sliderNumber]= !1})},getData:function(){return this.each(function(){var a=b(this).data("iosslider");return void 0==a?!1:a})},autoSlidePause:function(){return this.each(function(){var a=b(this).data("iosslider");if(void 0==a)return!1;J[a.sliderNumber].autoSlide=!1;e.autoSlidePause(a.sliderNumber);return a})},autoSlidePlay:function(){return this.each(function(){var a=b(this).data("iosslider");if(void 0==a)return!1;J[a.sliderNumber].autoSlide=!0;e.autoSlide(b(a.scrollerNode),b(a.slideNodes),$[a.sliderNumber],a.scrollbarClass, a.scrollbarWidth,a.stageWidth,a.scrollbarStageWidth,a.scrollMargin,a.scrollBorder,a.originalOffsets,a.childrenOffsets,a.slideNodeOuterWidths,a.sliderNumber,a.infiniteSliderWidth,a.numberOfSlides,a.centeredSlideOffset,a.settings);return a})}};b.fn.iosSlider=function(a){if(V[a])return V[a].apply(this,Array.prototype.slice.call(arguments,1));if("object"!==typeof a&&a)b.error("invalid method call!");else return V.init.apply(this,arguments)}})(jQuery);




jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

var sliderHolder = jQuery('.banner-slider-holder');
	var sliderLoader = sliderHolder.find('.loader');
	
	var progress = 0;
	function animateFunc(){
		if(progress > 100){
			return false;
		}
		sliderLoader.html(progress+'%');
		progress+=5;
		setTimeout(animateFunc, 25);
	}
	setTimeout(animateFunc, 25);
	
	function loaded(){
		setTimeout(function(){
		
			img =  jQuery('.banner-slider-container .iosSlider .slider .item img:first');
			height = img.height();
			if(img.parent('a').length){
				height = img.parent('a').outerHeight();
			}
		
			sliderLoader.html('');
			sliderLoader.fadeOut(1500, function(){
				jQuery(this).remove();
				sliderHolder.removeClass('loading').css('height', 'auto');
			});
			
			sliderHolder.animate({
			  height: height
			}, 500, "easeOutExpo");
			
		}, 1000);
	}
	
	jQuery(window).load(function(){
	var slider_container = jQuery('.banner-slider-container');
	var slider_img =  jQuery('.banner-slider-container .iosSlider .slider .item img:first');
	var sliderHeight = slider_img.height();
	if(slider_img.parent('a')){
		sliderHeight = slider_img.parent('a').outerHeight();
	}
	var ratio = Math.round((sliderHeight/slider_img.width())*100);
	slider_container.css({
		'padding-bottom': ratio + '%'
	});
	
  
    jQuery('.iosSlider').iosSlider({
      responsiveSlideWidth: true,
      snapToChildren: true,
      desktopClickDrag: true,
      infiniteSlider: true,
      /* navSlideSelector: '.slideSelectors .button-item', */
      navNextSelector: '.iosSlider .next',
      navPrevSelector: '.iosSlider .prev',
      onSlideComplete: slideComplete,
	  onSliderLoaded: sliderLoaded,
	  onSlideChange: slideChange,
      autoSlide: 1      , autoSlideTimer: 5000	  , autoSlideTransTimer: 750	  , desktopClickDrag: 1	  , infiniteSlider: 0    });
    
	
	function slideChange(args) {
		
	}
	
	function slideComplete(args) {
			/* Slides Animation Presets */
			if(jQuery('.banner-slider-container.boxed-slider').length){
			/* Boxed Slider */
				var slideTitle = [{left: '0%', opacity: '1'}, 400]; // example: Animation settings: left = 50%, opacity = 100%;  Animation speed: 400ms
				var slideTitle2 = [{left: '0%', opacity: '1'}, 600];
				var slideTitle3 = [{left: '0%', opacity: '1'}, 600];
				var slideTitle4 = [{left: '0%', opacity: '1'}, 600];
				var slideText = [{left: '0%', opacity: '1'}, 600];
				var slideList = [{left: '0%', opacity: '1'}, 600];
				/* slide-skin animation type */
				if(args.currentSlideObject.find('.slide-skin').length){
					delete slideTitle[0].left; //delete left animation option
					slideTitle[0].top = '0px'; //add right animation option
					delete slideTitle2[0].left;
					slideTitle2[0].right = '0%';
					delete slideTitle4[0].left;
					slideTitle4[0].right = '0%';
					delete slideText[0].left;
					slideText[0].top = '0px';
					delete slideList[0].left;
					slideList[0].right = '0%';
				}
				/* slide-skin-2 animation type */
				if(args.currentSlideObject.find('.slide-skin-2').length){
					delete slideTitle2[0].left;
					slideTitle2[0].right = '0%';
					delete slideTitle3[0].left;
					slideTitle3[0].bottom = '0px';
					delete slideText[0].left;
					slideText[0].top = '0px';
				}
				/* slide-skin-3 animation type */
				if(args.currentSlideObject.find('.slide-skin-3').length){
					delete slideTitle[0].left;
					slideTitle[0].top = '0px';
					delete slideTitle3[0].left;
					slideTitle3[0].bottom = '0px';
					delete slideText[0].left;
					slideText[0].bottom = '0px';
				}
			}else{
			/* Wide Slider */
				var slideTitle = [{left: '0%', opacity: '1'}, 400]; // example: Animation settings: left = 50%, opacity = 100%;  Animation speed: 400ms
				var slideTitle2 = [{left: '0%', opacity: '1'}, 600];
				var slideTitle3 = [{left: '0%', opacity: '1'}, 600];
				var slideTitle4 = [{left: '0%', opacity: '1'}, 600];
				var slideText = [{left: '0%', opacity: '1'}, 600];
				var slideList = [{left: '0%', opacity: '1'}, 600];
				/* slide-skin animation type */
				if(args.currentSlideObject.find('.slide-skin').length){
					delete slideTitle[0].left; //delete left animation option
					slideTitle[0].top = '0px'; //add right animation option
					delete slideTitle2[0].left;
					slideTitle2[0].right = '0%';
					delete slideTitle4[0].left;
					slideTitle4[0].right = '0%';
					delete slideText[0].left;
					slideText[0].top = '0px';
					delete slideList[0].left;
					slideList[0].right = '0%';
				}
				/* slide-skin-2 animation type */
				if(args.currentSlideObject.find('.slide-skin-2').length){
					delete slideTitle2[0].left;
					slideTitle2[0].right = '0%';
					delete slideTitle3[0].left;
					slideTitle3[0].bottom = '0px';
					delete slideText[0].left;
					slideText[0].top = '0px';
				}
				/* slide-skin-3 animation type */
				if(args.currentSlideObject.find('.slide-skin-3').length){
					delete slideTitle[0].left;
					slideTitle[0].top = '0px';
					delete slideTitle3[0].left;
					slideTitle3[0].bottom = '0px';
					delete slideText[0].left;
					slideText[0].bottom = '0px';
				}
			}
			
			
			/* ============================================ */
			
			
			/* Animation Elements */
			/* ===slide title element=== */
			jQuery(args.sliderObject).find('h2').attr('style', '');
			jQuery(args.currentSlideObject).find('h2').animate(slideTitle[0], slideTitle[1], 'easeOutQuint');
			/* ========================== */
			
			/* ===slide title 2 element=== */
			jQuery(args.sliderObject).find('h3').attr('style', '');
			jQuery(args.currentSlideObject).find('h3').animate(slideTitle2[0], slideTitle2[1], 'easeOutQuint');
			/* ========================== */
			
			/* ===slide title 3 element=== */
			jQuery(args.sliderObject).find('h4').attr('style', '');
			jQuery(args.currentSlideObject).find('h4').animate(slideTitle3[0], slideTitle3[1], 'easeOutQuint');
			/* ========================== */
			
			/* ===slide title 4 element=== */
			jQuery(args.sliderObject).find('h5').attr('style', '');
			jQuery(args.currentSlideObject).find('h5').animate(slideTitle4[0], slideTitle4[1], 'easeOutQuint');
			/* ========================== */
			
			/* ===slide text element=== */
			jQuery(args.sliderObject).find('p').attr('style', '');
			jQuery(args.currentSlideObject).find('p').animate(slideText[0], slideText[1], 'easeOutQuint');
			/* ========================== */
			
			/* ===slide list element=== */
			jQuery(args.sliderObject).find('ul').attr('style', '');
			jQuery(args.currentSlideObject).find('ul').animate(slideList[0], slideList[1], 'easeOutQuint');
			/* ========================== */
			
			
	  }
	
	function sliderLoaded(args) {
		slideComplete(args);
		slideChange(args);
		loaded();
	}
    
  });