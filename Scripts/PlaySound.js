var autoPlay = false;
var queuedStopAutoplay = false;
var autoPlayTimeoutID;
function toggleAutoplay()
{
    autoPlay = !autoPlay;
    if(autoPlay)
    {
        document.getElementById('autoplaybtn').classList.add('enabled');
        document.getElementById('autoplaybtn').title = "自動播放下段聲音（已開啟）";
    }
    else
    {
        document.getElementById('autoplaybtn').classList.remove('enabled');
        document.getElementById('autoplaybtn').title = "自動播放下段聲音（目前關閉）";
    }
}
var SoundObj = {
    audio : new Audio(),
    endFunc : function(canAutoplay)
    {
        if(!!this.bindEle)
        {
            this.bindEle.classList.remove("playing");
            if(canAutoplay && autoPlay && this.next != null)
            {
                if(queuedStopAutoplay) queuedStopAutoplay = false;
                else
                {
                    autoPlayTimeoutID = window.setTimeout(( () => {PlayOrStopSound(this.next, true);} ), 200);
                    if(zenscroll)
                    {
                        if(isElementFullyInViewport && !isElementFullyInViewport(this.next))
                        {
                            zenscroll.center(this.next);
                        }
                    }
                }
            }
        }
        
    },
    bindEle : null,
    isPlaying : function () {
        /*console.log('isPlaying: curtime= ' + this.audio.currentTime +
            ', paused = ' + this.audio.paused +
            ', ended = ' + this.audio.ended +
            ', readystate = ' + this.audio.readyState);*/
        return this.audio
            && this.audio.currentTime > 0
            && !this.audio.paused
            && !this.audio.ended
            && this.audio.readyState > 2;
    },
    next : null
};
SoundObj.audio.onended = function(){SoundObj.endFunc(true);};
SoundObj.audio.onerror = function(){SoundObj.endFunc(true);};
function StopCurSound()
{
    window.clearTimeout(autoPlayTimeoutID);
    if(SoundObj.isPlaying())
    {
        SoundObj.audio.pause();
        SoundObj.endFunc(false);
    }
}

function PlayOrStopSound(ele, chkAutoplay)
{
    window.clearTimeout(autoPlayTimeoutID);
    if(SoundObj.bindEle === ele && SoundObj.isPlaying())
    {
        SoundObj.audio.pause();
        SoundObj.endFunc(false);
    }
    else
    {
        if(ele.hasAttribute('data-surl'))
        {
            SoundObj.endFunc(false);
            queuedStopAutoplay = SoundObj.isPlaying();
            if(chkAutoplay !== undefined && chkAutoplay)
            {
                SoundObj.next = SoundTxtMap.get(ele);
            }
            else
            {
                SoundObj.next = null;
            }
            ele.classList.add("playing");
            SoundObj.audio.src = "Sviaym/"+ele.getAttribute('data-surl');
            SoundObj.audio.load();
            SoundObj.bindEle = ele;
            SoundObj.audio.play();
            //console.log(ele.getAttribute('data-surl'));
        }
        else
        {
            console.log('Error: no valid data-soundurl in element!');
        }
    }
}
var SoundTxtMap = new Map();
window.addEventListener('load',
    function(e)
    {
        var SoundTxts = document.getElementsByClassName('soundtxt');
        for(var i = 0; i < SoundTxts.length; i++)
        {
            if(i+1<SoundTxts.length)
                SoundTxtMap.set(SoundTxts[i], SoundTxts[i+1]);
            SoundTxts[i].onclick = function()
            {
                PlayOrStopSound(this, true);
            }
        }
    }
);