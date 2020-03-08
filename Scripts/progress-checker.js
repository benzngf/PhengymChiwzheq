function isElementInViewport (el) {
    var inset = 20;
    var rect = el.getBoundingClientRect();
    wh = (window.innerHeight || document.documentElement.clientHeight);
    ww = (window.innerWidth || document.documentElement.clientWidth);
    if(rect.left+inset > ww || rect.right-inset < 0)
    {
        return false;
    }
    if(rect.top+inset > wh || rect.bottom-inset < 0)
    {
        return false;
    }
    return true;
}
function onVisibilityChange(el, isVisible) {
    var navEle = document.getElementById("nav-"+el.id);
    
    if(typeof(navEle) != 'undefined' && navEle != null)
    {
        if(isVisible)
        {
            navEle.classList.add("reading");
            //console.log("reading:"+el.id);
        }
        else
        {
            navEle.classList.remove("reading");
            //console.log("not reading:"+el.id);
        }
    }
}

var chkElements = [];
[].forEach.call(document.getElementsByClassName("chkvis"),function(el)
{
    chkElements.push({ele:el, vis:false});
});
var handler = function()
{
    chkElements.forEach(chkEl => {
        var visible = isElementInViewport(chkEl.ele);
        
        if(visible != chkEl.vis)
        {
            chkEl.vis = visible;
            onVisibilityChange(chkEl.ele, chkEl.vis)
        }
    });
   // console.log("check once for "+chkElements.length+" elements");
}
if (window.addEventListener) {
    addEventListener('DOMContentLoaded', handler, false);
    addEventListener('load', handler, false);
    addEventListener('scroll', handler, false);
    addEventListener('resize', handler, false);
} else if (window.attachEvent)  {
    attachEvent('onDOMContentLoaded', handler); // Internet Explorer 9+ :(
    attachEvent('onload', handler);
    attachEvent('onscroll', handler);
    attachEvent('onresize', handler);
}