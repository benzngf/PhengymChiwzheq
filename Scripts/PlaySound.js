var SoundObj = {
    audio : new Audio(),
    endFunc : function()
    {
        if(!!this.bindEle)
        {
            this.bindEle.classList.remove("playing");
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
    }
}
SoundObj.audio.onended = function(){SoundObj.endFunc();};

function PlayOrStopSound(ele)
{
    if(SoundObj.bindEle === ele && SoundObj.isPlaying())
    {
        SoundObj.audio.pause();
        SoundObj.endFunc();
    }
    else
    {
        if(ele.hasAttribute('data-soundurl'))
        {
            SoundObj.endFunc();
            ele.classList.add("playing");
            SoundObj.audio.src = ele.getAttribute('data-soundurl');
            SoundObj.audio.load();
            SoundObj.bindEle = ele;
            SoundObj.audio.play();
        }
        else
        {
            console.log('Error: no valid data-soundurl in element!');
        }
    }
}

window.addEventListener('load',
    function(e)
    {
        var SoundTxts = document.getElementsByClassName('soundtxt');
        for(var i = 0; i < SoundTxts.length; i++)
        {
            SoundTxts[i].onclick = function()
            {
                PlayOrStopSound(this);
            }
        }
    }
);