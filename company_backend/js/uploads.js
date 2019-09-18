var app = app || {};
// console.log(app);
(function(o){
    "use strict";

    // Private methods
    let ajax, getFormData, setProgress;

    ajax = function(data){
        // console.log(data);
        let xmlHttp = new XMLHttpRequest();
        let uploaded;
        

        xmlHttp.addEventListener('readystatechange', function(){
            // console.log(this.readyState);
            // console.log(this.status);
            if(this.readyState === 4 && this.status === 200){
                // 測試
                // console.log('Ajax request OK');
                // 會return一個JSON格式的array
                // console.log(this.response);

                uploaded = JSON.parse(this.response);
                // console.log(uploaded);
                if(typeof o.options.finished === 'function'){
                    o.options.finished(uploaded);
                }
            }
            else if(typeof o.options.error === 'function' ){
                o.options.error();
            }
        });

        //上傳的事件要用XMLHttpRequest.upload
        xmlHttp.upload.addEventListener('progress', function(e){
            var percent;
            // console.log(e);
            if(percent == 100){
                percent=0;
            };
            if(e.lengthComputable){
                    //4捨5入
                percent = Math.round( (e.loaded/e.total) * 100 );
                console.log(percent);
                setProgress(percent);
            };
        })

        xmlHttp.open( 'post', o.options.processor );
        xmlHttp.send(data);
    };

    getFormData = function(source){
        // console.log(source);
        let data = new FormData();
        let i;

        for(i=0; i<source.length; i++){
            data.append('files[]', source[i]);
        };
        // console.log(data);
        return data;
    };

    setProgress = function(value){

        // console.log(value);
        if(o.options.progressBar !== undefined){
            o.options.progressBar.style.width = value? value+'%': 0;
        };

        if(o.options.progressText !== undefined){
            o.options.progressText.textContent = value? value+'%': '';
        };
    };

    o.upLoader = function(options){
        // console.log(options);
        o.options = options;

        if(options.files !== undefined){
            ajax( getFormData(o.options.files) );
            // getFormData(o.options.files);
        }
    }
}(app));