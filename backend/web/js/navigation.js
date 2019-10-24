/**
 * http://candrews.net/blog/2010/10/introducing-sprymap/
 * Charlie Andrews
 *
 * Instantiate the widget when you want it to turned into a map,
 * probably in the window.onload or $(document).ready() function.
 *
 * Default parameters are listed as the parameters below
 * var map = new spryMap({
 *    // The ID of the element being transformed into a map
 *    id : "",
 *    // The width of the map (in px)
 *    width: 800,
 *    // The height of the map (in px)
 *    height: 800,
 *    // The X value of the starting map position
 *    startX: 0,
 *    // The Y value of the starting map position
 *    startY: 0,
 *    // Boolean true if the map should animate to a stop
 *    scrolling: true,
 *    // The time (in ms) that the above scrolling lasts
 *    scrollTime: 300,
 *    // Boolean true if the map disallows moving past its edges
 *    lockEdges: true,
 *    // The CSS class attached to the wrapping map div
 *    cssClass: ""
 * });
 *
 */


var cD = "url(data:image/x-win-bitmap;base64,AAACAAEAICACAAcABQAwAQAAFgAAACgAAAAgAAAAQAAAAAEAAQAAAAAAAAEAAAAAAAAAAAAAAgAAAAAAAAAAAAAA////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD8AAAA/AAAAfwAAAP+AAAH/gAAB/8AAAH/AAAB/wAAA/0AAANsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//////////////////////////////////////////////////////////////////////////////////////gH///4B///8Af//+AD///AA///wAH//+AB///wAf//4AH//+AD///yT/////////////////////////////8=), default";

var cU = "url(data:image/x-win-bitmap;base64,AAACAAEAICACAAcABQAwAQAAFgAAACgAAAAgAAAAQAAAAAEAAQAAAAAAAAEAAAAAAAAAAAAAAgAAAAAAAAAAAAAA////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD8AAAA/AAAAfwAAAP+AAAH/gAAB/8AAA//AAAd/wAAGf+AAAH9gAADbYAAA2yAAAZsAAAGbAAAAGAAAAAAAAA//////////////////////////////////////////////////////////////////////////////////////gH///4B///8Af//+AD///AA///wAH//4AB//8AAf//AAD//5AA///gAP//4AD//8AF///AB///5A////5///8=), default";

function SpryMap(c) {

    function g(b,e) {
        var d = b, f = e
        if (a.lockEdges) {
            var j = -a.map.offsetWidth+a.viewingBox.offsetWidth,
                k = -a.map.offsetHeight+a.viewingBox.offsetHeight;
            d = d < j ? j : d;
            f = f < k ? k : f;
            d = d > 0 ? 0 : d;
            f = f > 0 ? 0 : f
        }
        a.map.style.left = d + "px";
        a.map.style.top = f + "px"
    }

    function h(b,e,d) {
        if (b.attachEvent) {
            b["e"+e+d] = d;
            b[e+d] = function() {
                b["e"+e+d](window.event)
            };
            b.attachEvent("on"+e,b[e+d])
        } else b.addEventListener(e,d,false)
    }
    function i(b,e) {
        this.x = b;
        this.y = e
    }

    var a = this;
    a.map = document.getElementById(c.id);
    a.width = typeof c.width == "undefined" ? 800 : c.width;
    a.height = typeof c.height == "undefined" ? 800 :c.height;
    a.scrolling = typeof c.scrolling == "undefined" ? true : c.scrolling;
    a.scrollTime = typeof c.scrollTime == "undefined" ? 300 : c.scrollTime;
    a.lockEdges = typeof c.lockEdges == "undefined" ? true : c.lockEdges;
    a.viewingBox = document.createElement("div");
    if (typeof c.cssClass!="undefined") a.viewingBox.className=c.cssClass;
    a.mousePosition=new i;a.mouseLocations=[];
    a.velocity=new i;
    a.mouseDown=false;
    a.timerId=-1;
    a.timerCount=0;
    a.map.parentNode.replaceChild(a.viewingBox,a.map);
    a.viewingBox.appendChild(a.map);
    a.viewingBox.style.overflow="hidden";
    a.viewingBox.style.width=a.width+"px";
    a.viewingBox.style.height=a.height+"px";
    a.viewingBox.style.position="relative";
    a.map.style.position="absolute";
    g(typeof c.startX=="undefined"?0:-c.startX,typeof c.startY=="undefined"?0:-c.startY);

    mouseMove=function(b) {
        var e=b.clientX-a.mousePosition.x+parseInt(a.map.style.left),d=b.clientY-a.mousePosition.y+parseInt(a.map.style.top);
        g(e,d);a.mousePosition.x=b.clientX;
        a.mousePosition.y=b.clientY
    };

    onTimer=function() {
        if(a.mouseDown) {
            a.mouseLocations.unshift(new i(a.mousePosition.x,a.mousePosition.y));
            a.mouseLocations.length > 10 && a.mouseLocations.pop()
        } else {
            var b=a.scrollTime/20,e=a.velocity.y*((b-a.timerCount)/b);
            g(-(a.velocity.x*((b-a.timerCount)/b))+parseInt(a.map.style.left),-e+parseInt(a.map.style.top));
            if(a.timerCount==b) {
                clearInterval(a.timerId);
                a.timerId=-1
            }
            ++a.timerCount
        }
    };

    h (a.viewingBox,"mousedown", function(b) {
        a.timerId!=-1 && a.scrolling && clearInterval(a.timerId);
        a.viewingBox.style.cursor=cD;
        a.mousePosition.x=b.clientX;
        a.mousePosition.y=b.clientY;
        h(document,"mousemove",mouseMove);
        a.mouseDown=true;
        if(a.scrolling) {
            a.timerCount=0;
            a.timerId=setInterval("onTimer()",20)
        }
        b.preventDefault()
    });

    h(document,"mouseup",function() {
        if(a.mouseDown) {
            var b=mouseMove;
            if(document.detachEvent) {
                document.detachEvent("onmousemove",document["mousemove"+b]);
                document["mousemove"+b]=null
            } else document.removeEventListener("mousemove",b,false);a.mouseDown=false;
            if(a.mouseLocations.length>0) {
                b=a.mouseLocations.length;
                a.velocity.x=(a.mouseLocations[b-1].x-a.mouseLocations[0].x)/b;
                a.velocity.y=(a.mouseLocations[b-1].y-a.mouseLocations[0].y)/b;
                a.mouseLocations.length=0
            }
        }
        a.viewingBox.style.cursor=cU
    })
};